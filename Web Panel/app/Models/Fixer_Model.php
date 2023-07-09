<?php

class Fixer_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function cronexp()
    {
        $list_user = shell_exec("ls /home");
        $list_user = preg_split("/\r\n|\n|\r/", $list_user);
        foreach ($list_user as $us)
        {
            $query = $this->db->prepare("SELECT * FROM users WHERE username=:username");
            $query->execute(['username' => $us]);
            $queryCount = $query->rowCount();
            if ($queryCount <1) {
                shell_exec("sudo killall -u " . $us);
                shell_exec("bash /var/www/html/app/Libs/sh/deleteuser " . $us);
            }

        }

        $query = $this->db->prepare("select * from users where enable='true' ORDER BY id DESC");
        $query->execute();
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($queryCount as $us) {
            if (!empty($us["finishdate"])) {
                $expiredate = strtotime(date("Y-m-d", strtotime($us["finishdate"])));
                if ($expiredate < strtotime(date("Y-m-d")) || $expiredate == strtotime(date("Y-m-d"))) {
                    $sql = "UPDATE users SET enable=? WHERE username=?";
                    $this->db->prepare($sql)->execute(['expired', $us["username"]]);
                    shell_exec("sudo killall -u " . $us["username"]);
                    shell_exec("bash /var/www/html/app/Libs/sh/deleteuser " . $us["username"]);
                }
            }
        }
        foreach ($queryCount as $us) {

            $stmt = $this->db->prepare("SELECT * FROM Traffic WHERE user=:user");
            $stmt->execute(['user' => $us['username']]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($user as $usernamet)
            {
                $total=$usernamet["total"];

                if ($us["traffic"] < $total && !empty($us["traffic"])) {
                    $sql = "UPDATE users SET enable=? WHERE username=?";
                    $this->db->prepare($sql)->execute(['traffic', $us["username"]]);
                    shell_exec("sudo killall -u " . $us["username"]);
                    shell_exec("bash /var/www/html/app/Libs/sh/deleteuser " . $us["username"]);
                }
            }

        }
        return $queryCount;
    }
    public function multiuser()
    {

        $query_setting = $this->db->prepare("select * from setting");
        $query_setting->execute();
        $queryCount_setting = $query_setting->fetchAll(PDO::FETCH_ASSOC);
        foreach ($queryCount_setting as $val) {
            $multiuser = $val['multiuser'];
        }

        $list = shell_exec("sudo lsof -i :" . PORT . " -n | grep -v root | grep ESTABLISHED");
        $onlineuserlist = preg_split("/\r\n|\n|\r/", $list);
        foreach ($onlineuserlist as $user) {
            $user = preg_replace('/\s+/', ' ', $user);
            $userarray = explode(" ", $user);
            if (!isset($userarray[2])) {
                $userarray[2] = null;
            }
            $onlinelist[] = $userarray[2];
        }
        echo "success";
        print_r($onlinelist);
        $onlinelist = array_replace($onlinelist, array_fill_keys(array_keys($onlinelist, null), ''));
        $onlinecount = array_count_values($onlinelist);

        foreach ($onlinelist as $useron) {
            $query = $this->db->prepare("SELECT * FROM users WHERE username=:username");
            $query->execute(['username' => $useron]);
            $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($queryCount as $row) {
                $limitation = $row['multiuser'];
                $username = $row['username'];
                $startdate = $row['startdate'];
                $finishdate_one_connect = $row['finishdate_one_connect'];
                if (empty($limitation)) {
                    $limitation = "0";
                }
                $userlist[$username] = $limitation;
                if (empty($startdate)) {
                    $use_active = $username . "|" . $onlinecount[$username];
                    $act_explode = explode("|", $use_active);
                    if ($act_explode[1] > 0) {
                        $start_inp = date("Y-m-d");
                        $end_inp = date('Y-m-d', strtotime($start_inp . " + $finishdate_one_connect days"));
                        $sql = "UPDATE users SET startdate=?,finishdate=? WHERE username=?";
                        $this->db->prepare($sql)->execute([$start_inp, $end_inp, $act_explode[0]]);
                    }

                }
                if ($limitation !== "0" && $onlinecount[$username] > $limitation){

                    if ($multiuser == 'on') {
                        shell_exec('sudo killall -u ' . $username);
                    }
                }


                //header("Refresh:1");
            }
        }
        $this->synstraffics();
        $this->cronexp_traffic();
    }
    public function cronexp_traffic()
    {
        $query = $this->db->prepare("select * from users where enable='true' ORDER BY id DESC");
        $query->execute();
        $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($queryCount as $us) {

            $stmt = $this->db->prepare("SELECT * FROM Traffic WHERE user=:user");
            $stmt->execute(['user' => $us['username']]);
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($user as $usernamet)
            {
                $total=$usernamet["total"];

                if ($us["traffic"] < $total && !empty($us["traffic"])) {
                    $sql = "UPDATE users SET enable=? WHERE username=?";
                    $this->db->prepare($sql)->execute(['traffic', $us["username"]]);
                    shell_exec("sudo killall -u " . $us["username"]);
                    shell_exec("bash /var/www/html/app/Libs/sh/deleteuser " . $us["username"]);
                }
            }

        }
        return $queryCount;
    }
    public function synstraffic()
    {
        //empty
    }
    public function synstraffics()
    {
        echo"suucess";
        $pid = shell_exec("pgrep nethogs");
        $pid = preg_replace("/\\s+/", "", $pid);
        // print_r($pid);

        $out = file_get_contents("/var/www/html/cp/storage/log/out.json");
        echo "<pre>";
        print_r($out);
        $trafficlog = preg_split("/\r\n|\n|\r/", $out);
        $trafficlog = array_filter($trafficlog);
        $lastdata = end($trafficlog);
        $json = json_decode($lastdata, true);

        $newarray = [];
        foreach ($json as $value) {
            $TX = round($value["TX"], 0);
            $RX = round($value["RX"], 0);
            $name = preg_replace("/\\s+/", "", $value["name"]);
            if (strpos($name, "sshd") === false) {
                $name = "";
            }
            if (strpos($name, "root") !== false) {
                $name = "";
            }
            if (strpos($name, "/usr/sbin/dropbear") !== false) {
                $name = "";
            }
            if (strpos($name, "/usr/bin/stunnel4") !== false) {
                $name = "";
            }
            if (strpos($name, "unknown TCP") !== false) {
                $name = "";
            }
            if (strpos($name, "/usr/sbin/apache2") !== false) {
                $name = "";
            }
            if (strpos($name, "[net]") !== false) {
                $name = "";
            }
            if (strpos($name, "[accepted]") !== false) {
                $name = "";
            }
            if (strpos($name, "[rexeced]") !== false) {
                $name = "";
            }
            if (strpos($name, "@notty") !== false) {
                $name = "";
            }
            if (strpos($name, "root:sshd") !== false) {
                $name = "";
            }
            if (strpos($name, "/sbin/sshd") !== false) {
                $name = "";
            }
            if (strpos($name, "[priv]") !== false) {
                $name = "";
            }
            if (strpos($name, "@pts/1") !== false) {
                $name = "";
            }
            if ($value["RX"] < 1 && $value["TX"] < 1) {
                $name = "";
            }
            $name = str_replace("sshd:", "", $name);
            if (!empty($name)) {
                if (isset($newarray[$name])) {
                    $newarray[$name]["TX"] + $TX;
                    $newarray[$name]["RX"] + $RX;
                } else {
                    $newarray[$name] = ["RX" => $RX, "TX" => $TX, "Total" => $RX + $TX];
                }
            }
        }
        //$newarray= json_encode($newarray);
        foreach ($newarray as $username => $usr) {
            $stmt = $this->db->prepare("SELECT * FROM Traffic WHERE user=:user");
            $stmt->execute(['user' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $userdownload = $user["download"];
            $userupload = $user["upload"];
            $usertotal = $user["total"];
            $rx = round($usr["RX"]);
            $rx=($rx)/10;
            $rx= round(($rx/12)*100);
            $tx = round($usr["TX"]);
            $tx=($tx)/10;
            $tx=round(($tx/12)*100);
            $tot = $rx+$tx;
            $lastdownload = $userdownload + $rx;
            $lastupload = $userupload + $tx;
            $lasttotal = $usertotal + $tot;
            $query = $this->db->prepare("SELECT * FROM Traffic WHERE user=:username");
            $query->execute(['username' => $username]);
            $queryCount = $query->rowCount();
            if ($queryCount < 1) {
                $sql = "INSERT INTO `Traffic` (`id`,`user`, `download`, `upload`, `total` ) VALUES (NULL,?,?,?,?)";
                $stmt = $this->db->prepare($sql);
                $stmt->execute(array($username, $lastdownload, $lastupload, $lasttotal));
                //shell_exec("sudo rm -rf /var/www/html/cp/storage/log/out.json");

            } else {
                $sql = "UPDATE Traffic SET upload=?,download=?,total=? WHERE user=?";
                $this->db->prepare($sql)->execute([$lastupload, $lastdownload, $lasttotal, $username]);
                //shell_exec("sudo rm -rf /var/www/html/cp/storage/log/out.json");
            }
        }

        $query_setting = $this->db->prepare("select * from setting");
        $query_setting->execute();
        $queryCount_setting = $query_setting->fetchAll(PDO::FETCH_ASSOC);
        foreach ($queryCount_setting as $val) {
            $multiuser = $val['multiuser'];
        }
        $list = shell_exec("sudo lsof -i :" . PORT . " -n | grep -v root | grep ESTABLISHED");
        $onlineuserlist = preg_split("/\r\n|\n|\r/", $list);
        foreach ($onlineuserlist as $user) {
            $user = preg_replace('/\s+/', ' ', $user);
            $userarray = explode(" ", $user);
            if (!isset($userarray[2])) {
                $userarray[2] = null;
            }

            $onlinelist[] = $userarray[2];
        }

        $onlinelist = array_replace($onlinelist, array_fill_keys(array_keys($onlinelist, null), ''));
        $onlinecount = array_count_values($onlinelist);

        foreach ($onlinelist as $useron) {
            $query = $this->db->prepare("SELECT * FROM users WHERE username=:username");
            $query->execute(['username' => $useron]);
            $queryCount = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach ($queryCount as $row) {
                $limitation = $row['multiuser'];
                $username = $row['username'];
                $startdate = $row['startdate'];
                $finishdate_one_connect = $row['finishdate_one_connect'];
                if (empty($limitation)) {
                    $limitation = "0";
                }
                $userlist[$username] = $limitation;
                if (empty($startdate)) {

                    $use_active = $username . "|" . $onlinecount[$username];
                    $act_explode = explode("|", $use_active);
                    if ($act_explode[1] > 0) {
                        $start_inp = date("Y-m-d");
                        $end_inp = date('Y-m-d', strtotime($start_inp . " + $finishdate_one_connect days"));
                        $sql = "UPDATE users SET startdate=?,finishdate=? WHERE username=?";
                        $this->db->prepare($sql)->execute([$start_inp, $end_inp, $act_explode[0]]);
                    }

                }
                if ($limitation !== "0" && $onlinecount[$username] > $limitation) {
                    if ($multiuser == 'on') {
                        shell_exec('sudo killall -u ' . $username);
                    }
                }
                //header("Refresh:1");
            }
            shell_exec("sudo kill -9 " . $pid);
            shell_exec("sudo killall -9 nethogs");

        }


        shell_exec("sudo rm -rf storage/log/out.json");
        //shell_exec("sudo nethogs -j -d 10 -v 3 > /var/www/html/cp/storage/log/out.json");
        shell_exec("bash /var/www/html/app/Libs/sh/traffic.sh &");
    }
}
