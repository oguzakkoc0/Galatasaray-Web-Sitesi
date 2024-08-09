<?php
    include 'ayar.php';
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
                <a href="" class="logo"><strong>Yönetici Paneli</strong></a>
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
                <table class="table table-dark table-striped mt-4">
                    <tr>
                        <td>
                            Başlık
                        </td>
                        <td>
                            Tarih
                        </td>
                        <td>
                            Düzenle
                        </td>
                        <td>
                            Sil
                        </td>
                    </tr>
                    <?php
                        $veri = $db->prepare("SELECT * FROM yazil ORDER BY yazi_id DESC");
                        $veri->execute();
                        $islem = $veri->fetchAll(PDO::FETCH_ASSOC);

                        foreach($islem as $row){
                            echo '<tr>
                                <td>
                                    <a href="yazi.php?link='.$row["yazi_link"].'" class="text-white" target="_blank">'.$row["yazi_baslik"].'</a>
                                </td>
                                <td>
                                    '.$row["yazi_tarih"].'
                                </td>
                                <td>
                                    <a href="duzenleblog.php?id='.$row["yazi_id"].'" class="text-white">Düzenle</a>
                                </td>
                                <td>
                                    <a href="blogsil.php?id=' . $row["yazi_id"] . '&tablo=yazil" class="text-white" onclick="return confirm(\'Bu haberi silmek istediğinize emin misiniz?\')">Sil</a>
                                </td>
                            </tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
                <table class="table table-dark table-striped mt-4">
                    <tr>
                        <td>
                            Başlık
                        </td>
                        <td>
                            Tarih
                        </td>
                        <td>
                            Düzenle
                        </td>
                        <td>
                            Sil
                        </td>
                    </tr>
                    <?php
                        $veri = $db->prepare("SELECT * FROM sondakika ORDER BY id DESC");
                        $veri->execute();
                        $islem = $veri->fetchAll(PDO::FETCH_ASSOC);

                        foreach($islem as $row){
                            echo '<tr>
                                <td>
                                    <a href="yazi.php?link='.$row["resim"].'" class="text-white" target="_blank">'.$row["baslik"].'</a>
                                </td>
                                <td>
                                    '.$row["tarih"].'
                                </td>
                                <td>
                                    <a href="haberduzenle.php?id='.$row["id"].'" class="text-white">Düzenle</a>
                                </td>
                                <td>
                                    <a href="haber_sil.php?id=' . $row["id"] . '&tablo=sondakika" class="text-white" onclick="return confirm(\'Bu haberi silmek istediğinize emin misiniz?\')">Sil</a>
                                </td>
                            </tr>';
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    
    
</body>
</html>
