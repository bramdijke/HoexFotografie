<?php
include "includes/database.php";

/*Add button en delete button op gekozen categorie*/
/*for each afbeelding een verwijder button en toevoegen*/
//op to

$categorie_id = mysqli_escape_string($db, $_GET['categorie_id']);
$query = "SELECT * FROM categorieën where categorie_id = '$categorie_id'";
$results = mysqli_query($db, $query);
$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>


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
            <li><a href="portfolio-bewerken.php">Portfolio bewerken</a></li>
            <li><a href="overview.php">Reserveringen</a></li>
        </ul>
    </nav>
</header>
<main>
    <h1>Bewerken</h1>

</main>
</body>
</html>
