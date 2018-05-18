<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Article;
use App\Proof;
use Auth;


class ReportController extends Controller
{
    public function show() {
        if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == 'true' || isset(getRole(Auth::user())->vbc) && getRole(Auth::user())->vbc == 'true') {
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

            $response['proofs'] = Proof::all();

            $response['standardArticles'] = $standardArticles;
            $response['roles']            = getRole(Auth::user());
            return view('report', $response);
        } else {
            return redirect('/');
        }
    }

    public function save($key, $value) {
        if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else {
            $explode_key    = explode("_", $key);
            $id             = end($explode_key);
            $field          = str_replace("_$id", "", $key);
            $report         = Article::find($id);
            $report->$field = $value;
            $report->save();
            ajaxOutData();
        }
    }
}
