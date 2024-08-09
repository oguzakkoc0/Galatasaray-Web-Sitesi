<?php
include 'ayar.php';
include 'func.php';

session_start();
if(isset($_SESSION["kullaniciadi"])){
    $kullaniciAdi = $_SESSION["kullaniciadi"];
}
else{
    echo "Bu sayfayı görüntüleme yetkiniz yoktur";
    header("Location: index.php"); 
    exit();
}
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
            <?php
            if (isset($kullaniciAdi)) {
                echo '<button id="cikis-btn" onclick="cikisYap() ">Çıkış Yap</button>';
            } else {
                echo '<a href="login.php" class="menu-button">Giriş Yap</a>';
            }
            ?>
        </div>
    </nav>
</header>
<div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
                <?php

                    if ($_POST) {
                        $baslik     = htmlspecialchars($_POST["baslik"]);
                        $aciklama   = htmlspecialchars($_POST["aciklama"]);
                        $resim      = htmlspecialchars($_POST["resim"]);
                        $link       = permalink($baslik);

                        // Boşluk Kontrolü
                        if (empty($baslik) || empty($aciklama) || empty($resim)) {
                            // Eğer Boşsa
                            echo '<p class="alert alert-warning">Lütfen boş bırakmayınız!</p>';
                        } else {
                            // Eğer Boş Değilse!

                            // Veri ekleme
                            $veriekle = $db->prepare("INSERT INTO yazil SET yazi_baslik=?, yazi_aciklama=?, yazi_link=?, yazi_resim=?");
                            $veriekle ->execute([
                                $baslik,
                                $aciklama,
                                $link,
                                $resim
                            ]);

                            if ($veriekle) {
                                // Başarıyla veri eklendiyse
                                echo '<p class="alert alert-success">Başarıyla eklendi! :)</p>';
                                header("REFRESH:2;URL=profile.php");
                            } else {
                                // Veri ekleme başarısızsa
                                echo '<p class="alert alert-danger">Başarısız, eklenemedi! :(</p>';
                                header("REFRESH:2;URL=profile.php");
                            }
                            
                        }
                        
                    }
                
                ?>
                <form action="" method="post">
                    <strong>Başlık:</strong>
                    <input type="text" name="baslik" class="form-control">
                    <strong>Açıklama/Yazı:</strong>
                    <textarea name="aciklama" cols="30" rows="10" class="form-control"></textarea>
                    <strong>Resim Linki:</strong>
                    <input type="text" name="resim" class="form-control">
                    <br />
                    <input type="submit" value="Yayınla/Paylaş" class="btn btn-dark">
                </form>
            </div>
        </div>
    </div>
<footer>
    <div class="container">
        <p>&copy; 2023 Son Dakika Futbol - Tüm Hakları Saklıdır.</p>
    </div>
</footer>
<script>
    function cikisYap() {
        window.location.href = "cikis.php"; 
    }

    <?php
    if (isset($kullaniciAdi)) {
        echo 'document.getElementById("cikis-btn").style.display = "block";';
    }
    ?>
</script>
</body>
</html>
