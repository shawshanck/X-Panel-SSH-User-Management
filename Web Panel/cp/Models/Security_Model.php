<?php

class Security_Model extends Model
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

    public function requests()
    {
        $query = $this->db->prepare("select DISTINCT ip_address from requests ORDER BY id DESC");
        $query->execute();
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($queryCount as $val)
        {
            $query = $this->db->prepare("select * from requests WHERE ip_address=:ip");
            $query->execute(['ip' => $val['ip_address']]);
            $result_req = $query->fetch(PDO::FETCH_ASSOC);
            $query = $this->db->prepare("select COUNT(*) from requests WHERE ip_address=:ip");
            $query->execute(['ip' => $val['ip_address']]);
            $result_co = ["count" => $query->fetchColumn()];
            $result[]=array_merge($result_req,$result_co);
        }
        return $result;
    }

    public function iplist()
    {
        $query = $this->db->prepare("select * from ip_list ORDER BY id DESC");
        $query->execute();
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        return $queryCount;
    }

    public function submit_allow($data_sybmit)
    {
        $id=$data_sybmit['id'];
        $sql = "UPDATE ip_list SET ip_status=? WHERE id=?";
        $this->db->prepare($sql)->execute(['allow', $id]);
        header("Location: ip");
    }
    public function submit_band($data_sybmit)
    {
        $id=$data_sybmit['id'];
        $sql = "UPDATE ip_list SET ip_status=? WHERE id=?";
        $this->db->prepare($sql)->execute(['ban', $id]);
        header("Location: ip");
    }
    public function ip_insert($data_sybmit)
    {

        $query = $this->db->prepare("SELECT * FROM ip_list WHERE ip_address=:ip");
        $query->execute(['ip' => $data_sybmit['ip']]);
        $queryCount = $query->rowCount();
        if ($queryCount < 1) {
            $sql = "INSERT INTO `ip_list` (`ip_address`, `ip_dsc`, `ip_status`) VALUES (?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array($data_sybmit['ip'], $data_sybmit['desc'], $data_sybmit['status']));
            if ($stmt) {
                header("Location: ip");
                return true;
            } else {
                return false;
            }
        } else {
            header("Location: ip");

        }
    }

    public function delete_ip($data_sybmit)
    {
        $id=$data_sybmit['id'];
        $query = $this->db->prepare("DELETE FROM ip_list WHERE id=?")->execute([$id]);
        if($query)
        {
            header("Location: ip");
        }
    }
}
