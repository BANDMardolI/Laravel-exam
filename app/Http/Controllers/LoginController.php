<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ReCaptcha\ReCaptcha;

class LoginController extends Controller
{
    public function login(){
        $user = new User();
        return view('login',['page' => 'Login', 'user' => $user]);
    }
    public function registration(){
        $user = new User();
        return view('login',['page' => 'Registration', 'user' => $user]);
    }
    public function authorizate(Request $request){

        $auth_pair = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if(Auth::attempt($auth_pair)){
            $request->session()->regenerate();
            return redirect('/');
        }else{
            return back()->withErrors(['password'=>'Login or password is incorrect!'])->onlyInput('login');
        }

    }
    public function register(Request $request){
        $recaptcha = new ReCaptcha(env('RECAPTCHA_SECRET_KEY'));
        $response = $recaptcha->verify($request->input('g-recaptcha-response'), env('APP_URL'));

        if (!$response->isSuccess()) {
                //Капча не пройдена
            return redirect()->back()->withErrors(['g-recaptcha-response' => 'Пожалуйста, подтвердите, что вы человек.'])->withInput();
        }
        $user = new User();
        $user->name = $request->login;
        $user->password = $request->password;
        $user->email = $request->email;
        if(!$user->save()){
            return back()->withErrors(['email'=>'Email in use'])->onlyInput('email');
        }
            return redirect()->action('App\Http\Controllers\LoginController@login')->with('message', 'Registration complete!')
        ;
    }
}
