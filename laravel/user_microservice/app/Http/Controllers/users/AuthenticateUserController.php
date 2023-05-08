<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthenticateUserController extends Controller
{
    //LoginToAccount
    public function LoginToAccount(Request $request){
        if ($this->validateJSON($request, array(
            "email" => "required|email|exists:App\Models\User,email",
            "password" => "required"
        ))){
            $out = new \stdClass();
            //get the user
            $user = User::where('email', '=', $request['email'])->get()->first();
            
            //validate password
            if (Hash::check($request['password'], $user->password)){
                //check for the api key
                if (is_null($user->apikey) || is_null($user->key_expire) || is_null($user->key_created)){
                    //generate api key
                    $user->apikey = $this->GenerateAPIKey();
                    $user->key_created =  date('Y-m-d H:i:s'); 
                    $user->key_expire = date('Y-m-d H:i:s', strtotime('+6 hours'));
                    $user->save();
                }else{
                    $exp_date = strtotime($user->key_expire);
                    $created_date = strtotime($user->key_created);

                    $time_now = time();
                    if ($time_now - $created_date > 7200 || $exp_date - $time_now <= 0){
                        $user->apikey = $this->GenerateAPIKey();
                        $user->key_created =  date('Y-m-d H:i:s'); 
                        $user->key_expire = date('Y-m-d H:i:s', strtotime('+6 hours'));
                        $user->save();
                    }
                    //check whether the date created less than 1 hour
                }
                $out->error = FALSE;
                $out->api_key = $user->apikey;
                $out->api_key_expire = strtotime($user->key_expire);
                $out->user_type = $user->type;

            }else{
                //incorrect password
                $out->error = TRUE;
                $out->errorcode = 1050;
                $out->message = "Incorrect password.";
            }

            return json_encode($out);
        }
    }

    //InvalidateApiKey 
    public function InvalidateApiKey(Request $request){
        if ($this->validateJSON($request, array(
            "api_key" => "required"
        ))){
            $out = new \stdClass();
            //delete api key
            $user = User::where("apikey", $request["api_key"])->get()->first();
            
            if (is_null($user)){
                //key not exists
                $out->error = TRUE;
                $out->errorcode = 1051;
                $out->message = "API key does not exists";
            }else{
                $user->apikey = null;
                $user->key_created = null;
                $user->key_expire = null;
                $out->error = FALSE;
            }
            return json_encode($out);
            
        }
    }


    public function ValidateApiKey(Request $request){
        if ($this->validateJSON($request, array(
            "service_secret" => "required",
            "api_key" => "required"
        ))){
            $out = new \stdClass();

            //check for key
            $user = User::where("apikey", "=", $request["api_key"])->get()->first();

            if (!$user){
                $out->error = TRUE;
                $out->errorcode = 1051;
                $out->message = "API key does not exists";
            }else{
                //check wheter the key expired
                $exp_date = strtotime($user->key_expire);
                $time_now = time();
                if ($exp_date - $time_now <= 0){
                    //key expired
                    $out->error = TRUE;
                    $out->errorcode = 1052;
                    $out->message = "API key expired";
                }else{
                    $out->error = FALSE;
                    $out->api_key = $user->apikey;
                    $out->api_key_expire = strtotime($user->key_expire);
                    $out->user_type = $user->type;
                    
                }
            }

            return json_encode($out);
        }
    }


    protected function GenerateAPIKey()
    {
        # code...
        $key = $this->__CreateNewApiKey();
        $i = 0;
        while(!is_null(User::where('apikey', '=', $key)->get()->first()))
            //throw error
            if ($i > 1000) throw new Exception("Generating Api key taked too long and terminated.", 1);
            $i++;
            $key = $this->__CreateNewApiKey();
        return $key;
    }

    protected function __CreateNewApiKey() {
        $keyLength = 512;
        $key = '';
        $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      
        // Generate random bytes
        $bytes = openssl_random_pseudo_bytes($keyLength);
      
        // Convert bytes to characters
        for ($i = 0; $i < $keyLength; ++$i) {
          $index = ord($bytes[$i]) % strlen($charset);
          $key .= $charset[$index];
        }
      
        return $key;
      }
      
}
