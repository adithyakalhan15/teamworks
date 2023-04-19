<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function ValidateJSON(Request $request, $rules)
    {
        # this boilerplate code helps to validate and give json output on fail...
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            //get error messages
            $error = $validator->errors()->all();
            print_r($error);
            return false;
        }
        return true;
    }
}
