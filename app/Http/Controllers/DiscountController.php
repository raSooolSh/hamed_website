<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'course_id'=>['required','exists:courses,id'],
            'discount_code'=>['required']
        ]);
        $course= Course::find($request->course_id);
        $discount = Discount::where('code',$request->discount_code)->first();
        if($discount && ! is_null($discount->users)){
            $users=mb_split('\*',$discount->users);
        }
        if(is_null($discount)){
            return response(['error'=>'چنین کد تخفیفی یافت نشد']);
        }elseif(isset($users) && ! in_array(Auth()->user()->phone_number,$users)){
            return response(['error'=>'شما مجاز به استفاده از این کد نیستید']);
        }elseif($discount && $discount->expire_at < now()){
            return response(['error'=>'کد تخفیف شما منقضی شده']);
        }

        if($discount->getRawOriginal('type') == 'value'){
            return response(['priceByDiscount'=>$course->price - $discount->value ,'code' => $request->discount_code]);
        }elseif($discount->getRawOriginal('type') == 'percent'){
            return response(['priceByDiscount'=>$course->price - ($course->price/100)*$discount->value ,'code' => $request->discount_code]);
        }

    }
}
