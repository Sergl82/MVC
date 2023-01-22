<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        session()->flash('success',"Вы зарегистрированны: {$request->name}");
        Auth::login($user);
        return redirect()->route('home');
    }

    public function loginForm()
    {
       return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password,
        ])) {
            session()->flash('success', "Добро пожаловать: {$request->name}");
            return redirect()->route('home');
        }
            return redirect()->back()->with('error', 'Не верный логин или пароль');
        }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
