<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\PasswordResetTokens;

use App\Mail\ResetPasswordMail;

class ResetUserPasswordController extends Controller
{
    //

    const DEFAULT_PASSWORD_RESET_URL = "";

    public function RequestPasswordReset(Request $request)
    {
        # code...
        if ($this->validateJSON($request, array(
            "email" => "required|exists:App\Models\User,email"
        ))){
            $out = new \stdClass();
            $user = User::where('email', '=', $request['user']);

            $url = DEFAULT_PASSWORD_RESET_URL;
            if ($request->has('url')){
                $url = $request['url'];
            }

            if ($request->has('token_id')){
                $token = PasswordResetFromToken::find($request['token_id']);
                if (!is_null($token)){
                    //resend the mail
                    $url .= "?token=" . $token->token;

                    //send the email
                    $email = new ResetPasswordMail($user, $url);
                    Mail::to($request['email'])->send($email);

                    $out->error = FALSE;
                }else{
                    $out->error = TRUE;
                    $out->errorcode = 1053;
                    $out->message = "Password reset request token id not exists";
                }
            }else{
                $token = CreateResetToken();
                //create a token CreateResetToken
                $tr = new PasswordResetTokens();
                $tr->user_id = $user->id;
                $tr->token = $token;
                $tr->token_expire = date('Y-m-d H:i:s', strtotime('+6 hours'));;
                $tr->save();


                $url .= "?token=" . $token;

                //send the email
                $email = new ResetPasswordMail($user, $url);
                Mail::to($request['email'])->send($email);

                $out->error = FALSE;
                $out->token_id = $tr->id;
            }
            

            return json_encode($out);
        }
        
    }

    public function PasswordResetFromToken(Request $request)
    {
        # code...
        if ($this->validateJSON($request, array(
            "token" => "required|exists:App\Models\ResetPasswordMail,token",
            "password" => "required|confirmed|min:8|max:20",
        ))){
            $out = new \stdClass();
            $token = ResetPasswordMail::where('token',  '=', $request['token'])->get()->first();

            //check whether the token expired or valid
            $expd = strtotime($token->token_expire);
            $time_now = time();

            if ($expd - $time_now > 0){
                //valid
                $user = User::find($token->user_id);
                if (!is_null($user)){
                    $user->password = Hash::make($request['password']);
                    $user->save();
                    $out->error = FALSE;
                }else{
                    $out->error = TRUE;
                    $out->errorcode = 1054;
                    $out->message = "Password reset request token expired";
                }
            }else{
                //expired
                $token->delete();
                $out->error = TRUE;
                $out->errorcode = 1054;
                $out->message = "Password reset request token expired";
            }

            return json_encode($out);
        }
        
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
