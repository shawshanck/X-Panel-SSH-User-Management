<?php

class Permission_Model extends Model
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
            $url = htmlspecialchars($_GET['url']);
            $url = explode('/', $url);
            $query = $this->db->prepare("SELECT * FROM admins WHERE username_u=:username AND permission_u='admin' AND login_key=:login_key");
            $query->execute(['username' => $Ukey,'login_key' => $_COOKIE["xpkey"]]);
            $queryCount = $query->rowCount();
            if ($queryCount > 0) {
                if (ucfirst($url[0]) == 'Managers' || ucfirst($url[0]) == 'Settings' || ucfirst($url[0]) == 'online') {
                    die('<h4 style="color: red">INACCESSIBILITY</h4>');
                }
            }
        }

    }
}