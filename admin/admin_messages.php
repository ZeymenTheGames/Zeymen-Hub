<?php
include '../config.php';
requireAdmin();

// Silme İşlemi
if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    if ($_GET['action'] == 'delete') {
        $pdo->prepare("DELETE FROM messages WHERE id = ?")->execute([$id]);
    }
    header("Location: messages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Zeymen Hub - Mesaj Yönetimi</title>
    <style>
        body { background: #0b0f1a; color: white; font-family: sans-serif; padding: 40px; }
        .container { max-width: 1000px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; background: #1e293b; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        th, td { padding: 15px; border-bottom: 1px solid #334155; text-align: left; }
        th { background: #0d121f; color: #00f2ff; text-transform: uppercase; font-size: 0.8rem; }
        .del-btn { background: #ff4757; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 0.8rem; transition: 0.3s; }
        .del-btn:hover { background: #ff6b81; box-shadow: 0 0 10px #ff4757; }
        .back-link { color: #00f2ff; text-decoration: none; margin-bottom: 20px; display: inline-block; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="back-link">← Panele Geri Dön</a>
        <h2 style="border-left: 5px solid #00f2ff; padding-left: 15px; margin-bottom: 30px;">📩 Mesaj Duvarı Yönetimi</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Kullanıcı</th>
                    <th>Mesaj</th>
                    <th>Tarih</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM messages ORDER BY id DESC");
                while($m = $stmt->fetch()): ?>
                    <tr>
                        <td style="display:flex; align-items:center; gap:10px;">
                            <img src="<?= $m['user_avatar'] ?>" width="30" style="border-radius:50%; border: 1px solid #00f2ff;">
                            <b><?= htmlspecialchars($m['user_name']) ?></b>
                        </td>
                        <td style="max-width: 400px; font-size: 0.9rem; color: #cbd5e1;"><?= nl2br(htmlspecialchars($m['message'])) ?></td>
                        <td style="font-size: 0.8rem; color: #64748b;"><?= date("d.m.Y H:i", strtotime($m['created_at'])) ?></td>
                        <td>
                            <a href="?action=delete&id=<?= $m['id'] ?>" class="del-btn" onclick="return confirm('Bu mesajı silmek istediğine emin misin?')">SİL</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>