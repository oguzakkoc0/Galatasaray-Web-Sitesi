<?php
include 'ayar.php';
include 'func.php';
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
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center mt-5 mb-5">
                <h1><strong>Blog Sayfası</strong></h1>

            </div>
        </div>
        <div class="row">
        <?php
            $veri = $db->prepare("SELECT * FROM yazil ORDER BY yazi_id DESC");
            $veri->execute();
            $islem = $veri->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($islem as $row) {
                echo '<div class="col-lg-4">
                    <div class="card">
                        <img src="'.$row['yazi_resim'].'" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">'.kisalt($row["yazi_baslik"],50).'</h5>
                            <p class="card-text">'.kisalt($row["yazi_aciklama"],140).'</p>
                            <a href="yazi.php?link='.$row["yazi_link"].'" class="btn btn-dark">Devamını Oku</a>
                        </div>
                    </div>
                    <div class="my-4"></div>
                </div>';
                
            }
        ?>
        </div>
    </div>
    <footer>
        <div class="container">
            <p>&copy; 2023 Son Dakika Futbol - Tüm Hakları Saklıdır.</p>
        </div>
    </footer>
</body>
</html>
