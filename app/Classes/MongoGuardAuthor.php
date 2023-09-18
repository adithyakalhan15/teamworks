<?php
namespace App\Classes;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
//use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Models\User;
use App\Classes\MongoGuard;


class MongoGuardAuthor extends MongoGuard{
    use GuardHelpers;

    protected $request;

    public function __construct($provider, Request $request, $name)
    {
        //call parent class
        parent::__construct($provider, $request, $name);        
    }

    public function checkAsUser()
    {
        return parent::check();
    }

    public function check()
    {
        if (!is_null($this->user()) && $this->user()->role == User::ROLE_AUTHOR){
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
    public function guestAsUser(){
        
        return parent::guest();
    }

     public function guest(){
        
        return is_null($this->user()) || $this->user()->role != User::ROLE_AUTHOR;
    }
}