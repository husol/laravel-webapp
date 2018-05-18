<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use App\Proof;
use File;
use Auth;


class ProofController extends Controller {

    public function save(Request $request) {
        if($request->id == '') {
            if ($request->hasFile('file')) {
                $fileName       = uniqid(true).strtotime('now') . '.' . $request->file->extension();
                $request->file->move(public_path("files"), $fileName);
                Proof::create([
                            'code'          => $request->input('code'),
                            'name'          => $request->input('name'),
                            'issue'         => $request->input('issue'),
                            'source'        => $request->input('source'),
                            'id_article'    => $request->input('id_article'),
                            'file'          => asset('files/' . $fileName)
                        ]);
            }
            else {
                Proof::create([
                            'code'    => $request->input('code'),
                            'name'    => $request->input('name'),
                            'issue'   => $request->input('issue'),
                            'source'  => $request->input('source'),
                            'id_article'    => $request->input('id_article'),
                            'file'    => ''
                        ]);
            }
        }
        else {
            $proof = Proof::find($request->id);
            if ($request->hasFile('file')) {
                $fileName       = explode('/', $proof->file);
                $fileName       = end($fileName);
                File::delete(public_path("files"). DIRECTORY_SEPARATOR .$fileName);
                $fileName       = uniqid(true).strtotime('now') . '.' . $request->file->extension();
                $request->file->move(public_path("files"), $fileName);
                Proof::where('id', $request->id)
                    ->update([  'code'          => $request->input('code'),
                                'name'          => $request->input('name'),
                                'issue'         => $request->input('issue'),
                                'source'        => $request->input('source'),
                                'id_article'    => $request->input('id_article'),
                                'file'          => asset('files/' . $fileName)
                            ]);
            }
            else {
                Proof::where('id', $request->id)
                    ->update([  'code'          => $request->input('code'),
                                'name'          => $request->input('name'),
                                'issue'         => $request->input('issue'),
                                'source'        => $request->input('source'),
                                'id_article'    => $request->input('id_article'),
                                'file'          => ''
                            ]);
            }
        }
        return redirect('/quantri#minhchung');
    }

    public function delete($id) {
        Proof::destroy($id);
        return redirect('/quantri#minhchung');
    }
}
