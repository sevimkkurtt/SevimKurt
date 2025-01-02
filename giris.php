<?php
include("baglanti.php");

if (isset($_POST["girisyap"])) {
    $kullanicilar = $_POST["kullanicilar"];
    $sifre = $_POST["sifre"];

    // SQL Injection önlemi
    $kullanicilar = mysqli_real_escape_string($baglanti, $kullanicilar);

    // Kullanıcıyı veritabanında arama
    $sorgu = "SELECT * FROM filmkullanicilar WHERE kullanicilar = '$kullanicilar'";
    $sonuc = mysqli_query($baglanti, $sorgu);
    $kulad = mysqli_fetch_assoc($sonuc);

    if ($kulad && password_verify($sifre, $kulad['sifre'])) {
        echo '<div class="alert alert-success" role="alert">
                Başarıyla giriş yaptınız!
              </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                Kullanıcı adı veya şifre hatalı!
              </div>';
    }
}


    mysqli_close($baglanti);

?>
