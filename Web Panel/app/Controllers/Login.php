<?php
include_once("../app/Models/Login_Model.php");

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Login_Model();
        $this->index();
    }
    public function index()
    {
        $maxRequests = 3; // حداکثر تعداد درخواست‌ها در بازه زمانی
        $timeWindow = 900;
        $ipAddress = $_SERVER['REMOTE_ADDR']; // آدرس IP کاربر
        $recentRequests = $this->model->getRecentRequests($ipAddress, $timeWindow);
        if ($recentRequests >= $maxRequests) {
            //http_response_code(429); // کد خطای Too Many Requests
            //require_once ('Views/Limit/Index.php');
            //exit;
        }
        $this->login_user();


        if (!empty(action) and action=='lang') {
            $lang = htmlspecialchars(action_run);
            if($lang=='fa')
            {
                file_put_contents("/var/www/html/cp/Config/database.php", str_replace("\$lang = \"".LANG."\"", "\$lang = \"fa-ir\"", file_get_contents("/var/www/html/cp/Config/database.php")));
                sleep(2);
                header('location: users');
            }
            if($lang=='en')
            {
                file_put_contents("/var/www/html/cp/Config/database.php", str_replace("\$lang = \"".LANG."\"", "\$lang = \"en-us\"", file_get_contents("/var/www/html/cp/Config/database.php")));
                sleep(2);
                header('location: users');
            }
        }
        $this->view->Render("Login/index");
    }
    function login_user(){
        if (isset($_POST['submit']))
        {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            $data_sybmit = array(
                'username' =>$username,
                'password' => $password
            );
            //shell_exec("bash adduser " . $username . " " . $password);
            $this->model->submit_index($data_sybmit);
            //header('location: users');


        }

    }


}