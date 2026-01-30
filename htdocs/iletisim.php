<?php
require_once 'config.php';
include 'includes/header.php';

$is_logged_in = isset($_SESSION['user_id']); 
$user_name = $is_logged_in ? $_SESSION['user_name'] : "Misafir";
$user_avatar = $is_logged_in ? $_SESSION['user_avatar'] : "https://via.placeholder.com/50/00f2ff/0b0f1a?text=M";
?>

<div class="container">
    <?php if(isset($_GET['status'])): ?>
        <div style="padding: 15px; border-radius: 10px; margin-bottom: 25px; text-align: center; font-weight: bold; background: <?= $_GET['status'] == 'success' ? '#2ecc71' : '#ff4757' ?>;">
            <?= $_GET['status'] == 'success' ? '✅ Mesajın başarıyla duvara asıldı!' : '⚠️ Filtreye takıldın veya bir hata oluştu!' ?>
        </div>
    <?php endif; ?>

    <div style="background: #1e293b; padding: 35px; border-radius: 20px; border: 1px solid #00f2ff33; position: relative;">
        <?php if(!$is_logged_in): ?>
            <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(11,15,26,0.95); z-index:10; display:flex; flex-direction:column; justify-content:center; align-items:center; border-radius:20px; text-align: center;">
                <h3 style="margin-bottom: 20px;">Mesaj Yazmak İçin Google ile Giriş Yapmalısın</h3>
                <a href="auth_google.php" style="background:#fff; color:#000; padding:12px 25px; border-radius:8px; text-decoration:none; font-weight:bold; box-shadow: 0 4px 15px rgba(255,255,255,0.2);">Google Hesabı ile Bağlan</a>
            </div>
        <?php endif; ?>

        <form action="process_message.php" method="POST">
            <div style="display:flex; align-items:center; gap:15px; margin-bottom:25px;">
                <img src="<?= $user_avatar ?>" style="width:50px; height:50px; border-radius:50%; border:2px solid #00f2ff;">
                <span style="font-size: 1.2rem; font-weight: bold;"><?= htmlspecialchars($user_name) ?></span>
            </div>
            <textarea name="message" placeholder="Buraya bir şeyler karala... (Meme serbest, küfür yasak!)" style="width:100%; background:#0b0f1a; border:1px solid #334155; border-radius:12px; padding:20px; color:#fff; min-height:120px; resize:none; font-size: 1rem;" required></textarea>
            <button type="submit" style="background:#00f2ff; color:#000; border:none; padding:15px; border-radius:10px; font-weight:bold; cursor:pointer; width:100%; margin-top:20px; font-size: 1.1rem; transition: 0.3s;">MESAJI GÖNDER</button>
        </form>
    </div>

    <h2 style="margin-top:60px; text-align:center; color:#00f2ff; text-transform: uppercase; letter-spacing: 2px;">💬 Mesaj Duvarı</h2>
    
    <div id="feed" style="margin-top: 30px;">
        <?php
        $stmt = $pdo->query("SELECT * FROM messages WHERE status = 'approved' ORDER BY id DESC");
        while($m = $stmt->fetch()): ?>
            <div style="background:#1e293b; padding:20px; border-radius:15px; margin-bottom:20px; border: 1px solid #ffffff0d; animation: fadeIn 0.5s ease;">
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:12px; font-size:0.85rem; color:#00f2ff;">
                    <img src="<?= $m['user_avatar'] ?>" style="width:30px; height:30px; border-radius:50%;">
                    <b><?= htmlspecialchars($m['user_name']) ?></b> 
                    <span style="color: #64748b;">• <?= date("d.m.Y H:i", strtotime($m['created_at'])) ?></span>
                </div>
                <p style="margin:0; line-height:1.6; color:#e2e8f0; font-size: 1.05rem;"><?= nl2br(htmlspecialchars($m['message'])) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>