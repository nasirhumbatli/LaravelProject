<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        return view('backend.default.index');
    }

    public function login()
    {
        if(!Auth::guest()){
            return redirect(route('manage.index'));
        }else{
            return view('backend.default.login');

        }
    }

    public function authenticate(Request $request){
        $request->flash();

        $credentials = $request->only('email','password');

        $messages = [
            'email.required' => 'Email sahəsi tələb olunur.',
            'password.required' => 'Şifrə sahəsi tələb olunur.'
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ],$messages);

        $remember_me = $request->has('remember_me')? true: false;
    
        if(Auth::attempt($credentials,$remember_me)){

            return redirect()->intended(route("manage.index"));
        }else {

            return back()->with('error','İstifadəçi Tapılmadı');
        }

    }

    public function logout(){
        Auth::logout();
        return redirect(route('manage.login'))->with('success','Çıxış Etdiniz');
    }
}
