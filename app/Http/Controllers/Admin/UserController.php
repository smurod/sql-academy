<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $users = User::query()->with('roles')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
    public function updateRole(Request $request, User $user)
    {
        if ($user->hasRole('superadmin') || $user->email === 'smurod8880@gmail.com') {
            abort(403, 'Нельзя изменять роль основателя.');
        }

        if ($request->user()->is($user)) {
            abort(403, 'Нельзя изменять свою роль.');
        }

        $data = $request->validate([
            'role' => ['required', Rule::in(['admin', 'student'])],
        ]);

        $user->syncRoles([$data['role']]);

        return back()->with('status', 'Роль пользователя обновлена.');
    }
}
