<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    //

    function CreateUserAccount(Request $request){
        $output = new \stdClass();

        return \json_encode($output);
    }

    function CreateResearcherAccount(Request $request){
        $output = new \stdClass();

        return \json_encode($output);
    }

    function CreateAdminAccount(Request $request){
        $output = new \stdClass();

        return \json_encode($output);
    }

    function ApproveResearcherAccount(Request $request){
        $output = new \stdClass();

        return \json_encode($output);
    }
}
