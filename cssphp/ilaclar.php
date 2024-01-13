<?php
session_start();
if (!isset($_SESSION["tur"]) || $_SESSION["tur"] !== 'hasta') {
    header('Location: ilkgiris.php');
    exit();
}

// Veritabanı bağlantısı
$db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

// İlaçları getiren sorgu
$ilaclar = $db->query("SELECT * FROM ilaclar")->fetchAll(PDO::FETCH_ASSOC);

// Rastgele 11 haneli bir numara oluşturan fonksiyon
function generateOrderTrackingNumber() {
    $numara = '';
    for ($i = 0; $i < 11; $i++) {
        $numara .= mt_rand(0, 9);
    }
    return $numara;
}

// Sipariş verildiğinde çalışacak kod
if (isset($_POST['ver'])) {
    // Seçilen ilaçları ve adetleri al
    $siparisListesi = isset($_POST['siparis']) ? $_POST['siparis'] : array();

    // Rastgele sipariş numarası oluştur
    $siparisNumarasi = generateOrderTrackingNumber();

    // Toplam tutarı tutmak için bir değişken oluştur
    $toplamTutar = 0;

    // Sipariş bilgilerini veritabanına ekle
    foreach ($ilaclar as $ilacID => $ilac) {
        $ilacAdi = $ilac['ilac_adi'];

        // Adet değerini kontrol et
        $adetKey = 'adet_' . $ilac['ilac_id'];
        if (isset($_POST[$adetKey])) {
            $sipAdet = $_POST[$adetKey];
        } else {
            // Hata durumunu yönetebilirsiniz, şu an 1 olarak varsayıyorum.
            $sipAdet = 1;
        }

        // İlaç fiyatını al (ilac_fiyat olarak değiştirdim)
        $ilacFiyat = $ilac['ilac_fiyat'];

        // Toplam tutarı güncelle
        $toplamTutar += ($sipAdet * $ilacFiyat);

        // Siparişi veritabanına ekle
        $query = $db->prepare("INSERT INTO siparisler (sip_no, ilac, sip_aded, tutar) VALUES (:sip_no, :ilac, :sip_aded, :tutar)");
        $query->bindValue(':sip_no', $siparisNumarasi);
        $query->bindValue(':ilac', $ilacAdi);
        $query->bindValue(':sip_aded', $sipAdet);
        $query->bindValue(':tutar', ($sipAdet * $ilacFiyat));
        $query->execute();
    }

    // Ekrana sipariş numarasını ve borcu yazdır
    echo "Sipariş Numarası: " . $siparisNumarasi;
    echo "<br>Borcunuz: " . $toplamTutar . " TL";
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>İlaçlar</title>
</head>
<body style="background-image: url('arkaplan.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="Untitled_logo_1_free-file (1).jpg" alt="Logo">
            </div>
           
            <div class="header-right">
                <input type="text" placeholder="Ara...">
            </div>
        </div>
    </header>

    <div class='topnav' id='myTopnav'>
        <a href='hasta_home.php' class='active'>Anasayfa</a>
        <a href='hasta_ilacsip.php'>Sipariş Ver</a>
        <a href='hasta_siptakip.php'>Sipariş Durumu</a>
        <a href='ilaclar.php'>İlaçlar</a>
        <a href='ilkgiris.php'  class='cikis'><i class='fas fa-sign-out-alt'></i> </a>
        <div class='dropdown'>
            <button class='dropbtn'>
                <i class='fas fa-user-alt'></i>
            </button>
            <div class='dropdown-content'>
                <a href='hasta_profil.php'>Profil</a>
                <a href='hasta_guncelle_islem.php'>Profili Güncelle</a>
            </div>
        </div>
        <a href='javascript:void(0);' class='icon' onclick='myFunction()'>&#9776;</a>
    </div>

    <section id="order-form-section">
        <h2>İlaç Sipariş Formu</h2>
        <form method="post" action="">
            <div class="order-form-container">
                <?php foreach ($ilaclar as $ilacID => $ilac) : ?>
                    <div class="order-item">
                        <div class="item-info">
                            <p><strong>Barkod No:</strong> <?php echo $ilac['ilac_barkod']; ?></p>
                            <p><strong>İlaç Adı:</strong> <?php echo $ilac['ilac_adi']; ?></p>
                        </div>
                        <div class="item-quantity">
                            <label for="adet_<?php echo $ilac['ilac_id']; ?>">Adet:</label>
                            <input type="radio" name="adet_<?php echo $ilac['ilac_id']; ?>" id="adet_<?php echo $ilac['ilac_id']; ?>_1" value="1" checked>
                            <label for="adet_<?php echo $ilac['ilac_id']; ?>_1">1</label>
                            <input type="radio" name="adet_<?php echo $ilac['ilac_id']; ?>" id="adet_<?php echo $ilac['ilac_id']; ?>_2" value="2">
                            <label for="adet_<?php echo $ilac['ilac_id']; ?>_2">2</label>
                            <input type="radio" name="adet_<?php echo $ilac['ilac_id']; ?>" id="adet_<?php echo $ilac['ilac_id']; ?>_3" value="3">
                            <label for="adet_<?php echo $ilac['ilac_id']; ?>_3">3</label>
                        </div>
                        <div class="item-price">
                            <?php echo "<strong>Fiyat: " . $ilac['ilac_fiyat'] . " TL</strong>"; ?>
                        </div>
                        <div class="item-order">
                            <label for="siparis_<?php echo $ilac['ilac_id']; ?>">Sipariş:</label>
                            <input type="checkbox" name="siparis[]" id="siparis_<?php echo $ilac['ilac_id']; ?>" value="<?php echo $ilacID; ?>">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <br>
            <button type="submit" name="ver">Sipariş Ver</button>
        </form>
    </section>

    <footer>
        <div class="content-box">
            <h3>Hakkımızda</h3>
            <p><a href="hakkimizda.html">Daha fazla bilgi için tıklayınız.</a></p>
        </div>
        <div class="content-box">
            <h3>İletişim Bilgileri</h3>
            <p>Telefon: +90 123 456 7890</p>
            <p>E-posta: info@sirketiniz.com</p>
        </div>
        <div class="content-box">
            <h3>Sosyal Medya</h3>
            <p>
                Takip edin:
                <a href="https://www.facebook.com/sirketiniz" target="_blank">Facebook</a>,
                <a href="https://twitter.com/sirketiniz" target="_blank">Twitter</a>,
                <a href="https://www.instagram.com/sirketiniz" target="_blank">Instagram</a>
            </p>
        </div>
        <div class="content-box">
            <h3>İletişim</h3>
            <p>Şirketimize gelin!</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3040.6976335829536!2d27.952470677268835!3d40.3490530597536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14b5d36c674be217%3A0x19f628c15549067c!2sBand%C4%B1rma%20Onyedi%20Eyl%C3%BCl%20%C3%9Cniversitesi%20Band%C4%B1rma%20Meslek%20Y%C3%BCksekokulu!5e0!3m2!1str!2str!4v1704853947396!5m2!1str!2str" width="180" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </footer>

    <script src='script.js'></script>
</body>
</html>
