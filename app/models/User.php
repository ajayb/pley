<?php

/**
 * User: Ajay Bhosale
 * Date: 08/04/2014
 * Time: 9:40 PM
 */
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * This will set rules for user registration.
     *
     * @name        $rules
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>  
     * 
     * @var array         
     */
    public static $rules = array(
        'firstname' => 'required|alpha|min:2',
        'lastname' => 'required|alpha|min:2',
        'email' => 'required|email|unique:users',
        'password' => 'required|alpha_num|between:6,12|confirmed',
        'password_confirmation' => 'required|alpha_num|between:6,12'
    );

    /**
     * The database table used by the model.
     *
     * @name        $table
     * @access      Protected
     * @author      Ajay Bhosale <avbhosale@gmail.com>
     * 
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @name        $hidden
     * @access      Protected
     * @author      Ajay Bhosale <avbhosale@gmail.com>
     * 
     * @var array
     */
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @name        getAuthIdentifier
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       null
     * @return      mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @name        getAuthPassword
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>       
     *  
     * @param       null
     * @return      string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @name        getReminderEmail
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>        
     * 
     * @param       null
     * @return      string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    /**
     * Get the reminder token.
     *
     * @name        getRememberToken
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       null
     * @return      string
     */
    public function getRememberToken() {
        return $this->remember_token;
    }

    /**
     * Set the reminder token.
     *
     * @name        setRememberToken
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>    
     *     
     * @param       $value : string
     * @return      void
     */
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    /**
     * Get the reminder token name.
     *
     * @name        getRememberTokenName
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       null
     * @return      string
     */
    public function getRememberTokenName() {
        return 'remember_token';
    }

    /**
     * Add new user in users table.
     *
     * @name        addNewUser
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       $userDetails : Object
     * @return      Boolean 
     */
    public function addNewUser($userDetails) {

        try {
            $this->firstname = $userDetails->firstname;
            $this->lastname = $userDetails->lastname;
            $this->email = $userDetails->email;
            $this->password = $userDetails->password;
            $this->save();
            return true;
        } catch (Exception $ex) {
            Log::error($ex);
            return false;
        }
    }

}
