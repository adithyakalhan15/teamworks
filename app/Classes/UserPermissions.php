<?php 
namespace App\Classes;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class UserPermissions extends Authenticatable{
    const ROLE_USER = 0;
    const ROLE_AUTHOR = 1;
    const ROLE_ADMIN = 2;
    
    const TASK_VIEW_PROFILE = 0;
    const TASK_EDIT_PROFILE = 1;
    const TASK_VIEW_PUBLICATIONS = 2;
    const TASK_EDIT_PUBLICATIONS = 3;
    const TASK_CREATE_PUBLICATIONS = 4;
    const TASK_DELETE_PUBLICATIONS= 5;
    const TASK_APPROVE_PUBLICATIONS = 6;
    const TASK_APPROVE_AUTHORS = 7;
    const TASK_DELETE_ALL_ACCOUNTS = 8;
    

    protected $permissions = [
        'user'=>[self::TASK_VIEW_PROFILE, self::TASK_EDIT_PROFILE, self::TASK_VIEW_PUBLICATIONS],
        'author'=>[
            self::TASK_VIEW_PROFILE, 
            self::TASK_EDIT_PROFILE, 
            self::TASK_VIEW_PUBLICATIONS, 
            self::TASK_EDIT_PUBLICATIONS, 
            self::TASK_CREATE_PUBLICATIONS, 
            self::TASK_DELETE_PUBLICATIONS
        ],
        'admin'=>[
            self::TASK_VIEW_PROFILE, 
            self::TASK_EDIT_PROFILE, 
            self::TASK_VIEW_PUBLICATIONS, 
            self::TASK_EDIT_PUBLICATIONS, 
            self::TASK_CREATE_PUBLICATIONS, 
            self::TASK_DELETE_PUBLICATIONS, 
            self::TASK_APPROVE_PUBLICATIONS, 
            self::TASK_APPROVE_AUTHORS, 
            self::TASK_DELETE_ALL_ACCOUNTS
        ],
    ];

    /**
     * @return string
     * @throws \Exception
     */
    protected function RoleToString($role){
        switch ($role) {
            case self::ROLE_USER:
                return 'user';
            case self::ROLE_AUTHOR:
                return 'author';
            case self::ROLE_ADMIN:
                return 'admin';
            default:
                throw new Exception("Invalid Role", 1);
                
        }
    }

    /**
     * @return bool
     */
    public function _hasPermissions($role, $task){
        $role = $this->RoleToString($role);

        if (array_key_exists($role, $this->permissions)){
            if (in_array($task, $this->permissions[$role])){
                return true;
            }
        }
        return false;
    }
}


