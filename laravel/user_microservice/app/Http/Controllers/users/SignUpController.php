<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\UserApiKey;


class SignUpController extends Controller
{
    //
    const ACCOUNY_TYPE_USER = 'user';
    const ACCOUNY_TYPE_RESEARCHER = 'researcher';
    const ACCOUNY_TYPE_ADMIN = 'admin';

    function CreateUserAccount(Request $request){
        $output = new \stdClass();
        if ($this->ValidateJSON($request, array(
            "firstname"=>"required",
            "email"=>"required|email|unique:App\Models\User,email",
            "password"=>"required|min:8|max:20|confirmed",
        ))){
           //create the account
            try {
                //code...
                $id = $this->CreateAllAccounts($request);

                //send the confirmation email

                //set output
                $output->error = FALSE;

            } catch (\Throwable $th) {
                //throw $th;
                $output->error = TRUE;
                $output->message = "Internal server error";
                $output->errorcode = 1001;
            }

            return \json_encode($output);
        }

        
    }

    

    function CreateResearcherAccount(Request $request){
        $output = new \stdClass();
        if (!$this->ValidateJSON($request, array(
            "firstname"=>"required",
            "email"=>"required|email|unique:App\Models\User,email",
            "password"=>"required|min:8|max:20|confirmed",
        ))){
          return '';  
        }

        //create the account
        try {
            //code...
            $id = $this->CreateAllAccounts($request, ACCOUNY_TYPE_RESEARCHER);

            //send the confirmation email

            //set output
            $output->error = FALSE;

        } catch (\Throwable $th) {
            //throw $th;
            $output->error = TRUE;
            $output->message = "Internal server error";
            $output->errorcode = 1001;
        }

        return \json_encode($output);
    }

    function CreateAdminAccount(Request $request){
        $output = new \stdClass();
        if (!$this->ValidateJSON($request, array(
            "firstname"=>"required",
            "email"=>"required|email|unique:App\Models\User,email",
            "password"=>"required|min:8|max:20|confirmed",
        ))){
          return '';  
        }

        //create the account
        try {
            $id = $this->CreateAllAccounts($request, ACCOUNY_TYPE_RESEARCHER);
            //send the confirmation email
            $output->error = FALSE;
            
        } catch (\Throwable $th) {
            //throw $th;
            $output->error = TRUE;
            $output->message = "Internal server error";
            $output->errorcode = 1001;
        }

        return \json_encode($output);
    }

    function ApproveResearcherAccount(Request $request){
        if (!$this->ValidateJSON($request, array(
            "account_id" => "required|exists:App\Models\User, id",
        ))){
            $output = new \stdClass();
            $confirm = TRUE;

            if ($request->has("confirmation") && $request['confirmation'] == 0){
                $confirm = FALSE;
            }

            $user = User::find($request['account_id']);
            
            if ($confirm){
                $user->is_verified = 1;
            }else{
                $user->is_verified = 0;
            }


            $output->error = FALSE;
            return \json_encode($output);
        }
        
    }

    private function CreateAllAccounts($request, $type=ACCOUNY_TYPE_USER){
        if ($type != ACCOUNY_TYPE_USER && $type != ACCOUNY_TYPE_RESEARCHER && $type != ACCOUNY_TYPE_ADMIN){
            $type=ACCOUNY_TYPE_USER;
        }
        $user = new User();
        $user->firstname = $request['firstname'];
        
        //if last name defined,
        if ($request->has("lastname")){
            $user->lastname = $request['lastname'];
        }

        $user->email = $request['email'];
        $user->password = Hash::make($request['password']);
        $user->type = $type;

        $user->save();

        return $user->id;
    }
}
