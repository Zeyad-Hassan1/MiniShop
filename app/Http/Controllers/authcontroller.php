<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginrequest;
use Illuminate\Http\Request;
use App\Http\Requests\registerrequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class authcontroller extends Controller
{
    public function showregisterform (){
        return view('auth.register');
    }
    public function register(registerrequest $request){
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return redirect('login')->with('success' , 'user created successully');
    }
    public function showloginform (){
        return view('auth.login');
    }
    public function login(loginrequest $request){
        $credentials = $request->validated();
        if(auth()->attempt($credentials)){
            return redirect()->intended('/')->with('success' , 'login successfully');
        }
        return back()->withErrors(['email'=>'no data with this data']);
    }
    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success' , 'logout successfully');
    }
}
