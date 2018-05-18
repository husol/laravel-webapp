<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use Auth;


class CommentController extends Controller
{
    public function show() {
    	if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else {
            $response = array();
            return view('comment', $response);
        }
    }
}
