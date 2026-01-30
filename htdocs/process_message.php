<?php
include 'config.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    $is_public = isset($_POST['is_public']) ? 1 : 0;
    
    if (empty($message)) {
        header("Location: iletisim.php?error=empty");
        exit;
    }

    // --- KÜFÜR FİLTRESİ ---
    $yasakli = ['aq', 'amk', 'sik', 'pç', 'orospu', 'göt', 'yavşak', 'piç', 'ibne', 'puşt', 'gavat', 'kahpe']; 
    $kufur_var_mi = false;
    $mesaj_low = mb_strtolower($message, 'UTF-8');

    foreach ($yasakli as $kelime) {
        if (preg_match('/\b' . preg_quote($kelime, '/') . '\b/u', $mesaj_low)) {
            $kufur_var_mi = true;
            break;
        }
    }

    if ($kufur_var_mi) {
        header("Location: iletisim.php?status=kufur_yasak");
        exit;
    }

    try {
        // Durumu direkt 'approved' yapıyoruz ki anında yayınlansın
        $stmt = $pdo->prepare("INSERT INTO messages (user_id, user_name, user_avatar, message, is_public, status) VALUES (?, ?, ?, ?, ?, 'approved')");
        $stmt->execute([
            $_SESSION['user_id'],
            $_SESSION['user_name'],
            $_SESSION['user_avatar'],
            $message,
            $is_public
        ]);
        
        header("Location: iletisim.php?status=success");
        exit;
    } catch (PDOException $e) {
        die("Hata: " . $e->getMessage());
    }
} else {
    header("Location: iletisim.php");
    exit;
}