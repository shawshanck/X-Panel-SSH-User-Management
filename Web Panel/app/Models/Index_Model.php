<?php

class Index_Model extends Model
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
    //we will use the select function
    public function all_user()
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
            $query = $this->db->prepare("SELECT * FROM users");
            $query->execute();
        }
        else{
            $query = $this->db->prepare("SELECT * FROM users WHERE customer_user=:customer_user");
            $query->execute(['customer_user' => $Ukey]);
        }
        $queryCount = $query->rowCount();
        return $queryCount;
    }
    public function traffic_user()
    {

        $query_traffic = $this->db->prepare("SELECT SUM(total) AS total FROM Traffic");
        $query_traffic->execute();
        $row = $query_traffic->fetch(PDO::FETCH_ASSOC);
        $queryCount_traffic = $row['total'];
        return $queryCount_traffic;
    }
    public function active_user()
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
            $query = $this->db->prepare("SELECT * FROM users WHERE enable='true'");
            $query->execute();
        }
        else{
            $query = $this->db->prepare("SELECT * FROM users WHERE enable='true' AND customer_user=:customer_user");
            $query->execute(['customer_user' => $Ukey]);
        }
        $queryCount = $query->rowCount();
        return $queryCount;
    }
    public function deactive_user()
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
            $query = $this->db->prepare("SELECT * FROM users WHERE enable!='true'");
            $query->execute();
        }
        else{
            $query = $this->db->prepare("SELECT * FROM users WHERE enable!='true' AND customer_user=:customer_user");
            $query->execute(['customer_user' => $Ukey]);
        }
        $queryCount = $query->rowCount();
        return $queryCount;
    }

    public function user_band()
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
            $query = $this->db->prepare("SELECT * FROM users,Traffic WHERE users.enable!='true' AND users.username=Traffic.user AND Traffic.total!='0' ORDER BY Traffic.total DESC LIMIT 10");
            $query->execute();
        }
        else{
            $query = $this->db->prepare("SELECT * FROM users,Traffic WHERE users.enable!='true' AND users.username=Traffic.user AND Traffic.total!='0' AND users.customer_user=:customer_user ORDER BY Traffic.total DESC LIMIT 10");
            $query->execute(['customer_user' => $Ukey]);
        }
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        return $queryCount;
    }
}
