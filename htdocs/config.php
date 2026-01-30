<?php
// Oturumu sadece bir kez başlatmak için kontrol
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Veritabanı Bilgileri
define('DB_HOST', 'sql100.infinityfree.com');      
define('DB_USER', 'if0_41013781');                
define('DB_PASS', 'cUOyhCPKDneqqOf');                 
define('DB_NAME', 'if0_41013781_zeymen_db'); 

// Site Ayarları
define('ADMIN_USERNAME', 'admin');
define('SITE_URL', 'https://zeymen.gamer.gd'); 

// --- GOOGLE LOGIN ANAHTARLARI ---
define('GOOGLE_CLIENT_ID', '812290218572-slgqob8okaacasot9m9sghgb5albv2hg.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_REDIRECT_URL', 'https://zeymen.gamer.gd/auth_google.php');
// --------------------------------

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}

// Global verileri çek
try {
    $site = $pdo->query("SELECT * FROM settings LIMIT 1")->fetch();
    $stats = $pdo->query("SELECT * FROM stats LIMIT 1")->fetch();
} catch(Exception $e) {
    $site = [];
    $stats = [];
}

// Yetki Fonksiyonları
function isAdmin() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireAdmin() {
    if (!isAdmin()) {
        header("Location: /admin/index.php");
        exit;
    }
}
?>