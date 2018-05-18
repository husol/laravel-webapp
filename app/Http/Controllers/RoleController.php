<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Article;
use Auth;


class RoleController extends Controller
{
    public function show() {
    	if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else if(!isset(getRole(Auth::user())->isAdmin) || getRole(Auth::user())->isAdmin != 'true') {
            return redirect('/');
        }
        else {
            $response   = array();
            $users      = User::all();
            foreach($users as $index => $user) {
                $userInfo       = json_decode($user->info);
                if(isset($userInfo->role)) {
                    if($userInfo->role->isAdmin == "true") {
                        unset($users[$index]);
                        continue;
                    }
                    $user->userRole = json_encode($userInfo->role);
                    $users[$index]  = $user;
                }
            }

            $response['users']  = $users;
            $articles = Article::orderBy('code')->get();
            //Get standard acticles
            $standardArticles   = array();
            foreach ($articles as $index => $article) {
                if($article->id_parent != null && $article->id_parent != '') {
                    continue;
                }
                $standardArticles[$article->id] = $article;
            }
            $response['standardArticles'] = $standardArticles;

            //Get criteria acticles
            $criteriaArticles = array();
            foreach ($articles as $index => $article) {
                if($article->id_parent == null || $article->id_parent == '') {
                    continue;
                }
                $article->standardName = $standardArticles[$article->id_parent]->title;
                if(!isset($criteriaArticles[$article->id_parent])) {
                    $criteriaArticles[$article->id_parent] = array();
                }
                $criteriaArticles[$article->id_parent][] = $article;
            }
            $response['criteriaArticles'] = $criteriaArticles;
            return view('role', $response);
        }
    }
}
