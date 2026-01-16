<?php
include 'includes/database.php';
$portfolioItems =[
        [
                "title" => "Weddings",
                "image" => "./images/wedding.webp",
                "alt" => "Weddings",
                "description" => "I document your wedding day with an eye for genuine emotions..."
        ],
        [
                "title" => "Babies",
                "image" => "./images/babies.webp",
                "alt" => "Babies",
                "description" => "Baby photography focused on warmth, softness, and authenticity..."
        ],
        [
                "title" => "Business",
                "image" => "./images/business-people-in-the-office.webp",
                "alt" => "Business",
                "description" => "High-quality business portraits and brand photography..."
        ],
        [
                "title" => "Art",
                "image" => "./images/art.webp",
                "alt" => "Art",
                "description" => "Art photography focused on creativity, mood, and expression..."
        ],
        [
                "title" => "Pets",
                "image" => "./images/dogs.webp",
                "alt" => "Dogs",
                "description" => "Pet photography dedicated to capturing personality..."
        ],
        [
                "title" => "Family",
                "image" => "./images/family.webp",
                "alt" => "Family",
                "description" => "Family photography that celebrates authentic moments..."
        ]
];

if (isset($_POST['Toevoegen'])) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $alt = $_POST['alt'];
    $description = $_POST['description'];

    $stmt = $db->prepare("INSERT INTO portfolio (title, image, alt, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $image, $alt, $description);
    $stmt->execute();
    $stmt->close();
}
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
                      <img src="<?= $item['image']; ?>" alt="<?= $item['alt']; ?>">

                      <div class="info">
                          <h3><?= $item['title']; ?></h3>
                          <p><?= $item['description']; ?></p>

                          <div class="actions">
                              <a href="...">Edit</a>
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