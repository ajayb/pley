<?php

class UsersController extends BaseController {

    protected $layout = "layouts.main";

    public function __construct(User $user) {
        $this->beforeFilter('csrf', array('on' => 'post'));
        $this->beforeFilter('auth', array('only' => array('getDashboard')));
    }

    public function getRegister() {
        return View::make('users.register');
    }

    public function postCreate() {
        if (Request::ajax()) {
            $validator = Validator::make(Input::all(), User::$rules);

            if ($validator->passes()) {
                $user = new User;
                $user->firstname = Input::get('firstname');
                $user->lastname = Input::get('lastname');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));
                $user->save();

                $message = 'success';
                return View::make('users/remote', compact('message'));
            } else {
                return Redirect::to('users/error')->with('error', 'The following errors occurred')->withErrors($validator)->withInput();
            }
        } else {
            return Redirect::to('/')->with('error', 'Your are trying to access restricted page');
        }
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postSignin() {
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

    public function getDashboard() {
        $this->layout->title = 'Dashboard';
        $this->layout->content = View::make('users.dashboard');
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::to('/')->with('message', 'Your are now logged out!');
    }

    public function getThankyou() {
        $this->layout->title = 'Registration';
        $this->layout->content = View::make('users.thankyou');
    }

    public function getError() {
        return View::make('error');
    }

    public function getTest() {
        $message = 'success';
        return View::make('users/signin', compact('message'));
    }
}