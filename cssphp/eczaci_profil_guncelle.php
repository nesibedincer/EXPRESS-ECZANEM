<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Eczacı Profil Güncelle</title>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo-container">
                <img src="Untitled_logo_1_free-file (1).jpg" alt="Logo">
            </div>
            
            <div class="header-right">
                <a href="hakkimizda.html">Hakkımızda</a>
                <a href="iletisim.html">İletişim</a>
                <input type="text" placeholder="Ara...">
            </div>
        </div>
    </header>

    <nav>
        <ul>
            <li><a href="eczaci_home.php">Ana Sayfa</a></li>
            <li><a href="profil.php">Profilim</a></li>
			<li><a href="eczaci_guncelle_islem.php">Profil Güncelle</a></li>
            <li><a href="eczane_bilgileri.php">Eczane Bilgileri</a></li>
            <li><a href="siparisler.php">Siparişler</a></li>
            <li><a href="depo_yonetimi.php">Depo Yönetimi</a></li>
            <li><a href="ilkgiris.php" class="cikis">Çıkış</a></li>
        </ul>
    </nav>


   <section id="register-section">
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
        &copy; 2023 Hasta Sitem
    </footer>

    <script src="script.js"></script>
</body>
</html>
<?php
session_start();

if (!isset($_SESSION["tc"])) {
    header("Location: ilkgiris.php");
    exit();
}

if (isset($_POST["guncellee"])) {
    // Kullanıcıdan alınan yeni bilgiler
    $new_ad_soyad = $_POST["ad"];
    $new_sifre = $_POST["sifre"];
    $new_tel = $_POST["tel"];
    $new_email = $_POST["email"];
    $tc = $_SESSION["tc"];

    // Veritabanına bağlantı
    $list = new PDO("mysql:host=localhost;dbname=eczanem", 'root', '');

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

