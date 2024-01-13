<?php
session_start();

// Eğer hasta olarak giriş yapmamışsa, ilkgiris.php sayfasına yönlendir
if (!isset($_SESSION["tur"]) || $_SESSION["tur"] !== 'hasta') {
    header('Location: ilkgiris.php');
    exit();
}

if (isset($_POST["guncellee"])) {
    // Kullanıcıdan alınan yeni bilgiler
    $new_ad_soyad = isset($_POST["ad"]) ? $_POST["ad"] : '';
    $new_sifre = isset($_POST["sifre"]) ? $_POST["sifre"] : '';
    $new_tel = isset($_POST["tel"]) ? $_POST["tel"] : '';
    $new_email = isset($_POST["email"]) ? $_POST["email"] : '';
    $tc = $_SESSION["tc"];

    // Veritabanına bağlantı
    $list = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

    // Veritabanına bağlantı kontrolü
    if (!$list) {
        die("Veritabanına bağlanılamadı.");
    }

    // Güncelleme sorgusu
    $update_query = $list->prepare("UPDATE kisiler SET adi_soyadi = :new_ad_soyad, sifre = :new_sifre, tel = :new_tel, eposta = :new_email WHERE tc = :tc");
    $update_query->bindParam(":new_ad_soyad", $new_ad_soyad);
    $update_query->bindParam(":new_sifre", $new_sifre);
    $update_query->bindParam(":new_tel", $new_tel);
    $update_query->bindParam(":new_email", $new_email);
    $update_query->bindParam(":tc", $tc);

    // Güncelleme sorgusunu çalıştırma
    if ($update_query->execute()) {
        echo "Profiliniz güncellenmiştir. Yönlendiriliyorsunuz...";
        header("Refresh: 3; URL=ilkgiris.php");
    } else {
        echo "Profil güncelleme hatası!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Hasta Profil Güncelle</title>
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
    <section style="color:white" id="register-section">
        <div class="register-container">
            <h2>Profili Güncelle</h2>
            <form id="register-form" onsubmit="register(event)" action="" method="post">  
                <label for="ad">Yeni Ad Soyad:</label>
                <input type="text"  name="ad"   class="girdi">

                <label for="soyad">Yeni Şifre:</label>
                <input type="password"  name="sifre"  class="girdi">

                <label for="tel">Yeni Telefon No:</label>
                <input type="text" name="tel"   class="girdi">

                <label for="email">Yeni E-posta:</label>
                <input type="text" name="email"  class="girdi">

                <button type="submit" name="guncellee" class="btn">Güncelle</button>
            </form>
        </div>
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
