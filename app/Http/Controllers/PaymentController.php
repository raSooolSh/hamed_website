<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function payment(Course $course, Request $request)
    {
        $request->validate([
            'course' => ['required', 'exists:courses,id'],
            'discount' => ['nullable', 'exists:discounts,code']
        ]);

        if (!is_null($request->discount)) {
            $discount = Discount::where('code', $request->discount)->first();
            if (!is_null($discount->users)) {
                $users = mb_split('\*', $discount->users);
            }
        }

        if (isset($discount) && $discount->expire_at < now()) {
            return redirect()->back()->with('toast', ['error' =>  'کد تخفیف منقضی شده است']);
        } elseif (isset($users) && !in_array(auth()->user()->phone_number, $users)) {
            return redirect()->back()->with('toast', ['error' =>  "شما مجاز به استفاده از این کد تخفیف نیستید"]);
        }

        if (isset($discount)) {
            if ($discount->getRawOriginal('type') == 'percent') {
                $payment_price = $course->price - ($course->price / 100) * $discount->value;
            } elseif ($discount->getRawOriginal('type') == 'value') {
                $payment_price = $course->price - $discount->value;
            }
        } else {
            if (!is_null($course->discount_off) && $course->discount_expire_at > now()) {
                $payment_price = $course->price - $course->discount_off;
            } else {
                $payment_price = $course->price;
            }
        };

        // $payment_price
        $data = array(
            'merchant_id' => env('GATEWAY_API'),
            'amount' => 10000,
            'callback_url' => route('payment_verify', ['course' => $course->slug]),
            'description' => 'خرید دوره آموزشی ' . $course->name_fa
        );


        $result = Http::withUserAgent('ZarinPal Rest Api v1')->contentType('application/json')->asJson()->post('https://api.zarinpal.com/pg/v4/payment/request.json', $data);
        dd($result->json());
        if ($result->failed()) {
            $msg = 'در برقراری ارتباط با درگاه پرداخت خطایی رخ داده لطفا دوباره تلاش کنید.';
            return redirect()->back()->with('toast', ['error' =>  $msg]);
        } else {
            $result = $result->json()['data'];
            if ($result["code"] == 100) {

                Transaction::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => $course->id,
                    'course_price' => $course->price,
                    'payment_price' => $payment_price,
                    'discount_code' => $request->discount,
                    'token' => $result["authority"],
                    'description' => null,
                    'gateway_name' => env('GATEWAY_NAME')
                ]);


                return redirect()->to('https://www.zarinpal.com/pg/StartPay/' . $result["authority"]);
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }
    }





    // verify payment -------------------------------------------------

    public function verify(Course $course, Request $request)
    {
        $MerchantID = env('GATEWAY_API');


        $Authority = $request->Authority;

        $transaction = Transaction::where('token', $request->Authority)->first();

        $data = [
            'merchant_id' => $MerchantID,
            'authority' => $Authority,
            'amount' => 10000
        ];
        // $transaction->payment_price

        $result = Http::withUserAgent('ZarinPal Rest Api v1')->contentType('application/json')->asJson()->post('https://api.zarinpal.com/pg/v4/payment/verify.json', $data)->json();

        if ($result->failed()) {

        //             [▼
        //   "data" => []
        //   "errors" => array:3 [▶
        //     "code" => -53
        //     "message" => "Session is not this merchant_id session."
        //     "validations" => []
        //   ]
        // ]

        error_log($result->throw())
        } else {
            $result = $result['data'];
            if (!is_null($transaction->discount_code)) {
                $discount = Discount::where('code', $transaction->discount_code)->first();
            }

            if ($result['code'] == 100 || $result['code'] ==101) {
                $transaction->update([
                    'status' => 1,
                    'payment_status' => $result['code']
                ]);

                Auth()->user()->courses()->syncWithPivotValues($transaction->course_id, [
                    'course_price' => $transaction->course_price,
                    'payment_price' => $transaction->payment_price,
                    'discount_code' => isset($discount) ? $discount->code : null,
                    'discount_type' => isset($discount) ? $discount->type : null,
                    'discount_off' => isset($discount) ? $discount->value : null
                ]);

                echo 'Transation success. RefID:' . $result['ref_id'];
            } else {
                echo 'Transation failed. Status:' . $result['code'];
            }
        }
    }
}
