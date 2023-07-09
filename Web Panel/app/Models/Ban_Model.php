<?php

class Ban_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->index();
    }


    public function index()
    {
        $ipAddress = $_SERVER['REMOTE_ADDR']; // آدرس IP کاربر
        $query = $this->db->prepare("SELECT * FROM ip_list WHERE ip_address=:ip AND ip_status='ban'");
        $query->execute(['ip' => $ipAddress]);
        $queryCount = $query->rowCount();
        if ($queryCount > 0) {
            http_response_code(429); // کد خطای Too Many Requests
            require_once('../app/Views/Limit/ban.php');
            exit;
        }
    }



}