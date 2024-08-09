<?php
include 'ayar.php';

if (isset($_GET['id']) && isset($_GET['tablo'])) {
    $id = $_GET['id'];
    $tablo = $_GET['tablo'];

    // Silme işlemi
    $silme_sorgusu = $db->prepare("DELETE FROM $tablo WHERE id = ?");
    $silme_sorgusu->execute([$id]);

    if ($silme_sorgusu) {
        echo "Veri başarıyla silindi!";
    } else {
        echo "Veri silinirken bir hata oluştu.";
    }
} else {
    echo "Geçersiz istek!";
}

header("Refresh:2; url=admin.php"); 
?>
