<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function ShowRegisterPage(Request $request) {
        return view('user.register');
    }

    public function RegisterAccount(Request $request){
        try {
            if ($request['accountType'] == 'user'){
                return $this->RegisterUserAccount($request);
            } else if ($request['accountType'] == 'author'){
                return $this->RegisterAuthorAccount($request);
            }else{
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['accountType' => 'Invalid account type']);
        }
        
    }

    private function RegisterUserAccount(Request $request){
        //validate and confirm passowrd ||confirmPassword
        $user = new User();
        if ($request->has('title')){
            $user->title = $request['title'];
        }
        $user->first_name = $request['firstName'];
        $user->last_name = $request['lastName'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->role = User::ROLE_USER;
        $user->save();

        Auth::login($user);

        return redirect('/user/profile');
    }

    private function RegisterAuthorAccount(Request $request){
        $user = new User();
        if ($request->has('title')){
            $user->title = $request['title'];
        }
        $user->first_name = $request['firstName'];
        $user->last_name = $request['lastName'];
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->role = User::ROLE_AUTHOR;

        //users have an author account too
        $author = new Author();
        $author->first_name = $request['firstName'];
        $author->last_name = $request['lastName'];
        if ($request->has('title')){
            $author->title = $request['title'];
        }
        $author->save();
        $user->author_id = $author->_id;

        /**
         * DEBUG
         * check env for debug or production
         */
        if (env('APP_DEBUG') == true){
            $user->email_verified_at = now();
            $user->is_email_verified = TRUE;
            $user->is_account_verified = TRUE;
        }
        $user->save();
    }
}
