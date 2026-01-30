<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zeymen Hub</title>
    <style>
        body { background: #0b0f1a; color: white; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; }
        .nav { display: flex; justify-content: space-between; align-items: center; padding: 15px 50px; background: #0d121f; border-bottom: 1px solid #00f2ff33; }
        .nav-links a { color: white; text-decoration: none; font-weight: bold; margin-right: 25px; transition: 0.3s; }
        .nav-links a:hover { color: #00f2ff; }
        .admin-btn { color: #ff4757 !important; border: 1px solid #ff4757; padding: 7px 15px; border-radius: 5px; text-decoration: none; font-weight: bold; }
        .admin-btn:hover { background: #ff4757; color: #fff !important; }
        .container { max-width: 900px; margin: 40px auto; padding: 20px; }
    </style>
</head>
<body>
<nav class="nav">
    <div class="nav-links">
        <a href="index.php">Ana Sayfa</a>
        <a href="hakkimda.php">Hakkımda</a>
        <a href="iletisim.php">İletişim</a>
    </div>
    <a href="admin/" class="admin-btn">Admin Paneli</a>
</nav>