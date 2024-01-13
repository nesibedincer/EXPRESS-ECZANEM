
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Eczane Sitem - Kayıt Ol</title>
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

    <section style="color:white" id="register-section">
        <div class="register-container">
            <h2>Kayıt Ol</h2>
            <form id="register-form" onsubmit="register(event)" action="" method="post">  
                <label for="ad">Adı Soyadı:</label>
            <input type="text"  name="ad"   class="girdi">

            <label for="soyad">Şifre:</label>
            <input type="password"  name="sifre"  class="girdi">

            <label for="sifre">Tc Kimlik No:</label>
            <input type="text" name="tc"   class="girdi">

            <label for="tel">Tel:</label>
            <input type="text" name="tel"   class="girdi">

            <label for="email">E-posta:</label>
            <input type="email" name="email"  class="girdi">


                <label for="register-user-type">Kullanıcı Türü:</label>
                <select  name="tur"  class="secenek">
                    <option value="hasta" class="secilen">Hasta</option>
                    <option value="eczaci" class="secilen">Eczacı</option>
                    <option value="kurye" class="secilen">Kurye</option>
                </select>

                <button type="submit" name="kaydet" class="btn">Kayıt Ol </button>
            </form>

            <p>Zaten bir hesabınız var mı? <a href="ilkgiris.php" class="girisyap">Giriş yapın.</a></p>
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
if(isset($_POST['kaydet']))
{
    $x=new PDO("mysql:host=localhost;dbname=eczanem", 'root',''); //bağlantı kodu
    $AdSoyad=$_POST['ad'];
    $sifre=$_POST['sifre'];
    $tc=$_POST['tc'];
    $mail=$_POST['email'];
    $tur=$_POST['tur'];
    $tel=$_POST['tel'];
	$ekleme = $x->exec("INSERT INTO kisiler(adi_soyadi, sifre, tc, tel, eposta, kullanici_turu) VALUES ('$AdSoyad','$sifre','$tc','$tel','$mail','$tur')");
		  if($ekleme)
			{
				echo "Kayıt Başarılı";
			}
			else
			{
				echo "<br>Kayıt başarısız";
			}
}
?>

   