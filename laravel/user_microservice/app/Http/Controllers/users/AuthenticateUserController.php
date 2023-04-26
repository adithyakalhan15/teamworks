<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\UserApiKey;

class AuthenticateUserController extends Controller
{
    //

    //InvalidateApiKey
    function InvalidateApiKey(Request $request){
        if ($this->validateJSON($request, array(
            "service_secret" => "required",
            "api_key" => "required"
        ))){
            UserApiKey::where("apikey", $request["api_key"])->delete();
        }
    }
}
