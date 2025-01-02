<?php
include("baglanti.php");

function temizleInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = temizleInput($_POST['new-email']);
    $password = password_hash($_POST['new-password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO filmkullanicilari (email, sifre) VALUES ('$email', '$password')";
    if (mysqli_query($baglanti, $query)) {
        // Kayıt başarılı, yönlendirme yap
        header("Location: girisyap.php");
        exit;
    } else {
        echo "Kayıt sırasında bir hata oluştu: " . mysqli_error($baglanti);
    }

    mysqli_close($baglanti);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>

   
</head>
<body>
    <header>
        <div class="logo">Bana Film Öner</div>
        <nav>
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="korkufilmler.php">Korku Filmleri</a></li>
                <li><a href="KomediFilmleri.php">Komedi Filmleri</a></li>
                <li><a href="BilimKurguFilmleri.php">Bilim Kurgu Filmleri</a></li>
                <li><a href="AksiyonFilmleri.php">Aksiyon Filmleri</a></li>
                <li><a href="kayit.php">Yönetici Girişi</a></li>
                <li><a href="hesapolustur.php">Kayıt Ol</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="form-box">
            <h2>Kayıt Ol</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="input-group">
                    <label for="new-email">E-posta:</label>
                    <input type="email" id="new-email" name="new-email" placeholder="E-posta adresinizi girin" required>
                </div>
                <div class="input-group">
                    <label for="new-password">Parola:</label>
                    <input type="password" id="new-password" name="new-password" placeholder="Parolanızı girin" required>
                </div>
                <button type="submit" class="btn">Kayıt Ol</button>
            </form>
            <div class="redirect">
                <p>Hesabın var mı? <a href="girisyap.php">Giriş Yap</a></p>
            </div>
        </div>
    </div>
</body>
</html>
<style>
        /* Genel Sayfa Stilleri */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff; /* Arka plan beyaz */
            color: #333; /* Metin rengi koyu gri */
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed; /* Header sabit */
            top: 0;
            left: 0;
            z-index: 1000;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-top: 100px; /* Header yüksekliğine göre boşluk bırakıldı */
        }

        .form-box {
            background-color: #f9f9f9; /* Kutular açık gri */
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 320px;
            max-width: 100%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            color: #555;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            background-color: #eee;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .input-group input:focus {
            border-color: #ff5733;
            outline: none;
            box-shadow: 0 0 8px #ff5733;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background-color: #ff5733;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #e64a19;
        }

        .redirect {
            text-align: center;
            margin-top: 20px;
        }

        .redirect a {
            color: #ff5733;
            text-decoration: none;
        }

        .redirect a:hover {
            text-decoration: underline;
        }
    </style>