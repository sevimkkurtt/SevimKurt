<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aksiyon Filmleri</title>
    <style>
        /* Header ve footer temel stilleri */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        nav ul li a:hover {
            color: #ffcc00; /* Üzerine gelindiğinde renk değişimi */
        }


        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
        }

        /* Kart stilleri */
        .card-container {
            display: flex;
            justify-content: space-around;
            margin: 50px 0;
        }

        .card {
            width: 250px;
            height: 350px;
            perspective: 1000px;
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .card:hover .card-inner {
            transform: rotateY(180deg);
        }

        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 10px;
        }

        .card-front {
            background-size: cover;
            background-position: center;
        }

        .card-back {
            background-color: #333;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: rotateY(180deg);
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">Bana Film Öner</div>
        <nav>
            <ul>
                <li><a href="index.php">Ana Sayfa</a></li>
                <li><a href="KorkuFilmler.php">Korku Filmleri</a></li>
                <li><a href="KomediFilmleri.php">Komedi Filmleri</a></li>
                <li><a href="BilimKurguFilmleri.php">Bilim Kurgu Filmleri</a></li>
                <li><a href="AksiyonFilmleri.php">Aksiyon Filmleri</a></li>
                <li><a href="hesapolustur.php">Yönetici Girişi</a></li>
                <li><a href="hesapolustur.php">Kayıt Ol</a></li>
            </ul>
        </nav>
    </header>

    <!-- İlk Kart Grubu -->
    <section class="card-container">
        <div class="card">
            <div class="card-inner">
                <div class="card-front" style="background-image: url('img/Aksiyon1.jpeg');"></div>
                <div class="card-back">
                    <p>Kart 1 Arkası</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-front" style="background-image: url('img/Aksiyon2.jpeg');"></div>
                <div class="card-back">
                    <p>Kart 2 Arkası</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-front" style="background-image: url('img/Aksiyon3.jpeg');"></div>
                <div class="card-back">
                    <p>Kart 3 Arkası</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-front" style="background-image: url('img/Aksiyon4.jpeg');"></div>
                <div class="card-back">
                    <p>Kart 4 Arkası</p>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-inner">
                <div class="card-front" style="background-image: url('img/Aksiyon5.jpeg');"></div>
                <div class="card-back">
                    <p>Kart 5 Arkası</p>
                </div>
            </div>
        </div>
    </section>

   
    <footer>
        <p>&copy; 2024 Bana Film Öner. Tüm hakları saklıdır.</p>
    </footer>

</body>
</html>
