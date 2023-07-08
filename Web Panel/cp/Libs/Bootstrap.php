<?php

class Bootstrap
{
    function __construct()
    {

        @session_start();
        function generateCsrfToken()
        {
            $chars = "QRSTUVWXYZabcdefghijklmnopABCDEFGHIJKLMNOPqrstuvwxyz1234567890";
            $key = substr(str_shuffle($chars), 0, 32);
            if (!isset($_SESSION['csrf_token'])) {
                $_SESSION['csrf_token'] = bin2hex($key); // تولید توکن CSRF تصادفی
            }
        }

        function validateCsrfToken($token)
        {
            if (isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token)) {
                unset($_SESSION['csrf_token']); // حذف توکن CSRF پس از استفاده
                generateCsrfToken();
                return true; // توکن معتبر است
            }
            return false; // توکن نامعتبر است
        }

        function redirectToErrorPage()
        {
            echo "<H5>403 ACCESSS";
            exit;
        }

// تولید و بررسی توکن CSRF
        generateCsrfToken();
        $link = htmlspecialchars($_GET['url']);
        $link = explode('&', $link);
        $link_s = '';
        if (preg_match('/^[a-zA-Z0-9]+$/', $link[0])) {
            $link_s = $link[0];
        }


        if ($_SERVER['REQUEST_METHOD'] === 'POST' and $link_s != 'api') {
            if (!isset($_POST['csrf_token'])) {
                redirectToErrorPage(); // توکن CSRF ارسال نشده است، ریدایرکت به صفحه خطا
            }

            $submittedToken = $_POST['csrf_token'];

            if (validateCsrfToken($submittedToken)) {
                // توکن معتبر است
                // ادامه عملیات مربوط به درخواست POST
                define('csrfAccess', 'true');
                require_once("Models/Limit_Model.php");
                $this->model = new Limit_Model();


            } else {
                // توکن نامعتبر است
                // پردازش خطا یا مانع از ادامه عملیات
                define('csrfAccess', 'false');
                require_once("Models/Limit_Model.php");
                $this->model = new Limit_Model();
                echo '
            <div class="p-4 mb-2" style="position: fixed;z-index: 9999;left: 0;">
              <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                  <img src="' . path . 'assets/images/xlogo.png" class="img-fluid m-r-5" alt="XPanel" style="width: 17px">
                  <strong class="me-auto">XPanel</strong>
                  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">Invalid Token</div>
              </div>
            </div>';
            }
        }

// نمایش توکن CSRF در فرم
        $csrfToken = isset($_SESSION['csrf_token']) ? $_SESSION['csrf_token'] : '';
        define('csrfToken', $csrfToken);

        if (!isset($_GET['url'])) {
            $url = 'index';
        } else {
            $url = htmlspecialchars($_GET['url']);
            if (preg_match('/^[a-zA-Z0-9]+$/', $url)) {
                $url = htmlspecialchars($_GET['url']);
            }
        }
        if($url!='reinstall')
        {
            require_once("Models/Ban_Model.php");
            $this->model = new Ban_Model();
        }
        $urlex = explode('/', $url);
        $urlex2 = explode('.', $url);
        if ($urlex[0] == 'assets') {

            if (file_exists("$url")) {
                if ($urlex2[1] == 'css') {
                    header("Content-type: text/css");
                }
                if ($urlex2[1] == 'js') {
                    header("Content-type: text/js");
                }
                echo file_get_contents($url);
            }
        } else {
            $url = explode('.', $url);

            if (!empty(strstr($url[0], "&"))) {

                $url = explode('&', $url[0]);
                $sort = explode('=', $url[1]);

                if(!empty($url[2]))
                {$method = explode('=', $url[2]);}
                if(!empty($url[3]))
                {$action_api = explode('=', $url[3]);
                    $action_api_fix = explode(';', $action_api[0]);
                    define("api_action", $action_api_fix[1]);
                    define("api_action_run", $action_api[1]);
                }
                else
                {
                    define("api_action", '');
                    define("api_action_run", '');
                }
                $action_fix = explode(';', $sort[0]);
                if ($action_fix[1] == 'sort') {
                    define("sort", $sort[1]);
                }
                if ($action_fix[1] == 'key') {
                    define("key", $sort[1]);
                    define("method", $method[1]);
                } else {
                    define("action", $action_fix[1]);
                    define("action_run", $sort[1]);
                }
                if (!empty($url[2])) {

                    $action = explode('=', $url[2]);
                    $action_fix = explode(';', $action[0]);
                    define("action", $action_fix[1]);
                    define("action_run", $action[1]);
                }
            } else {
                define("sort", '');
                define("action", '');
                define("action_run", '');
            }

            if (!file_exists("Controllers/" . ucfirst($url[0]) . ".php")) {
                echo "Not Found Page";
            } else {
                require_once("Libs/lang/" . LANG . ".php");
                require_once("Libs/jdf.php");
                require_once("Models/Permission_Model.php");
                $this->model = new Permission_Model();
                $file = "Controllers/" . ucfirst($url[0]) . ".php";
                require_once($file);
                new $url[0]();
                //$controller->loadModel($url[0]);
            }
        }

    }
}
