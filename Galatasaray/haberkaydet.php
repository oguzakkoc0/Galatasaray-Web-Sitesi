<?php
include 'ayar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Formdan gelen verileri al
   $resim = isset($_POST['resim']) ? $_POST['resim'] : null;
   $baslik = isset($_POST['baslik']) ? $_POST['baslik'] : null;

   if ($resimm !== null) {
       try {
           // Veritabanına ekleme işlemi
           $veri = $db->prepare("INSERT INTO sondakika (resim, baslik) VALUES (?, ?)");
           $veri->execute([$resim, $baslik]);

           echo "Haber başarıyla kaydedildi.";
           echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 2000);
                </script>";
       } catch (PDOException $e) {
           echo "Hata: " . $e->getMessage();
       }
   } else {
       echo "Hata: Haber boş olamaz.";
   }
}
?>
