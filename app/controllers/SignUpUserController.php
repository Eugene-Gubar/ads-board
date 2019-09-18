<?php

namespace controllers;

use Ubiquity\utils\http\URequest;

/**
 * Controller SignUpUserController
 **/
class SignUpUserController extends ControllerBase
{

    public function index()
    { }

    /**
     *@route("/signup")
     **/
    public function signUp()
    {
        // $rpData = URequest::getPost();
        // echo '<pre>'.print_r($rpData).'</pre>';
        $this->loadView('SignUpUserController/signUp.html');
    }
}
