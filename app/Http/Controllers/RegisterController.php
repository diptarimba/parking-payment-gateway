<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.signup');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,username',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create(array_merge($request->all(), [
            'avatar' => 'storage/placeholder/avatar/default-profile.png',
            'password' => bcrypt($request->password)
        ]));

        return redirect()->route('login.index')->with('success', 'Success Register, Please Login First!');
    }
}
