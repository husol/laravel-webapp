<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Article;
use App\Proof;
use Auth;


class CategoryController extends Controller
{
    public function show() {
    	if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else {
            $response                   = array();
            $articles                   = Article::all();
            $standardArticles           = array();
            foreach ($articles as $index => $article) {
                if($article->id_parent != null && $article->id_parent != '') {
                    continue;
                }
                $article->strinfo   = json_encode(array('id'        => $article->id,
                                                        'code'      => $article->code,
                                                        'title'      => $article->title));
                $standardArticles[$article->id] = $article;
                $standardArticles[$article->id]['subArticle'] = array();
            }

            foreach ($articles as $index => $article) {
                if($article->id_parent == null || $article->id_parent == '') {
                    continue;
                }
                $standardArticles[$article->id_parent]['subArticle'] = array_merge($standardArticles[$article->id_parent]['subArticle'], array($article));
            }

            $response['standardArticles'] = $standardArticles;
            $response['proofs']						= Proof::all();
            return view('category', $response);
        }
    }
}
