<?php
$host = "localhost";
$kullanici = "root";
$sifre = "";
$vt = "filmkullanicilar"; // Doğru veritabanı adı

$baglanti = mysqli_connect($host, $kullanici, $sifre, $vt);

if (!$baglanti) {
    die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}

mysqli_set_charset($baglanti, "UTF8");
?>
