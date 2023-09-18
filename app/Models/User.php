<?php 

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

use App\Models\Publication;
use App\Classes\UserPermissions;


class User extends UserPermissions
{
   protected $connection = 'mongodb';
   //protected $collection = 'users';

    const ROLE_USER = 0;
    const ROLE_AUTHOR = 1;
    const ROLE_ADMIN = 2;
   /**
    * Schema
      id: int,
      title: String,
      first_name: String,
      last_name: String,
      email: String,
      password: String,
      occupation: String,
      bio: String,
      user_image: String, //image name

      role: int, // 0: user, 1: author, 2: admin

      email_verified_at: Date,
      is_email_verified: Boolean,
      is_account_verified: Boolean,
    */

    // Set default values in the constructor
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Set default values
        $this->attributes['user_image'] = NULL;
        $this->attributes['role'] = 0;
        $this->attributes['email_verified_at'] = NULL;
        $this->attributes['is_email_verified'] = false;
        $this->attributes['is_account_verified'] = false;
    }

    // Override the save method for value checks
    public function save(array $options = [])
    {
        // Perform value checks before saving
        $this->validateProperties();
        return parent::save($options); // Call the original save method
    }

    // Validate the model's data
    /**
     * @throws \Exception
     */
    protected function validateProperties()
    {
        // Perform validation here and return true or false
        if ($this->role < 0 || $this->role > 2){
            throw new \Exception("Invalid value for the role.\n");
        }

        //check whether is_email_verified and email_verified_at are boolean
        if (!is_bool($this->is_email_verified)){
            throw new \Exception("Value for is_email_verified must be a boolean.\n");
        }
        if (!is_bool($this->is_account_verified)){
            throw new \Exception("Value for is_account_verified must be a boolean.\n");
        }

        //check first name, email and password are empty
        if (empty($this->first_name) || empty($this->email) || empty($this->password)){
            throw new \Exception("Email, first name and password are required.\n");
        }

        //email should be unique
        $user = User::where("email", $this->email)->get()->first();
        if (!is_null($user)){
            throw new \Exception("Email must be unique. The user already exists.\n");
        }
        /*
        public function mypublications(){
            return $this->hasMany(Publication::class, 'owner_id', '_id');
        }*/

        return true;
    }

    /**
     * @return string|array
     *
     */
    public function GetAccountType($explain_me = false){
        $role = "";
        $explain = "";
        switch ($this->role) {
            case self::ROLE_USER:
                $role = "User";
                $explain = "You can read publications.";
                break;
            case self::ROLE_AUTHOR:
                $role = "Author";
                $explain = "You can read and create publications.";
                break;
            case self::ROLE_ADMIN:
                $role = "Admin";
                $explain = "Administrative account with full control.";
                break;

            default:
                # code...
                break;
        }

        if ($explain_me){
            return [$role, $explain];
        }else{
            return $role;
        }   
    }

    public function hasPermissions($task){
        return parent::_hasPermissions($this->role, $task);
    }

}