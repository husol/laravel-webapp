<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Validator;
use Auth;
use Redirect;
use Cache;
use File;
use Url;

class UserController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function save(Request $request) {
        if($request->id == '') {
            $info = $request->input('info');
            if ($request->hasFile('avatar')) {
                $avatarName     = uniqid(true).strtotime('now');
                $info['avatar'] = $avatarName . $request->avatar->extension();
                $request->avatar->move(public_path("avatars"), $info['avatar']);
            }
            User::create([
                            'username'  => $request->input('username'),
                            'password'  => bcrypt($request->input('password')),
                            'info'      => json_encode($info),
                            'email'     => $request->input('email')
                        ]);
            
        }
        else {
            $password = $request->input('password');
            $user = User::find($request->id);
            if($password != '') {
                $password = bcrypt($password);
            }
            else {
                $password = $user->password;
            }
            $info       = $request->input('info');
            $userInfo   = json_decode($user->info, true);
            $roleInfo   = $userInfo['role'];
            if ($request->hasFile('avatar')) {
                if(isset($userInfo['avatar']) && $userInfo['avatar'] != '') {
                    $userInfo       = explode('/', $userInfo['avatar']);
                    $avatarName     = end($userInfo);
                    File::delete(public_path("avatars"). DIRECTORY_SEPARATOR .$avatarName);
                    $avatarName     = uniqid(true).strtotime('now');
                    $info['avatar'] = $avatarName . '.' . $request->avatar->extension();
                    $request->avatar->move(public_path("avatars"), $info['avatar']);
                }
                else {
                    $avatarName     = uniqid(true).strtotime('now');
                    $info['avatar'] = $avatarName . '.' . $request->avatar->extension();
                    $request->avatar->move(public_path("avatars"), $info['avatar']);
                }
            }
            $info['phone']      = isset($userInfo['phone']) ? $userInfo['phone'] : '';
            $info['address']    = isset($userInfo['address']) ? $userInfo['address'] : '';
            $info['role']       = $roleInfo;

            User::where('id', $request->id)
                    ->update([  'username'  => $request->input('username') != null ? $request->input('username') : $user->username,
                                'password'  => $password,
                                'info'      => json_encode($info),
                                'email'     => $request->input('email')
                            ]);
        }
        Cache::flush();
        return redirect('/quantri#nguoidung');
    }

    public function saveProfile(Request $request) {
        $password = $request->input('password');
        $user = User::find($request->id);
        if($password != '') {
            $password = bcrypt($password);
        }
        else {
            $password = $user->password;
        }
        $info       = $request->input('info');
        $userInfo   = json_decode($user->info, true);
        $roleInfo   = $userInfo['role'];
        if ($request->hasFile('avatar')) {
            if(isset($userInfo['avatar']) && $userInfo['avatar'] != '') {
                $userInfo       = explode('/', $userInfo['avatar']);
                $avatarName     = end($userInfo);
                File::delete(public_path("avatars"). DIRECTORY_SEPARATOR .$avatarName);
                $avatarName     = uniqid(true).strtotime('now');
                $info['avatar'] = $avatarName . '.' . $request->avatar->extension();
                $request->avatar->move(public_path("avatars"), $info['avatar']);
            }
            else {
                $avatarName     = uniqid(true).strtotime('now');
                $info['avatar'] = $avatarName . '.' . $request->avatar->extension();
                $request->avatar->move(public_path("avatars"), $info['avatar']);
            }
        }
        $info['role']       = $roleInfo;

        User::where('id', $request->id)
                ->update([  'username'  => $request->input('username') != null ? $request->input('username') : $user->username,
                            'password'  => $password,
                            'info'      => json_encode($info),
                            'email'     => $request->input('email')
                        ]);
        return redirect(url()->previous());
    }

    public function delete($id) {
        User::destroy($id);
        return redirect('/quantri#nguoidung');
    }

    public function checkUsername($username) {
        if(!preg_match('/^[a-z][a-z0-9]{2,24}$/', $username)){
            ajaxOutData(1);
        }

        if(Auth::check()) {
            $user = User::where('username', $username)->first();
            if (!empty($user)) {
                ajaxOutData(2);
            }
        }
        ajaxOutData(0);
    }

    public function saveRole($id_user, $role) {
        $user = User::find($id_user);
        $info = json_decode($user->info, true);
        $info['role'] = $role;
        User::where('id', $id_user)->update(['info' => json_encode($info)]);

        ajaxOutData();
    }
}
