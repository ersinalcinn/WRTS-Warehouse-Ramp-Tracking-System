<?php

$sifre = "";
for ($i = 0; $i < 8; $i++) {
    $sec = rand(1, 3);

    if ($sec == 1) $sifre .= chr(rand(65, 90)); //A-Z
    elseif ($sec == 2) $sifre .= chr(rand(97, 122)); //a-z
    elseif ($sec == 3) $sifre .= chr(rand(48, 57)); //0-9
}
?>
<?php
session_start();
include 'includes/connect_database.inc.php';
$id = $_SESSION["ID"];
//Hataları Gizle


$sql = "SELECT * from users where user_id='$id'";
$sorgu = mysqli_query($conn, $sql);
$dizi = mysqli_fetch_array($sorgu);
$name = $dizi["name"];
$surname = $dizi["surname"];
$email = $dizi["email"];


//Form'dan bütün değerler geliyorsa mail gönderme işlemini başlatıyoruz.



//Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz
include('phpmail/class.phpmailer.php');
include('phpmail/class.smtp.php');
//Php Smtp Mailler Sınıfını Sayfaya Dahil Ediyoruz Tamamlandı

//Mail Bağlantı Ayarları 
//Mail Hangi Hesaptan Gönderilecek ise onun bilgilerini yazın.
$MailSmtpHost = "smtp.gmail.com";
$MailUserName = "wrtscontrolpanel@gmail.com";
$MailPassword = "wrts1234";
//Mail Bağlantı Ayarları Tamamlandı

//Doldurulan Form Mail Olarak Kime Gidecek?

//Doldurulan Form Mail Olarak Kime Gidecek Tamamlandı

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = $MailSmtpHost; //Smtp Host
$mail->SMTPSecure = 'ssl';  //yada tls
$mail->Port = 465;  //SSL kullanacaksanız portu 465 olarak değiştiriniz - TLS Portu 587
$mail->Username = $MailUserName; //Smtp Kullanıcı Adı
$mail->Password = $MailPassword; //Smtp Parola
$mail->SetFrom('info@wrts.net', 'WRTS CONTROL PANEL');
$mail->AddAddress($email, $name); //Mailin Gideceği Adres ve Alıcı Adı
$mail->CharSet = 'UTF-8'; //Mail Karakter Seti
$mail->Subject = 'New Password'; //Mail Konu Başlığı
$mail->MsgHTML("Hello...<br /> Your password has been successfully changed. <br /> Your new password:  '$sifre' 
	         this is it. To change your password, you can change it from the user panel after logging in to the system."); //Mail Mesaj İçeriği
if ($mail->Send()) {
    echo '<script>alert("Mail gönderildi!");</script>';
    $sql = "UPDATE users set password='$sifre' where user_id='$id'";
    $sorgu = mysqli_query($conn, $sql);
    $dizi = mysqli_fetch_array($sorgu);

    echo '<script>document.location="login.php"</script>';
} else {
    echo 'Mail gönderilirken bir hata oluştu: ' . $mail->ErrorInfo;
}

?>