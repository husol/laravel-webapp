<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Status;
use App\Proof;
use Auth;


class ShareController extends Controller
{
    public function show() {
    	if(!Auth::check()) {
          return redirect('/dangnhap');
      }
      else if(isset(getRole(Auth::user())->isAdmin) && getRole(Auth::user())->isAdmin == 'true' || isset(getRole(Auth::user())->cse) && getRole(Auth::user())->cse == 'true') {
          $response           = array();
          $statuses           = Status::all()->sortByDesc("id");
          $shares             = array();
          foreach($statuses as $status) {
            if($status->id_parent != null && $status->id_parent != 0) {
              continue;
            }
            $userInfo             = json_decode($status->user->info);
            $status->avatar       = isset($userInfo->avatar) ? $userInfo->avatar : null;
            $status->author       = $userInfo->name;
            $shares[$status->id]  = $status;
            $shares[$status->id]['substatus'] = array();
          }

          $statuses           = Status::all()->sortBy("id");
          foreach($statuses as $status) {
            if($status->id_parent == null || $status->id_parent == 0) {
              continue;
            }
            $userInfo             = json_decode($status->user->info);
            $status->avatar       = isset($userInfo->avatar) ? $userInfo->avatar : null;
            $status->author       = $userInfo->name;
            $shares[$status->id_parent]['substatus'] = array_merge($shares[$status->id_parent]['substatus'], array($status));
          }

          $response['shares'] = $shares;

          $response['proofs'] = Proof::all();

          return view('share', $response);
      } else {
          return redirect('/');
      }
    }

    public function save(Request $request) {
    	if($request->id == '') {
          Status::create([
                          'id_user'   => $request->input('id_user'),
                          'content'   => $request->input('content'),
                          'id_parent' => $request->input('id_parent')
                      ]);
      }
      else {
          Status::where('id', $request->id)
          		->update([  'id_user'   => $request->input('id_user'),
                          'content'  	=> $request->input('content'),
                          'id_parent' => $request->input('id_parent')
                      ]);
      }
      return redirect('/chiase');
    }

    public function delete($id) {
        $status = Status::find($id);
        if($status->id_user == Auth::user()->id) {
          Status::destroy($id);
          Status::where('id_parent', '=', $id)->delete();
        }
        return redirect('/chiase');
    }
}
