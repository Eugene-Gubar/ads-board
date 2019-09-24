<?php

namespace controllers;

use Ubiquity\orm\DAO;
use Ubiquity\utils\http\UResponse;
use Ubiquity\utils\http\USession;
use models\Ads;


/**
 * Controller IndexController
 **/
class IndexController extends ControllerBase
{
    public function index()
    {
        $this->loadView("IndexController/index.html");
        $this->getAdsAll(1, 10);
    }

    public function viewSession()
    {
        echo '<pre>' . print_r(USession::getAll()) . '</pre><br>';
        //    $sUser = USession::get('activeUser');
        //    $sRole = $sUser->getRole();
        //    echo print_r(USession::get('activeUser')->getId());
    }


    /**
     * @route("view/{id}", "requirements"=>["id"=>"\d+"], "methods"=>["get"])
     */
    public function getAdsView($id)
    {
        if ($ad = DAO::getOne(Ads::class, $id)) {
            $this->loadView('IndexController/getAdsView.html', compact('ad'));
        } else {
            UResponse::header('Messages', 'Not Found', false, 404);
            echo 'Not Found';
        }
    }

    /**
     * @route("/{pageNum}/{rowsPerPage}", "requirements"=>["pageNum"=>"\d+", "rowsPerPage"=>"\d+"], "methods"=>["get"])
     **/
    public function getAdsAll($pageNum, $rowsPerPage)
    {
        if ($pageNum > 0 && $rowsPerPage > 0) {

            $ads = DAO::paginate(Ads::class, $pageNum, $rowsPerPage);
            $count = DAO::count(Ads::class);
            $pages = ceil($count / $rowsPerPage);
            
            $this->loadView('IndexController/getAdsAll.html', compact('ads', 'pages', 'pageNum', 'rowsPerPage'));

        } else {
            UResponse::header('Messages', 'Bad Request', false, 400);
            echo 'Bad Request';
        }
    }
}
