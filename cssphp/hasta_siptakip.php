<?php
// Veritabanı bağlantısı
$db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', ''); 

// Hasta olarak giriş yapmamışsa ilkgiris.php sayfasına yönlendir
session_start();
if (!isset($_SESSION["tur"]) || $_SESSION["tur"] !== 'hasta') {
    header('Location: ilkgiris.php');
    exit();
}

// Sipariş numarasını al
$siparisNo = isset($_POST['sip_no']) ? $_POST['sip_no'] : '';

// Eğer sipariş numarası post edildiyse, detay sayfasına yönlendir
if(isset($_POST['submit'])){
    header("Location: hasta_siptakip_detay.php?sip_no=$siparisNo");
    exit();
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Sipariş Detayı</title>
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
        <a href='ilkgiris.php'  class='cikis'><i class='fas fa-sign-out-alt'></i> </a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()"> </a>
    </div>

    <section style="color:white" id='list-section'>
        <div class='list-container'>
            <h2>Sipariş Detayı</h2>
            <form method="post" action="">
                <label for="sip_no">Sipariş Numarası:</label>
                <input type="text" id="sip_no" name="sip_no" required>
                <button type="submit" name="submit">Detayları Göster</button>
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
</body>
</html>
