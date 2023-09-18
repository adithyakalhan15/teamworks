<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;

class LoginController extends Controller
{
    
    // Login page
    public function ShowLoginPage(Request $request){
        return view('user.login');
    }

    // Attempt login
    public function AttemptLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        try {
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
                return redirect()->route('home')->with('message', "Login successfull.");
            }else{
                echo "Login failed";
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    public function Logout(Request $request) {
        Auth::logout();
        return redirect()->back();
    }
}
