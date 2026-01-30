<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
    .custom-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(13, 18, 31, 0.95); /* Sitenin temasına uygun koyu renk */
        padding: 15px 50px;
        border-bottom: 1px solid rgba(0, 243, 255, 0.2);
        position: sticky;
        top: 0;
        z-index: 1000;
        backdrop-filter: blur(10px);
    }

    .nav-left {
        display: flex;
        gap: 30px;
    }

    .nav-left a {
        text-decoration: none;
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .nav-left a:hover {
        color: #00f3ff;
        text-shadow: 0 0 10px #00f3ff;
    }

    .nav-right .admin-link {
        text-decoration: none;
        background: transparent;
        color: #ff4757;
        padding: 8px 20px;
        border: 1px solid #ff4757;
        border-radius: 8px;
        font-weight: bold;
        transition: 0.3s;
        font-size: 14px;
    }

    .nav-right .admin-link:hover {
        background: #ff4757;
        color: #fff !important;
        box-shadow: 0 0 15px rgba(255, 71, 87, 0.4);
    }
</style>

<nav class="custom-navbar">
    <div class="nav-left">
        <a href="index.php">Ana Sayfa</a>
        <a href="hakkimda.php">Hakkımda</a>
        <a href="iletisim.php">İletişim</a>
    </div>

    <div class="nav-right">
        <a href="/admin/index.php" class="admin-link">Admin Paneli</a>
    </div>
</nav>

<main class="main-content">
    <section id="home" class="container" style="text-align: center; padding-top: 4rem;">
        
        <h1 class="title-minecraft" style="font-size: 3.5rem; margin-bottom: 2rem; color: #fff; text-shadow: 0 0 20px #00f3ff;">
            <?= htmlspecialchars($site['site_title'] ?? 'Zeymen Hub') ?>
        </h1>

        <div class="stats-grid" style="display: flex; justify-content: center; gap: 2rem; margin-top: 2rem; flex-wrap: wrap; width: 100%;">
            <div class="stat-card" style="background: rgba(0,243,255,0.05); padding: 2rem; border-radius: 20px; border: 1px solid rgba(0,243,255,0.3); min-width: 220px;">
                <div style="font-size: 3rem; color: #00f3ff; font-weight: bold;"><?= number_format($stats['subscribers'] ?? 0) ?></div>
                <div style="color: #aaa; text-transform: uppercase; font-size: 0.8rem;">YouTube Abone</div>
            </div>
            <div class="stat-card" style="background: rgba(0,243,255,0.05); padding: 2rem; border-radius: 20px; border: 1px solid rgba(0,243,255,0.3); min-width: 220px;">
                <div style="font-size: 3rem; color: #00f3ff; font-weight: bold;"><?= number_format($stats['views'] ?? 0) ?></div>
                <div style="color: #aaa; text-transform: uppercase; font-size: 0.8rem;">Toplam İzlenme</div>
            </div>
            <div class="stat-card" style="background: rgba(0,243,255,0.05); padding: 2rem; border-radius: 20px; border: 1px solid rgba(0,243,255,0.3); min-width: 220px;">
                <div style="font-size: 3rem; color: #00f3ff; font-weight: bold;"><?= number_format($stats['videos'] ?? 0) ?></div>
                <div style="color: #aaa; text-transform: uppercase; font-size: 0.8rem;">Video Sayısı</div>
            </div>
        </div>

        <div style="display: flex; justify-content: center; align-items: center; gap: 20px; margin: 60px auto; width: 100%; max-width: 800px; flex-wrap: wrap;">
            <?php if(!empty($stats['instagram_link']) && $stats['instagram_link'] != '#'): ?>
                <a href="<?= $stats['instagram_link'] ?>" target="_blank" style="background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; padding: 16px 32px; border-radius: 12px; text-decoration: none; font-weight: bold; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(220, 39, 67, 0.2);">
                    <span>📸</span> Instagram
                </a>
            <?php endif; ?>

            <?php if(!empty($stats['discord_link']) && $stats['discord_link'] != '#'): ?>
                <a href="<?= $stats['discord_link'] ?>" target="_blank" style="background: #7289da; color: white; padding: 16px 32px; border-radius: 12px; text-decoration: none; font-weight: bold; display: flex; align-items: center; gap: 10px; box-shadow: 0 10px 20px rgba(114, 137, 218, 0.2);">
                    <span>🎮</span> Discord Sunucusu
                </a>
            <?php endif; ?>
        </div>

        <h2 style="color:#00f3ff; margin-top:5rem; font-size: 2.2rem; text-transform: uppercase; letter-spacing: 4px; text-shadow: 0 0 15px rgba(0,243,255,0.5);">
            📺 SON VİDEOLARIM
        </h2>
        
        <div class="video-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 3rem; padding: 4rem 0;">
            <?php
            $videos = $pdo->query("SELECT * FROM videos ORDER BY id DESC LIMIT 6")->fetchAll();
            foreach($videos as $video):
            ?>
                <div class="video-item" style="display: flex; flex-direction: column; gap: 0;">
                    
                    <div style="background: #161d31; border-radius: 20px 20px 0 0; overflow: hidden; border: 1px solid #2d3548; border-bottom: none;">
                        <iframe width="100%" height="220" src="https://www.youtube.com/embed/<?= $video['video_id'] ?>" frameborder="0" allowfullscreen></iframe>
                        <div style="padding: 20px;">
                            <h3 style="margin: 0; font-size: 1.1rem; color: #fff; text-align: left; line-height: 1.5;">
                                <?= htmlspecialchars($video['title']) ?>
                            </h3>
                        </div>
                    </div>

                    <div style="background: #0d121f; border-radius: 0 0 20px 20px; border: 1px solid #2d3548; padding: 15px; border-top: 1px dashed #2d3548;">
                        <details style="cursor: pointer; width: 100%;">
                            <summary style="color: #00f3ff; font-weight: bold; font-size: 0.85rem; outline: none; list-style: none; display: flex; justify-content: center; align-items: center; gap: 8px;">
                                <span>▼</span> VİDEO DETAYLARI VE AÇIKLAMA
                            </summary>
                            <div style="margin-top: 15px; color: #999; font-size: 0.9rem; text-align: left; line-height: 1.6; padding: 10px; border-top: 1px solid rgba(0,243,255,0.1);">
                                <?= nl2br(htmlspecialchars($video['description'] ?? 'Bu video için henüz bir açıklama girilmedi.')) ?>
                            </div>
                        </details>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>