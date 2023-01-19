<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Role;
use App\Models\Premission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        $roles=Role::when($request->has('search'),function($query)use($request){
                $query->where('name','LIKE',"%{$request->search}%");
            })->with('premissions')->latest()->paginate(8);
        if($request->ajax()){
            return view('admin.roles.roles-paginate',compact('roles'));
        }else{
            return view('admin.roles.index',compact('roles'));
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(){
        $premissions=Premission::all();
        return view('admin.roles.create',compact('premissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','unique:roles,name'],
            'premissions'=>['required','array']
        ]);

        try{
            DB::beginTransaction();

            $role=Role::create([
                'name'=>$request->name,
            ]);

            $role->premissions()->sync($request->premissions);

            DB::commit();

        }catch(\Exception $e){
            throw $e;
        }

        alert()->success('نقش با موفقیت ایجاد شد')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role){
        $premissions=Premission::all();
        return view('admin.roles.edit',compact('role','premissions'));
    }

    /**
     * @param Role $role
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws Exception
     */
    public function update(Role $role, Request $request)
    {
        $request->validate([
            'name'=>['required','string',Rule::unique('roles','name')->ignore($role->id)],
            'premissions'=>['required','array']
        ]);

        try{
            DB::beginTransaction();

            $role->update([
                'name'=>$request->name,
            ]);

            $role->premissions()->sync($request->premissions);

            DB::commit();

        }catch(\Exception $e){
            throw $e;
        }

        alert()->success('نقش با موفقیت ویرایش شد')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.roles.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'role_name'=>'required|exists:roles,name',
        ]);

        $role=Role::whereName($request->role_name)->firstOrFail();

        $role->delete();

        alert()->success('نقش با موفقیت حذف شد')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.roles.index');
    }
}
