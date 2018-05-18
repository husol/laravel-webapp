<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests;
use App\User;
use Validator;
use Auth;
use Redirect;


class AjaxController extends Controller {
    use AuthenticatesUsers;

    public function index(Request $request) {
        $object         = $request->input('object');
        $functionName   = $request->input('func');
        $params         = $request->input('parameters');
        $agrs       = array();
        foreach($params as $param){
            switch($param){
                case 'null':
                    $agrs[] = NULL;
                    break;
                case 'true':
                    $agrs[] = TRUE;
                    break;
                case 'false':
                    $agrs[] = FALSE;
                    break;
                default:
                    $agrs[] = $param;
            }
        }

        $objectName = ucfirst($object) . 'Controller';
        //check does the object and function posted by client is in correct form
        if(!preg_match('/^[0-9A-Za-z_]+$/', $objectName) || !preg_match('/^[0-9A-Za-z_]+$/', $functionName)) {
            ajaxOutData('ERR: Invalid Controler name or Function name.');
        }
        $objectName = 'App\\Http\\Controllers\\' . $objectName;

        if( !class_exists($objectName) ) {
            ajaxOutData("ERR: $objectName is not existed.");
        }

        if( !method_exists($objectName, $functionName)) {
            ajaxOutData("ERR: $functionName function is not existed.");
        }

        $object = new $objectName;

        echo call_user_func_array(array($object, $functionName), $agrs);
        die();
    }
}
