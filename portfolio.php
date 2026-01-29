<?php

/** @var mysqli $db */
require_once "includes/database.php";
$query = "SELECT * FROM categories";
$results = mysqli_query($db, $query);
$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOEX Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">

<nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 py-2 flex flex-col md:grid md:grid-cols-3 items-center gap-4 md:gap-0">
        <ul class="flex items-center space-x-6 md:space-x-8 order-2 md:order-1">
            <li><a href="portfolio.php"
                   class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Portfolio</a>
            </li>
            <li><a href="reserveren.php"
                   class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Reserveren</a>
            </li>
            <li><a href="about.php"
                   class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">About</a>
            </li>
        </ul>

        <div class="flex justify-center order-1 md:order-2">
            <a href="index.php" class="flex items-center">
                <img src="images/hoexfotografie-logo.png" alt="hoex logo" class="h-10 md:h-14 w-auto object-contain">
            </a>
        </div>

        <div class="hidden md:flex justify-end order-3">
            <div class="flex space-x-4 text-gray-500">
                <a href="#" class="hover:text-black transition"><i class="fa-brands fa-instagram text-lg"></i></a>
            </div>
        </div>
    </div>
</nav>

<main class="py-12">
    <div class="container mx-auto px-6">
        <h1 class="text-4xl font-bold text-center mb-10 uppercase tracking-widest">Portfolio</h1>

        <div class="relative group">
            <button id="prevBtn"
                    class="absolute left-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 p-4 rounded-full shadow-lg hover:bg-white transition opacity-0 group-hover:opacity-100">
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <div id="portfolioScroller" class="flex overflow-x-auto gap-6 no-scrollbar snap-x snap-mandatory">
                <?php foreach ($categories as $category) : ?>
                    <div class="portfolio-item min-w-[300px] md:min-w-[400px] snap-center">
                        <a href="categories-klant.php?category_id=<?= $category['category_id']; ?>"
                           class="block overflow-hidden rounded-lg shadow-md hover:shadow-xl transition">
                            <img src="images/<?= $category['cover']; ?>"
                                 alt="<?= $category['name']; ?>"
                                 class="w-full h-[500px] object-cover hover:scale-105 transition duration-500">
                        </a>
                        <div class="mt-4 text-center">
                            <h3 class="text-xl font-semibold uppercase"><?= htmlspecialchars($category['name']); ?></h3>
                            <p class="text-gray-500"><?= htmlspecialchars($category['year']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button id="nextBtn"
                    class="absolute right-0 top-1/2 -translate-y-1/2 z-10 bg-white/80 p-4 rounded-full shadow-lg hover:bg-white transition opacity-0 group-hover:opacity-100">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>
<script src="js/scrolling.js"></script>
</body>
</html>