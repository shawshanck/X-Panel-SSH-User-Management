<?php

class Limit_Model extends Model
{
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->index();
    }
    function getRecentRequests($ipAddress, $timeWindow)
    {
        $time = time();
        $query = $this->db->prepare("select * from requests");
        $query->execute();
        $queryCount = $query->fetchAll();

        $timeWindow = strtotime("-$timeWindow seconds", $time);
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM requests WHERE ip_address = :ip AND timestamp > :timelog");
        $stmt->execute([
            ':ip' => $ipAddress,
            ':timelog' => $timeWindow
        ]);

        return $stmt->fetchColumn();
    }

    function saveRequest($ipAddress, $timestamp)
    {
        $query = $this->db->prepare("SELECT * FROM whitelist_ip WHERE ip_address=:ip");
        $query->execute(['ip' => $ipAddress]);
        $queryCount = $query->rowCount();
        if ($queryCount < 1) {
            $stmt = $this->db->prepare("INSERT INTO requests (ip_address, timestamp) VALUES (:ip, :timestamp)");
            $stmt->bindParam(':ip', $ipAddress, PDO::PARAM_STR);
            $stmt->bindParam(':timestamp', $timestamp, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function index()
    {
        $maxRequests = 3; // حداکثر تعداد درخواست‌ها در بازه زمانی
        $ipAddress = $_SERVER['REMOTE_ADDR']; // آدرس IP کاربر
        $timeWindow = 5;
        $timestamp = time(); // زمان فعلی
        $this->saveRequest($ipAddress, $timestamp);
        $recentRequests = $this->getRecentRequests($ipAddress, $timeWindow);
        if ($recentRequests >= $maxRequests) {
            $sql = "UPDATE ip_list SET ip_status=?, ip_dsc=? WHERE ip_address=?";
            $this->db->prepare($sql)->execute(['ban','System Baned', $ipAddress]);
            http_response_code(429); // کد خطای Too Many Requests
            require_once('Views/Limit/ban.php');
            exit;
        }
    }



}