<?php
require_once "includes/database.php";
require_once "includes/category-data.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($cname) ?></title>
    <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>
<main>
    <h1><?= htmlspecialchars($cname) ?></h1>

    <?php if (empty($fotos)): ?>
        <p>Deze categorie heeft nog geen foto’s.</p>
    <?php else: ?>
        <div class="foto-grid">
            <?php foreach ($fotos as $foto): ?>
                <div class="foto-item">
                    <img src="images/<?= htmlspecialchars($foto['image']) ?>" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
