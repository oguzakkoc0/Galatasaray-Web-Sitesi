<?php
    include 'ayar.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri al
        $haberId = $_POST['id'];
        $baslik = $_POST['baslik'];
        $aciklama = $_POST['aciklama'];
        $resim = $_POST['resim'];

        // Güncelleme sorgusunu hazırla
        $guncelle = $db->prepare("UPDATE sondakika SET baslik = ?, aciklama = ?, resim = ? WHERE id = ?");
        $guncelle->execute([$baslik, $aciklama, $resim, $haberId]);

        // Güncelleme başarılı mesajını ekle
        echo '<p class="text-success">Haber başarıyla güncellendi.</p>';
    }

    // Haberin mevcut bilgilerini çek
    if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $yazi_id = $_GET["id"];
        $selectQuery = $db->prepare("SELECT * FROM sondakika WHERE id = ?");
        $selectQuery->execute([$yazi_id]);
        $haber = $selectQuery->fetch(PDO::FETCH_ASSOC);

        // Veri alındıysa ve bir dizi ise devam et
        if ($haber && is_array($haber)) {
?>
            <style>
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .aciklama {
            color: white;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <div style="text-align: center;">
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $haber['id']; ?>">
            
            <label for="baslik">Haber Başlığı:</label>
            <input type="text" name="baslik" value="<?php echo $haber['baslik']; ?>" required>

            <label for="aciklama">Haber Açıklaması:</label>
            <textarea name="aciklama" rows="8" required><?php echo $haber['aciklama']; ?></textarea>

            <label for="resim">Haber Resmi (URL):</label>
            <input type="text" name="resim" value="<?php echo $haber['resim']; ?>" required>
        
            <button type="submit">Güncelle</button>
        </form>
    </div>
<?php
        } else {
            // Veriyi almakta sorun varsa hata mesajı göster veya işlemi sonlandır
            echo "Veri alınamadı veya beklenmeyen bir hata oluştu.";
        }
    } else {
        // id parametresi yok veya geçersiz hata mesajı göster veya işlemi sonlandır
        echo "Geçersiz veya eksik id parametresi.";
    }
?>
