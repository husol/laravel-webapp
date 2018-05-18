<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Validator;
use Auth;
use Redirect;


class LoginController extends Controller {
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function index() {
    	return view('login');
    }

    public function doLogIn(Request $request) {
    	$rules = array('username'  => 'required',
      			       'password' => 'required|alphaNum|min:3');
    	$validator = Validator::make($request->all(), $rules);
    	if ($validator->fails()) {
        return redirect('/dangnhap')
            ->withErrors($validator)
            ->withInput($request->except('password'));
    	} else {
            $userdata = array(
                'username'  => $request->input('username'),
                'password'  => $request->input('password')
            );

            if (Auth::attempt($userdata, $request->input('rememberme'))) {
                return redirect('');
            } else {
                return redirect('/dangnhap')
                        ->withErrors(array('Thông tin đăng nhập không đúng!'))
                        ->withInput($request->except('password'));
            }
    	}
    }

    public function doLogout() {
    	Auth::logout();
    	return redirect('/dangnhap');
    }
}
