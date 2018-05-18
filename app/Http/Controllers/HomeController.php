<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Notif;
use Validator;
use Auth;
use Redirect;


class HomeController extends Controller {
    use AuthenticatesUsers;

    public function index() {
        if (Auth::check()) {
            $response = array();
            $response['notifications'] = Notif::all()->sortByDesc('created_at')->take(7);
            return view('home', $response);
        }

        return redirect('/dangnhap');
    }

    public function notification($id) {
            if (Auth::check()) {
                $response = array();
                $response['notification'] = Notif::find($id);
                return view('notification', $response);
            }

        return redirect('/dangnhap');
    }
}
