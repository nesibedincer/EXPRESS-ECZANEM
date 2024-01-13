<?php
session_start();

if ($_SESSION["tur"] == 'eczaci') {
    // Eczacı girişi yapılmışsa işlemleri gerçekleştir
    if (isset($_POST['ekle'])) {
        $x = new PDO("mysql:host=localhost;dbname=eczanem", 'root', ''); //bağlantı kodu

        $ia = $_POST['ad'];
        $fiyat = $_POST['fiyat'];
        $miktar = $_POST['miktar'];
        $bn = $_POST['barkod'];
        $f = $_POST['foto'];

        $ekleme = $x->exec("INSERT INTO `ilaclar`(`ilac_adi`, `ilac_miktari`, `ilac_barkod`, `ilac_fiyat`, `foto`) VALUES ('$ia','$miktar','$bn','$fiyat','$f')");
        if ($ekleme) {
            echo "Kayıt Başarılı";
        } else {
            echo "<br>Kayıt başarısız";
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
    <title>İlaç Ekle</title>
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

      <div class="topnav" id="myTopnav">
        <a href="eczaci_home.php" class="active">Anasayfa</a>
        <a href="eczane_siparisler.php">Siparişler</a>
    
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fas fa-user-alt  "></i>
            </button>
            <div class="dropdown-content" >
                <a href="profil.php">Profil</a>
                <a href="eczaci_guncelle_islem.php">Profili Güncelle</a>
            </div>
        </div>
    
        <div class="dropdown" >
            <button class="dropbtn" id="depyon" >
                <i class="fas fa-medkit"></i>
            </button>
            <div class="dropdown-content">
                <a href="ilac_listele.php">İlaçları Listele</a>
                <a href="ilac_ekle.php">İlaçları Ekle</a>
                <a href="ilac_guncelle.php">İlaçları Güncelle</a>
                <a href="ilac_sil.php">İlaçları Sil</a>
            </div>
        </div>
    
        <a href='ilkgiris.php'  class='cikis'><i class='fas fa-sign-out-alt'></i> </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()"> </a>
    </div>

    <section style="color:white" id="register-section">
        <div class="register-container">
            <h2>İlaç Ekle</h2>
            <form id="register-form" onsubmit="register(event)" action="" method="post">  
                <label for="ad">İlaç Barkod Numarası:</label>
                <input type="text"  name="barkod" class="girdi">

                <label for="register-user-type">İlaç Adı:</label>
                <select  name="ad"  class="secenek">
                    <option value="parol" class="secilen">Parol</option>
                    <option value="majezik" class="secilen">Majezik</option>
                    <option value="arveles" class="secilen">Arveles</option>
                    <option value="lasix" class="secilen">Lasix</option>
                    <option value="aferin" class="secilen">Aferin</option>
                    <option value="nurofen" class="secilen">Nurofen</option>
                    <option value="dolarex" class="secilen">Dolarex</option>
                    <option value="apranax" class="secilen">Apranax</option>
                    <option value="dexday" class="secilen">Dexday</option>
                </select>

                <label for="sifre">İlaç Fiyatı:</label>
                <input type="text" name="fiyat" class="girdi">

                <label for="tel">İlaç Miktarı:</label>
                <input type="text" name="miktar" class="girdi">

                <label for="email">Fotoğraf:</label>
                <input type="file" name="foto" class="girdi">

                <button type="submit" name="ekle" class="btn">İlaç Ekle </button>
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

    <script src='script.js'></script>
    <script>
        function register(event) {
            // Kayıt işlemleri burada gerçekleştirilecek
            alert('Kayıt işlemi başarıyla tamamlandı!');
            window.location.href = "ilkgiris.php"; // Kayıt işlemi tamamlandıktan sonra ilkgiris.html sayfasına yönlendir
        }
    </script>
</body>
</html>

<?php
} else {
    // Eczacı girişi yapılmamışsa ilkgiris.php'ye yönlendir
    header('location: ilkgiris.php');
}
?>
