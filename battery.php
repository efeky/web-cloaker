<?php
$mysqli = new mysqli("localhost", "db", "pass", "db");
if ($mysqli->connect_errno) die("DB Hatası: " . $mysqli->connect_error);

$ip = $_POST['ip'] ?? '';
$reason = $_POST['reason'] ?? 'Battery %100+Charging';

if($ip){
    $stmt = $mysqli->prepare("INSERT IGNORE INTO blacklist_ips (ip, reason) VALUES (?, ?)");
    $stmt->bind_param("ss", $ip, $reason);
    $stmt->execute();
}

$mysqli->close();