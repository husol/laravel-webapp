<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Notif;
use Validator;
use Auth;
use Redirect;


class NotifController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function save(Request $request) {
        if($request->id == '') {
            Notif::create([
                            'name'  => $request->input('name'),
                            'data'  => $request->input('data'),
                        ]);
        }
        else {
            Notif::where('id', $request->id)
                    ->update([  'name' => $request->input('name'),
                                'data' => $request->input('data')
                            ]);
        }
        return redirect('/quantri#thongbao');
    }

    public function delete($id) {
        Notif::destroy($id);
        return redirect('/quantri#thongbao');
    }
}
