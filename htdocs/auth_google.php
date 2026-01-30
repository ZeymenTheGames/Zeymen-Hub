<?php
include 'config.php';
session_start();

// Google'dan bir 'code' geldiyse (Giriş yapılmışsa)
if (isset($_GET['code'])) {
    $token_url = "https://oauth2.googleapis.com/token";
    $params = [
        "code"          => $_GET['code'],
        "client_id"      => GOOGLE_CLIENT_ID,
        "client_secret"  => GOOGLE_CLIENT_SECRET,
        "redirect_uri"   => GOOGLE_REDIRECT_URL,
        "grant_type"     => "authorization_code"
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    $response = curl_exec($ch);
    $data = json_decode($response, true);

    if (isset($data['access_token'])) {
        // Kullanıcı bilgilerini alıyoruz
        $info_url = "https://www.googleapis.com/oauth2/v1/userinfo?access_token=" . $data['access_token'];
        $user = json_decode(file_get_contents($info_url), true);

        // Bilgileri oturuma kaydediyoruz
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_avatar'] = $user['picture'];

        header("Location: iletisim.php");
        exit;
    }
}

// Butona tıklandığında Google'ın giriş sayfasına gönderir
$auth_url = "https://accounts.google.com/o/oauth2/v2/auth?client_id=" . GOOGLE_CLIENT_ID . "&redirect_uri=" . urlencode(GOOGLE_REDIRECT_URL) . "&response_type=code&scope=profile%20email";
header("Location: " . $auth_url);
exit;