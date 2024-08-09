<?php
    include 'ayar.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Formdan gelen verileri al
        $yazi_baslik = $_POST["yazi_baslik"];
        $yazi_resim = $_POST["yazi_resim"];
        $yazi_id = $_POST["yazi_id"];
        $yazi_aciklama = $_POST["yazi_aciklama"];

    
        // Güncelleme sorgusunu hazırla
        $updateQuery = $db->prepare("UPDATE yazil SET yazi_baslik = ?, yazi_aciklama = ?, yazi_resim = ? WHERE yazi_id = ?");
        $updateQuery->execute([$yazi_baslik, $yazi_aciklama, $yazi_resim, $yazi_id]);

    
        // Güncelleme başarılı mesajını ekle
        echo '<p class="text-success">Haber başarıyla güncellendi.</p>';
    }
    
    // Haberin mevcut bilgilerini çek
    if(isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $yazi_id = $_GET["id"];
        $selectQuery = $db->prepare("SELECT * FROM yazil WHERE yazi_id = ?");
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
    </style>
    <div style="text-align: center;">
        <form method="post" action="">
            <input type="hidden" name="yazi_id" value="<?php echo $haber['yazi_id']; ?>">
            
            <label for="yazi_baslik">Haber Başlığı:</label>
            <input type="text" name="yazi_baslik" value="<?php echo $haber['yazi_baslik']; ?>" required>

            <label for="yazi_aciklama">Haber Açıklaması:</label>
            <textarea name="yazi_aciklama" rows="8" required><?php echo $haber['yazi_aciklama']; ?></textarea>


        
            <label for="yazi_resim">Haber Resmi (URL):</label>
            <input type="text" name="yazi_resim" value="<?php echo $haber['yazi_resim']; ?>" required>
        
            <button type="submit">Güncelle</button>
        </form>
    </div>
<?php
        } else {
            // Veriyi almakta sorun varsa hata mesajı göster veya işlemi sonlandır
            echo "Veri alınamadı veya beklenmeyen bir hata oluştu.";
        }
    } else {
        // id parametresi yok veya geçersiz, hata mesajı göster veya işlemi sonlandır
        echo "Geçersiz veya eksik id parametresi.";
    }
?>
