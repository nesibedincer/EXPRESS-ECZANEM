var suankiSlayt = 0;
var otomatikKaydirma;

function slaytGoster(index) {
  var slaytlar = document.getElementsByClassName("slayt");

  // Tüm slaytları gizle
  for (var i = 0; i < slaytlar.length; i++) {
    slaytlar[i].style.display = "none";
  }

  // Belirli slaytı göster
  slaytlar[index].style.display = "block";
}

function otomatikSlaytKaydir() {
  sonrakiSlayt();
}

function baslatOtomatikKaydirma() {
  otomatikKaydirma = setInterval(otomatikSlaytKaydir, 5000); // Her 5 saniyede bir geçiş yap
}

function durdurOtomatikKaydirma() {
  clearInterval(otomatikKaydirma);
}

function oncekiSlayt() {
  suankiSlayt--;
  if (suankiSlayt < 0) {
    suankiSlayt = document.getElementsByClassName("slayt").length - 1;
  }
  slaytGoster(suankiSlayt);
}

function sonrakiSlayt() {
  suankiSlayt++;
  if (suankiSlayt >= document.getElementsByClassName("slayt").length) {
    suankiSlayt = 0;
  }
  slaytGoster(suankiSlayt);
}

// İlk slaytı göster
slaytGoster(suankiSlayt);

// Otomatik kaydırma başlat
baslatOtomatikKaydirma();

// Mouse butonu basılı olduğunda otomatik kaydırmayı durdur
document.getElementById("slider").addEventListener("mousedown", function() {
  durdurOtomatikKaydirma();
});

// Mouse butonu bırakıldığında otomatik kaydırmayı tekrar başlat
document.getElementById("slider").addEventListener("mouseup", function() {
  baslatOtomatikKaydirma();
});


// Sepete ürün ekleme fonksiyonu

function addToCart(productId) {
    // Sepet işlemleri burada yapılacak
    alert("Ürün sepete eklendi!");
}
function login(event) {
    event.preventDefault(); // Formun otomatik submit işlemini engelle

    // Kullanıcı girişi kontrolü burada yapılabilir
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var userType = document.getElementById("user-type").value;

    // Örnek: Kullanıcı türüne göre farklı işlemler
    switch (userType) {
        case "hasta":
            
            // Hasta ile ilgili işlemler burada yapılabilir

            // Hasta kullanıcı adı girildiyse, belirlediğiniz sayfaya yönlendir
            window.location.href = "hasta_home.html";
            break;
        case "eczaci":
           
            window.location.href = "eczaci_home.html";
            // Eczacı ile ilgili işlemler burada yapılabilir
            break;
        case "kurye":
            
            window.location.href = "kurye_home.html";
            // Kurye ile ilgili işlemler burada yapılabilir
            break;
        default:
            alert("Bilinmeyen kullanıcı türü!");
            break;
    }
}

function uploadFile() {
    var fileInput = document.getElementById('dosya-yukle');
    var file = fileInput.files[0];

    if (file) {
        // Dosya yükleme işlemleri burada gerçekleştirilecek
        alert('Dosya yüklendi: ' + file.name);
    } else {
        alert('Lütfen bir dosya seçin.');
    }
}

// Çıkış işlemi için JavaScript kodları
function logout() {
    // Oturumu kapatma işlemleri buraya eklenir
    // Örneğin: localStorage.clear(); // Bu sadece basit bir örnektir, gerçek uygulama senaryosuna uyarlanmalıdır

    // Kullanıcıyı giriş sayfasına yönlendir
    window.location.href = "ilkgiris.html";
}
// Kullanıcı bilgilerini saklamak için basit bir nesne
let userProfile = {
    ad: "",
    soyad: "",
    tel: "",
    email: "",
    adres: "",
    kullaniciAdi: "",
    sifre: ""
};

// Profil bilgilerini güncelleme fonksiyonu
function updateProfile(event) {
    event.preventDefault(); // Formun varsayılan davranışını engelle

    // Formdaki bilgileri al
    userProfile.ad = document.getElementById('ad').value;
    userProfile.soyad = document.getElementById('soyad').value;
    userProfile.tel = document.getElementById('tel').value;
    userProfile.email = document.getElementById('email').value;
    userProfile.adres = document.getElementById('adres').value;
    userProfile.kullaniciAdi = document.getElementById('kullanici-adi').value;
    userProfile.sifre = document.getElementById('sifre').value;

    // Konsola bilgileri yazdır (Bu kısmı gerçek bir sunucu ile güncelleme işlemi yapacak şekilde değiştirebilirsiniz.)
    console.log("Profil bilgileri güncellendi:", userProfile);
}
function editProfile() {
    document.getElementById('kullanici-adi').readOnly = false;
    document.getElementById('sifre').readOnly = false;
    document.getElementById('kaydet-btn').style.display = 'inline-block';
}

function updateProfile(event) {
    event.preventDefault();

    // Profil bilgilerini güncelleme işlemleri burada yapılabilir.
    // Örneğin, bir API'ye güncelleme isteği gönderilebilir.

    // Düzenleme modunu kapat
    document.getElementById('kullanici-adi').readOnly = true;
    document.getElementById('sifre').readOnly = true;
    document.getElementById('kaydet-btn').style.display = 'none';

    alert('Profil bilgileri güncellendi!');
}
// script.js

// Örnek bildirim verileri
var bildirimler = [
    { id: 1, mesaj: "Yeni sipariş alındı: #1234" },
    { id: 2, mesaj: "Yeni sipariş alındı: #5678" }
];

// Sayfa yüklendiğinde bildirimleri göster
window.onload = function() {
    showNotifications();
};

function showNotifications() {
    var bildirimListesi = document.getElementById('bildirim-listesi');

    // Bildirimleri listeye ekle
    bildirimler.forEach(function(bildirim) {
        var li = document.createElement('li');
        li.textContent = bildirim.mesaj;
        bildirimListesi.appendChild(li);
    });
}
// script.js

function processPayment(event) {
    event.preventDefault();

    // Burada gerçek bir ödeme geçidi entegrasyonu yapılabilir.
    // Kredi kartı bilgileri ve diğer hassas bilgiler sunucuya gönderilmelidir.

    // Simülasyon: Gerçek bir ödeme işlemi gerçekleştirilmiş gibi kabul ediyoruz.
    // Bu kısımda gerçek bir ödeme geçidi entegrasyonu yapılmalıdır.

    // Ödeme başarıyla gerçekleştiğini varsayalım.
    alert('Ödeme işlemi başarıyla tamamlandı!');

    // Yüklenen bakiye miktarını al
    var yuklenecekMiktar = parseFloat(document.getElementById('bakiye-miktar').value);

    // Mevcut bakiyeyi al
    var mevcutBakiye = parseFloat(document.getElementById('mevcut-bakiye').innerText);

    // Yeni bakiyeyi hesapla
    var yeniBakiye = mevcutBakiye + yuklenecekMiktar;

    // Yeni bakiyeyi göster
    document.getElementById('mevcut-bakiye').innerText = yeniBakiye.toFixed(2);

    // Bakiye yükleme işlemi gerçekleştirildiğine dair mesaj
    alert('Bakiye yükleme işlemi başarıyla tamamlandı!');
}

