<?php
require_once '../config.php';
requireAdmin(); // Giriş yapmayanları index.php'ye fırlatır
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Zeymen Gamer - Dashboard</title>
    <style>
        body { background: #0a0f1c; color: white; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #00f3ff; padding-bottom: 15px; margin-bottom: 30px; }
        .header h1 { color: #00f3ff; margin: 0; text-transform: uppercase; letter-spacing: 2px; }
        
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .card { background: #161d31; padding: 25px; border-radius: 12px; border: 1px solid #2d3548; text-align: center; transition: 0.3s; }
        .card:hover { border-color: #00f3ff; transform: translateY(-5px); }
        .card h3 { color: #00f3ff; margin-top: 0; font-size: 14px; text-transform: uppercase; }
        .card p { font-size: 32px; font-weight: bold; margin: 15px 0; }
        
        .btn { display: inline-block; padding: 12px 25px; background: #00f3ff; color: #0a0f1c; text-decoration: none; border-radius: 6px; font-weight: bold; transition: 0.3s; }
        .btn:hover { background: #00d4df; }
        .logout { color: #ff4b4b; text-decoration: none; font-weight: bold; border: 1px solid #ff4b4b; padding: 5px 15px; border-radius: 5px; }
        .logout:hover { background: #ff4b4b; color: white; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admin Paneli</h1>
        <a href="logout.php" class="logout">GÜVENLİ ÇIKIŞ</a>
    </div>

    <div class="grid">
        <div class="card">
            <h3>Abone Sayısı</h3>
            <p><?php echo number_format($stats['subscribers'] ?? 0); ?></p>
            <a href="edit_stats.php" class="btn">GÜNCELLE</a>
        </div>

        <div class="card">
            <h3>Toplam İzlenme</h3>
            <p><?php echo number_format($stats['views'] ?? 0); ?></p>
            <a href="edit_stats.php" class="btn">GÜNCELLE</a>
        </div>

        <div class="card">
            <h3>Video Sayısı</h3>
            <p><?php echo number_format($stats['videos'] ?? 0); ?></p>
            <a href="edit_stats.php" class="btn">GÜNCELLE</a>
        </div>
    </div>

    <div style="margin-top: 50px; background: #161d31; padding: 30px; border-radius: 12px; border: 1px dashed #00f3ff; text-align: center;">
        <h2 style="margin-top:0;">Video Yönetimi</h2>
        <p>YouTube videolarını ana sayfaya eklemek için aşağıdaki butonu kullan.</p>
        <a href="add_video.php" class="btn" style="background: #ff0000; color: white;">+ YENİ VİDEO EKLE</a>
    </div>
</body>
</html>