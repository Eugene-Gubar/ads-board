<?php

namespace controllers;

use Ubiquity\utils\http\URequest;

use models\User;
use Ubiquity\orm\DAO;

use Ubiquity\log\Logger;

use Ubiquity\contents\validation\ValidatorsManager;


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

        $vio = [];
        $success = [];

        if (URequest::isPost()) {
            $postUser = URequest::getPost();
            if ($postUser) {
                $user = new User();

                $user->setName($postUser["name"]);
                $user->setLastname($postUser["lastname"]);
                $user->setEmail($postUser["email"]);
                $user->setPhone($postUser["phone"]);
                $user->setPassword($postUser["password"]);

                $violations = ValidatorsManager::validate($user);

                if (mb_strlen($postUser["phone"]) <= 6) {
                    array_push($violations, 'phone: Number must be longer than 6 characters');
                } else {
                    if (!filter_var($postUser["phone"], FILTER_SANITIZE_NUMBER_INT)) {
                        array_push($violations, 'phone: Invalid value for phone');
                    }
                }

                if ($postUser["password"] === $postUser["confirm"]) {
                    if (mb_strlen($postUser["password"]) <= 6) {
                        array_push($violations, 'password: Password must be longer than 6 characters');
                    } else {
                        $user->setPassword(md5($postUser["password"]));
                    }
                } else {
                    array_push($violations, 'password: Confirm and password fields must match');
                }


                if (sizeof($violations) > 0) {

                    Logger::warn('Sign up', 'An unsuccessful attempt to register a user. Invalid data fields.');

                } else {
                    if (DAO::getOne(User::class, 'email=?', false, [$postUser["email"]])) {
                        array_push($violations, 'This mail is already available.');
                    } else {
                        if (DAO::save($user)) {
                            array_push($success, 'The user was added to the database');
                        } else {
                            array_push($violations, 'Fail added to db. Please try again');
                        }
                    }
                }
            }
        }

        $vio = explode('~]*', implode('~]*', $violations));

        $this->loadView('SignUpUserController/signUp.html', compact('vio', 'success'));
    }
}
