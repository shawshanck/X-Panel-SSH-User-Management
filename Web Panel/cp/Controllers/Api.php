<?php
include_once("Models/Api_Model.php");
class Api extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Api_Model();
        $key = htmlspecialchars(key);
        $token = $this->model->check_token($key);
        if($token == 'allowed'){
            $this->index();
        }else{

            echo 'invalid api key';

        }

    }
    public function index()
    {
        //list user
        if (!empty(action) and action=='method' and action_run=='listuser' and empty(api_action)) {
            $list_user = $this->model->list_user();
            $this->response($list_user) ;
        }

        //sort status user
        if (!empty(key) and !empty(method) and method=='listuser' and api_action=='status') {
            $status_user = $this->model->status_user(api_action_run);
            $this->response($status_user) ;
        }

        //active user
        if (!empty(key) and !empty(method) and method=='activeuser') {
            $username = htmlspecialchars($_POST['username']);
            if(!empty($username) and preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                $data_sybmit = array(
                    'username' => $username
                );
                $this->model->active_user($data_sybmit);
            }
            else
            {
                echo "invalid empty username";
            }
        }
        //deactive user
        if(!empty(key) and !empty(method) and method=='deactiveuser'){
            $username = htmlspecialchars($_POST['username']);
            if(!empty($username) and preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                $data_sybmit = array(
                    'username' => $username
                );
                $this->model->deactive_user($data_sybmit);
            }
            else
            {
                echo "invalid empty username";
            }
        }
        //reset traffic user
        if(!empty(key) and !empty(method) and method=="resetuser"){
            $username = htmlspecialchars($_POST['username']);
            if(!empty($username) and preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                $data_sybmit = array(
                    'username' => $username
                );
                $this->model->reset_user($data_sybmit);
            }
            else
            {
                echo "invalid empty username";
            }
        }
        //renewal user
        if(!empty(key) and !empty(method) and method=="renewal"){
            $username = htmlspecialchars($_POST['username']);
            $day_date = htmlspecialchars($_POST['day_date']);

            $renewal_date = htmlspecialchars($_POST['re_date']);
            $renewal_traffic = htmlspecialchars($_POST['re_traffic']);

            if(!empty($username) and !empty($day_date) and !empty($renewal_date) and !empty($renewal_traffic)
                and preg_match('/^[-a-zA-Z0-9]+$/', $day_date)
                and preg_match('/^[-a-zA-Z0-9]+$/', $renewal_date)
                and preg_match('/^[-a-zA-Z0-9]+$/', $renewal_traffic)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                $data_sybmit = array(
                    'username' => $username,
                    'day_date' => $day_date,
                    'renewal_date' => $renewal_date,
                    'renewal_traffic' => $renewal_traffic
                );
                $this->model->renewal_update($data_sybmit);
            }
            else
            {
                echo "invalid empty username and date";
            }
        }
        //add user
        if(!empty(key) and !empty(method) and method=="adduser"){
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $mobile = htmlspecialchars($_POST['mobile']);
            $multiuser = htmlspecialchars("1") ;
            if(isset($_POST['multiuser'])){
                $multiuser = htmlspecialchars($_POST['multiuser']);
            }
            $connection_start = htmlspecialchars($_POST['connection_start']);
            $traffic = htmlspecialchars('0');
            if(isset($_POST['traffic'])){
                $traffic = htmlspecialchars($_POST['traffic']);
            }
            $type_traffic = htmlspecialchars($_POST['type_traffic']);
            $expdate = htmlspecialchars($_POST['expdate']);
            $desc = htmlspecialchars($_POST['desc']);
            if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)
                and empty($email) or preg_match('/^[a-zA-Z0-9-@]+$/', $email)
                and empty($mobile) or preg_match('/^[a-zA-Z0-9-@]+$/', $mobile)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                and empty($connection_start) or preg_match('/^[a-zA-Z0-9-@]+$/', $connection_start)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)
                and empty($expdate) or preg_match('/^[\/-a-zA-Z0-9-۱۲۳۴۵۶۷۸۹۰]+$/', $expdate)
                and empty($desc) or preg_match('/^[a-zA-Z0-9-@-اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]+$/', $desc)) {
                if (!empty($connection_start)) {
                    $st_date = '';
                } else {
                    $st_date = date("Y-m-d");
                }
                if ($type_traffic == "gb") {
                    $traffic = $traffic * 1024;
                } else {
                    $traffic = $traffic;
                }
                if (!empty($username) and !empty($password)) {
                    $data_sybmit = array(
                        'username' => $username,
                        'password' => $password,
                        'email' => $email,
                        'mobile' => $mobile,
                        'multiuser' => $multiuser,
                        'startdate' => $st_date,
                        'finishdate' => $expdate,
                        'finishdate_one_connect' => $connection_start,
                        'enable' => 'true',
                        'traffic' => $traffic,
                        'referral' => '',
                        'info' => $desc
                    );
                    $this->model->submit_index($data_sybmit);
                }
            }
            else
            {
                echo "invalid empty username and password";
            }

        }

        //show user
        if(isset($_GET['method']) && $_GET['method'] == "user" && !empty($_GET['username']))
            if(!empty(key) and !empty(method) and method=="user" and api_action=='username'){
                $usernme = htmlspecialchars(api_action_run);
                $show_user = $this->model->show_user($usernme);
                $this->response($show_user) ;
            }
        //edit user
        if(isset($_GET['method']) && $_GET['method'] == "edituser"){
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $mobile = htmlspecialchars($_POST['mobile']);
            $multiuser = htmlspecialchars($_POST['multiuser']);
            $traffic = htmlspecialchars($_POST['traffic']);
            $type_traffic = htmlspecialchars($_POST['type_traffic']);
            $expdate = htmlspecialchars($_POST['expdate']);
            $desc = htmlspecialchars($_POST['desc']);
            if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)
                and empty($email) or preg_match('/^[a-zA-Z0-9-@]+$/', $email)
                and empty($mobile) or preg_match('/^[a-zA-Z0-9-@]+$/', $mobile)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)
                and empty($expdate) or preg_match('/^[\/-a-zA-Z0-9-۱۲۳۴۵۶۷۸۹۰]+$/', $expdate)
                and empty($desc) or preg_match('/^[a-zA-Z0-9-@-اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]+$/', $desc)) {
                if ($type_traffic == "gb") {
                    $traffic = $traffic * 1024;
                } else {
                    $traffic = $traffic;
                }
                if (!empty($username) && !empty($password)) {
                    $data_sybmit = array(
                        'username' => $username,
                        'password' => $password,
                        'email' => $email,
                        'mobile' => $mobile,
                        'multiuser' => $multiuser,
                        'finishdate' => $expdate,
                        'traffic' => $traffic,
                        'info' => $desc
                    );
                    $edit_user = $this->model->edit_user($data_sybmit);
                    $this->response($edit_user);
                }
            }
            else
            {
                echo "invalid empty username and password";
            }
        }
        // delete user
        if(!empty(key) and !empty(method) and method=="deleteuser"){
            $usernme = htmlspecialchars($_POST['username']);
            if(!empty($usernme) and preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' => $usernme
                );
                $this->model->delete_user($data_sybmit);
            }
            else
            {
                echo "invalid empty username";
            }
        }


    }

    function response($data){

        $res= [
            'version' => '3.6',
            'status' => 200,
            'data'   => $data

        ];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($res,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

}
