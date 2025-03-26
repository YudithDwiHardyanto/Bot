<?php
// Token bot Telegram Anda
$botToken = "7914894833:AAEN9Fn7OuttXc7Y2hdCWmCcIZ4KV-GPgVo";
// ID chat Telegram Anda
$chatId = "6146540731";

// Ambil IP user
$userIP = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "Direct Visit";
$time = date("Y-m-d H:i:s");

// Buat pesan untuk dikirim ke Telegram
$message = "IP Address: $userIP\n"
    . "User-Agent: $userAgent\n"
    . "Referrer: $referrer\n"
    . "Time: $time";

// Kirim pesan ke bot Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    "chat_id" => $chatId,
    "text" => $message,
    "parse_mode" => "Markdown"
];

$options = [
    "http" => [
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Simpan data ke dalam file log
$logData = "[$time] - IP: $userIP - User-Agent: $userAgent - Referrer: $referrer\n";
file_put_contents("log.txt", $logData, FILE_APPEND);

// Redirect ke halaman lain setelah logging (opsional)
header("Location: https://example.com");
exit();
?>
