<?php
include_once("Models/Security_Model.php");

class Security extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Security_Model();
        $this->index();
    }

    public function index()
    {
        $requests=$this->model->requests();

        $data = array(
            "requests" => $requests
        );

        $this->view->Render("Security/index",$data);
    }

}
