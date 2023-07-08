<?php
include_once("Models/Index_Model.php");

class Online extends Controller
{

    function __construct()
    {

        parent::__construct();
        $this->model = new Index_Model();

        if (!empty(action) and action=='kill-id') {
            $killid = htmlspecialchars(action_run);
            shell_exec("sudo kill -9 " . $killid);
        }

        if (!empty(action) and action=='kill-user') {
            $killuser = htmlspecialchars(action_run);
            shell_exec("sudo killall -u " . $killuser);
        }
        $this->view->Render("Online/index");
    }
}
