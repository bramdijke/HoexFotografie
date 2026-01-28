<?php
include 'includes/database.php';
$intro = "Hi there! Welcome to the Hoex Fotografie website. Here you can explore our portfolio and make reservations for photography sessions. Why not start by checking out our portfolio or make a reservation today? <br>Thank you for visiting, and we look forward to capturing your special moments!";

/** @var mysqli $db */
$query = "SELECT * FROM categories LIMIT 3";
$results = mysqli_query($db, $query);
$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOEX Fotografie | Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-900 overflow-x-hidden">

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

<header class="relative h-[80vh] flex flex-col items-center justify-center text-center px-6 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="images/bg.jpg" alt="Photography Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/40"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center">
        <div class="mb-6">
            <img src="images/hoexfotografie-logo.png" alt="HOEX"
                 class="h-24 md:h-40 w-auto object-contain brightness-0 invert">
        </div>
    </div>

    <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-gray-50 to-transparent z-10"></div>
</header>

<main class="container mx-auto px-6 py-24 relative z-20">
    <div class="max-w-7xl mx-auto">
        <div class="mb-10 text-center md:text-left">
            <h2 class="text-3xl font-black uppercase tracking-tighter text-shadow-grey">Featured Collections</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php foreach ($categories as $category): ?>
                <div class="group/item w-full">
                    <a href="categories-klant.php?category_id=<?= $category['category_id']; ?>"

                    class="block relative overflow-hidden rounded-2xl shadow-lg">

                        <img src="/images/<?= htmlspecialchars($category['cover']); ?>"
                             alt="<?= htmlspecialchars($category['name']); ?>"
                             class="w-full h-[550px] object-cover transition-transform duration-700 group-hover/item:scale-110">

                        <div class="absolute inset-0 bg-black/30 opacity-0 group-hover/item:opacity-100 transition-opacity flex items-end p-8">
                            <span class="text-white text-sm font-semibold uppercase tracking-widest">View Gallery</span>
                        </div>
                    </a>

                    <div class="mt-4 flex justify-between items-center px-1">
                        <h3 class="text-xl font-bold uppercase"><?= $category['name']; ?></h3>
                        <p class="text-gray-400 font-medium"><?= $category['year']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>

</body>
</html>