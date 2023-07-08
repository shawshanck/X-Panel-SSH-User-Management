<?php

class Login_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function submit_index($data_sybmit)
    {
        $user = $data_sybmit['username'];
        $pass = $data_sybmit['password'];
        $query = $this->db->prepare("select * from setting where adminuser='".$user."' and adminpassword='".$pass."'");
        $query->execute();
        $queryCount = $query->rowCount();

        $query_ress = $this->db->prepare("select * from admins where username_u='".$user."' and password_u='".$pass."'");
        $query_ress->execute();
        $queryCount_ress = $query_ress->rowCount();
        if ($queryCount > 0) {
            $kay_login=$user.":XPlogin".time();
            $sql = "UPDATE setting SET login_key=? WHERE adminuser=?";
            $this->db->prepare($sql)->execute([$kay_login, $user]);

            // تنظیم کوکی با تنظیمات امنیتی
            $cookieName = 'xpkey';
            $cookieValue = $kay_login;
            $cookieExpiration = time() + 7200;
            $cookiePath = '/';
            $cookieSecure = false; // تنظیم Secure به true
            $cookieHttpOnly = true; // تنظیم HttpOnly به true
            $cookieSameSite = 'Strict'; // تنظیم SameSite به Strict

// تنظیم کوکی با تنظیمات امنیتی
            setcookie($cookieName, $cookieValue, [
                'expires' => $cookieExpiration,
                'path' => $cookiePath,
                'secure' => $cookieSecure,
                'httponly' => $cookieHttpOnly,
                'samesite' => $cookieSameSite
            ]);
            header("location: index");
        }
        elseif ($queryCount_ress > 0) {
            $kay_login=$user.":XPlogin".time();
            $sql = "UPDATE admins SET login_key=? WHERE username_u=?";
            $this->db->prepare($sql)->execute([$kay_login, $user]);
            // تنظیم کوکی با تنظیمات امنیتی
            $cookieName = 'xpkey';
            $cookieValue = $kay_login;
            $cookieExpiration = time() + 7200;
            $cookiePath = '/';
            $cookieSecure = false; // تنظیم Secure به true
            $cookieHttpOnly = true; // تنظیم HttpOnly به true
            $cookieSameSite = 'Strict'; // تنظیم SameSite به Strict

// تنظیم کوکی با تنظیمات امنیتی
            setcookie($cookieName, $cookieValue, [
                'expires' => $cookieExpiration,
                'path' => $cookiePath,
                'secure' => $cookieSecure,
                'httponly' => $cookieHttpOnly,
                'samesite' => $cookieSameSite
            ]);
            header("location: index");
        }
        else
        {
            header("location: login");
        }

    }
}
