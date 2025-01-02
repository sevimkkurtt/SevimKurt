<?php
require_once 'config.php';
require_once 'functions.php';

session_start();

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['giris'])) {
    $kulad = temizleInput($_POST['kullanicilar']);
    $sifre = $_POST['sifre'];
    
    // CSRF kontrolü
    if (!isset($_POST['csrf_token']) || !checkCSRFToken($_POST['csrf_token'])) {
        $error = "Güvenlik doğrulaması başarısız!";
    } else if (empty($kulad) || empty($sifre)) {
        $error = "Kullanıcı adı ve şifre gereklidir!";
    } else {
        if (guvenliGiris($kulad, $sifre)) {
            header("Location: index.php");
            exit();
        } else {
            $error = "Geçersiz kullanıcı adı veya şifre!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - <?php echo SITE_NAME; ?></title>
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
</head>
<body>
    <header>
        <div class="logo"><?php echo SITE_NAME; ?></div>
        <nav>
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="korkufilmler.php">Korku Filmleri</a></li>
                <li><a href="KomediFilmleri.php">Komedi Filmleri</a></li>
                <li><a href="BilimKurguFilmleri.php">Bilim Kurgu Filmleri</a></li>
                <li><a href="AksiyonFilmleri.php">Aksiyon Filmleri</a></li>
                <li><a href="hesapolustur.php">Hesap Oluştur</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="form-box">
            <h2>Giriş Yap</h2>
            <?php 
            if ($error) echo showError($error);
            if ($success) echo showSuccess($success);
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <div class="input-group">
                    <label for="kullanicilar">Kullanıcı Adı:</label>
                    <input type="text" id="kullanicilar" name="kullanicilar" 
                           placeholder="Kullanıcı adınızı girin" required
                           value="<?php echo isset($_POST['kullanicilar']) ? temizleInput($_POST['kullanicilar']) : ''; ?>">
                </div>
                <div class="input-group">
                    <label for="sifre">Şifre:</label>
                    <input type="password" id="sifre" name="sifre" 
                           placeholder="Şifrenizi girin" required>
                    <div class="password-toggle">
                        <input type="checkbox" id="showPassword"> Şifreyi göster
                    </div>
                </div>
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Beni hatırla</label>
                </div>
                <button type="submit" name="giris" class="btn">Giriş Yap</button>
            </form>
            <div class="redirect">
                <p>Hesabın yok mu? <a href="hesapolustur.php">Kayıt Ol</a></p>
                <p><a href="sifremi-unuttum.php">Şifremi Unuttum</a></p>
            </div>
        </div>
    </div>

    <script>
        // Şifre göster/gizle fonksiyonu
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordInput = document.getElementById('sifre');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
