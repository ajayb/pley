<?php

class HomeController extends BaseController {

    protected $layout = "layouts.main";

    public function home() {
        $this->layout->title = 'Welcome to Pley World!!!';
        $this->layout->content = View::make('home');
    }
}