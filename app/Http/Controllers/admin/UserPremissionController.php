<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Premission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserPremissionController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(User $user)
    {
        $premissions = Premission::all();
        $roles = Role::all();
        return view('admin.users.premission-create', compact('user', 'premissions', 'roles'));
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'premissions' => 'array',
        ]);

        $user->premissions()->sync($request->premissions);

        $user->roles()->sync($request->roles);

        alert()->success('دسترسی ها اعمال شد')->persistent('حله')->autoclose(3000);
        return redirect()->route('admin.users.index');
    }
}
