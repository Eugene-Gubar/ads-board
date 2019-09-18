<?php

namespace controllers;

use Ubiquity\utils\http\USession;


/**
 * Controller IndexController
 **/
class IndexController extends ControllerBase
{

    public function index()
    {
        $this->loadView("IndexController/index.html");
    }

    public function viewSession()
    {
       echo '<pre>'.print_r(USession::getAll()).'</pre><br>';
       $sUser = USession::get('activeUser');
    //    $sRole = $sUser->getRole();
       echo $sUser;
    }
}
