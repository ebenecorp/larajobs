<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    //
    public function create()
    {
        return view('users.create');
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user =  User::create($data);

        auth()->login($user);

        return redirect()->route('listing.index')->with(Session::flash('message', " User account created and logged in "));
    }

    public function show(){
        return view('user.login');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listing.index')->with(Session::flash('message', "You have been loggout "));
    }
}
