<?php

class Edituser_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        if (isset($_COOKIE["xpkey"])) {
            $key_login = explode(':', $_COOKIE["xpkey"]);
            $U=htmlspecialchars($key_login[0]);
            $Ukey='';
            if (preg_match('/^[a-zA-Z0-9]+$/', $U)) {
                $Ukey = htmlspecialchars($U);
            }
            $query = $this->db->prepare("SELECT * FROM setting WHERE adminuser=:adminuser and login_key=:login_key");
            $query->execute(['adminuser' => $Ukey,'login_key' => $_COOKIE["xpkey"]]);
            $queryCount = $query->rowCount();

            $query_ress = $this->db->prepare("SELECT * FROM admins WHERE username_u=:adminuser and login_key=:login_key");
            $query_ress->execute(['adminuser' => $Ukey,'login_key' => $_COOKIE["xpkey"]]);
            $queryCount_ress = $query_ress->rowCount();

            if ($queryCount >0) {
                define('permis','admin');
            }
            if ($queryCount_ress >0) {
                define('permis','reseller');
            }
            if ($queryCount == 0 && $queryCount_ress == 0) {
                header("location: login");
            }
        } else {
            header("location: login");
        }
    }

    public function user($data_sybmit)
    {
        if (isset($_COOKIE["xpkey"])) {
            $key_login = explode(':', $_COOKIE["xpkey"]);
            $U=htmlspecialchars($key_login[0]);
            $Ukey='';
            if (preg_match('/^[a-zA-Z0-9]+$/', $U)) {
                $Ukey = htmlspecialchars($U);
            }
        }
        if(permis=='admin') {
            $query = $this->db->prepare("SELECT * FROM users WHERE username=:username");
            $query->execute(['username' => $data_sybmit['username']]);
        }
        else{
            $query = $this->db->prepare("SELECT * FROM users WHERE username=:username and customer_user=:customer_user");
            $query->execute(['username' => $data_sybmit['username'],'customer_user' => $Ukey]);
        }
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        return $queryCount;
    }
    public function submit_update($data_sybmit)
    {
        $password=$data_sybmit['password'];
        $email=$data_sybmit['email'];
        $username=$data_sybmit['username'];
        $mobile=$data_sybmit['mobile'];
        $multiuser=$data_sybmit['multiuser'];
        $traffic=$data_sybmit['traffic'];
        $info=$data_sybmit['info'];
        $activate=$data_sybmit['activate'];
        if(LANG=='fa-ir') {
            if (!empty($data_sybmit['finishdate'])) {
                $finishdate = explode('/', $data_sybmit['finishdate']);
                $finishdate = jalali_to_gregorian($finishdate[0], $finishdate[1], $finishdate[2], '-');
                $finishdate = explode('-', $finishdate);
                if($finishdate[1]<10)
                {$m='0'.$finishdate[1];} else { $m=$finishdate[1];}
                if($finishdate[2]<10)
                {$d='0'.$finishdate[2];} else { $d=$finishdate[2];}
                $finishdate=$finishdate[0].'-'.$m.'-'.$d;
            } else {
                $finishdate = '';
            }
        }
        else{
            $finishdate = $data_sybmit['finishdate'];
        }
        $data = [
            'password'=>$password,
            'email' => $email,
            'mobile' => $mobile,
            'multiuser' => $multiuser,
            'finishdate' => $finishdate,
            'traffic' => $traffic,
            'info' => $info,
            'username' => $username,
            'activate' => $activate
        ];

        $sql = "UPDATE users SET password=:password, email=:email,mobile=:mobile,multiuser=:multiuser,finishdate=:finishdate,enable=:activate,traffic=:traffic,info=:info WHERE username=:username ";

        $statement = $this->db->prepare($sql);
        $statement->execute($data);
        if($statement->execute($data))
        {
            shell_exec("sudo killall -u " . $username);
            shell_exec("bash Libs/sh/changepass ".$username." ".$password);

            if($activate=='true')
            {
                shell_exec("sudo killall -u " . $username);
                shell_exec("bash Libs/sh/adduser " . $username . " " . $password);
            }
            header("Refresh:0");

        }
    }

    function en_number($number)
    {

        $en = array("0","1","2","3","4","5","6","7","8","9");
        $fa = array("۰","۱","۲","۳","۴","۵","۶","۷","۸","۹");
        return str_replace($fa,$en, $number);
    }
}
