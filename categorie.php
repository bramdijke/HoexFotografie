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
    <title><?= htmlspecialchars($cname) ?> bewerken</title>
    <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>
<header>
    <nav class="sticky-top">
        <p>HOEX</p>
        <ul>
            <li><a href="portfolio-bewerken.php">Portfolio bewerken</a></li>
            <li><a href="overview.php">Reserveringen</a></li>
        </ul>
    </nav>
</header>

<main>
    <h1><?= htmlspecialchars($cname) ?> bewerken</h1>
    <p>Jaar: <?= htmlspecialchars($cyear) ?></p>

    <img
            src="images/<?= htmlspecialchars($ccover) ?>"
            alt="Cover foto van <?= htmlspecialchars($cname) ?>"
            style="max-width: 400px; height: 400px;"
    >

    <h2>Foto’s in <?= htmlspecialchars($cname) ?></h2>

    <?php if (empty($fotos)){ ?>
        <p>Deze categorie heeft nog geen foto’s.</p>
    <?php } else{ ?>
        <div class="foto-grid">
            <?php foreach ($fotos as $foto){ ?>
                <div class="foto-item">
                    <img
                            src="images/<?= htmlspecialchars($foto['image']) ?>"
                            alt="Foto <?= htmlspecialchars($foto['id']) ?>"
                            style="width: 250px; height: 250px; object-fit: cover;"
                    >
                </div>
            <?php }; ?>
        </div>
    <?php }; ?>
<!--Add to category-->
    <form method="POST" enctype="multipart/form-data" style="margin: 16px 0;">
        <input type="hidden" name="category_id" value="<?= htmlspecialchars($category_id) ?>">

        <label for="photo">Foto toevoegen:</label>
        <input type="file" name="photo" id="photo" accept="image/*" required>

        <button type="submit" name="add_photo">Upload</button>
    </form>
<!--Delete from category-->
    <form method="POST" onsubmit="return confirm('Weet je zeker dat je deze foto wilt verwijderen?');">
        <input type="hidden" name="category_id" value="<?= htmlspecialchars($category_id) ?>">
        <input type="hidden" name="photo_id" value="<?= htmlspecialchars($foto['id']) ?>">
        <button type="submit" name="delete_photo">Verwijderen</button>
    </form>


</main>
</body>
</html>

