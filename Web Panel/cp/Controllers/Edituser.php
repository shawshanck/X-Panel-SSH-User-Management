<?php
include_once("Models/Edituser_Model.php");
class Edituser extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Edituser_Model();
        $this->index();
    }

    public function index()
    {

        if(!empty(action) and action=='username') {
            $usernme = htmlspecialchars(action_run);
            if (preg_match('/^[-a-zA-Z0-9]+$/', $usernme)) {
                $data_sybmit = array(
                    'username' => $usernme
                );
                $user = $this->model->user($data_sybmit);
            }
            $data = array(
                "for" => $user
            );
            if (isset($_POST['submit'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);
                $email = htmlspecialchars($_POST['email']);
                $mobile = htmlspecialchars($_POST['mobile']);
                $multiuser = htmlspecialchars($_POST['multiuser']);
                $traffic = htmlspecialchars($_POST['traffic']);
                $type_traffic = htmlspecialchars($_POST['type_traffic']);
                $expdate = htmlspecialchars($_POST['expdate']);
                $desc = htmlspecialchars($_POST['desc']);
                $activate = htmlspecialchars($_POST['activate']);
                if (preg_match('/^[a-zA-Z0-9-#?]+$/', $password)
                    and preg_match('/^[-a-zA-Z0-9]+$/', $username)
                    and empty($email) or preg_match('/^[a-zA-Z0-9-@]+$/', $email)
                    and empty($mobile) or preg_match('/^[a-zA-Z0-9-@]+$/', $mobile)
                    and preg_match('/^[a-zA-Z0-9-@]+$/', $multiuser)
                    and preg_match('/^[a-zA-Z0-9-@]+$/', $activate)
                    and preg_match('/^[a-zA-Z0-9-@]+$/', $traffic)
                    and preg_match('/^[a-zA-Z0-9-@]+$/', $type_traffic)
                    and empty($expdate) or preg_match('/^[\/-a-zA-Z0-9-۱۲۳۴۵۶۷۸۹۰]+$/', $expdate)
                    and empty($desc) or preg_match('/^[a-zA-Z0-9-@-اآبپتثئجچحخدذرزژسشصضطظعغفقکگلمنوهی\s]+$/', $desc)) {
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
                        'finishdate' => $expdate,
                        'traffic' => $traffic,
                        'info' => $desc,
                        'activate' => $activate
                    );
                    $this->model->submit_update($data_sybmit);
                }
            }
            $this->view->Render("Users/edituser",$data);
        }
        else{header("Location: /cp/users");}



    }
}