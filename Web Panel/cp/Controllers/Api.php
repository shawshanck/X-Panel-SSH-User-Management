<?php
include_once("Models/Api_Model.php");
class Api extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->model = new Api_Model();
        $key = htmlentities($_GET['key']);
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
        if (isset($_GET['method'])) {

            if (isset($_GET['method']) && htmlspecialchars($_GET['method']) == "listuser") {
            $list_users = $this->model->list_user();
            foreach ($list_users as $list_user) {
                if (1024 < $list_user['total']) {
                    $total = round($list_user['total'] / 1024, 3) . ' GB';
                } else {
                    $total = $list_user['total'] . ' MB';
                }
                $server = $_SERVER["SERVER_NAME"];
                if (empty($list_user['ssh_tls_port']) || $list_user['ssh_tls_port'] == 'NULL') {
                    $ssh_tls_port = '444';
                } else {
                    $ssh_tls_port = $list_user['ssh_tls_port'];
                }
                $data [] = array(
                    'id' => $list_user['id'],
                    'server' => $server,
                    'username' => $list_user['username'],
                    'password' => $list_user['password'],
                    'ssh_port' => PORT,
                    'ssh_tls_port' => $ssh_tls_port,
                    'email' => $list_user['email'],
                    'mobile' => $list_user['mobile'],
                    'multiuser' => $list_user['multiuser'],
                    'startdate' => $list_user['startdate'],
                    'finishdate' => $list_user['finishdate'],
                    'finishdate_one_connect' => $list_user['connection_start'],
                    'customer_user' => $list_user['customer_user'],
                    'enable' => $list_user['enable'],
                    'traffic' => $list_user['traffic'],
                    'referral' => $list_user['referral'],
                    'info' => $list_user['info'],
                    'traffic_usage' => $total,
                    'qr_ssh' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $list_user['username'] . ":" . $list_user['password'] . "@" . $server . ":" . PORT . "/#" . $list_user['username'],
                    'qr_ssh_tls' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $list_user['username'] . ":" . $list_user['password'] . "@" . $server . ":" . $ssh_tls_port . "/#" . $list_user['username']
                );
            }
            $this->response($data);
        }
    }

        //sort status user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "users" && !empty($_GET['status'])){
            $status_user = $this->model->status_user(htmlspecialchars($_GET['status']));
            foreach ($status_user as $list_user) {
                if (1024 < $list_user['total']) {
                    $total = round($list_user['total'] / 1024, 3) . ' GB';
                } else {
                    $total = $list_user['total'] . ' MB';
                }
                $server = $_SERVER["SERVER_NAME"];
                if (empty($list_user['ssh_tls_port']) || $list_user['ssh_tls_port'] == 'NULL') {
                    $ssh_tls_port = '444';
                } else {
                    $ssh_tls_port = $list_user['ssh_tls_port'];
                }
                $data [] = array(
                    'id' => $list_user['id'],
                    'server' => $server,
                    'username' => $list_user['username'],
                    'password' => $list_user['password'],
                    'ssh_port' => PORT,
                    'ssh_tls_port' => $ssh_tls_port,
                    'email' => $list_user['email'],
                    'mobile' => $list_user['mobile'],
                    'multiuser' => $list_user['multiuser'],
                    'startdate' => $list_user['startdate'],
                    'finishdate' => $list_user['finishdate'],
                    'finishdate_one_connect' => $list_user['connection_start'],
                    'customer_user' => $list_user['customer_user'],
                    'enable' => $list_user['enable'],
                    'traffic' => $list_user['traffic'],
                    'referral' => $list_user['referral'],
                    'info' => $list_user['info'],
                    'traffic_usage' => $total,
                    'qr_ssh' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $list_user['username'] . ":" . $list_user['password'] . "@" . $server . ":" . PORT . "/#" . $list_user['username'],
                    'qr_ssh_tls' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $list_user['username'] . ":" . $list_user['password'] . "@" . $server . ":" . $ssh_tls_port . "/#" . $list_user['username']
                );
            }
            $this->response($data) ;
        }

        //active user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "activeuser"){
            $username = htmlentities($_POST['username']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
            if(!empty($username)) {
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
        }
        //deactive user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "deactiveuser") {
            $username = htmlentities($_POST['username']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                if (!empty($username)) {
                    $data_sybmit = array(
                        'username' => $username
                    );
                    $this->model->deactive_user($data_sybmit);
                } else {
                    echo "invalid empty username";
                }
            }
        }
        //reset traffic user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "resetuser") {
            $username = htmlentities($_POST['username']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $username)) {
                if (!empty($username)) {
                    $data_sybmit = array(
                        'username' => $username
                    );
                    $this->model->reset_user($data_sybmit);
                } else {
                    echo "invalid empty username";
                }
            }
        }
        //renewal user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "renewal") {
            $username = htmlentities($_POST['username']);
            $day_date = htmlentities($_POST['day_date']);

            $renewal_date = htmlentities($_POST['re_date']);
            $renewal_traffic = htmlentities($_POST['re_traffic']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $username)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $day_date)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $renewal_date)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $renewal_traffic)) {
                if (!empty($username) and !empty($day_date) and !empty($renewal_date) and !empty($renewal_traffic)) {
                    $data_sybmit = array(
                        'username' => $username,
                        'day_date' => $day_date,
                        'renewal_date' => $renewal_date,
                        'renewal_traffic' => $renewal_traffic
                    );
                    $this->model->renewal_update($data_sybmit);
                } else {
                    echo "invalid empty username and date";
                }
            }
        }
        //add user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "adduser") {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $email = htmlentities($_POST['email']);
            $mobile = htmlentities($_POST['mobile']);
            $multiuser = htmlentities("1");
            if (isset($_POST['multiuser'])) {
                $multiuser = htmlentities($_POST['multiuser']);
            }
            $connection_start = htmlentities($_POST['connection_start']);
            $traffic = htmlentities('0');
            if (isset($_POST['traffic'])) {
                $traffic = htmlentities($_POST['traffic']);
            }
            $type_traffic = htmlentities($_POST['type_traffic']);
            $expdate = htmlentities($_POST['expdate']);
            $desc = htmlentities($_POST['desc']);
            if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $email)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $mobile)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $connection_start)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)
                and preg_match('/^[\/-a-zA-Z0-9-۱۲۳۴۵۶۷۸۹۰]+$/', $expdate)
                and preg_match('/^[a-zA-Z0-9-@-اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]+$/', $desc)) {
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
                } else {
                    echo "invalid empty username and password";
                }

            }
        }

        //show user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "user" && !empty($_GET['username'])) {
            $usernme = htmlentities($_GET['username']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $show_user = $this->model->show_user($usernme);
                if (1024 < $show_user[0]['total']) {
                    $total = round($show_user[0]['total'] / 1024, 3) . ' GB';
                } else {
                    $total = $show_user[0]['total'] . ' MB';
                }
                $server = $_SERVER["SERVER_NAME"];
                if (empty($show_user[0]['ssh_tls_port']) || $show_user[0]['ssh_tls_port'] == 'NULL') {
                    $ssh_tls_port = '444';
                } else {
                    $ssh_tls_port = $show_user[0]['ssh_tls_port'];
                }
                $data [] = array(
                    'id' => $show_user[0]['id'],
                    'server' => $server,
                    'username' => $show_user[0]['username'],
                    'password' => $show_user[0]['password'],
                    'ssh_port' => PORT,
                    'ssh_tls_port' => $ssh_tls_port,
                    'email' => $show_user[0]['email'],
                    'mobile' => $show_user[0]['mobile'],
                    'multiuser' => $show_user[0]['multiuser'],
                    'startdate' => $show_user[0]['startdate'],
                    'finishdate' => $show_user[0]['finishdate'],
                    'finishdate_one_connect' => $show_user[0]['connection_start'],
                    'customer_user' => $show_user[0]['customer_user'],
                    'enable' => $show_user[0]['enable'],
                    'traffic' => $show_user[0]['traffic'],
                    'referral' => $show_user[0]['referral'],
                    'info' => $show_user[0]['info'],
                    'traffic_usage' => $total,
                    'qr_ssh' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $show_user[0]['username'] . ":" . $show_user[0]['password'] . "@" . $server . ":" . PORT . "/#" . $show_user[0]['username'],
                    'qr_ssh_tls' => "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=ssh://" . $show_user[0]['username'] . ":" . $show_user[0]['password'] . "@" . $server . ":" . $ssh_tls_port . "/#" . $show_user[0]['username']
                );
                $this->response($data);
            }
        }
        //edit user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "edituser"){
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $email = htmlentities($_POST['email']);
            $mobile = htmlentities($_POST['mobile']);
            $multiuser = htmlentities($_POST['multiuser']);
            $traffic = htmlentities($_POST['traffic']);
            $type_traffic = htmlentities($_POST['type_traffic']);
            $expdate = htmlentities($_POST['expdate']);
            $desc = htmlentities($_POST['desc']);
            if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                and preg_match('/^[-a-zA-Z0-9]+$/', $username)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $email)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $mobile)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)
                and preg_match('/^[\/-a-zA-Z0-9-۱۲۳۴۵۶۷۸۹۰]+$/', $expdate)
                and preg_match('/^[a-zA-Z0-9-@-اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]+$/', $desc)) {
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
                } else {
                    echo "invalid empty username and password";
                }
            }
        }
        // delete user
        if(isset($_GET['method']) && htmlspecialchars($_GET['method']) == "deleteuser") {
            $usernme = htmlspecialchars($_POST['username']);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                if (!empty($usernme)) {
                    $data_sybmit = array(
                        'username' => $usernme
                    );
                    $this->model->delete_user($data_sybmit);
                } else {
                    echo "invalid empty username";
                }
            }
        }


    }

    function response($data){

        $res= [
            'version' => '3.5',
            'status' => 200,
            'data'   => $data

        ];
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($res,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    }

}
