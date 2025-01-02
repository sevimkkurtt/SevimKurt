<?php
require_once 'config.php';
require_once 'admin/config.php';
require_once 'admin/functions.php';

session_start();

$error = '';
$success = '';

// Zaten giriş yapmış admin varsa yönlendir
if (isset($_SESSION[ADMIN_SESSION_KEY]) && $_SESSION[ADMIN_SESSION_KEY]) {
    header("Location: admin/index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['giris'])) {
    $username = temizleInput($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = "Kullanıcı adı ve şifre gereklidir!";
    } else {
        if (adminGiris($username, $password)) {
            header("Location: admin/index.php");
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
    <title>Yönetici Girişi - <?php echo SITE_NAME; ?></title>
    <link rel="stylesheet" href="adminlogin.css">
</head>
<body>
    <div class="admin-login-container">
        <div class="admin-login-box">
            <h2>Yönetici Girişi</h2>
            <?php 
            if ($error) echo showError($error);
            if ($success) echo showSuccess($success);
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Kullanıcı Adı</label>
                    <input type="text" 
                           name="username" 
                           id="username" 
                           class="form-control" 
                           placeholder="Kullanıcı Adı" 
                           required 
                           value="<?php echo isset($_POST['username']) ? temizleInput($_POST['username']) : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Parola</label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           class="form-control" 
                           placeholder="Parola" 
                           required>
                    <div class="password-toggle">
                        <input type="checkbox" id="showPassword"> Şifreyi göster
                    </div>
                </div>
                <button type="submit" name="giris" class="btn btn-primary">Giriş Yap</button>
            </form>
            <div class="admin-links">
                <a href="index.php">Ana Sayfaya Dön</a>
            </div>
        </div>
    </div>

    <script>
        // Şifre göster/gizle fonksiyonu
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordInput = document.getElementById('password');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>