<?php
session_start();
var_dump($_SESSION);

if (isset($_POST['ver'])) {
    // Sipariş bilgilerini al
    $siparisListesi = $_POST['siparis'];
    $adetListesi = $_POST['adet'];

    // Veritabanına bağlantı
    $db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

    // Hastanın bilgilerini al
    // (Bu bilgileri örnek olarak $_SESSION'dan alıyorum, sizin uygulamanıza göre değişebilir.)
    $hastaID = $_SESSION['hasta_id'];
    $hastaAdi = $_SESSION['hasta_adi'];

    // Siparişi veritabanına ekle
    $ekleSiparis = $db->prepare("INSERT INTO siparişler (hasta_id, hasta_adi, ilac_id, adet, durum, sip_no) VALUES (:hasta_id, :hasta_adi, :ilac_id, :adet, :durum, :sip_no)");

    foreach ($siparisListesi as $ilacID) {
        $adet = $adetListesi[$ilacID];
        $durum = 'Hazırlanıyor'; // Varsayılan durumu ayarlayabilirsiniz
        $siparisNo = generateOrderTrackingNumber();

        $ekleSiparis->bindParam(':hasta_id', $hastaID);
        $ekleSiparis->bindParam(':hasta_adi', $hastaAdi);
        $ekleSiparis->bindParam(':ilac_id', $ilacID);
        $ekleSiparis->bindParam(':adet', $adet);
        $ekleSiparis->bindParam(':durum', $durum);
        $ekleSiparis->bindParam(':sip_no', $siparisNo);

        $ekleSiparis->execute();
    }

    echo "Siparişiniz alınmıştır. Sipariş Numaranız: " . $siparisNo;

    // İsterseniz başka bir sayfaya yönlendirebilirsiniz.
    // header("Location: baska_bir_sayfa.php");
} else {
    // Eğer 'ver' parametresi yoksa, hatalı bir istek olduğunu belirtin veya başka bir şey yapabilirsiniz.
    echo "Hatalı istek!";
}

function generateOrderTrackingNumber() {
    // Rastgele 11 haneli bir numara oluştur
    $numara = '';
    for ($i = 0; $i < 11; $i++) {
        $numara .= mt_rand(0, 9);
    }
    return $numara;
}
?>
