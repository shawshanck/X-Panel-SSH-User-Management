<?php
include_once("../app/Models/Users_Model.php");
class Users extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Users_Model();
        $this->index();
    }
    public function index()
    {
        $users=$this->model->users();
        $setting=$this->model->Get_settings();

        //  echo "<pre>";
        // print_r($users);
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $password = substr( str_shuffle( $chars ), 0, 8 );
        $data = array(
            "for" => $users,
            "setting" => $setting,
            "password" => $password
        );
        if (!empty(action) and action=='active') {
            $usernme = htmlspecialchars(action_run);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' => $usernme
                );
                $this->model->submit_ative($data_sybmit);
            }
        }

        if(!empty(action) and action=='deactive') {
            $usernme = htmlspecialchars(action_run);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' => $usernme
                );
                $this->model->submit_deative($data_sybmit);
            }
        }

        if(!empty(action) and action=='delete') {
            $usernme = htmlspecialchars(action_run);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' =>$usernme
                );
                $this->model->delete_user($data_sybmit);
            }
        }

        if(!empty(action) and action=='reset-traffic') {
            $usernme = htmlspecialchars(action_run);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' => $usernme
                );
                $this->model->reset_traffic($data_sybmit);
            }
        }

        $this->submit_index();
        $this->submit_index_bulk();
        $this->bulk_delete();
        $this->renewal_date();
        $this->view->Render("Users/index",$data);
    }
    function bulk_delete(){

        if (isset($_POST['delete']) and csrfAccess=='true') {
            $checkbox = htmlspecialchars($_POST['usernamed']);
            foreach ($checkbox as $val) {
                if (preg_match('/^[-a-zA-Z0-9]+$/', $val)) {
                    $data_sybmit = array(
                        'username' => $val
                    );
                    //shell_exec("bash adduser " . $username . " " . $password);
                    $this->model->delete_user($data_sybmit);
                }
            }
        }
    }
    function renewal_date(){

        if (isset($_POST['renewal_date']) and csrfAccess=='true') {
            $username_re = htmlspecialchars($_POST['username_re']);
            $day_date = htmlspecialchars($_POST['day_date']);

            $renewal_date = htmlspecialchars($_POST['re_date']);
            $renewal_traffic = htmlspecialchars($_POST['re_traffic']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $username_re)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $day_date)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $renewal_date)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $renewal_traffic)) {
                $data_sybmit = array(
                    'username' => $username_re,
                    'day_date' => $day_date,
                    'renewal_date' => $renewal_date,
                    'renewal_traffic' => $renewal_traffic
                );

                //shell_exec("bash adduser " . $username . " " . $password);
                $this->model->renewal_update($data_sybmit);
            }
        }

    }
    function submit_index(){

        if (isset($_POST['submit']) and csrfAccess=='true')
        {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
            $email = htmlspecialchars($_POST['email']);
            $mobile = htmlspecialchars($_POST['mobile']);
            $multiuser = htmlspecialchars($_POST['multiuser']);
            $connection_start = htmlspecialchars($_POST['connection_start']);
            $traffic = htmlspecialchars($_POST['traffic']);
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
                print_r($data_sybmit);
                //shell_exec("bash adduser " . $username . " " . $password);
                $this->model->submit_index($data_sybmit);
                //header('location: users');
            }

        }

    }

    //bulk user
    function submit_index_bulk(){


        if (isset($_POST['bulk']) and csrfAccess=='true')
        {
            $count_user = htmlspecialchars($_POST['count_user']);
            $start_user = htmlspecialchars($_POST['start_user']);
            $start_number = htmlspecialchars($_POST['start_number']);

            $password = htmlspecialchars($_POST['password']);
            $pass_random = htmlspecialchars($_POST['pass_random']);
            $char_pass = htmlspecialchars($_POST['char_pass']);

            $multiuser = htmlspecialchars($_POST['multiuser']);
            $connection_start = htmlspecialchars($_POST['connection_start']);
            $traffic = htmlspecialchars($_POST['traffic']);
            $type_traffic = htmlspecialchars($_POST['type_traffic']);
            if (preg_match('/^[0-9]+$/', $count_user)
                and empty($password) or preg_match('/^[-a-zA-Z0-9-@]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9-@]+$/', $pass_random)
                and preg_match('/^[-a-zA-Z0-9-@]+$/', $char_pass)
                and preg_match('/^[a-zA-Z0-9]+$/', $start_user)
                and preg_match('/^[0-9]+$/', $start_number)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $connection_start)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)) {
                if ($type_traffic == "gb") {
                    $traffic = $traffic * 1024;
                } else {
                    $traffic = $traffic;
                }
                for ($i = 0; $i < $count_user; $i++) {
                    if ($start_number < $start_number + $count_user) {
                        $list_users[] = $start_user . $start_number;
                        $start_number++;
                    }
                }

                foreach ($list_users as $user) {
                    $data_sybmit = array(
                        'username' => $user,
                        'password' => $password,
                        'email' => 'کاربر عمده',
                        'mobile' => '',
                        'multiuser' => $multiuser,
                        'startdate' => '',
                        'finishdate' => '',
                        'finishdate_one_connect' => $connection_start,
                        'enable' => 'true',
                        'traffic' => $traffic,
                        'referral' => '',
                        'info' => 'کاربرعمده',
                        'pass_rand' => $pass_random,
                        'pass_char' => $char_pass
                    );
                    //shell_exec("bash adduser " . $username . " " . $password);
                    $this->model->submit_index($data_sybmit);
                    //header('location: users');

                }
            }


        }

    }


}
