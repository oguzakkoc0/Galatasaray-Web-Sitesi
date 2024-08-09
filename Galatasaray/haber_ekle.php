<?php
include 'ayar.php';

if (isset($_POST['haber_ekle'])) {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $resim = $_POST['resim'];

    $ekleme_sorgusu = $db->prepare("INSERT INTO sondakika (baslik, aciklama, resim) VALUES (?, ?, ?)");
    $ekleme_sorgusu->execute([$baslik, $aciklama, $resim]);

    if ($ekleme_sorgusu) {
        echo "Haber başarıyla eklendi!";
        header("Refresh:2; url=admin.php"); 
    } else {
        echo "Haber eklenirken bir hata oluştu.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haber Ekle</title>
    <link rel="stylesheet" href="cssblog/normalize.css">
    <link rel="stylesheet" href="cssblog/all.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-grid.min.css">
    <link rel="stylesheet" href="cssblog/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="cssblog/style.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.haber-ekle-formu {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.haber-ekle-formu h4 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 8px;
    color: #555;
}

input, textarea {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button {
    background-color: #4caf50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

    </style>
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

<div class="haber-ekle-formu">
    <h4>Haber Ekle</h4>
    <form action="haber_ekle.php" method="post">
        <label for="baslik">Başlık:</label>
        <input type="text" id="baslik" name="baslik" required>

        <label for="aciklama">Açıklama:</label>
        <textarea id="aciklama" name="aciklama" required></textarea>

        <label for="resim">Resim URL:</label>
        <input type="text" id="resim" name="resim" required>

        <button type="submit" name="haber_ekle">Haber Ekle</button>
    </form>
</div>

</body>
</html>