<?php

namespace controllers;

use Ubiquity\utils\http\USession;
use Ubiquity\controllers\Startup;
use Ubiquity\utils\http\URequest;
use Ubiquity\utils\base\UFileSystem;

use Ubiquity\contents\validation\ValidatorsManager;
use Ubiquity\log\Logger;

use Ubiquity\utils\http\UResponse;

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
                } elseif (sizeof($violations) === 0) {

                    if ($_FILES['image']['size'] > 0) {
                        $t_dir = UFileSystem::cleanPathname('public/assets/img/');
                        $t_file = UFileSystem::cleanFilePathname($t_dir . basename($_FILES['image']['name']));
                        $iType = strtolower(pathinfo($t_file, PATHINFO_EXTENSION));
                        $iHashName = md5(pathinfo($_FILES['image']['name'], PATHINFO_FILENAME));

                        if ($_FILES['image']['size'] > 5000000) {
                            array_push($violations, 'File is too large');
                        }

                        if ($iType != 'webp' && $iType != 'jpg' && $iType != 'png' && $iType != 'jpeg') {
                            array_push($violations, 'Only .WEBP .JPG, .JPEG, .PNG extension files are allowed');
                        }

                        $iFileHashName = $t_dir . basename($iHashName) . '.' . $iType;

                        if (file_exists($iFileHashName)) {
                            array_push($violations, 'File already exists. Try to change name file');
                        } else {

                            if (move_uploaded_file($_FILES['image']['tmp_name'], $iFileHashName)) {
                                $adv->setImageName($iHashName);
                                $adv->setImageType($iType);
                            } else {
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
                        } catch (\Exception $e) {
                            Logger::error('DATABASE', 'Failed to add a new user to the database. Please try again', $e->getMessage());
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
     *@route("/remove/{id}","requirements"=>["id"=>"\d+"], "methods"=>["get"])
     **/
    public function removeAdvert($id)
    {

        if (is_int(intval($id)) && $adv = DAO::getOne(Ads::class, $id)) {
            $t_dir = UFileSystem::cleanPathname('public/assets/img/');

            try {
                // $adv = DAO::getOne(Ads::class, $id);

                $imageHashName = $adv->getImageName();
                $imageType = $adv->getImageType();
                $idUserAd = $adv->getUser()->getId();
                echo 'asdf';
                if ($idUserAd === USession::get('activeUser')->getId()) {
                    if (DAO::delete(Ads::class, $id)) {
                        UFileSystem::deleteFile($t_dir.$imageHashName.'.'.$imageType);

                        echo 'Advert deleted from database';
                        Logger::info('Delete', 'Remove advert id: '.$id.' for user id: '.$idUserAd.' from database');
                        UResponse::header('Messages', 'Gone', false, 410);
                    }
                } else {
                    echo 'Forbidden. The request is not allowed.';
                    Logger::info('Forbidden', 'Remove advert id: '.$id.' for user id: '.$idUserAd.' Not allowed.');
                    UResponse::header('Messages', 'Forbidden', false, 403);
                }
            } catch (\PDOException $e) {
                UResponse::header('Messages', 'Internal Server Error', false, 500);
                Logger::error('DAOUpdates', $e->getMessage(), 'Delete');

            } catch (\Exception $e) {
                UResponse::header('Messages', 'Internal Server Error', false, 500);
                Logger::error('Caught Exception', $e->getMessage());
            }

        } else {
            echo 'Bad Request';
            UResponse::header('Messages', 'Bad Request', false, 400);
        }

    }


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
