<?php
require_once "includes/database.php";

// 1) Read categorie_id safely from the URL
$categorie_id = filter_input(INPUT_GET, 'categorie_id', FILTER_VALIDATE_INT);

if (!$categorie_id) {
    // If someone visits categorie.php without an id
    die("Geen geldige categorie gekozen.");
}

/*Fetch the category from the database using a prepared statement*/
$stmt = $db->prepare("SELECT categorie_id, name, year, cover FROM categorieën WHERE categorie_id = ?");
$stmt->bind_param("i", $categorie_id);
$stmt->execute();
$result = $stmt->get_result();
$categorie = $result->fetch_assoc();

if (!$categorie) {
    die("Categorie niet gevonden.");
}

$foto_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$stmt = $db->prepare("SELECT id, categorie, image FROM foto's WHERE id = ?");
$stmt->bind_param("i", $foto_id);
$stmt->execute();
$result = $stmt->get_result();
$foto = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categorie['name']) ?> bewerken</title>
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
    <h1><?= htmlspecialchars($categorie['name']) ?> bewerken</h1>
    <p>Jaar: <?= htmlspecialchars($categorie['year']) ?></p>

    <img
            src="images/<?= htmlspecialchars($categorie['cover']) ?>"
            alt="Cover foto van <?= htmlspecialchars($categorie['name']) ?>"
            style="max-width: 400px; height: 400px;"
    >

    <button>
        Foto verwijderen
    </button>

    <button>
        Foto's toevoegen
    </button>


</main>
</body>
</html>
