<?php
include 'ayar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Formdan gelen verileri al
   $oyuncuAdi = isset($_POST['oyuncuadi']) ? $_POST['oyuncuadi'] : null;
   $oyuncuResim = isset($_POST['oyuncuresmi']) ? $_POST['oyuncuresmi'] : null;

   if ($oyuncuAdi !== null) {
       try {
           // Veritabanına ekleme işlemi
           $veri = $db->prepare("INSERT INTO oyuncular (oyuncuadi, oyuncuresmi) VALUES (?, ?)");
           $veri->execute([$oyuncuAdi, $oyuncuResim]);

           echo "Oyuncu başarıyla kaydedildi.";
           echo "<script>
                    setTimeout(function() {
                        window.location.href = 'kadro.php';
                    }, 2000);
                </script>";
       } catch (PDOException $e) {
           echo "Hata: " . $e->getMessage();
       }
   } else {
       echo "Hata: Oyuncu adı boş olamaz.";
   }
}
?>
