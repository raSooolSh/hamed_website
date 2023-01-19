<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Component;
use Morilog\Jalali\Jalalian;

class CourseController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $courses = Course::when($request->has('search'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'LIKE', "%{$request->search}%")
                    ->orWhere('teacher', 'LIKE', "%{$request->search}%");
            });
        })->latest()->paginate(8);
        if ($request->ajax()) {
            return view('admin.courses.courses-paginate', compact('courses'));
        } else {
            return view('admin.courses.index', compact('courses'));
        }
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function image(Request $request)
    {
        $request->validate([
            'url' => 'required|string'
        ]);

        return view('admin.courses.image')->with([
            'url' => $request->url,
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.courses.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        
        $validate = $request->validate([
            'image' => ['required', 'string', 'regex:/(.jpg)|(.png)|(.jpeg)$/'],
            'name_fa' => ['required', 'string', 'max:255', 'unique:courses,name_fa'],
            'name_en' => ['required', 'string', 'max:255', 'unique:courses,name_en'],
            'teacher' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'integer', 'min:1000'],
            'is_active' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'section' => ['required', 'array'],
            'discount_off' => ['nullable', 'integer',"max:$request->price"],
            'discount_expire_at' => ['nullable','string'],
            'section.*' => ['required', 'string'],
        ]);

        if(! is_null($request->discount_expire_at)){
            try{
                $validate['discount_expire_at']=jdate()->fromFormat('Y-m-d H:i:s',$request->discount_expire_at)->toCarbon();
            }catch(\Exception $e){
                return ValidationException::withMessages([
                    'discount_expire_at'=>'فرمت تاریخ اتمام تخفیف صحیح نمی باشد'
                ]);
            }
        }else{
            $validate['discount_expire_at']=null;
        }
       

        $sectionData = $validate['section'];
        unset($validate['section']);
        try {
            DB::beginTransaction();

            $course = Course::create($validate);

            foreach ($sectionData as $section) {
                $course->sections()->create([
                    'name' => $section,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            alert()->error("error:" . $e->getMessage())->persistent('حله!');
            return redirect()->route('admin.courses.index');
        }
        $folderName=str_replace(['/','\\','?','*','<','>','|','[',']'],'-',$validate['name']);
        Storage::disk('vip')->makeDirectory('courses/'.$folderName);


        alert()->success('دوره با موفقیت ایجاد شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.courses.index');
    }

    /**
     * @param Course $course
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    /**
     * @param Request $request
     * @param Course $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {

        $validate = $request->validate([
            'image' => ['string', 'regex:/(.jpg)|(.png)|(.jpeg)$/'],
            'name_fa' => ['required', 'string', 'max:255', Rule::unique('courses', 'name_fa')->ignore($course->id)],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('courses', 'name_en')->ignore($course->id)],
            'teacher' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'integer', 'min:1000'],
            'is_active' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'content' => ['required', 'string'],
            'discount_off' => ['nullable', 'integer'],
            'discount_expire_at' => ['nullable','string'],
            'section' => ['required', 'array'],
            'section.*' => ['required', 'string'],
        ]);

        if(! is_null($request->discount_expire_at)){
            try{
                $validate['discount_expire_at']=jdate()->fromFormat('Y-m-d H:i:s',$request->discount_expire_at)->toCarbon();
            }catch(\Exception $e){
                return ValidationException::withMessages([
                    'discount_expire_at'=>'فرمت تاریخ اتمام تخفیف صحیح نمی باشد'
                ]);
            }
        }else{
            $validate['discount_expire_at']=null;
        }

        $sectionData = $validate['section'];
        unset($validate['section']);

        try {
            DB::beginTransaction();

            $course->update($validate);

            foreach ($course->sections as $section) {
                if (isset($sectionData[$section->id])) {

                    if ($sectionData[$section->id] != $section->name) {
                        $section->update([
                            'name' => $sectionData[$section->id],
                        ]);
                    }

                    unset($sectionData[$section->id]);
                }else{

                    $section->delete();

                }
            }

            foreach ($sectionData as $section){
                $course->sections()->create([
                    'name'=>$section,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            alert()->error("error:" . $e->getMessage())->persistent('حله!');
            return redirect()->route('admin.courses.index');
        }


        alert()->success('دوره با موفقیت ویرایش شد')->persistent('حله!')->autoclose(3000);
        return redirect()->route('admin.courses.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'course_slug' => 'required|exists:courses,slug',
        ]);

        $course = Course::whereSlug($request->course_slug)->firstOrFail();

        $course->delete();

        alert()->success('دوره با موفقیت حذف شد')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.courses.index');
    }
}
