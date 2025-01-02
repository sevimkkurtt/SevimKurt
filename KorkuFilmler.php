<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Korku Filmleri</title>
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

      footer {
        text-align: center;
        padding: 20px;
        background-color: #333;
        color: white;
      }
      nav ul li a:hover {
            color: #ffcc00; /* Üzerine gelindiğinde renk değişimi */
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

      .card-front,
      .card-back {
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
                <li><a href="kayit.php">Yönetici Girişi</a></li>
                <li><a href="hesapolustur.php">Kayıt Ol</a></li>
            </ul>
        </nav>
    </header>

    <!-- İlk Kart Grubu -->
    <section class="card-container">
      <div class="card">
        <div class="card-inner">
          <div
            class="card-front"
            style="background-image: url('img/Korku4.jpeg')"
          ></div>
          <div class="card-back">
            <p>
              Okulun devrimci sanat yönetmeni olan Madame Blanc'ın rehberliğinde
              Susie olağanüstü bir ilerleme kaydederken, kendine Sara isimli bir
              arkadaş da edinir. Zaman içerisinde iki arkadaş bu prestijli
              okulun ve yöneticilerinin karanlık bir sırrı sakladıklarından
              şüphelenmeye başlar...
              <br />
              <br />

              IMDB: 6.7/10
              <br />
              <br />
              Oyuncular:Dokata Johnson, Tilda Swinton, Mia Goth
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-inner">
          <div
            class="card-front"
            style="background-image: url('img/Korku2.jpeg')"
          ></div>
          <div class="card-back">
            <p>
              Genç bir kadın olan Nina, yetenekli bir balerindir. Eski bir
              balerin olan ve dans konusundaki hırsını kendisine aşılayan annesi
              ile New York'ta yaşayan Nina'nın hayatı danstan ibarettir. Bale
              yönetmeni Thomas Leroy, sahneye koyduğu Kuğu Gölü Balesi'nin baş
              dansçısını yeni sezonda değiştirmeye karar verir.
              <br />
              <br />
              IMDB: 8.0/10
              <br /><br />
              Oyuncular: Natalie Portman, Mila Kunis, Vincent Cassel
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-inner">
          <div
            class="card-front"
            style="background-image: url('img/Korku3.jpeg')"
          ></div>
          <div class="card-back">
            <p>
              1998 yılında Pearl, ünlü olma takıntısına sahip olan genç bir
              kızdır. Göz alıcı bir hayata özlem duyan Pearl'ün bu hayali
              reddedilince büyük bir öfkeye kapılır ve bir cinayet serisine
              başlar.
              <br /><br />
              IMDB: 7.0/10
              <br /><br />
              Oyuncular: Mia Goth, David Corenswet, Tandi Wright
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-inner">
          <div
            class="card-front"
            style="background-image: url('img/Korku1.jpeg')"
          ></div>
          <div class="card-back">
            <p>
              1998 yılında Pearl, ünlü olma takıntısına sahip olan genç bir
              kızdır. Göz alıcı bir hayata özlem duyan Pearl'ün bu hayali
              reddedilince büyük bir öfkeye kapılır ve bir cinayet serisine
              başlar.
              <br /><br />
              IMDB: 7.6/10
              <br /><br />
              Oyuncular: Christian Bale, Justin Theroux, Josh Lucas
            </p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-inner">
          <div
            class="card-front"
            style="background-image: url('img/Korku5.jpeg')"
          ></div>
          <div class="card-back">
            <p>
              Film çekimi için gittikleri evde kendilerini korkunç bir kabusun
              içinde bulan bir grup gencin hikayesini konu ediyor. Hollywood
              hayalleri olan bir grup gençten oluşan bir film ekibi, yetişkin
              filmi çekmek için Teksas'ın derinliklerindeki uzak bir çiftlik
              evine gider. Ekip, yaşlı bir çiftin evinde çekime başlar.
              <br /><br />
              IMDB: 6.7/10
              <br /><br />
              Oyuncular: Mia Goth, Jenna Ortega, Brittany Snow
            </p>
          </div>
        </div>
      </div>
   </section>

    <footer>
      <p>&copy; 2024 Bana Film Öner. Tüm hakları saklıdır.</p>
    </footer>
  </body>
</html>
