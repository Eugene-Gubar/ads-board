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

    /**
     *@route("/add","methods"=>["get", "post"])
     **/
    public function addAdvert()
    {
        $this->loadView('UserDashboardController/addAdvert.html');
    }

    /**
     *@route("/update/{id}","methods"=>["get", "post"])
     **/
    public function updateAdvert($id)
    {

        

        $this->loadView("UserDashboardController/updateAdvert.html", compact("id"));
    }

    /**
     *@route("/remove/{id}","methods"=>["get"])
     **/
    public function removeAdvert($id)
    { }
}
