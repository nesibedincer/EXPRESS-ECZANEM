<!-- giris.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Eczane Sitem - Giriş Yap</title>
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

    <section style="color:white" id="login-section">
        <div class="login-container">
            <form id="login-form" onsubmit="login(event) action="" method="post"">  
                <label for="username">TC Kimlik No:</label>
                <input type="text"  name="tc" class="girdi" required>

                <label for="password">Şifre:</label>
                <input type="password"  name="sifre" class="girdi" required>

                

                <button type="submit" name="giris" class="btn">Giriş Yap</button>
            </form>
            <p>Hesabınız yok mu? <a href="kayitol.php" class="girisyap" >Kayıt olun.</a></p>
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
<?php
if(isset($_POST['giris']))
{
	session_start();
	$tc=$_POST['tc'];
	$sifre=$_POST['sifre'];

	
	
	$list = new PDO("mysql:host=localhost;dbname=eczanem", 'root',''); //bağlantı kodu
	$listele= $list-> query("SELECT * FROM kisiler");
	while ($row = $listele->fetch()) {
		if ($tc==$row['tc'] && $sifre==$row['sifre'] )
		{   
			$_SESSION["tc"] = $tc;
			$_SESSION["sifre"] = $sifre;
			$_SESSION["tur"]=$row['kullanici_turu'];

			if($row['kullanici_turu']=='hasta')
				header('location: hasta_home.php');
			elseif($row['kullanici_turu']=='eczaci')
				header('location: eczaci_home.php');
			elseif($row['kullanici_turu']=='kurye')
				header('location: kurye_home.php');
			
	    }
	}
}
?>