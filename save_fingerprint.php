<?php
$mysqli = new mysqli("localhost", "db", "password", "db");
if ($mysqli->connect_errno) die("DB Hatası: " . $mysqli->connect_error);

$fingerprint = $_POST['fingerprint'] ?? '';
$ip = $_POST['ip'] ?? $_SERVER['REMOTE_ADDR'];
$reason = $_POST['reason'] ?? 'Unknown';

if ($fingerprint){
    $stmt = $mysqli->prepare("INSERT INTO fingerprints (fingerprint, ip, reason) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fingerprint, $ip, $reason);
    $stmt->execute();
    $stmt->close();
}
?>