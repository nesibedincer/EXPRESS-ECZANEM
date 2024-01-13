<?php
    session_start();

    $tc = $_SESSION["tc"];
    $sifre = $_SESSION["sifre"];

    $db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

    // Profili silme işlemini gerçekleştir
    $silme_sorgu = $db->prepare("DELETE FROM kisiler WHERE tc=:tc AND sifre=:sifre");
    $silme_sorgu->bindParam(':tc', $tc);
    $silme_sorgu->bindParam(':sifre', $sifre);
    
    if ($silme_sorgu->execute()) {
        echo "Profil başarıyla silindi!";
    } else {
        echo "Profil silinirken bir hata oluştu.";
    }
?>
