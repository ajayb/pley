<?php

/**
 * User: Ajay Bhosale
 * Date: 08/04/2014
 * Time: 9:40 PM
 */
class UsersController extends BaseController {

    /**
     * Set default layout to the application.
     *
     * @name        $layout
     * @access      protected
     * @author      Ajay Bhosale <avbhosale@gmail.com>  
     * 
     * @var string         
     */
    protected $layout = "layouts.main";

    public function __construct(User $user) {

        // Prevent users from directly accessing to pages which require login        
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    /**
     * Get the user registration page.
     *
     * @name        getRegister
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getRegister() {
        return View::make('users.register');
    }

    /**
     * Create new user.
     *
     * @name        postCreate
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function postCreate() {
        //If the request is Ajax base then only allow user for registration
        if (Request::ajax()) {
            $validator = Validator::make(Input::all(), User::$rules);

            if ($validator->passes()) {

                $userDetails = new stdClass();
                $userDetails->firstname = Input::get('firstname');
                $userDetails->lastname = Input::get('lastname');
                $userDetails->email = Input::get('email');
                $userDetails->password = Hash::make(Input::get('password'));

                $user = new User;
                if ($user->addNewUser($userDetails)) {
                    $message = 'success';
                    return View::make('users/remote', compact('message'));
                }
            }
            return Redirect::to('users/error')->with('error', 'The following errors occurred')->withErrors($validator)->withInput();
        } else {
            return Redirect::to('/')->with('error', 'Your are trying to access restricted page');
        }
    }

    /**
     * Get login page.
     *
     * @name        getLogin
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getLogin() {
        return View::make('users.login');
    }

    /**
     * Authenticate login details and allow user to access register pages.
     *
     * @name        postSignin
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function postSignin() {
        //If the request is Ajax base then only allow user for login
        if (Request::ajax()) {
            if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {
                $message = 'success';
                return View::make('users/remote', compact('message'));
            } else {
                return Redirect::to('users/error')->with('error', 'Your username/password combination was incorrect');
            }
        } else {
            return Redirect::to('/')->with('error', 'Your are trying to access restricted page');
        }
    }

    /**
     * Get access to dashboard page.
     *
     * @name        getDashboard
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getDashboard() {
        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('users.dashboard');
    }

    /**
     * Logout user from the system.
     *
     * @name        getLogout
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getLogout() {
        Auth::logout();
        return Redirect::to('/')->with('message', 'Your are now logged out!');
    }

    /**
     * After successful registration show welcome message
     *
     * @name        getThankyou
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getThankyou() {
        $this->layout->title = 'Registration';
        $this->layout->content = View::make('users.thankyou');
    }

    /**
     * Display error 
     *
     * @name        getError
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function getError() {
        return View::make('error');
    }

}
