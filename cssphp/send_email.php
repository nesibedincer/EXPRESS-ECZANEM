<!-- send_email.php -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $toEmail = "eczanem777@gmail.com";
    $subject = "Yeni İletişim Mesajı";
    
    // Formdan gelen verileri al
    $email = test_input($_POST["email"]);
    $message = test_input($_POST["message"]);
    
    // E-posta başlığı ve içeriği
    $headers = "From: " . $email . "\r\n" .
        "Reply-To: " . $email . "\r\n" .
        "X-Mailer: PHP/" . phpversion();
    
    // E-posta gönderme işlemi
    $mailSent = mail($toEmail, $subject, $message, $headers);
    
    if ($mailSent) {
        echo "Mesajınız başarıyla gönderildi!";
    } else {
        echo "Mesaj gönderilirken bir hata oluştu.";
    }
}

// Veri güvenliği için girişleri temizleme işlemi
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
