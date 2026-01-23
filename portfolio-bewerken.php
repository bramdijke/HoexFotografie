<?php

/** @var mysqli $db */

require_once "includes/database.php";

$showForm = false;
$showDelete = false;

$query = "SELECT * FROM categories";
$results = mysqli_query($db, $query);
$categories = mysqli_fetch_all($results, MYSQLI_ASSOC);

if (isset($_POST['add'])) {
    $showForm = true;
}

if (isset($_POST['submit'])) {
    require_once "includes/image-helper.php";

    $name = mysqli_escape_string($db, $_POST['name']);
    $year = mysqli_escape_string($db, $_POST['year']);

    if ($year < 1901 || $year > 2100) {
        //echo "Jaartal moet tussen 1901 en 2100";
    } else {
        $cover = addImageFile($_FILES['cover']);

        $query = "INSERT INTO categories (name, year, cover) VALUES ('$name', '$year', '$cover')";
        $result = mysqli_query($db, $query);

        mysqli_close($db);

        header("location: portfolio-bewerken.php");

        exit;
        }

}

if (isset($_POST['delete'])) {
    $cover = $_POST['cover'];

    if (file_exists("images/$cover")) {
        unlink("images/$cover");
    }

    $categorie_id = mysqli_escape_string($db, $_POST['category_id']);

    $query = "DELETE FROM categories WHERE category_id = '$categorie_id'";
    mysqli_query($db, $query);

    mysqli_close($db);

    header("Location: portfolio-bewerken.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOEX</title>
    <link rel="stylesheet" href="styles/stylesheet.css">

</head>
<body>
    <nav class="sticky-top">
        <p>HOEX</p>
        <ul>
            <li><a href="portfolio-bewerken.php">Portfolio bewerken</a></li>
            <li><a href="overview.php">Reserveringen</a></li>
        </ul>
    </nav>
    <header>
        <!--<a href="edit.php"> Edit.php</a>-->
        <h1>Portfolio Beheren</h1>
    </header>

<main>
    <div>
        <?php if(!$showForm): ?>
            <form method="post" action="">
                <button type="submit" name="add">Map toevoegen</button>
            </form>
        <?php endif; ?>
        <?php if ($showForm): ?>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="name">Map naam</label>
                <input type="text" id="name" name="name">

                <label for="year">Jaar</label>
                <input type="number" id="year" name="year">
                <span class="has-text-danger"></span>


                <label for="cover">Cover foto</label>
                <input type="file" name="cover" id="cover">

                <button type="submit" name="submit">Map toevoegen</button>
            </form>
        <?php endif; ?>
    </div>
    <div class="portfolio-wrap">
        <button class="scroll-btn left" type="button" aria-label="Scroll left">‹</button>

        <ul class="portfolio" id="portfolioScroller">
            <?php foreach ($categories as $category){ ?>
                <li class="portfolio-item">
                    <a href="categorie.php?category_id=<?= $category['category_id'] ?>">

                    <img src="images/<?= $category['cover']; ?>" alt="Cover foto van <?= $category['name']; ?>"></a>
                    <h3><?= $category['name']; ?></h3>
                    <p><?= $category['year']; ?></p>
                    <form method="post" action="" onsubmit="return confirm('Weet je het zeker?');">
                        <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>"/>
                        <input type="hidden" name="cover" value="<?= $category['cover'] ?>"/>
                        <button type="submit" name="delete">Map verwijderen</button>
                    </form>
                </li>
            <?php } ?>
        </ul>



        <button class="scroll-btn right" type="button" aria-label="Scroll right">›</button>
    </div>
</main>
    <footer class="site-footer">
        <p>© 2024 Hoex Fotografie. All rights reserved.</p>

    </footer>

</body>
</html>

<script>
    const scroller = document.getElementById("portfolioScroller");
    const scrollAmount = 420;

    scroller.innerHTML += scroller.innerHTML;

    document.querySelector(".scroll-btn.left").addEventListener("click", () => {
        if (scroller.scrollLeft === 0) {
            scroller.scrollTo({
                left: scroller.scrollWidth,
                behavior: "smooth"
            });
        } else {
            scroller.scrollBy({ left: -scrollAmount, behavior: "smooth" });
        }
    });

    document.querySelector(".scroll-btn.right").addEventListener("click", () => {
        if (scroller.scrollLeft + scroller.clientWidth >= scroller.scrollWidth) {
            scroller.scrollTo({ left: 0, behavior: "smooth" });
        } else {
            scroller.scrollBy({ left: scrollAmount, behavior: "smooth" });
        }
    });

    scroller.addEventListener("scroll", () => {
        if (scroller.scrollLeft >= scroller.scrollWidth / 2) {
            scroller.scrollLeft = 0;
        }
    });


</script>
