<?php

namespace controllers;

use Ubiquity\utils\http\URequest;

use models\User;

use Ubiquity\orm\DAO;

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

                    echo implode('<br>', $violations);

                } else {
                    if (DAO::getOne(User::class, 'email=?', false, [$postUser["email"]])) {
                        echo 'This mail is already available.<br>';
                        // echo '<pre>'.print_r($user).'</pre>';
                    } else {
                        if (DAO::save($user)) {
                            echo 'The user was added to the database.<br>';
                        } else {
                            echo 'fail added to db';
                            echo '<pre>' . print_r($user) . '</pre>';
                        }
                    }
                }
            }
        }

        $this->loadView('SignUpUserController/signUp.html');
    }
}
