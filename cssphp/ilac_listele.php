<?php
// Oturum kontrolü
session_start();
if (!isset($_SESSION["tur"]) || $_SESSION["tur"] !== 'eczaci') {
    header('Location: ilkgiris.php');
    exit();
}

// Veritabanı bağlantısı
$db = new PDO("mysql:host=localhost;dbname=eczanem", 'root', ''); 

// İlaçları getiren sorgu
$ilaclar = $db->query("SELECT * FROM ilaclar")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>İlaç Listeleme</title>
</head>
<body style="background-image: url('arkaplan.jpg'); background-size:
cover; background-position: center; background-repeat: no-repeat;">
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

    <section style="color:white" id='list-section'>
        <div class='list-container'>
            <h2>İlaç Listesi</h2>
            <table>
                <thead>
                    <tr>
                        <th>Barkod No</th>
                        <th>İlaç Adı</th>
                        <th>Miktar</th>
                        <th>Fiyat</th>
                        <th>Fotoğraf</th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach ($ilaclar as $ilac) : ?>
    <tr>
        <td><?php echo $ilac['ilac_barkod']; ?></td>
        <td><?php echo $ilac['ilac_adi']; ?></td>
        <td><?php echo $ilac['ilac_miktari']; ?></td>
        <td><?php echo $ilac['ilac_fiyat']; ?></td>
        <td><img src="<?php echo $ilac['foto']; ?>" width='150' height='150' alt="İlaç Fotoğrafı"></td>
    </tr>
<?php endforeach; ?>
                </tbody>
            </table>
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
