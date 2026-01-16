<?php
$portfolioItems = [
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
                "image" => "/HoexFotografie/images/family.webp",
                "alt" => "Family",
                "description" => "Family photography that celebrates authentic moments..."
        ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
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
            <?php foreach ($portfolioItems as $item){ ?>
                <li class="portfolio-item">
                    <img src="<?= $item['image']; ?>" alt="<?= $item['alt']; ?>">
                    <h3><?= $item['title']; ?></h3>
                    <p><?= $item['description']; ?></p>
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