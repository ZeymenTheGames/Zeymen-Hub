<?php
require_once '../config.php';
requireAdmin();
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $url = $_POST['youtube_url'];
    $desc = $_POST['description']; // Yeni açıklama alanı

    preg_match("/(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be\/)[^&\n]+/", $url, $matches);
    $video_id = $matches[0] ?? "";

    if ($video_id) {
        $stmt = $pdo->prepare("INSERT INTO videos (title, video_id, description) VALUES (?, ?, ?)");
        $stmt->execute([$title, $video_id, $desc]);
        $message = "Video ve açıklama eklendi!";
    } else {
        $message = "Hata: Geçerli YouTube linki girin!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Video Ekle</title>
    <style>
        body { background: #0a0f1c; color: white; font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .add-box { background: #161d31; padding: 30px; border-radius: 12px; border: 1px solid #ff0000; width: 450px; }
        input, textarea { width: 100%; padding: 12px; margin-bottom: 15px; background: #0a0f1c; border: 1px solid #2d3548; color: white; border-radius: 6px; box-sizing: border-box; }
        textarea { height: 100px; resize: none; }
        button { width: 100%; padding: 12px; background: #ff0000; color: white; border: none; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="add-box">
        <h2 style="color:#ff0000; text-align:center;">YENİ VİDEO</h2>
        <?php if($message) echo "<p style='text-align:center;'>$message</p>"; ?>
        <form method="POST">
            <input type="text" name="title" placeholder="Video Başlığı" required>
            <input type="text" name="youtube_url" placeholder="YouTube Linki" required>
            <textarea name="description" placeholder="Video Açıklaması (Açılır pencerede görünecek)"></textarea>
            <button type="submit">SİTEYE EKLE</button>
        </form>
        <a href="dashboard.php" style="display:block; text-align:center; margin-top:15px; color:#aaa; text-decoration:none;">← Geri Dön</a>
    </div>
</body>
</html>