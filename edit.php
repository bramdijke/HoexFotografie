<?php
include 'includes/database.php';
$portfolioItems =[
        [
                "title" => "Weddings",
                "images" => "/images/wedding.webp",
                "alt" => "Weddings",
                "description" => "I document your wedding day with an eye for genuine emotions..."
        ],
        [
                "title" => "Babies",
                "images" => "/images/babies.webp",
                "alt" => "Babies",
                "description" => "Baby photography focused on warmth, softness, and authenticity..."
        ],
        [
                "title" => "Business",
                "images" => "/images/business-people-in-the-office.webp",
                "alt" => "Business",
                "description" => "High-quality business portraits and brand photography..."
        ],
        [
                "title" => "Art",
                "images" => "/images/art.webp",
                "alt" => "Art",
                "description" => "Art photography focused on creativity, mood, and expression..."
        ],
        [
                "title" => "Pets",
                "images" => "/images/dogs.webp",
                "alt" => "Dogs",
                "description" => "Pet photography dedicated to capturing personality..."
        ],
        [
                "title" => "Family",
                "images" => "/images/family.webp",
                "alt" => "Family",
                "description" => "Family photography that celebrates authentic moments..."
        ]
];

/*if (isset($_POST['Toevoegen'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $alt = $_POST['alt'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO portfolio (title, image, alt, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $image, $alt, $description);
    $stmt->execute();
    $stmt->close();
}*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Document</title>
  <link rel="stylesheet" href="/HoexFotografie/styles/stylesheet.css">
</head>
<body>
        <nav class="sticky-top">
            <p>HOEX</p>
            <ul>
                <li><a href="edit.php">Portfolio Bewerken</a></li>
                <li><a href="overview.php">Reserveren</a></li>
            </ul>
        </nav>

    <div class="header-container">
  <header>
      <h1>Fotos bijwerken</h1>
      <form method="post" action="post">
          <button>Toevoegen</button>
        </form>
  </header >
    </div>
  <main>

      <div class="edit-images">
          <ul>
              <?php foreach ($portfolioItems as $item){ ?>
                  <li class="portfolio-edit-item">
                      <img src="<?= $item['images']; ?>" alt="<?= $item['alt']; ?>">

                      <div class="info">
                          <h3><?= $item['title']; ?></h3>
                          <p><?= $item['description']; ?></p>

                          <div class="actions">
                              <a href="...">Delete</a>
                          </div>
                      </div>
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