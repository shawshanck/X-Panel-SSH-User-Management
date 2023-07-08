<?php

class Login_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();

    }
    function getRecentRequests($ipAddress, $timeWindow) {
        $time = time();
        $timeWindow = strtotime("-$timeWindow seconds", $time);
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM requests WHERE ip_address = :ip AND timestamp > :timelog");
        $stmt->execute([
            ':ip' => $ipAddress,
            ':timelog' => $timeWindow
        ]);

        return $stmt->fetchColumn();
    }

    function saveRequest($ipAddress, $timestamp) {
        $stmt = $this->db->prepare("INSERT INTO requests (ip_address, timestamp) VALUES (:ip, :timestamp)");
        $stmt->bindParam(':ip', $ipAddress, PDO::PARAM_STR);
        $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function submit_index($data_sybmit)
    {

        $user = $data_sybmit['username'];
        $pass = $data_sybmit['password'];
        $query = $this->db->prepare("select * from setting where adminuser=:adminuser and adminpassword=:adminpassword");
        $query->execute(['adminuser' => $user,'adminpassword' => $pass]);
        $queryCount = $query->rowCount();

        $query_ress = $this->db->prepare("select * from admins where username_u=:username_u and password_u=:password_u");
        $query_ress->execute(['username_u' => $user,'password_u' => $pass]);
        $queryCount_ress = $query_ress->rowCount();
        if ($queryCount > 0) {
            $kay_login=$user.":XPlogin".time();
            $sql = "UPDATE setting SET login_key=? WHERE adminuser=?";
            $this->db->prepare($sql)->execute([$kay_login, $user]);
            setcookie("xpkey", $kay_login, time()+86400);
            header("location: index");
        }
        elseif ($queryCount_ress > 0) {
            $kay_login=$user.":XPlogin".time();
            $sql = "UPDATE admins SET login_key=? WHERE username_u=?";
            $this->db->prepare($sql)->execute([$kay_login, $user]);
            setcookie("xpkey", $kay_login, time()+86400);
            header("location: index");
        }
        else
        {
            $ipAddress = $_SERVER['REMOTE_ADDR']; // آدرس IP کاربر
            $timestamp = time(); // زمان فعلی
            $this->saveRequest($ipAddress, $timestamp);
            header("location: login");
        }

    }
}
