<?php
/**
 * User: Ajay Bhosale
 * Date: 08/04/2014
 * Time: 9:40 PM
 */
class HomeController extends BaseController {

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

    /**
     * Get default home page.
     *
     * @name        home
     * @access      Public
     * @author      Ajay Bhosale <avbhosale@gmail.com>   
     *      
     * @param       nothing
     * @return      mixed
     */
    public function home() {
        $this->layout->title = 'Welcome to Pley World!!!';
        $this->layout->content = View::make('home');
    }
}