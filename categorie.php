<?php
require_once "includes/database.php";

//add photo
if (isset($_POST['add_photo'])) {
    $category_id_post = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    if (!$category_id_post) {
        die("Ongeldige category_id (POST).");
    }

    // Validate upload
    if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        die("Upload mislukt.");
    }

    // Basic security: only allow images
    $allowed = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($_FILES['photo']['type'], $allowed, true)) {
        die("Alleen JPG, PNG of WEBP toegestaan.");
    }

    // Create a unique filename
    $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
    $newName = bin2hex(random_bytes(16)) . "." . strtolower($ext);

    // Save file to /images
    $targetPath = __DIR__ . "/images/" . $newName;
    if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
        die("Kon bestand niet opslaan.");
    }

    // Insert into DB
    $stmtAdd = $db->prepare("INSERT INTO photos (category_id, image) VALUES (?, ?)");
    $stmtAdd->bind_param("is", $category_id_post, $newName);
    $stmtAdd->execute();
    $stmtAdd->close();

    // Redirect back (very important)
    header("Location: categorie.php?category_id=" . $category_id_post);
    exit;
}

// ===== HANDLE DELETE PHOTO =====
if (isset($_POST['delete_photo'])) {
    $category_id_post = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
    $photo_id = filter_input(INPUT_POST, 'photo_id', FILTER_VALIDATE_INT);

    if (!$category_id_post || !$photo_id) {
        die("Ongeldige delete request.");
    }

    // 1) Get filename from DB (so you know what to delete on disk)
    $stmtGet = $db->prepare("SELECT image FROM photos WHERE id = ? AND category_id = ?");
    $stmtGet->bind_param("ii", $photo_id, $category_id_post);
    $stmtGet->execute();
    $stmtGet->bind_result($filename);

    if ($stmtGet->fetch()) {
        $stmtGet->close();

        // 2) Delete from DB
        $stmtDel = $db->prepare("DELETE FROM photos WHERE id = ? AND category_id = ?");
        $stmtDel->bind_param("ii", $photo_id, $category_id_post);
        $stmtDel->execute();
        $stmtDel->close();

        // 3) Delete file from /images (only if exists)
        $filePath = __DIR__ . "/images/" . $filename;
        if ($filename && file_exists($filePath)) {
            unlink($filePath);
        }
    } else {
        $stmtGet->close();
        die("Foto niet gevonden.");
    }

    // Redirect back
    header("Location: categorie.php?category_id=" . $category_id_post);
    exit;
}


// 1) Read category_id from URL
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if (!$category_id) {
    die("Geen geldige categorie gekozen.");
}

// 2) Fetch category
$stmt = $db->prepare("SELECT category_id, name, year, cover FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$stmt->bind_result($cid, $cname, $cyear, $ccover);

if (!$stmt->fetch()) {
    die("Categorie niet gevonden.");
}
$stmt->close();

// 3) Fetch photos for this category
$fotos = [];
$stmtFotos = $db->prepare("SELECT id, image FROM photos WHERE category_id = ? ORDER BY id DESC");
$stmtFotos->bind_param("i", $category_id);
$stmtFotos->execute();
$stmtFotos->bind_result($foto_id, $foto_image);

while ($stmtFotos->fetch()) {
    $fotos[] = [
            'id' => $foto_id,
            'image' => $foto_image
    ];
}
$stmtFotos->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($cname) ?> bewerken - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-gray-900">

<header>
    <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-2 flex flex-col md:grid md:grid-cols-3 items-center gap-4 md:gap-0">
            <ul class="flex items-center space-x-6 md:space-x-8 order-2 md:order-1">
                <li><a href="portfolio-bewerken.php"
                       class="text-xs uppercase tracking-widest font-bold border-b border-black pb-1">Portfolio
                        bewerken</a></li>
                <li><a href="overview.php"
                       class="text-xs uppercase tracking-widest font-medium hover:text-gray-500 transition">Reserveringen</a>
                </li>
            </ul>

            <div class="flex justify-center order-1 md:order-2">
                <a href="index.php" class="flex items-center">
                    <img src="images/hoexfotografie-logo.png" alt="hoex logo"
                         class="h-10 md:h-14 w-auto object-contain">
                </a>
            </div>

            <div class="hidden md:flex justify-end order-3">
                <a href="#" class="text-gray-500 hover:text-black transition"><i
                            class="fa-brands fa-instagram text-lg"></i></a>
            </div>
        </div>
    </nav>
</header>

<main class="container mx-auto px-6 py-12 max-w-6xl">

    <div class="flex flex-col md:flex-row gap-8 items-start mb-12 bg-white p-8 rounded-xl shadow-sm border border-gray-100">
        <div class="w-full md:w-64 shrink-0">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Cover Afbeelding</p>
            <img src="images/<?= htmlspecialchars($ccover) ?>"
                 alt="Cover"
                 class="w-full aspect-square object-cover rounded-lg shadow-md border border-gray-200">
        </div>

        <div class="flex-grow w-full">
            <h1 class="text-4xl font-black uppercase tracking-tighter mb-1"><?= htmlspecialchars($cname) ?></h1>
            <p class="text-gray-400 font-bold uppercase tracking-widest text-xs mb-8"><?= htmlspecialchars($cyear) ?></p>

            <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-200">
                <h3 class="text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-4">Nieuwe foto toevoegen aan
                    deze map</h3>
                <form method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-4">
                    <input type="hidden" name="category_id" value="<?= htmlspecialchars($category_id) ?>">
                    <input type="file" name="photo" id="photo" accept="image/*" required
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-black file:text-white hover:file:bg-gray-800 cursor-pointer">
                    <button type="submit" name="add_photo"
                            class="bg-black text-white px-8 py-3 rounded text-[10px] font-bold uppercase tracking-widest hover:bg-gray-800 transition shadow-lg shrink-0">
                        Uploaden
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="flex justify-between items-end mb-8">
        <h2 class="text-2xl font-black uppercase tracking-tighter">Inhoud van de map</h2>
        <span class="text-[10px] font-bold uppercase tracking-widest text-gray-400"><?= count($fotos) ?> foto's</span>
    </div>

    <?php if (empty($fotos)): ?>
        <div class="text-center py-20 bg-white rounded-xl border border-gray-100 shadow-sm">
            <p class="text-gray-400 uppercase text-xs tracking-widest">Deze categorie heeft nog geen foto’s.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($fotos as $foto): ?>
                <div class="bg-white p-3 rounded-xl shadow-sm border border-gray-100 group">
                    <div class="aspect-square overflow-hidden rounded-lg mb-3">
                        <img src="images/<?= htmlspecialchars($foto['image']) ?>"
                             alt="Foto"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <form method="POST" onsubmit="return confirm('Weet je zeker dat je deze foto wilt verwijderen?');">
                        <input type="hidden" name="category_id" value="<?= htmlspecialchars($category_id) ?>">
                        <input type="hidden" name="photo_id" value="<?= htmlspecialchars($foto['id']) ?>">
                        <button type="submit" name="delete_photo"
                                class="w-full py-2 bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-widest rounded hover:bg-red-600 hover:text-white transition-all">
                            <i class="fa-solid fa-trash-can mr-2"></i> Verwijderen
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-20 text-center">
        <a href="portfolio-bewerken.php"
           class="text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-black transition-colors">
            &larr; Terug naar mappen overzicht
        </a>
    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>

</body>
</html>

