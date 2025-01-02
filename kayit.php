    <?php
    session_start(); // Oturum başlat
    include("baglanti.php");
    $calistirekle = null;
    if (isset($_POST["giris"])) {
        $kullaniciadi = $_POST["kullaniciadi"];
        $email = $_POST["email"];
        $parola = password_hash($_POST["parola"], PASSWORD_DEFAULT); 
        
        // Hazırlıklı ifade kullanımı
        $stmt = $baglanti->prepare("INSERT INTO yoneticiler (kullaniciadi, email, parola) VALUES (?, ?, ?)");
        if ($stmt === false) {
            die('prepare() failed: ' . htmlspecialchars($baglanti->error));
        }

        $stmt->bind_param("sss", $kulad, $email, $parola);
        $calistirekle = $stmt->execute();

        if ($calistirekle) {
            // Kullanıcı bilgilerini oturuma kaydet
            $_SESSION['kulad'] = $kulad;
            $_SESSION['email'] = $email;
            
            header("Location: admin/index.php");
            exit(); 
        } else {
            echo '<div class="alert alert-danger" role="alert">Bir problem oluştu.</div>';
        }

        $stmt->close();
        $baglanti->close();
    }
    ?>
    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kayıt Ol</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body {
                background-color: #f8f9fa;
                font-family: Arial, sans-serif;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-control {
                border-radius: 5px;
                border: 1px solid #ced4da;
            }
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                transition: background-color 0.3s, border-color 0.3s;
            }
            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #004085;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
    <div class="container">
        <form method="POST" action="">
        <div class="form-group">
            <label for="kullaniciadi">Kullanıcı Adı</label>
            <input type="text" name="kullaniciadi" class="form-control" id="kullaniciadi" placeholder="Kullanıcı Adı" required>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">E-mail</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail" required>
            <small id="emailHelp" class="form-text text-muted">E-mail adresiniz gizli kalacaktır.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Parola</label>
            <input type="password" name="parola" class="form-control" id="exampleInputPassword1" placeholder="Parola" required>
        </div>
        
        <button type="submit" name="giris" class="btn btn-primary">Kaydol</button>
        </form>
    </div>
    </body>
    </html>
