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


        $data = array(
            'MerchantID' => env('GATEWAY_API'),
            'Amount' => $payment_price,
            'CallbackURL' => route('payment_verify', ['course' => $course->slug]),
            'Description' => 'خرید دوره آموزشی ' . $course->name_fa
        );


        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);


        if ($err) {
            $msg = 'خطا :' . $err;
            return redirect()->back()->with('toast', ['error' =>  $msg]);
        } else {
            if ($result["Status"] == 100) {

                Transaction::create([
                    'user_id' => auth()->user()->id,
                    'course_id' => $course->id,
                    'course_price' => $course->price,
                    'payment_price' => $payment_price,
                    'discount_code' => $request->discount,
                    'token' => $result["Authority"],
                    'description' => null,
                    'gateway_name' => env('GATEWAY_NAME')
                ]);


                return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]);
            } else {
                echo 'ERR: ' . $result["Status"];
            }
        }
    }

    public function verify(Course $course,Request $request)
    {
        $MerchantID = env('GATEWAY_API');


        $Authority = $request->Authority;

        $transaction = Transaction::where('token', $request->Authority)->first();

        $data = [
            'MerchantID' => $MerchantID,
            'Authority' => $Authority,
            'Amount' => $transaction->payment_price
        ];

        $jsonData = json_encode($data);


        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));


        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if(! is_null($transaction->discount_code)){
                $discount = Discount::where('code',$transaction->discount_code)->first();
            }

            if ($result['Status'] == 100) {
                $transaction->update([
                    'status' => 1 ,
                    'payment_status' => $result['Status']
                ]);
                
                Auth()->user()->courses()->syncWithPivotValues($transaction->course_id,[
                    'course_price'=>$transaction->course_price,
                    'payment_price'=>$transaction->payment_price,
                    'discount_code'=>isset($discount) ? $discount->code : null,
                    'discount_type'=>isset($discount) ? $discount->type : null,
                    'discount_off'=>isset($discount) ? $discount->value : null
                ]);

                echo 'Transation success. RefID:' . $result['RefID'];
            } else {
                echo 'Transation failed. Status:' . $result['Status'];
            }
        }
    }
}
