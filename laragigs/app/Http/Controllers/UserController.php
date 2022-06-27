<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //Show All Users
    public function index() {
        $users = User::latest()->get();
        // dd($users);
        return view('partials._registered_user',compact('users'));
    }


    //Show Register/Create Form
    public function create() {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request) {
        $formFields = $request -> validate([
                'name' => ['required', 'min:3'],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required|confirmed|min:6'
            ]);

            //Hash Password
            $formFields['password'] = bcrypt($formFields['password']);

            //Create User
            $user = User::create($formFields);

            //Login
            Auth::login($user);

            return redirect('/')->with('message', 'User Created and Logged in');

    }

    // Logout
    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out.');
    }

    //Show Login Form
    public function login() {
        return view('users.login');
    }

    //Autherticate User
    public function authenticate(Request $request) {
        $formFields = $request->validate([
            'email' => ['required', 'email',],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
