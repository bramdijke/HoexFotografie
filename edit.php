<?php
include 'includes/database.php';

$query = "SELECT * FROM categorieën";

$results = mysqli_query($db, $query);

$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
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
          <ul class="portfolio" id="portfolioScroller">
              <?php foreach ($categories as $category){ ?>
                  <li class="portfolio-item">
                      <a href="categorie.php" ><img src="images/<?= $category['cover']; ?>" alt="Cover foto van <?= $category['name']; ?>"></a>
                      <h3><?= $category['name']; ?></h3>
                      <p><?= $category['year']; ?></p>
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