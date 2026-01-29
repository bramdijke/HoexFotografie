<?php
session_start();
/** @var mysqli $db */

$errors = [];
$showForm = true;

if (isset($_POST['submit'])) {
    require_once 'includes/database.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `user` = '$email'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            mysqli_close($db);

            session_start();
            session_regenerate_id(true);
            $_SESSION['loggedIn'] = true;

            header('Location: portfolio-bewerken.php');
            exit;
        } else {
            $errors['login'] = 'Wachtwoord en email komen niet overeen.';
        }
    } else $errors['login'] = 'Wachtwoord en email komen niet overeen.';
} elseif ($_SESSION['loggedIn'] === true) {
    header('Location: portfolio-bewerken.php');
}

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
    <h1>Login</h1>
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" required>

            <label for="password">Wachtwoord</label>
            <input type="password" name="password" required>
            <span><?= isset($errors['login']) ? $errors['login'] : '' ?></span>

            <button type="submit" name="submit">Login</button>
        </form>

    <?php else: ?>
    <h1>Inlog Succesvol</h1>
    <h1><a href="overview.php">Reserveringen</a></h1>
    <h1><a href="portfolio-bewerken.php">Portfolio Beheren</a></h1>
    <?php endif; ?>



</main>
</body>
</html>