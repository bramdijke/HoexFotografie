<?php
session_start();


if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    header("Location: login.php");
    exit;
}
/** @var mysqli $db */

require_once "includes/database.php";
require_once "includes/image-helper.php";

$showAdd = isset($_POST['add']);
$showEditId = isset($_POST['edit']) ? $_POST['category_id'] : null;

// --- Logica voor toevoegen ---
if (isset($_POST['addSubmit'])) {
    $name = mysqli_escape_string($db, $_POST['name']);
    $year = mysqli_escape_string($db, $_POST['year']);

    if ($year >= 1901 && $year <= 2100) {
        $cover = addImageFile($_FILES['cover']);
        $query = "INSERT INTO categories (name, year, cover) VALUES ('$name', '$year', '$cover')";
        mysqli_query($db, $query);
        header("location: portfolio-bewerken.php");
        exit;
    }
}

// --- Logica voor bewerken ---
if (isset($_POST['editSubmit'])) {
    $category_id = $_POST['category_id'];
    if (isset($_FILES['newCover']) && $_FILES['newCover']['error'] !== UPLOAD_ERR_NO_FILE) {
        $newCover = addImageFile($_FILES['newCover']);
        if ($newCover) {
            $oldCover = $_POST['oldCover'];
            if (file_exists("images/$oldCover")) {
                unlink("images/$oldCover");
            }
            $newCoverEsc = mysqli_escape_string($db, $newCover);
            $query = "UPDATE categories SET cover = '$newCoverEsc' WHERE category_id = $category_id";
            mysqli_query($db, $query);
        }
    }
    header("Location: portfolio-bewerken.php");
    exit;
}

// --- Logica voor verwijderen ---
if (isset($_POST['delete'])) {
    $cover = $_POST['cover'];
    if (file_exists("images/$cover")) {
        unlink("images/$cover");
    }
    $category_id = mysqli_escape_string($db, $_POST['category_id']);
    $query = "DELETE FROM categories WHERE category_id = '$category_id'";
    mysqli_query($db, $query);
    header("Location: portfolio-bewerken.php");
    exit;
}

// Ophalen categorieën
$query = "SELECT * FROM categories ORDER BY year DESC";
$results = mysqli_query($db, $query);
$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Beheren - HOEX</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans text-gray-900">

<nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-6 py-2 flex flex-col md:grid md:grid-cols-3 items-center gap-4 md:gap-0">
        <ul class="flex items-center space-x-6 md:space-x-8 order-2 md:order-1">
            <li><a href="portfolio-bewerken.php"
                   class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Portfolio
                    bewerken</a>
            </li>
            <li><a href="overview.php"
                   class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Reserveringen</a>
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

<main class="container mx-auto px-6 py-12 max-w-6xl">
    <header class="mb-12">
        <h1 class="text-4xl font-black uppercase tracking-tighter">Portfolio Beheren</h1>
        <p class="text-gray-400 text-sm mt-2 font-medium tracking-wide">Beheer hier je mappen en categorieën.</p>
    </header>

    <section class="mb-16">
        <?php if (!$showAdd): ?>
            <form method="post">
                <button type="submit" name="add"
                        class="flex items-center gap-3 bg-black text-white px-6 py-4 rounded shadow-lg hover:bg-gray-800 transition transform hover:-translate-y-1 uppercase text-xs font-bold tracking-widest">
                    <i class="fa-solid fa-folder-plus text-lg"></i> Nieuwe Map Toevoegen
                </button>
            </form>
        <?php else: ?>
            <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 max-w-2xl">
                <h3 class="text-lg font-bold mb-6 uppercase tracking-tight">Nieuwe categorie aanmaken</h3>
                <form method="post" enctype="multipart/form-data" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Naam
                                Map</label>
                            <input type="text" name="name" required
                                   class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black outline-none">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Jaartal</label>
                            <input type="number" name="year" placeholder="2024" required
                                   class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Cover
                            Afbeelding</label>
                        <input type="file" name="cover" required
                               class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-gray-100 file:text-black hover:file:bg-gray-200 cursor-pointer">
                    </div>
                    <div class="flex gap-4 pt-4">
                        <button type="submit" name="addSubmit"
                                class="bg-black text-white px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition">
                            Opslaan
                        </button>
                        <a href="portfolio-bewerken.php"
                           class="px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-black transition flex items-center">Annuleren</a>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </section>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        <?php foreach ($categories as $category): ?>
            <div class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 transition-all hover:shadow-xl">
                <div class="relative aspect-[4/5] overflow-hidden bg-gray-200">
                    <img src="images/<?= $category['cover']; ?>"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                         alt="Cover">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <a href="categorie.php?category_id=<?= $category['category_id'] ?>"
                           class="bg-white text-black px-6 py-2 rounded-full text-[10px] font-bold uppercase tracking-widest transform translate-y-4 group-hover:translate-y-0 transition-transform">
                            Bekijk Inhoud
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="font-black uppercase tracking-tight text-xl"><?= $category['name']; ?></h3>
                            <p class="text-[10px] font-bold text-gray-400 tracking-widest uppercase"><?= $category['year']; ?></p>
                        </div>
                    </div>

                    <div class="space-y-3 pt-4 border-t border-gray-50">
                        <?php if ($showEditId != $category['category_id']): ?>
                            <form method="post">
                                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                <button type="submit" name="edit"
                                        class="text-[10px] font-bold uppercase tracking-widest text-blue-500 hover:text-blue-700 transition flex items-center gap-2">
                                    <i class="fa-solid fa-image"></i> Cover Veranderen
                                </button>
                            </form>
                        <?php else: ?>
                            <form method="post" enctype="multipart/form-data"
                                  class="bg-gray-50 p-3 rounded-lg animate-pulse">
                                <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                                <input type="hidden" name="oldCover" value="<?= $category['cover'] ?>">
                                <input type="file" name="newCover" required class="text-[10px] mb-2 w-full">
                                <button type="submit" name="editSubmit"
                                        class="bg-blue-500 text-white px-3 py-1 rounded text-[10px] uppercase font-bold">
                                    Update
                                </button>
                            </form>
                        <?php endif; ?>

                        <form method="post"
                              onsubmit="return confirm('Weet je zeker dat je deze map en alle data wilt verwijderen?');">
                            <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>"/>
                            <input type="hidden" name="cover" value="<?= $category['cover'] ?>"/>
                            <button type="submit" name="delete"
                                    class="text-[10px] font-bold uppercase tracking-widest text-red-400 hover:text-red-600 transition flex items-center gap-2">
                                <i class="fa-solid fa-trash-can"></i> Map verwijderen
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>

</body>
</html>