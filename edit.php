<?php
include 'includes/database.php';
$portfolioItems =[
        [
                "title" => "Weddings",
                "image" => "/HoexFotografie/images/wedding.webp",
                "alt" => "Weddings",
                "description" => "I document your wedding day with an eye for genuine emotions..."
        ],
        [
                "title" => "Babies",
                "image" => "/HoexFotografie/images/babies.webp",
                "alt" => "Babies",
                "description" => "Baby photography focused on warmth, softness, and authenticity..."
        ],
        [
                "title" => "Business",
                "image" => "/HoexFotografie/images/business-people-in-the-office.webp",
                "alt" => "Business",
                "description" => "High-quality business portraits and brand photography..."
        ],
        [
                "title" => "Art",
                "image" => "/HoexFotografie/images/art.webp",
                "alt" => "Art",
                "description" => "Art photography focused on creativity, mood, and expression..."
        ],
        [
                "title" => "Pets",
                "image" => "/HoexFotografie/images/dogs.webp",
                "alt" => "Dogs",
                "description" => "Pet photography dedicated to capturing personality..."
        ],
        [
                "title" => "Family",
                "image" => "/HoexFotografie/images/family.webp",
                "alt" => "Family",
                "description" => "Family photography that celebrates authentic moments..."
        ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Document</title>
  <link rel="stylesheet" href="/HoexFotografie/stylesheet.css">
</head>
    <body>

    <nav class="sticky-top">
    <p>HOEX</p>
    <ul>
        <li><a href="/HoexFotografie/index.php"">Portfolio</a></li>
        <li><a href="/HoexFotografie/admin/overview.php">Reserveringen</a></li>
        <li><a href="/HoexFotografie/edit.php">Over</a></li>
    </ul>
    </nav>

    <div class="header-container">
  <header>
      <h1>Fotos bijwerken</h1>
      <button>Toevoegen</button>
  </header >
    </div>
  <main>
      <div class="edit-images">

              <ul >
                  <?php foreach ($portfolioItems as $item){ ?>
                      <li class="portfolio-item">
                          <h3><?= $item['title']; ?></h3>
                          <img src="<?= $item['image']; ?>" alt="<?= $item['alt']; ?>">

                          <p><?= $item['description']; ?></p>
                            <button>Edit</button>
                            <button>Delete</button>
                      </li>
                  <?php } ?>
              </ul>

      </div>
  </main>

  <footer>
    <p>&copy; 2026</p>
  </footer>

</body>
</html>