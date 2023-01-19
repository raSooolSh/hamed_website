<?php

namespace App\Http\Controllers\admin;

use App\Models\Course;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts = Discount::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        })->orderby('expire_at','desc')->paginate(8);
        if ($request->ajax()) {
            return view('admin.discounts.discounts-paginate', compact('discounts'));
        } else {
            return view('admin.discounts.index', compact('discounts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discounts.create')->with([
            'courses'=>Course::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate=$request->validate([
            'name'=>['required','string'],
            'code'=>['required','string','min:5',Rule::unique('discounts','code')],
            'courses'=>['required','array'],
            'courses.*'=>['required','exists:courses,id'],
            'type'=>['required','string','in:percent,value'],
            'value'=>['required','integer'],
            'expire_at'=>['nullable','string'],
            'users'=>['nullable','string','min:11']
        ]);

        if(! is_null($request->expire_at)){
            try{
                $validate['expire_at']=jdate()->fromFormat('Y-m-d H:i:s',$request->expire_at)->toCarbon();
            }catch(\Exception $e){
                return ValidationException::withMessages([
                    'expire_at'=>'فرمت تاریخ اتمام تخفیف صحیح نمی باشد'
                ]);
            }
        }else{
            $validate['expire_at']=null;
        }

        $courses=$validate['courses'];
        unset($validate['courses']);

        try {
            DB::beginTransaction();

            $discount=Discount::create($validate);

            $discount->courses()->sync($courses);

            DB::commit();
        } catch (\Exception $e) {
            alert()->error("error:" . $e->getMessage())->persistent('حله!');
            return redirect()->route('admin.discounts.index');
        }

        alert()->success('تخفیف با موفقیت ثبت شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.discounts.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit')->with([
            'discount'=>$discount,
            'courses'=>Course::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $validate=$request->validate([
            'name'=>['required','string'],
            'code'=>['required','string','min:5',Rule::unique('discounts','code')->ignore($discount->id)],
            'courses'=>['required','array'],
            'courses.*'=>['required','exists:courses,id'],
            'type'=>['required','string','in:percent,value'],
            'value'=>['required','integer'],
            'expire_at'=>['nullable','string'],
            'users'=>['nullable','string','min:11']
        ]);

        if(! is_null($request->expire_at)){
            try{
                $validate['expire_at']=jdate()->fromFormat('Y-m-d H:i:s',$request->expire_at)->toCarbon();
            }catch(\Exception $e){
                return ValidationException::withMessages([
                    'expire_at'=>'فرمت تاریخ اتمام تخفیف صحیح نمی باشد'
                ]);
            }
        }else{
            $validate['expire_at']=null;
        }

        $courses=$validate['courses'];
        unset($validate['courses']);

        try {
            DB::beginTransaction();

            $discount->update($validate);

            $discount->courses()->sync($courses);

            DB::commit();
        } catch (\Exception $e) {
            alert()->error("error:" . $e->getMessage())->persistent('حله!');
            return redirect()->route('admin.discounts.index');
        }

        alert()->success('تخفیف با موفقیت ویرایش شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.discounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $discount=Discount::find($request->discount_id);
        $discount->delete();

        alert()->success('تخفیف با موفقیت حذف شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.discounts.index');
    }
}
