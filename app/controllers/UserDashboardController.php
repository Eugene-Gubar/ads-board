<?php

namespace controllers;

use Ubiquity\utils\http\USession;
use Ubiquity\controllers\Startup;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\base\UFileSystem;

use Ubiquity\contents\validation\ValidatorsManager;
use Ubiquity\log\Logger;

use Ubiquity\orm\DAO;

use models\Ads;
use models\User;

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

        $ads = DAO::getOne(User::class, USession::get('activeUser')->getId())->getAdss();

        $this->loadView('UserDashboardController/userDashboard.html', compact('ads'));
    }

    /**
     *@route("/add","methods"=>["get", "post"])
     **/
    public function addAdvert()
    {

        $vio = [];
        $success = [];
        $violations = [];

        if (URequest::isPost()) {
            $pAdvertForm = URequest::getPost();

            if ($pAdvertForm) {
                $adv = new Ads();

                $adv->setTitle($pAdvertForm['title']);
                $adv->setBody($pAdvertForm['body']);

                $violations = ValidatorsManager::validate($adv);

                if (mb_strlen($pAdvertForm['title']) <= 12) {
                    array_push($violations, 'title: Title must be longer than 12 characters');
                } else {

                    $iHashName = NULL;
                    if ($_FILES['image']['size'] > 0) {
                        $t_dir = UFileSystem::cleanPathname('public/assets/img/');
                        $t_file = UFileSystem::cleanFilePathname($t_dir . basename($_FILES['image']['name']));
                        $iType = strtolower(pathinfo($t_file, PATHINFO_EXTENSION));
                        $iHashName = md5(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME));

                        if ($_FILES['image']['size'] > 5000000) {
                            array_push($violations, 'File is too large');
                        }

                        if ($iType != 'jpg' && $iType != 'png' && $iType != 'jpeg') {
                            array_push($violations, 'Only JPG, JPEG, PNG files are allowed');
                        }

                        $iFileHashName = $t_dir . basename($iHashName) . '.' . $iType;

                        if (file_exists($iFileHashName)) {
                            array_push($violations, 'File already exists. Try to change name file');
                        } else {

                            if (!(move_uploaded_file($_FILES['image']['tmp_name'], $iFileHashName))) {
                                array_push($violations, 'Failed to write file to server. Try again');
                            }
                        }
                    }

                    if (!(is_array($violations) && sizeof($violations) > 0)) {

                        $user = DAO::uGetOne(User::class, USession::get('activeUser')->getId(), false);

                        $adv->setUser($user);

                        try {
                            if (DAO::save($adv)) {
                                array_push($success, 'The new Advert was added.');
                                Logger::info('DATABASE', 'The new Advert was added to the database');
                            }
                        } catch (\Throwable $th) {
                            Logger::error('DATABASE', 'Failed to add a new user to the database. Please try again');
                        }
                    }
                }
            }
        }

        if (is_array($violations) && sizeof($violations) > 0) {
            $vio = explode('~]*', implode('~]*', $violations));
        }

        $this->loadView('UserDashboardController/addAdvert.html', compact('vio', 'success'));
    }

    /**
     *@route("/update/{id}","methods"=>["get", "post"])
     **/
    public function updateAdvert($id)
    {



        $this->loadView('UserDashboardController/updateAdvert.html', compact('id'));
    }

    /**
     *@route("/remove/{id}","methods"=>["get"])
     **/
    public function removeAdvert($id)
    { }


    public function isValid($action)
    {
        if (USession::exists('activeUser')) return true;
        return false;
    }

    public function onInvalidControl()
    {
        Startup::forward('/_default');
    }
}
