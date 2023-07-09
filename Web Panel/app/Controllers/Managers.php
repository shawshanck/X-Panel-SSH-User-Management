<?php
include_once("../app/Models/Managers_Model.php");
class Managers extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Managers_Model();
        $this->index();
    }
    public function index()
    {
        $users=$this->model->managers();
        //  echo "<pre>";
        // print_r($users);
        $data = array(
            "for" => $users
        );
        if (!empty(action) and action=='active') {
            $usernme = htmlspecialchars(action_run);
            $data_sybmit = array(
                'username' => $usernme
            );
            $this->model->submit_ative($data_sybmit);
        }

        if (!empty(action) and action=='deactive') {
            $usernme = htmlspecialchars(action_run);
            $data_sybmit = array(
                'username' => $usernme
            );
            $this->model->submit_deative($data_sybmit);
        }

        if (!empty(action) and action=='delete') {
            $usernme = htmlspecialchars(action_run);
            $data_sybmit = array(
                'username' =>$usernme
            );
            $this->model->delete_user($data_sybmit);
        }


        $this->submit_index();

        $this->view->Render("Managers/index",$data);
    }
    function submit_index(){

        if (isset($_POST['submit']))
        {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                $data_sybmit = array(
                    'username' => $username,
                    'password' => $password
                );
                //shell_exec("bash adduser " . $username . " " . $password);
                $this->model->submit_index($data_sybmit);
            }


        }

    }




}
