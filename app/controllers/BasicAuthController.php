<?php

namespace controllers;

use Ubiquity\utils\http\USession;
use Ubiquity\utils\http\URequest;
use Ubiquity\controllers\Startup;

use Ubiquity\controllers\Auth\AuthFiles;
use controllers\auth\files\BasicAuthControllerFiles;

use Ubiquity\orm\DAO;
use models\User;
use Ubiquity\utils\flash\FlashMessage;


/**
 * Auth Controller BasicAuthController
 * @route("/login","inherited"=>true,"automated"=>true)
 **/
class BasicAuthController extends \Ubiquity\controllers\auth\AuthController
{

    public function _getUserSessionKey()
    {
        return 'activeUser';
    }

    protected function onConnect($connected)
    {
        $urlParts = $this->getOriginalURL();
        USession::set($this->_getUserSessionKey(), $connected);
        if (isset($urlParts)) {
            $this->_forward(implode('/', $urlParts));
        } else {
            $user = USession::get('activeUser');
            if (USession::exists('activeUser') && USession::get('activeUser') === 'Admin') {
                // Startup::forward('admin');
                $this->loadView('SignUpUserController/success-signin.html', compact('user'));
            }
            // Startup::forward('_default');
            $this->loadView('SignUpUserController/success-signin.html', compact('user'));
        }
    }

    protected function _connect()
    {
        if (URequest::isPost()) {
            $email = URequest::post($this->_getLoginInputName());
            $password = md5(URequest::post($this->_getPasswordInputName()));

            $user = DAO::uGetOne(User::class, 'email=? and password= ?', false, [$email, $password]);

            if ($user) return $user;
        }
        return;
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::isValidUser()
     */
    public function _isValidUser($action = null)
    {
        return USession::exists($this->_getUserSessionKey());
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::badLoginMessage()
     */
    protected function badLoginMessage(FlashMessage $fMessage)
    {
        $fMessage->setTitle("Authentication falied");
        $fMessage->setContent("Login or password incorrect");
        $this->_setLoginCaption("Try logging in again");
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::_getLoginInputName()
     */
    public function _getLoginInputName()
    {
        return 'email';
    }

    public function _displayInfoAsString()
    {
        return true;
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::_checkConnectionTimeout()
     */
    public function _checkConnectionTimeout()
    {
        return 10000;
    }

    /**
     * {@inheritDoc}
     * @see \Ubiquity\controllers\auth\AuthController::attemptsNumber()
     */
    protected function attemptsNumber()
    {
        return 5;
    }

    public function _getBaseRoute()
    {
        return '/login';
    }

    protected function getFiles(): AuthFiles
    {
        return new BasicAuthControllerFiles();
    }
}
