<?php
require_once "includes/database.php";

// 1) Read category_id from URL
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if (!$category_id) {
    header("Location: portfolio.php");
    exit;
}

// 2) Fetch category
$stmt = $db->prepare("SELECT category_id, name, year, cover FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
$category = $result->fetch_assoc();
$stmt->close();

if (!$category) {
    die("Categorie niet gevonden.");
}

// 3) Fetch photos for this category
$fotos = [];
$stmtFotos = $db->prepare("SELECT id, image FROM photos WHERE category_id = ? ORDER BY id DESC");
$stmtFotos->bind_param("i", $category_id);
$stmtFotos->execute();
$resFotos = $stmtFotos->get_result();

while ($row = $resFotos->fetch_assoc()) {
    $fotos[] = $row;
}
$stmtFotos->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($category['name']) ?> - HOEX Fotografie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-white font-sans text-gray-900">

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

<main class="container mx-auto px-6 py-12">
    <header class="max-w-4xl mx-auto text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter mb-2"><?= htmlspecialchars($category['name']) ?></h1>
        <p class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400"><?= htmlspecialchars($category['year']) ?></p>
        <div class="mt-8 flex justify-center">
            <div class="w-12 h-px bg-black"></div>
        </div>
    </header>

    <?php if (empty($fotos)): ?>
        <div class="text-center py-20">
            <p class="text-sm uppercase tracking-widest text-gray-400">Deze categorie heeft nog geen foto’s.</p>
            <a href="portfolio.php"
               class="inline-block mt-6 text-[10px] font-bold uppercase tracking-widest border-b border-black pb-1 hover:text-gray-500 transition">Terug
                naar Portfolio</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($fotos as $foto): ?>
                <?php $imgPath = "images/" . $foto['image']; ?>
                <div class="overflow-hidden group">
                    <?php if (file_exists($imgPath)): ?>
                        <div class="aspect-[4/5] overflow-hidden bg-gray-100 shadow-sm transition-all duration-500 hover:shadow-2xl">
                            <img src="<?= htmlspecialchars($imgPath) ?>"
                                 alt="Foto"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 cursor-pointer">
                        </div>
                    <?php else: ?>
                        <div class="aspect-[4/5] bg-gray-100 flex items-center justify-center text-[10px] uppercase tracking-widest text-gray-400 p-4 text-center">
                            Bestand niet gevonden:<br><?= htmlspecialchars($foto['image']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-24 text-center">
        <a href="portfolio.php"
           class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-black transition-colors">
            &larr; Terug naar overzicht
        </a>
    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>

</body>
</html>