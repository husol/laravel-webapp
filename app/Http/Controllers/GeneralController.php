<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Article;
use PDF;
use Auth;

class GeneralController extends Controller {

    public function show() {
        if (!Auth::check()) {
            return redirect('/dangnhap');
        } else if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == 'true' || isset(getRole(Auth::user())->vbc) && getRole(Auth::user())->vbc == 'true') {
            $response = array();
            $articles = Article::all();
            $standardArticles = array();
            foreach ($articles as $index => $article) {
                if ($article->id_parent != null && $article->id_parent != '') {
                    continue;
                }
                $article->strinfo = json_encode(array('id' => $article->id,
                    'code' => $article->code,
                    'title' => $article->title));
                $standardArticles[$article->id] = $article;
                $standardArticles[$article->id]['subArticle'] = array();
            }

            foreach ($articles as $index => $article) {
                if ($article->id_parent == null || $article->id_parent == '') {
                    continue;
                }
                $standardArticles[$article->id_parent]['subArticle'] = array_merge($standardArticles[$article->id_parent]['subArticle'], array($article));
            }

            $response['standardArticles'] = $standardArticles;
            $response['roles'] = getRole(Auth::user());
            return view('general', $response);
        } else {
            return redirect('/');
        }
    }

    public function download() {
        ini_set('xdebug.max_nesting_level', 1000);
        if (!Auth::check()) {
            return redirect('/dangnhap');
        } else if (isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == 'true' || isset(getRole(Auth::user())->vbc) && getRole(Auth::user())->vbc == 'true') {
            $response = array();
            $articles = Article::all();
            $standardArticles = array();
            foreach ($articles as $index => $article) {
                if ($article->id_parent != null && $article->id_parent != '') {
                    continue;
                }
                $article->strinfo = json_encode(array('id' => $article->id,
                    'code' => $article->code,
                    'title' => $article->title));
                $standardArticles[$article->id] = $article;
                $standardArticles[$article->id]['subArticle'] = array();
            }

            foreach ($articles as $index => $article) {
                if ($article->id_parent == null || $article->id_parent == '') {
                    continue;
                }
                $standardArticles[$article->id_parent]['subArticle'] = array_merge($standardArticles[$article->id_parent]['subArticle'], array($article));
            }

            $response['standardArticles'] = $standardArticles;
            $response['roles'] = getRole(Auth::user());

            set_time_limit(3600);

            $pdf = PDF::loadView('exportgeneral', $response);
            
            $pdf->download('baocao.pdf');

            /*
             * use stream to review before download
            */
            //return $pdf->stream('baocao.pdf');
        } else {
            return redirect('/');
        }
    }

}
