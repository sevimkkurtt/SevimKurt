<?php
session_start();

// Oturum doğrulama
if (!isset($_SESSION['kullaniciadi'])) {
    echo "Bu sayfaya erişim izniniz yok.";
    exit;
}

// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmkullanicilar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantı kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

$uploadOk = 1;
$target_dir = "uploads/"; // Resimlerin yükleneceği klasör

// Klasör yoksa oluştur
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

if (isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Resmin geçerli olup olmadığını kontrol et
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "Dosya bir resim - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "Dosya bir resim değil.<br>";
        $uploadOk = 0;
    }

    // Dosyanın mevcut olup olmadığını kontrol et
    if (file_exists($target_file)) {
        echo "Üzgünüz, bu dosya zaten var.<br>";
        $uploadOk = 0;
    }

    // Dosya boyutunu kontrol et (örneğin 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Üzgünüz, dosyanın boyutu çok büyük.<br>";
        $uploadOk = 0;
    }

    // Geçerli resim türlerini kontrol et
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        echo "Üzgünüz, sadece JPG, JPEG, PNG ve GIF dosya türlerine izin verilmektedir.<br>";
        $uploadOk = 0;
    }

    // Yükleme işlemi
    if ($uploadOk == 0) {
        echo "Üzgünüz, dosya yüklenemedi.<br>";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Dosya " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " başarıyla yüklendi.<br>";

            // Veritabanına kayıt
            $dosya_adi = basename($_FILES["fileToUpload"]["name"]);
            $sql = "INSERT INTO yuklenen_resimler (dosya_adi, dosya_yolu) VALUES ('$dosya_adi', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "Veritabanına kayıt başarılı.<br>";
            } else {
                echo "Veritabanına kayıt sırasında hata: " . $conn->error . "<br>";
            }
        } else {
            echo "Üzgünüz, dosya yüklenirken bir hata oluştu.<br>";
        }
    }
}

// Yüklenen resimlerin listesi
$sql = "SELECT * FROM yuklenen_resimler";
$result = $conn->query($sql);

$uploadedImages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uploadedImages[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bana Film Öner - Yönetim Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            font-size: 20px;
            font-weight: bold;
        }
        header nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }
        header nav ul li {
            margin-left: 20px;
        }
        header nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding: 5px 10px;
            border-radius: 5px;
        }
        header nav ul li a:hover {
            background-color: #555;
        }
        .upload-form {
            margin: 30px auto;
            max-width: 600px;
            text-align: center;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .upload-form h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .upload-form input[type="file"] {
            margin-bottom: 20px;
            padding: 10px;
            font-size: 14px;
        }
        .upload-form button {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .upload-form button:hover {
            background-color: #555;
        }
        .section {
            margin: 30px auto;
            max-width: 1000px;
            padding: 10px;
        }
        .section h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 22px;
        }
        .scroll-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .image-box {
            width: 200px;
            height: 250px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #ccc;
            font-size: 16px;
            font-weight: bold;
            color: #555;
            text-align: center;
            background-size: cover;
            background-position: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .image-box:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Yönetim Paneli</div>
        <nav>
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="../index.php">Çıkış Yap</a></li>
            </ul>
        </nav>
    </header>

    <section class="upload-form">
        <h2>Yeni Film Resmi Yükle</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="fileToUpload">Resmi Seç:</label><br>
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*"><br><br>
            <button type="submit" name="submit">Yükle</button>
        </form>
    </section>

    <section class="section">
        <h2>Yüklenen Resimler</h2>
        <div class="scroll-container">
            <?php foreach ($uploadedImages as $image): ?>
                <div class="image-box" style="background-image: url('<?= $image['dosya_yolu'] ?>');">
                    <?= htmlspecialchars($image['dosya_adi']) ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Bana Film Öner. Tüm hakları saklıdır.</p>
    </footer>
</body>
</html>
