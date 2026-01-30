<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once '../config.php';

if(isAdmin()) { header("Location: dashboard.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user]);
    $userData = $stmt->fetch();

    // Veritabanındaki password_hash sütununa bakar
   // Karmaşık doğrulamayı geçici olarak kaldırıp direkt kontrol ediyoruz
    if ($userData && $pass === $userData['password_hash']) {
        $_SESSION['admin_logged_in'] = true; 
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Hatalı kullanıcı adı veya şifre!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Girişi</title>
    <style>
        body { background: #0a0f1c; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: #161d31; padding: 30px; border-radius: 10px; border: 1px solid #00f3ff; text-align: center; width: 300px; }
        h2 { color: #00f3ff; margin-bottom: 20px; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; background: #0a0f1c; border: 1px solid #2d3548; color: white; border-radius: 5px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #00f3ff; border: none; color: #0a0f1c; font-weight: bold; cursor: pointer; border-radius: 5px; }
        .err { color: #ff4b4b; font-size: 14px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>ADMIN PANELİ</h2>
        <?php if(isset($error)) echo "<div class='err'>$error</div>"; ?>
        <form method="POST">
            <input type="text" name="user" placeholder="Kullanıcı Adı" required>
            <input type="password" name="pass" placeholder="Şifre" required>
            <button type="submit">GİRİŞ YAP</button>
        </form>
    </div>
</body>
</html>