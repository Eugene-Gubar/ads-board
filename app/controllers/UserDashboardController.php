<?php

namespace controllers;

/**
 * Controller UserDashboardController
 **/
class UserDashboardController extends ControllerBase
{

    public function index()
    { }

    /**
     *@route("/user-dashboard","methods"=>["get"])
     **/
    public function userDashboard()
    {
        $this->loadView("UserDashboardController/userDashboard.html");
    }
}
