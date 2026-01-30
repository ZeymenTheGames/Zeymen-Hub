<?php
require_once '../config.php';
if (session_status() === PHP_SESSION_NONE) { session_start(); }
requireAdmin();

$message = "";

// Sayfa ilk açıldığında mevcut verileri çek
$stats = $pdo->query("SELECT * FROM stats WHERE id = 1")->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sub = $_POST['subscribers'] ?? 0;
    $view = $_POST['views'] ?? 0;
    $vid = $_POST['videos'] ?? 0;
    $insta = $_POST['instagram_link'] ?? '#';
    $disco = $_POST['discord_link'] ?? '#';

    try {
        $stmt = $pdo->prepare("UPDATE stats SET subscribers = ?, views = ?, videos = ?, instagram_link = ?, discord_link = ? WHERE id = 1");
        $stmt->execute([$sub, $view, $vid, $insta, $disco]);
        $message = "Başarıyla güncellendi!";
        // Güncel veriyi tekrar çek
        $stats = $pdo->query("SELECT * FROM stats WHERE id = 1")->fetch();
    } catch (PDOException $e) {
        $message = "Hata: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>İstatistikleri Güncelle</title>
    <style>
        body { background: #0a0f1c; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .box { background: #161d31; padding: 30px; border-radius: 12px; border: 1px solid #00f3ff; width: 380px; }
        h2 { color: #00f3ff; text-align: center; text-transform: uppercase; }
        label { display: block; margin: 10px 0 5px; font-size: 14px; color: #aaa; }
        input { width: 100%; padding: 12px; background: #0a0f1c; border: 1px solid #2d3548; color: white; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #00f3ff; color: #0a0f1c; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; margin-top: 20px; }
        .msg { background: rgba(0, 243, 255, 0.1); color: #00f3ff; padding: 10px; border-radius: 5px; text-align: center; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Panel Güncelle</h2>
        <?php if($message) echo "<div class='msg'>$message</div>"; ?>
        <form method="POST">
            <label>Abone Sayısı</label>
            <input type="number" name="subscribers" value="<?= $stats['subscribers'] ?>">
            <label>Toplam İzlenme</label>
            <input type="number" name="views" value="<?= $stats['views'] ?>">
            <label>Video Sayısı</label>
            <input type="number" name="videos" value="<?= $stats['videos'] ?>">
            <label>Instagram (https://...)</label>
            <input type="text" name="instagram_link" value="<?= $stats['instagram_link'] ?>">
            <label>Discord (https://...)</label>
            <input type="text" name="discord_link" value="<?= $stats['discord_link'] ?>">
            <button type="submit">HAYDİ GÜNCELLE</button>
        </form>
        <a href="dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#aaa; text-decoration:none;">← Geri Dön</a>
    </div>
</body>
</html>