<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\PasswordResetTokens;

class ResetUserPasswordController extends Controller
{
    //

    public function RequestPasswordReset(Request $request)
    {
        # code...
        if ($this->validateJSON($request, array(
            "email" => "required|exists:App\Models\User,email"
        ))){
            $out = new \stdClass();
            $user = User::where('email', '=', $request['user']);

            $token = CreateResetToken();
            //create a token CreateResetToken
            $tr = new PasswordResetTokens();
            $tr->user_id = $user->id;
            $tr->token = $token;
            $tr->token_expire = date('Y-m-d H:i:s', strtotime('+6 hours'));;
            $tr->save();

            //send the email

            return json_encode($out);
        }
        
    }

    public function PasswordResetFromToken(Request $request)
    {
        # code...
        $out = new \stdClass();
        return json_encode($out);
    }


    protected function CreateResetToken()
    {
        # code...
        $key = $this->__CreateResetToken();
        $i = 0;
        while(!is_null(PasswordResetTokens::where('token', '=', $key)->get()->first()))
            //throw error
            if ($i > 1000) throw new Exception("Generating Api key taked too long and terminated.", 1);
            $i++;
            $key = $this->__CreateResetToken();
        return $key;
    }

    protected function __CreateResetToken() {
        $keyLength = 200;
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
