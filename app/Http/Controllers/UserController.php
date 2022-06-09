<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\AuthenticateUsersRequest;
use PhpParser\Node\Expr\FuncCall;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
        $this->middleware('auth')->only(['logout']);
    }

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

    public function show()
    {
        return view('users.login');
    }

    public function authenticate(AuthenticateUsersRequest $request)
    {

        if (auth()->attempt($request->except('_token'))) {
            $request->session()->regenerate();

            return redirect()->route('listing.index')->with(Session::flash('message', " User account created and logged in "));
        }

        return back()->withErrors(['email' => ' Invalid username and password '])->onlyInput('email');
    }

    public function logout(Request $request)
    {

        auth()->logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect()->route('listing.index')->with(Session::flash('message', "You have been loggout "));
    }
}
