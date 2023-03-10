<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request){
        $users=User::when($request->has('search'),function($query)use($request){
            $query->where(function($query)use($request){
                $query->where('id','LIKE',"%{$request->search}%")
                ->orWhere('meli_code','LIKE',"%{$request->search}%")
                ->orWhere('full_name','LIKE',"%{$request->search}%")
                ->orWhere('phone_number','LIKE',"%{$request->search}%");
            });
        })->latest()->paginate(8);

        if($request->ajax()){
            return view('admin.users.users-paginate',compact('users'));
        }else{
            return view('admin.users.index',compact('users'));
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function admins(Request $request){
        $users=User::where('type','<>','user')
        ->when($request->has('search'),function($query)use($request){
            $query->where(function($query)use($request){
                $query->where('id','LIKE',"%{$request->search}%")
                ->orWhere('full_name','LIKE',"%{$request->search}%")
                ->orWhere('meli_code','LIKE',"%{$request->search}%")
                ->orWhere('phone_number','LIKE',"%{$request->search}%");
            });
        })->latest()->paginate(8);

        if($request->ajax()){
            return view('admin.users.users-paginate',compact('users'));
        }else{
            return view('admin.users.index',compact('users'));
        }

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function blockedUsers(Request $request){
        $users=User::where('is_block',true)
        ->when($request->has('search'),function($query)use($request){
            $query->where(function($query)use($request){
                $query->where('id','LIKE',"%{$request->search}%")
                ->orWhere('full_name','LIKE',"%{$request->search}%")
                ->orWhere('meli_code','LIKE',"%{$request->search}%")
                ->orWhere('phone_number','LIKE',"%{$request->search}%");
            });
        })->latest()->paginate(8);

        if($request->ajax()){
            return view('admin.users.users-paginate',compact('users'));
        }else{
            return view('admin.users.index',compact('users'));
        }

    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user){
        return view('admin.users.show',compact('user'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $user){
        return view('admin.users.edit',compact('user'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user){
        // dd($request->all());
        $data=$request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'meli_code' => ['required', 'string','digits:10','meli_code',Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['required', 'string','digits:11','regex:/^09\d{9}/',Rule::unique('users')->ignore($user->id)],
            'type'=>['required','in:user,admin,manager'],
            'is_block'=>['required','boolean'],
            'block_reason'=>[Rule::requiredIf(fn()=>$request->is_block),'nullable','string']
        ]);

        if($request->password){
            $request->validate([
                'password' => ['required', 'string', 'min:8', 'max:32' ,'strong_password','confirmed']
            ]);
            $data['password']=Hash::make($request->password);
        }

        $user->update($data);
        alert()->success('???????????? ???? ???????????? ?????????? ????')->persistent('??????')->autoclose(3000);
        return redirect()->route('admin.users.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function block(Request $request){

        $request->validate([
            'user_id'=>['required','integer','exists:users,id'],
            'block_reason'=>['required','string']
        ]);

        $user=User::findOrFail($request->user_id);

        $user->update([
            'is_block' => 1,
            'block_reason' => $request->block_reason
        ]);

        alert()->success("?????????? ???? ?????? ???????? ????")->persistent('?????? ??????!')->autoclose(3000);
        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unblock(User $user){

        $user->update([
            'is_block' => 0,
            'block_reason' => null
        ]);

        alert()->success("?????????? ???? ?????? ???????????? ????")->autoclose(3000);
        return redirect()->route('admin.users.index');
    }
}
