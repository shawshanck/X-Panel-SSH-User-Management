<?php
include_once("Models/Fixer_Model.php");
class Fixer extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Fixer_Model();
        $this->index();
    }
    public function index()
    {
                if(!empty(action) and action=='jub' and action_run=='exp') {
                $this->model->cronexp();
            }
            if (!empty($_GET["jub"]) and $_GET["jub"] == 'synstraffic')
                if(!empty(action) and action=='jub' and action_run=='synstraffic') {
                $this->model->synstraffic();
            }

                if(!empty(action) and action=='jub' and action_run=='multi') {
                $this->model->multiuser();
            }
    }
}
