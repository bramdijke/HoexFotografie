<?php

/** @var mysqli $db */

require_once "includes/database.php";

$query = "SELECT * FROM categorieën";

$results = mysqli_query($db, $query);

$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOEX</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
<header>
    <nav class="sticky-top">
        <p>HOEX</p>
        <ul>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="reserveren.php">Reserveren</a></li>
            <li><a href="about.php">Over</a></li>
        </ul>
    </nav>

</header>
<main>
    <h1>Portfolio</h1>
    <div class="portfolio-wrap">
        <button class="scroll-btn left" type="button" aria-label="Scroll left">‹</button>

        <ul class="portfolio" id="portfolioScroller">
            <?php foreach ($categories as $category){ ?>
                <li class="portfolio-item">
                    <a href="categorie.php" ><img src="images/<?= $category['cover']; ?>" alt="Cover foto van <?= $category['name']; ?>"></a>
                    <h3><?= $category['name']; ?></h3>
                    <p><?= $category['year']; ?></p>
                </li>
            <?php } ?>
        </ul>



        <button class="scroll-btn right" type="button" aria-label="Scroll right">›</button>
    </div>

</main>
<footer>
    <p>&copy; 2024 My Website</p>
</footer>

</body>
</html>

<script>
    const scroller = document.getElementById("portfolioScroller");
    const scrollAmount = 420;

    document.querySelector(".scroll-btn.left").addEventListener("click", () => {
        scroller.scrollBy({left: -scrollAmount, behavior: "smooth"});
    });

    document.querySelector(".scroll-btn.right").addEventListener("click", () => {
        scroller.scrollBy({left: scrollAmount, behavior: "smooth"});
    });
</script>