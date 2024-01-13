<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Eczaci Home - Eczane Bilgileri Güncelleme</title>
</head>
<body>
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

    <nav>
        <ul>
            <li><a href="eczaci_home.php">Ana Sayfa</a></li>
            <li><a href="profil.php">Profilim</a></li>
			
            <li><a href="eczane_bilgileri.php">Eczane Bilgileri</a></li>
            <li><a href="siparisler.php">Siparişler</a></li>
            <li><a href="depo_yonetimi.php">Depo Yönetimi</a></li>
            <li><a href="ilkgiris.php" class="cikis">Çıkış</a></li>
        </ul>
    </nav>
    

    <section>
        <h2>Eczane Bilgileri</h2>
        <form id="eczane-guncelleme-form" onsubmit="updatePharmacyInfo(event)">
            <label for="il">İl:</label>
            <input type="text" id="il" name="il" required class="girdi">

            <label for="ilce">İlçe:</label>
            <input type="text" id="ilce" name="ilce" required class="girdi">

            <label for="mahalle">Mahalle:</label>
            <input type="text" id="mahalle" name="mahalle" required class="girdi">

            <label for="nobetcitarih">Nöbetçi Tarih:</label>
            <input type="text" id="nobetcitarih" name="nobetcitarih" placeholder="Örneğin: Pazartesi-Aralık" required class="girdi">

            <button type="submit" class="btn">Güncelle</button>
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

    <script src="script.js"></script>
</body>
</html>
