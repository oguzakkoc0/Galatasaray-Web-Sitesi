<?php
include 'ayar.php';

// Veritabanından haberleri çek
$veri = $db->query("SELECT * FROM sondakika");
$haberler = $veri->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylee.css" />    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Borel&family=Merriweather:ital,wght@1,300&family=Poppins:wght@300;400;600;700&family=Titillium+Web:wght@400;700&display=swap" rel="stylesheet">
    <title>Anasayfa | Son Dakika Futbol</title>
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.css">
    <link rel="stylesheet" href="cssblog/normalize.css">
    <link rel="stylesheet" href="cssblog/all.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-grid.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="cssblog/style.css">
    <style>
    /* CSS Stili */
    .aciklama {
        color: white;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 100%; 
        text-decoration:none;
    }
</style>
</head>
<body>
    <header class="menub">
        <nav>
            <div class="logo">
                <a href="#"><img src="img/gslogo.png" alt="Logo"></a>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Anasayfa</a></li>
                    <li><a href="stadyum.php">Stadyum</a></li>
                    <li><a href="kadro.php">Kadro</a></li>
                    <li><a href="mars.php">Marşlar</a></li>
                    <li><a href="blog.php">Blog</a></li>
                </ul>
                <a href="login.php" class="menu-button">Giriş Yap</a>
            </div>
        </nav>
    </header>

    <section id="sondakika">
        <div class="container">
            <h3 style="font-size:35px">Son Dakika Haberleri <br> <br></h3>
            <div class="owl-carousel owl-theme">
                <img src="img/3.jpeg" alt="" srcset="">
                <img src="img/2.jpeg" alt="" srcset="">
                <img src="img/8.jpeg" alt="" srcset="">
                <img src="img/4.jpeg" alt="" srcset="">
                <img src="img/5.jpeg" alt="" srcset="">
                <img src="img/6.jpeg" alt="" srcset="">
                <img src="img/7.jpg" alt="" srcset="">
            </div>

            <section class="haber-kartlari">
                <?php foreach ($haberler as $haber): ?>
                    <div class="haber-karti">
                        <a href="haber_detay.php?id=<?php echo $haber['id']; ?>">
                            <img src="<?php echo $haber['resim']; ?>" alt="<?php echo $haber['baslik']; ?>">
                            <h5><?php echo $haber['baslik']; ?></h5>
                        </a>
                        <p class="aciklama"><?php echo substr($haber['aciklama'], 0, 100); ?>...</p>
                    </div>
                <?php endforeach; ?>
            </section>
</div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2023 Son Dakika Futbol - Tüm Hakları Saklıdır.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
            integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8="
            crossorigin="anonymous"></script>
    <script src="owl/owl.carousel.min.js"></script>
    <script src="owl/script.js"></script>
</body>
</html>
