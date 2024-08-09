<?php
    include 'ayar.php';
    include 'func.php';

    $link = @$_GET["link"]; // ?link= burayı çekeceğiz

    $data = $db->prepare("SELECT * FROM yazil WHERE yazi_link=?");
    $data ->execute([
        $link
    ]);
    $_data = $data->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_data["yazi_baslik"]; ?></title>
    <link rel="stylesheet" href="cssblog/normalize.css">
    <link rel="stylesheet" href="cssblog/all.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-grid.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="cssblog/style.css">
    <style>
        img{
            border-radius:5px
        }
    </style>
</head>
<body>

    <header class="container">
        <div class="row">
            <div class="col-lg-6">
                <a href="index.php" class="logo"><strong>Galatasaray Blog</strong></a>
            </div>
            <div class="col-lg-6 text-right">
                <a href="index.php" class="menu">Anasayfa</a>
                <a href="blog.php" class="menu">Blog</a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-5 mb-5">
                <center><img src="<?=$_data["yazi_resim"]?>" width="auto"></center><br>
                <a href="yazi.php?link=<?php echo $link; ?>" class="link"><h1 class="text-center"><strong><?php echo $_data["yazi_baslik"]; ?></strong></h1></a><br>
                <p><?php echo $_data["yazi_aciklama"]; ?></p>
                <strong>Tarih:</strong> <?php echo $_data["yazi_tarih"]; ?>
            </div>
        </div>
    </div>
    
</body>
</html>