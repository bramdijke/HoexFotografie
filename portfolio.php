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
    <link rel="stylesheet" href="styles/stylesheet.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
                    <a href="categorie.php" > <img src="HoexFotografie/images<?= $category['cover']; ?>" alt="Cover foto van <?= $category['name']; ?>"></a>
                    <h3><?= $category['name']; ?></h3>
                    <p><?= $category['year']; ?></p>
                </li>
            <?php } ?>
        </ul>



        <button class="scroll-btn right" type="button" aria-label="Scroll right">›</button>
    </div>

</main>
<footer class="site-footer">
    <p>© 2024 Hoex Fotografie. All rights reserved.</p>

    <div class="footer-social">
        <a href="https://instagram.com/yourname" target="_blank" rel="noopener" aria-label="Instagram">
            <i class="fa-brands fa-instagram"></i>
        </a>

        <a href="https://facebook.com/yourname" target="_blank" rel="noopener" aria-label="Facebook">
            <i class="fa-brands fa-facebook"></i>
        </a>

        <a href="https://tiktok.com/@yourname" target="_blank" rel="noopener" aria-label="TikTok">
            <i class="fa-brands fa-tiktok"></i>
        </a>
    </div>
</footer>

</body>
</html>

<script>
    const scroller = document.getElementById("portfolioScroller");
    const scrollAmount = 420;

    scroller.innerHTML += scroller.innerHTML;

    document.querySelector(".scroll-btn.left").addEventListener("click", () => {
        if (scroller.scrollLeft === 0) {
            scroller.scrollTo({
                left: scroller.scrollWidth,
                behavior: "smooth"
            });
        } else {
            scroller.scrollBy({ left: -scrollAmount, behavior: "smooth" });
        }
    });

    document.querySelector(".scroll-btn.right").addEventListener("click", () => {
        if (scroller.scrollLeft + scroller.clientWidth >= scroller.scrollWidth) {
            scroller.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            scroller.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    });

    scroller.addEventListener("scroll", () => {
        if (scroller.scrollLeft >= scroller.scrollWidth / 2) {
            scroller.scrollLeft = 0;
        }
    });


</script>