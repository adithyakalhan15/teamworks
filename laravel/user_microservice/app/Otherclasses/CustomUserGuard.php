<?php
namespace App\Otherclasses;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

class CustomUserGuard implements Guard
{
    use GuardHelpers;

    protected $request;

    public function __construct($provider, Request $request, $name)
    {
        $this->guardName = $name;
        $this->request = $request;
        $this->setProvider($provider);

        $this->userResolver = function () use ($provider) {
            if ($request->has("api_key")){
                //provider is a model
                $dummy = new \stdClass();
                $dummy->name = "DFDFD";
                $dummy->password = "password";
                return $dummy;
                //return $this->user = $provider->where("apikey", "=", $request['api_key'])->where("key_expire", ">", "now()");
            }else{
                return $this->user = null;
            }
        };
    }

    public function check()
    {
        if (!is_null($this->user()) && $this->user()->type == $this->guardName){
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
        if (is_null($this->user())){
            return $this->user()->id;
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
        return true;
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser(){

    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @return void
     */
    public function setUser(Authenticatable $user){

    }
}
