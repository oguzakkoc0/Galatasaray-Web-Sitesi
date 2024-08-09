<?php
    include 'ayar.php';
    include 'func.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Sayfası</title>
    <link rel="stylesheet" href="cssblog/normalize.css">
    <link rel="stylesheet" href="cssblog/all.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-grid.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="cssblog/style.css">
</head>
<body>

    <header class="container">
        <div class="row">
            <div class="col-lg-6">
                <a href="" class="logo"><strong>Yazı Ekle</strong></a>
            </div>
            <div class="col-lg-6 text-right">
                <a href="index.php" class="menu">Siteyi Görüntüle</a>
                <a href="admin.php" class="menu">Admin Ana Sayfa</a>
                <a href="yaziekle.php" class="menu">Yazı Ekle</a>
                <a href="haber_ekle.php" class="menu">Haber Ekle</a>
            </div>
        </div>
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
                                header("REFRESH:2;URL=yaziekle.php");
                            } else {
                                // Veri ekleme başarısızsa
                                echo '<p class="alert alert-danger">Başarısız, eklenemedi! :(</p>';
                                header("REFRESH:2;URL=yaziekle.php");
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
    
</body>
</html>