<?php
include_once("../app/Models/Security_Model.php");

class Ip extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Security_Model();
        $this->index();
    }

    public function index()
    {
        $blocklist=$this->model->iplist();

        $data = array(
            "list" => $blocklist
        );
        if (!empty(action) and action=='allow') {
            $id = htmlspecialchars(action_run);
            if (preg_match('/^[0-9]+$/', $id)) {
                $data_sybmit = array(
                    'id' =>$id
                );
                $this->model->submit_allow($data_sybmit);
            }
        }

        if(!empty(action) and action=='ban') {
            $id = htmlspecialchars(action_run);
            if (preg_match('/^[0-9]+$/', $id)) {
                $data_sybmit = array(
                    'id' =>$id
                );
                $this->model->submit_band($data_sybmit);
            }
        }

        if(!empty(action) and action=='id') {
            $id = htmlspecialchars(action_run);
            if (preg_match('/^[0-9]+$/', $id)) {
                $data_sybmit = array(
                    'id' =>$id
                );
                $this->model->delete_ip($data_sybmit);
            }
        }
        if (isset($_POST['submit']) and csrfAccess=='true') {
            $ip = htmlspecialchars($_POST['ip']);
            $desc = htmlspecialchars($_POST['desc']);
            $status = htmlspecialchars($_POST['status']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $ip)
                and empty($desc) or  preg_match('/^[a-zA-Z0-9]+$/', $desc)
                and preg_match('/^[a-zA-Z0-9]+$/', $status)) {
                $data_sybmit = array(
                    'ip' => $ip,
                    'desc' => $desc,
                    'status' => $status
                );

                //shell_exec("bash adduser " . $username . " " . $password);
                $this->model->ip_insert($data_sybmit);
            }
        }

        $this->view->Render("Security/ip",$data);
    }

}
