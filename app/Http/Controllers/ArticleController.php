<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Article;
use Auth;


class ArticleController extends Controller {
    public function saveStandard(Request $request) {
        if($request->id == '') {
            Article::create([
                            'code'    => $request->input('code'),
                            'title'   => $request->input('title'),
                            'content' => ''
                        ]);
        }
        else {
            Article::where('id', $request->id)
            		->update([  'code'    => $request->input('code'),
                                'title'   => $request->input('title'),
                                'content' => ''
                            ]);
        }
        return redirect('/quantri#tieuchuan');
    }

    public function deleteStandard($id) {
        Article::destroy($id);
        return redirect('/quantri#tieuchuan');
    }

    public function saveCriteria(Request $request) {
        if($request->id == '') {
            Article::create([
                            'code'          => $request->input('code'),
                            'title'         => $request->input('title'),
                            'content'       => $request->input('content'),
                            'description'   => '',
                            'id_parent'     => $request->input('id_parent'),
                            'keyword'       => $request->input('keyword')
                        ]);
        }
        else {
            Article::where('id', $request->id)
                    ->update([  'code'          => $request->input('code'),
                                'title'         => $request->input('title'),
                                'content'       => $request->input('content'),
                                'description'   => '',
                                'id_parent'     => $request->input('id_parent'),
                                'keyword'       => $request->input('keyword')
                            ]);
        }
        return redirect('/quantri#tieuchi');
    }

    public function deleteCriteria($id) {
        Article::destroy($id);
        return redirect('/quantri#tieuchi');
    }
}
