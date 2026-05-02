<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }
}
