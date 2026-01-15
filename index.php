<?php
/*include 'database.php';
session_start();
$_SERVER = array(); // Clear existing server variables for security
*/ ?>
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
            <li><a href="edit.php">Portfolio</a></li>
            <li><a href="about.php">Reserveringen</a></li>
            <li><a href="index.php">Over</a></li>
        </ul>
    </nav>

</header>
<main>
    <h1>Portfolio</h1>
    <div class="portfolio-wrap">
        <button class="scroll-btn left" type="button" aria-label="Scroll left">‹</button>

        <ul class="portfolio" id="portfolioScroller">
            <li class="portfolio-item">
                <img src="/images/wedding.webp" alt="Weddings">
                <h3>Weddings</h3>
                <p>I document your wedding day with an eye for genuine emotions, meaningful details, and natural
                    moments. From intimate glances to grand celebrations, every image tells the story of your love in a
                    timeless and elegant way.</p>
            </li>

            <li class="portfolio-item">
                <img src="/images/babies.webp" alt="Babies">
                <h3>Babies</h3>
                <p>Baby photography focused on warmth, softness, and authenticity. I capture delicate expressions and
                    precious details in a calm and comfortable setting, creating memories you will cherish for a
                    lifetime.</p>
            </li>

            <li class="portfolio-item">
                <img src="/images/business-people-in-the-office.webp" alt="business">
                <h3>Business</h3>
                <p>High-quality business portraits and brand photography designed to communicate confidence,
                    professionalism, and authenticity. Perfect for websites, social media, and marketing materials that
                    represent your business at its best.</p>
            </li>

            <li class="portfolio-item">
                <img src="/images/art.webp" alt="art">
                <h3>Art</h3>
                <p>Art photography focused on creativity, mood, and expression. Through thoughtful composition, lighting, and detail, I create images that go beyond documentation and become visual art—perfect for exhibitions, portfolios, and personal projects.</p>
            </li>

            <li class="portfolio-item">
                <img src="/images/dogs.webp" alt="dogs">
                <h3>Pets</h3>
                <p>Pet photography dedicated to capturing the unique personality and spirit of each animal. With patience and a natural approach, I create expressive images that highlight emotion, energy, and the special connection between animals and their owners.</p>
            </li>


            <li class="portfolio-item">
                <img src="/images/family.webp" alt="family">
                <h3>Family</h3>
                <p>Family photography that celebrates authentic moments, laughter, and togetherness. I focus on relaxed sessions where everyone feels comfortable, resulting in timeless images that reflect your family’s true personality and bond.</p>
            </li>
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
        scroller.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    document.querySelector(".scroll-btn.right").addEventListener("click", () => {
        scroller.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });
</script>