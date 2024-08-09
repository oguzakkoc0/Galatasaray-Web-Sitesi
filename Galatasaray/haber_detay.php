<?php
include 'ayar.php';

// Haber ID'sini al
$haberId = $_GET['id'];

// Veritabanından haber detayını çek
$veri = $db->prepare("SELECT * FROM sondakika WHERE id = ?");
$veri->execute([$haberId]);
$haberDetay = $veri->fetch(PDO::FETCH_ASSOC);
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
    <title><?php echo $haberDetay['baslik']; ?> | Son Dakika Futbol</title>
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.css">
    <style>
        h1 {
            text-align: center;
            margin: 5px;
            color: white; 
        }

        .container {
            text-align: center; 
        }

        .container img {
            max-width: 100%; 
            height: auto;    
            border-radius: 10px;
        }
        .aciklama{
            text-align: center; 
            white-space: pre-line;
            color: white;
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

    <section id="haber-detay">
        <div class="container">
            <h1><?php echo $haberDetay['baslik']; ?></h1><br>
            <img src="<?php echo $haberDetay['resim']; ?>" alt="<?php echo $haberDetay['baslik']; ?>"><br><br>
            <p style="text-align:center;"><?php echo $haberDetay['aciklama']; ?></p>
        </div>
    </section>
    <br><br><br><br><br><br><br><br><br><br>
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
