<?php

use \Illuminate\Session\TokenMismatchException;

class UserTest extends TestCase {

    /**
     * Test register page access
     */
    public function testRegisterPageAccess() {
        $this->call('GET', 'users/register');
        $this->assertResponseOk();
    }

    /**
     * If all input data are correct but its not a Ajax/XMLHttpRequest call then redirect him to home page.
     */
    public function testRegisterWithoutAjax() {
        $param = array('firstname' => 'Ajay', 'lastname' => 'Bhosale', 'email' => 'ajay.bhosale@globalss.com', 'password' => 'cell786', 'password_confirmation' => 'cell786', 'csrf_token' => Session::getToken());
        $response = $this->action('POST', 'UsersController@postCreate', $param);
        $this->assertRedirectedToAction('HomeController@home');
    }

    /**
     * If all input data are correct then it should store information into database and display 'success' message.
     */
    public function testRegisterWithValidData() {
        $this->client->setServerParameter('HTTP_X-Requested-With', 'XMLHttpRequest'); // need for Ajax request
        $param = array('firstname' => 'Ajay', 'lastname' => 'Bhosale', 'email' => 'ajay.bhosale@globalss.com', 'password' => 'cell786', 'password_confirmation' => 'cell786', 'csrf_token' => Session::getToken());
        $response = $this->action('POST', 'UsersController@postCreate', $param);
        $this->assertEquals('success', $response->getContent());
    }

    /**
     * If email address is already exists in database then show error message.
     */
    public function testRegisterDuplicateEmailAddress() {
        $this->client->setServerParameter('HTTP_X-Requested-With', 'XMLHttpRequest'); // need for Ajax request
        $param = array('firstname' => 'Vijay', 'lastname' => 'Bhosale', 'email' => 'ajay.bhosale@globalss.com', 'password' => 'cell786', 'password_confirmation' => 'cell786', 'csrf_token' => Session::getToken());
        $response = $this->action('POST', 'UsersController@postCreate', $param);
        $this->assertRedirectedToAction('UsersController@getError');
    }

    /**
     * If input data are not correct then it should not store information into database and redirect/show to error page.
     */
    public function testRegisterWithInValidData() {
        $this->client->setServerParameter('HTTP_X-Requested-With', 'XMLHttpRequest'); // need for Ajax request
        $param = array('firstname' => 'Ajay', 'lastname' => 'Bhosale', 'password_confirmation' => 'cell234723');
        $response = $this->action('POST', 'UsersController@postCreate', $param);
        $this->assertRedirectedToAction('UsersController@getError');
    }

    /**
     * Test login page access
     */
    public function testLoginPageAccess() {
        $this->call('GET', 'users/login');
        $this->assertResponseOk();
    }

    /**
     * If Email and Password are correct then it should display 'success' message.
     */
    public function testLoginWithValidData() {
        $this->client->setServerParameter('HTTP_X-Requested-With', 'XMLHttpRequest');
        $param = array('email' => 'ajay.bhosale@globalss.com', 'password' => 'cell786');
        $response = $this->action('POST', 'UsersController@postSignin', $param);
        $this->assertEquals('success', $response->getContent());
    }

    /**
     * Test login with in-valid data.
     */
    public function testLoginWithInValidData() {
        /**
         *  Email or Password field is missing then it should redirect to error page. 
         */
        $this->client->setServerParameter('HTTP_X-Requested-With', 'XMLHttpRequest'); // need for Ajax request
        $param = array('password' => 'roja786');
        $this->action('POST', 'UsersController@postSignin', $param);
        $this->assertRedirectedToAction('UsersController@getError');
    }

    /**
     * Test login without Ajax/XMLHttpRequest in-valid data.
     */
    public function testLoginWithoutAjax() {
        /**
         *  Though Email or Password values are correct but if not a Ajax/XMLHttpRequest request then redirect him to home pahe
         */
        $param = array('email' => 'ajay.bhosale@globalss.com', 'password' => 'cell786');
        $this->action('POST', 'UsersController@postSignin', $param);
        $this->assertRedirectedToAction('HomeController@home');
    }

    /**
     * Prevent dashboard [http://www.ajay.com/users/dashboard] access without login
     */
    public function testAccessDashboardWithoutLogin() {
        /**
         *  Without login someone tried to access dashboard link then it should redirect him to home page for login. 
         */
        Route::enableFilters();
        $this->call('GET', 'users/dashboard');
        $this->assertRedirectedTo('login');
    }

    /**
     * If user logut then redirect him to home page.
     */
    public function testLogout() {
        $this->call('GET', 'users/logout');
        $this->assertRedirectedToAction('HomeController@home');
    }

}
