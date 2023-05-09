<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AccountManagementController extends Controller
{
    //
    public function GetAllAccountList(Request $request)
    {
        # validation...
        if (!$this->validateJSON($request, array(
            "page" => "optional|integer|Min:1",
            "per_page" => "required"
        ))){
            return;
        }
        $page = 0;
        if ($request->has('page')){
            $page = $request['page'];
        }

        $perPage = 20;
        if ($request->has('per_page')){
            $page = $request['per_page'];
        }

        $offset = $page * $perPage;


        if ($request->has('s')){
            $user = User::where('firstname', 'like', $request['s'])
                        ->orwhere('lastname', 'like', $request['r'])
                        ->orwhere('username', 'like', $request['r'])
                        ->orwhere('email', 'like', $request['r']);
            if ($request->has('type')){
                $user = $user->where('type', $request['type']);
            }
        }else{

        }
        //change
    }
}
