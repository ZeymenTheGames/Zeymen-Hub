<?php include 'config.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
    .custom-navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(13, 18, 31, 0.95);
        padding: 15px 50px;
        border-bottom: 1px solid rgba(0, 243, 255, 0.2);
        position: sticky;
        top: 0;
        z-index: 1000;
        backdrop-filter: blur(10px);
        font-family: sans-serif;
    }

    .nav-left { display: flex; gap: 30px; }
    .nav-left a {
        text-decoration: none;
        color: #fff;
        font-weight: 600;
        font-size: 15px;
        transition: 0.3s;
        text-transform: uppercase;
    }
    .nav-left a:hover { color: #00f3ff; text-shadow: 0 0 10px #00f3ff; }

    .nav-right .admin-link {
        text-decoration: none;
        background: transparent;
        color: #ff4757;
        padding: 8px 20px;
        border: 1px solid #ff4757;
        border-radius: 8px;
        font-weight: bold;
    }
    .nav-right .admin-link:hover { background: #ff4757; color: #fff !important; }
</style>

<nav class="custom-navbar">
    <div class="nav-left">
        <a href="index.php">Ana Sayfa</a>
        <a href="hakkimda.php" style="color: #00f3ff;">Hakkımda</a> <a href="iletisim.php">İletişim</a>
    </div>
    <div class="nav-right">
        <a href="admin/" class="admin-link">Admin Paneli</a>
    </div>
</nav>

<main class="main-content" style="background-color: #0d121f; min-height: 80vh; padding: 50px 0;">
    <section class="container" style="max-width: 800px; margin: 0 auto; text-align: center; color: #fff;">
        
        <h1 style="color: #00f3ff; font-size: 3rem; text-shadow: 0 0 15px #00f3ff; margin-bottom: 30px;">
            Hakkımda
        </h1>

        <div style="background: rgba(22, 29, 49, 0.7); padding: 40px; border-radius: 20px; border: 1px solid #2d3548; line-height: 1.8; font-size: 1.1rem; text-align: left;">
            <p>Merhaba! Ben <strong>Zeymen</strong>.</p>
            <p>Şuanda 17 yaşındayım ve yaklaşık 8-9 yıldır minecraft oynuyorum. Youtube ve İnstagramda amatör içerik üreticisiyim. Bu süreçte bana destek olan, yanımda duran ve duracak olan herkese çok teşekkür ediyorum. </p>
            
            <hr style="border: 0; border-top: 1px dashed rgba(0, 243, 255, 0.3); margin: 30px 0;">
            
            <p><strong>Yayınlarım:</strong> Şuanda yayın yapmıyorum.</p>
            <p><strong>Hedefim:</strong> Topluluğumuzla birlikte eğlenceli ve öğretici vakit geçirmek.</p>
        </div>

    </section>
</main>

<?php include 'includes/footer.php'; ?>