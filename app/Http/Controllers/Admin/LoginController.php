<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\LoginRequest;
use App\Admin;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/admin/home';
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        if(Auth::id()){
//            return Redirect::back();
            return  Redirect::route('admin.index');
        }else{
            return view('admin.auth.login');
        }
    }

//    public function postLogin(LoginRequest  $request)
//    {
//        $login = [
//            'email' => $request->email,
//            'password' => $request->password,
//        ];
//        if (Auth::attempt($login)) {
//            return redirect()->route('admin.index');
//        } else {
//            return redirect()->back();
//        }
//    }
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
