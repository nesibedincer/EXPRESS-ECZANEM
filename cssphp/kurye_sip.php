<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Eczacı Siparişler</title>
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
        <a href='kurye_home.php' class='active'>Anasayfa</a>
        <a href='kurye_sip.php'>Sipariş Bildirim</a>
        <a href='ilkgiris.php'  class='cikis'><i class='fas fa-sign-out-alt'></i> </a>
        <div class='dropdown'>
            <button class='dropbtn'>
                <i class='fas fa-user-alt'></i>
            </button>
            <div class='dropdown-content'>
                <a href='kurye_profil.php'>Profil</a>
                <a href='kurye_guncelle_islem.php'>Profili Güncelle</a>
            </div>
        </div>
        <a href='ilkgiris.php'  class='cikis'><i class='fas fa-sign-out-alt'></i> </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()"> </a>
    </div>

    <section style="color:white" id="login-section">
        <?php
		 session_start();
			// Hasta olarak giriş yapmamışsa ilkgiris.php sayfasına yönlendir
if (!isset($_SESSION["tur"]) || $_SESSION["tur"] !== 'kurye') {
    header('Location: ilkgiris.php');
    exit();
}
        // Veritabanı bağlantısı
        $db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

        // Sipariş durumu "onaylandi", "yolda", "teslim_edildi" olanları çek
        $query = $db->prepare("SELECT * FROM siparisler WHERE sip_durum IN ('onaylandi', 'yolda', 'teslim_alindi')");
        $query->execute();
        $siparisler = $query->fetchAll(PDO::FETCH_ASSOC);

        // Siparişler var mı kontrol et
        if ($siparisler) {
            // Siparişlerin bilgilerini ekrana yazdır
            foreach ($siparisler as $siparis) {
                echo "<div class='order-container'>";
                echo "<div class='order-info'>";
                echo "<strong>Sipariş Numarası:</strong> " . $siparis['sip_no'] . "<br>";

                // "ad_soyad" anahtarını kontrol et
                if (isset($siparis['ad_soyad'])) {
                    echo "<strong>Ad Soyad:</strong> " . $siparis['ad_soyad'] . "<br>";
                } else {
                    echo "<strong>Ad Soyad:</strong> Bilgi Yok<br>";
                }

                echo "<strong>Adres:</strong> " . $siparis['adres'] . "<br>";
                echo "<strong>Ödeme Yöntemi:</strong> " . $siparis['odeme'] . "<br>";
                echo "<strong>Toplam Tutar:</strong> " . $siparis['tutar'] . " TL<br>";
                echo "</div>";
                echo "<div class='order-actions'>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='orderId' value='" . $siparis['sip_no'] . "'>";
                echo "<button type='submit' name='status' value='teslim_alindi'>Teslim Aldım</button>";
                echo "<button type='submit' name='status' value='yolda'>Yolda</button>";
                echo "<button type='submit' name='status' value='teslim_edildi'>Teslim Edildi</button>";
                echo "</form>";
                echo "</div>";
                echo "</div>";
                echo "<hr>";
            }
        } else {
            echo "<p>Sipariş bulunmamaktadır.</p>";
        }

        // POST isteği kontrolü
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Formdan gelen veriler
            $orderId = $_POST['orderId'];
            $newStatus = $_POST['status'];

            // Sipariş durumu güncelleme sorgusu
            $query = $db->prepare("UPDATE siparisler SET sip_durum = :newStatus WHERE sip_no = :orderId");
            $query->bindParam(":newStatus", $newStatus, PDO::PARAM_STR);
            $query->bindParam(":orderId", $orderId, PDO::PARAM_INT);

            // Sorguyu çalıştır ve durumu güncelle
            if ($query->execute()) {
                echo "Sipariş durumu güncellendi.";
            } else {
                echo "Sipariş durumu güncelleme hatası.";
            }
        }
        ?>
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
    <script src="script.js"></script>
</body>
</html>
