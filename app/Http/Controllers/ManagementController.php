<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Company;
use App\Notif;
use App\Questionaire;
use App\Proof;
use App\Article;
use Auth;


class ManagementController extends Controller
{
    public function show() {
    	if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == 'true'
            || isset(getRole(Auth::user())->vtb) && getRole(Auth::user())->vtb == 'true'
            || isset(getRole(Auth::user())->sch) && getRole(Auth::user())->sch == 'true') {
            $response                   = array();
            $users                      = User::orderBy('username')->get();
            foreach($users as $index => $user) {
                $user->info             = is_null(json_decode($user->info)) ? new \stdClass() : json_decode($user->info);
                $user->info->username   = $user->username;
                $user->info->password   = $user->password;
                $user->info->repassword = $user->password;
                $user->info->id         = $user->id;
                $user->info->email      = $user->email;
                $user->strinfo          = json_encode($user->info);
                $users[$index]          = $user;
            }
            $response['users']       = $users;

            $companies               = Company::orderBy('name')->get();
            foreach($companies as $index => $company) {
                $company->info       = is_null(json_decode($company->info)) ? \stdClass() : json_decode($company->info);
                $company->info->id   = $company->id;
                $company->info->name = $company->name;
                $company->strinfo    = json_encode($company->info);
                $companies[$index]   = $company;
            }
            $response['companies']   = $companies;

            $notifs                  = Notif::orderBy('id', 'desc')->get();
            foreach($notifs as $index => $notif) {
                $notif->strinfo     = json_encode(array('id' => $notif->id,
                                                        'name' => $notif->name,
                                                        'data' => $notif->data));
                $notifs[$index]     = $notif;
            }
            $response['notifs']     = $notifs;

            $questionaires          = Questionaire::all();
            foreach ($questionaires as $index => $questionaire) {
                $questionaire->strinfo = json_encode(array('id' => $questionaire->id,
                                                            'question' => $questionaire->question,
                                                            'answer' => $questionaire->answer));
                $questionaires[$index] = $questionaire;
            }
            $response['questionaires'] = $questionaires;

            $proofs                    = Proof::orderBy('code')->get();
            foreach ($proofs as $index => $proof) {
                $proof->strinfo = json_encode(array('id'        => $proof->id,
                                                    'code'      => $proof->code,
                                                    'name'      => $proof->name,
                                                    'issue'     => $proof->issue,
                                                    'source'    => $proof->source,
                                                    'id_article'=> $proof->id_article,
                                                    'file'      => $proof->file));
                $proofs[$index] = $proof;
            }
            $response['proofs'] = $proofs;

            $articles                   = Article::orderBy('code')->get();
            $standardArticles           = array();
            foreach ($articles as $index => $article) {
                if($article->id_parent != null && $article->id_parent != '') {
                    continue;
                }
                $article->strinfo   = json_encode(array('id'        => $article->id,
                                                        'code'      => $article->code,
                                                        'title'      => $article->title));
                $standardArticles[$article->id] = $article;
            }
            $response['standardArticles'] = $standardArticles;

            $criteriaArticles           = array();
            foreach ($articles as $index => $article) {
                if($article->id_parent == null || $article->id_parent == '') {
                    continue;
                }
                $article->strinfo   = json_encode(array('id'            => $article->id,
                                                        'code'          => $article->code,
                                                        'title'         => $article->title,
                                                        'content'       => $article->content,
                                                        'id_parent'     => $article->id_parent,
                                                        'keyword'       => $article->keyword));
                $article->standardName = $standardArticles[$article->id_parent]->title;
                $criteriaArticles[] = $article;
            }
            $response['criteriaArticles'] = $criteriaArticles;

            return view('usermanagement', $response);
        } else {
            return redirect('/');
        }
    }
}
