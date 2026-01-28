<?php
$showForm = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link rel="stylesheet" href="styles/stylesheet.css">
</head>
<body>
<header>
    <nav class="sticky-top">
        <p>HOEX</p>
    </nav>

</header>
<main>
    <?php if ($showForm): ?>
    <h1>test succes</h1>
    <?php else: ?>
    <h1><a href="overview.php">Reserveringen</a></h1>
    <h1><a href="portfolio-bewerken.php">Portfolio Beheren</a></h1>
    <?php endif; ?>



</main>
</body>
</html>