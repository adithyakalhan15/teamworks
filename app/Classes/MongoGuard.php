<?php
namespace App\Classes;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
//use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Models\User;



class MongoGuard implements Guard{
    use GuardHelpers;

    protected $request;

    const UserCookieName = "user_";

    public function __construct($provider, Request $request, $name)
    {
        $this->guardName = $name;
        $this->request = $request;
        $this->setProvider($provider);
        $this->user = null;

        $this->userResolver = function () use ($provider) {
            $uid = $request->session()->get("user_id", null);


            if (!is_null($uid)){
                // using logged in session value to get the user
                $user = User::find($uid);
                if (!is_null($user)){
                    $this->setUser($user);
                    return  $user;
                }
            }
            
            return FALSE;

        };
        
        //check if the session exists
        $uid = $request->session()->get("user_id");
        if (!is_null($uid)){
            $user = User::find($uid);
            if (!is_null($user)){
                $this->setUser($user);
            }
        }
        
    }



    public function check()
    {
        if (!is_null($this->user())){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    // Implement other methods of the Guard interface here

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest(){
        
        return is_null($this->user());
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user(){
        return $this->user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|string|null
     */
    public function id(){
        if (!is_null($this->user())){
            return $this->user()->_id;
        }

        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array  $credentials
     * @return bool
     */
    public function validate(array $credentials = []){
        //very simple validation
        if (isset($credentials['email']) && isset($credentials['password']) 
            && !empty($credentials['email']) && !empty($credentials['password'])){
            return true;
        }
        return false;
    }

    public function attempt(array $credentials = [], $remember=FALSE){
        //check if user cookie is available
        if ($this->validate($credentials)){
            $user = User::where("email", $credentials['email'])->first();
            if (!is_null($user)){
                if (Hash::check($credentials['password'], $user->password)){
                    $this->login($user, $remember);
                    return TRUE;
                }
            }
        }

        return FALSE;
        
    }

    public function login($user, $remember=FALSE){
        //set the user
        $this->setUser($user);

        //set the session
        $this->request->session()->put("user_id", $user->_id);

        //set the cookie
        if ($remember){
            //$this->request->cookie()->forever(self::UserCookieName, $user->user_id);
        }
    }

    

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser(){
        return $this->check();
    }

    /**
     * Set the current user.
     *
     * @pdaram  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user){
        $this->user = $user;
    }

    public function logout() {
        $this->request->session()->forget("user_id");

        //remove remember cookie
        if (isset($_COOKIE[self::UserCookieName])){
            if (is_array($this->user->remembertokens)){
                foreach ($this->user->remembertokens as $key -> $token) {
                    if ($token == $_COOKIE[self::UserCookieName]){
                        unset($this->user->remembertokens[$key]);
                        $this->user->save();
                        break;
                    }
                }
            }
            setcookie(self::UserCookieName, "", time() - 3600);

        }
        $this->user = null;
    }
}