<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Company;
use Validator;
use Auth;
use Redirect;


class CompanyController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/';

    public function show() {
        if(!Auth::check()) {
            return redirect('/dangnhap');
        }
        else {
            $response               = array();
            $companies              = Company::all();
            foreach($companies as $index => $company) {
                $company->info      = json_decode($company->info);
                $companies[$index]  = $company;
            }
            $response['companies']  = $companies;
            return view('company', $response);
        }
    }

    public function save(Request $request) {
        if($request->id == '') {
            Company::create([
                            'name'  => $request->input('name'),
                            'info'  => json_encode($request->input('info')),
                            'email' => ''
                        ]);
        }
        else {
            Company::where('id', $request->id)
                    ->update(['name' => $request->input('name'), 'info' => json_encode($request->input('info'))]);
        }
        return redirect('/quantri#doanhnghiep');
    }

    public function delete($id) {
        Company::destroy($id);
        return redirect('/quantri#doanhnghiep');
    }
}
