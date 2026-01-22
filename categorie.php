<?php
require_once "includes/database.php";

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

    <?php if (empty($fotos)): ?>
        <p>Deze categorie heeft nog geen foto’s.</p>
    <?php else: ?>
        <div class="foto-grid">
            <?php foreach ($fotos as $foto): ?>
                <div class="foto-item">
                    <img
                            src="images/<?= htmlspecialchars($foto['image']) ?>"
                            alt="Foto <?= htmlspecialchars($foto['id']) ?>"
                            style="width: 250px; height: 250px; object-fit: cover;"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
