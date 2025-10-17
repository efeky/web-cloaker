<?php
// === by https://github.com/efeky
// === 1️⃣ Database Connection (Please double check if theese are correct)
$mysqli = new mysqli("localhost", "db", "password", "db");
if ($mysqli->connect_errno) die("DB Error: " . $mysqli->connect_error);

// === 2️⃣ Google Ads and User Agents List (you can add more) ===
$googleBotsList = [
    'AdsBot-Google','AdsBot-Google-Mobile','Googlebot','Googlebot-Image','Googlebot-News',
    'Googlebot-Video','Mediapartners-Google','Google-InspectionTool','Storebot-Google',
    'Feedfetcher-Google','Google-Read-Aloud','DuplexWeb-Google','Google Favicon','GoogleOther',
    'GoogleOther-Image','GoogleOther-Video','Google-CloudVertexBot','Google-Extended'
];

$ip = $_SERVER['REMOTE_ADDR'] ?? '';
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$country = 'TR';
$isp = 'Bilinmiyor';
$isGoogleBot = false;
$reason = "";

// === 3️⃣ IP, ISP and Country Control (can be modified) You can edit the country Code , currently only TR (Turkiye) is allowed to access! ===
// === ⚠️ WARNING: api is %100 free so might be slow or will be not work for sometimes, for best performance please use a good paid api. ===

$details = @json_decode(file_get_contents("http://ip-api.com/json/{$ip}"));
if($details){
    $isp = $details->isp ?? 'Bilinmiyor';
    $country = $details->countryCode ?? 'TR';
}

// Google ip ranges
$googleIPs = [
    '64.233.160.0/19',
    '66.102.0.0/20',
    '66.249.64.0/19',
    '72.14.192.0/18',
    '74.125.0.0/16',
    '209.85.128.0/17',
    '216.239.32.0/19',
    '34.0.0.0/15',
    '35.0.0.0/16',
    '192.178.4.0/27',
    '192.178.4.32/27',
    '192.178.4.64/27',
    '192.178.4.96/27',
    '192.178.4.128/27',
    '192.178.4.160/27',
    '192.178.4.192/27',
    '192.178.5.0/27',
    '192.178.6.0/27',
    '192.178.6.32/27',
    '192.178.6.64/27',
    '192.178.6.96/27',
    '192.178.6.128/27',
    '192.178.6.160/27',
    '192.178.6.192/27',
    '192.178.6.224/27',
    '192.178.7.0/27',
    '192.178.7.32/27',
    '192.178.7.64/27',
    '192.178.7.96/27',
    '192.178.7.128/27',
    '192.178.7.160/27',
    '192.178.7.192/27',
    '192.178.7.224/27',
    '34.100.182.96/28',
    '34.101.50.144/28',
    '34.118.254.0/28',
    '34.118.66.0/28',
    '34.126.178.96/28',
    '34.146.150.144/28',
    '34.147.110.144/28',
    '34.151.74.144/28',
    '34.152.50.64/28',
    '34.154.114.144/28',
    '34.155.98.32/28',
    '34.165.18.176/28',
    '34.175.160.64/28',
    '34.176.130.16/28',
    '34.22.85.0/27',
    '34.64.82.64/28',
    '34.65.242.112/28',
    '34.80.50.80/28',
    '34.88.194.0/28',
    '34.89.10.80/28',
    '34.89.198.80/28',
    '34.96.162.48/28',
    '35.247.243.240/28',
    '66.249.64.0/27',
    '66.249.64.32/27',
    '66.249.64.64/27',
    '66.249.64.96/27',
    '66.249.64.128/27',
    '66.249.64.160/27',
    '66.249.64.192/27',
    '66.249.64.224/27',
    '66.249.65.0/27',
    '66.249.65.32/27',
    '66.249.65.64/27',
    '66.249.65.96/27',
    '66.249.65.128/27',
    '66.249.65.160/27',
    '66.249.65.192/27',
    '66.249.65.224/27',
    '66.249.66.0/27',
    '66.249.66.32/27',
    '66.249.66.64/27',
    '66.249.66.96/27',
    '66.249.66.128/27',
    '66.249.66.160/27',
    '66.249.66.192/27',
    '66.249.66.224/27',
    '66.249.67.0/27',
    '66.249.67.32/27',
    '66.249.68.0/27',
    '66.249.68.32/27',
    '66.249.68.64/27',
    '66.249.68.96/27',
    '66.249.68.128/27',
    '66.249.68.160/27',
    '66.249.68.192/27',
    '66.249.68.224/27',
    '66.249.69.0/27',
    '66.249.69.32/27',
    '66.249.69.64/27',
    '66.249.69.96/27',
    '66.249.69.128/27',
    '66.249.69.160/27',
    '66.249.69.192/27',
    '66.249.69.224/27',
    '66.249.70.0/27',
    '66.249.70.32/27',
    '66.249.70.64/27',
    '66.249.70.96/27',
    '66.249.70.128/27',
    '66.249.70.160/27',
    '66.249.70.192/27',
    '66.249.70.224/27',
    '66.249.71.0/27',
    '66.249.71.32/27',
    '66.249.71.64/27',
    '66.249.71.96/27',
    '66.249.71.128/27',
    '66.249.71.160/27',
    '66.249.71.192/27',
    '66.249.71.224/27',
    '66.249.72.0/27',
    '66.249.72.32/27',
    '66.249.72.64/27',
    '66.249.72.96/27',
    '66.249.72.128/27',
    '66.249.72.160/27',
    '66.249.72.192/27',
    '66.249.72.224/27',
    '66.249.73.0/27',
    '66.249.73.32/27',
    '66.249.73.64/27',
    '66.249.73.96/27',
    '66.249.73.128/27',
    '66.249.73.160/27',
    '66.249.73.192/27',
    '66.249.73.224/27',
    '66.249.74.0/27',
    '66.249.74.32/27',
    '66.249.74.64/27',
    '66.249.74.96/27',
    '66.249.74.128/27',
    '66.249.74.160/27',
    '66.249.74.192/27',
    '66.249.74.224/27',
    '66.249.75.0/27',
    '66.249.75.32/27',
    '66.249.75.64/27',
    '66.249.75.96/27',
    '66.249.75.128/27',
    '66.249.75.160/27',
    '66.249.75.192/27',
    '66.249.75.224/27',
    '66.249.76.0/27',
    '66.249.76.32/27',
    '66.249.76.64/27',
    '66.249.76.96/27',
    '66.249.76.128/27',
    '66.249.76.160/27',
    '66.249.76.192/27',
    '66.249.76.224/27',
    '66.249.77.0/27',
    '66.249.77.32/27',
    '66.249.77.64/27',
    '66.249.77.96/27',
    '66.249.77.128/27',
    '66.249.77.160/27',
    '66.249.77.192/27',
    '66.249.77.224/27',
    '66.249.78.0/27',
    '66.249.78.32/27',
    '66.249.78.64/27',
    '66.249.78.96/27',
    '66.249.78.128/27',
    '66.249.78.160/27',
    '66.249.78.192/27',
    '66.249.78.224/27',
    '66.249.79.0/27',
    '66.249.79.32/27',
    '66.249.79.64/27',
    '66.249.79.96/27',
    '66.249.79.128/27',
    '66.249.79.160/27',
    '66.249.79.192/27',
    '66.249.79.224/27'
];

// ISP Hosts Banned List (u can add or modify)
$bannedISPs = [
    'Hetzner Online GmbH',
    'OVH SAS',
    'DigitalOcean, LLC',
    'Amazon.com, Inc.',
    'Microsoft Corporation',
    'AS401120 cheapy.host LLC',
    'cheapy.host LLC',
    'Google LLC',
    'AS216071 SERVERS TECH FZCO',
    'AS198605 Gen Digital dba as Avast',
    'AS13332 Hype Enterprises',
    'AS7684 SAKURA internet inc.',
    'AS16509 Amazon.com, Inc.',
    'AS210558 1337 Services GmbH'
];

// IP Range Control function
function ip_in_range($ip, $ranges){
    foreach($ranges as $range){
        if(strpos($range,'/')!==false){
            list($subnet,$bits)=explode('/',$range);
            if((ip2long($ip) & ~((1<<(32-$bits))-1)) == ip2long($subnet)) return true;
        } else { 
            if($ip==$range) return true; 
        }
    }
    return false;
}

// === 4️⃣ Blacklist Controller ===
$blacklisted=false;
$stmt=$mysqli->prepare("SELECT COUNT(*) FROM blacklist_ips WHERE ip=?");
$stmt->bind_param("s",$ip); 
$stmt->execute();
$stmt->bind_result($count); 
$stmt->fetch(); 
$blacklisted=$count>0;
$stmt->close();
if($blacklisted){ 
    $isGoogleBot=true; 
    $reason="Blacklist IP"; 
}

// === 5️⃣ Bot Detection ===
if(!$isGoogleBot){
    if(preg_match('/'.implode('|',$googleBotsList).'/i',$userAgent)){
        $isGoogleBot=true; $reason="Google UA";
    }
    elseif(ip_in_range($ip,$googleIPs)){
        $isGoogleBot=true; $reason="Google IP Range";
    }
    elseif($country!=='TR'){
        $isGoogleBot=true; $reason="IP is not from Turkiye";
    }
    elseif(in_array($isp,$bannedISPs)){
        $isGoogleBot=true; $reason="Banned Google ISP ($isp)";
    }
}

// === 6️⃣ Reverse DNS Controller ===
$rdns=@gethostbyaddr($ip);
if(!$isGoogleBot && $rdns && stripos($rdns,"google")!==false){
    $isGoogleBot=true; $reason="Ters DNS Google";
}

// === 7️⃣ Dynamic Blacklist Add to DB ===
if($isGoogleBot && !$blacklisted){
    $stmt=$mysqli->prepare("INSERT INTO blacklist_ips (ip, reason) VALUES (?, ?)");
    $stmt->bind_param("ss",$ip,$reason); 
    $stmt->execute(); 
    $stmt->close();
}

// === 8️⃣ Log normal users for more Security (disable if u dont need) ===
function log_normal_user($mysqli, $ip, $ua, $country, $isp){
    $time = date('Y-m-d H:i:s');
    $stmt=$mysqli->prepare("INSERT INTO user_logs (ip, user_agent, reason, country, isp, created_at) VALUES (?, ?, ?, ?, ?, ?)");
    $reason = "Normal User";
    $stmt->bind_param("ssssss",$ip,$ua,$reason,$country,$isp,$time);
    $stmt->execute();
    $stmt->close();
}

// === 9️⃣ Save normal user ===
if(!$isGoogleBot){
    log_normal_user($mysqli,$ip,$userAgent,$country,$isp);
}

// === 10️⃣ HoneyPot Controller ===
$hpFilled = !empty($_POST['hp_name']??'') || !empty($_POST['hp_email']??'');
if($hpFilled){
    $isGoogleBot=true;
    $reason="HoneyPot Bot";
}

// === 11️⃣ Battery Control Simulation (beta 1.0) ===
$simulateBatteryBot = false;
if(!$isGoogleBot){
    if(stripos($isp,'Hetzner')!==false || ip_in_range($ip,$googleIPs)){
        $simulateBatteryBot = true;
        $isGoogleBot=true;
        $reason="Battery %100 + Charging (Simulated)";
    }
}

// === 12️⃣ Fingerprint Save (Server-side) ===
$fp = hash('sha256',$ip.$userAgent.$isp.$country);
$stmt=$mysqli->prepare("INSERT INTO fingerprints (ip,fingerprint,reason,created_at) VALUES (?,?,?,?)");
$time = date('Y-m-d H:i:s');
$stmt->bind_param("ssss",$ip,$fp,$reason,$time);
$stmt->execute();
$stmt->close();

// === 13️⃣ Page Forwarding.. (bot.html is for Detected bots, normal.html for Non-bots. real users.) ===
if($isGoogleBot){
    include "bot.html";
} else {
    include "normal.html";
}
?>