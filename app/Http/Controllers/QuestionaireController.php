<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Questionaire;
use Auth;


class QuestionaireController extends Controller {
    public function show() {
    	if(!Auth::check()) {
            return redirect('/');
        } else {
            $response = array();
            $response['questionaires'] = Questionaire::all();
            return view('questionaire', $response);
        }
    }

    public function save(Request $request) {
        if($request->id == '') {
            Questionaire::create([
                            'question'  => $request->input('question'),
                            'answer'  	=> $request->input('answer')
                        ]);
        }
        else {
            Questionaire::where('id', $request->id)
                    		->update(['question' 	=> $request->input('question'),
                    							'answer' 		=> $request->input('answer')
                    						]);
        }
        return redirect('/quantri#cauhoimau');
    }

    public function delete($id) {
        Questionaire::destroy($id);
        return redirect('/quantri#cauhoimau');
    }
}
