<?php
/** @var mysqli $db */
require_once 'includes/database.php';
session_start();

$errors = [];
$showForm = true;

// Als de gebruiker al is ingelogd, verberg het formulier
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    $showForm = false;
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `user` = '$email'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedIn'] = true;
            $showForm = false;
        } else {
            $errors['login'] = 'Wachtwoord en email komen niet overeen.';
        }
    } else {
        $errors['login'] = 'Wachtwoord en email komen niet overeen.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HOEX Fotografie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-gray-900">

<header>
    <nav class="bg-white/90 backdrop-blur-md shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-6 py-2 flex flex-col md:grid md:grid-cols-3 items-center gap-4 md:gap-0">
            <ul class="flex items-center space-x-6 md:space-x-8 order-2 md:order-1">
                <li><a href="portfolio.php"
                       class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Portfolio</a>
                </li>
                <li><a href="reserveren.php"
                       class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">Reserveren</a>
                </li>
                <li><a href="about.php"
                       class="text-xs md:text-sm uppercase tracking-widest font-medium hover:text-gray-500 transition">About</a>
                </li>
            </ul>

            <div class="flex justify-center order-1 md:order-2">
                <a href="index.php" class="flex items-center">
                    <img src="images/hoexfotografie-logo.png" alt="hoex logo"
                         class="h-10 md:h-14 w-auto object-contain">
                </a>
            </div>

            <div class="hidden md:flex justify-end order-3">
                <div class="flex space-x-4 text-gray-500">
                    <a href="#" class="hover:text-black transition"><i class="fa-brands fa-instagram text-lg"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container mx-auto py-20 px-4">
    <section class="max-w-md mx-auto bg-white p-8 rounded shadow-xl border-t-4 border-black">

        <?php if ($showForm): ?>
            <div class="mb-8 border-b border-gray-100 pb-4 text-center">
                <h1 class="text-2xl font-black uppercase tracking-tighter text-black">Admin Login</h1>
            </div>

            <form method="post" class="space-y-6">
                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                </div>

                <div>
                    <label for="password"
                           class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Wachtwoord</label>
                    <input type="password" name="password" id="password" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">

                    <?php if (isset($errors['login'])): ?>
                        <span class="block mt-2 text-[10px] font-bold uppercase tracking-widest text-red-500">
                            <?= $errors['login'] ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="pt-4">
                    <button type="submit" name="submit"
                            class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs shadow-lg transform transition-all duration-300 hover:bg-gray-800">
                        Login
                    </button>
                </div>
            </form>

        <?php else: ?>
            <div class="text-center py-6">
                <div class="mb-6">
                    <i class="fa-solid fa-circle-check text-5xl text-green-500"></i>
                </div>
                <h1 class="text-2xl font-black uppercase tracking-tighter text-black mb-8">Inlog Succesvol</h1>

                <div class="space-y-4">
                    <a href="overview.php"
                       class="block w-full border border-black text-black font-bold py-3 rounded uppercase tracking-widest text-xs hover:bg-black hover:text-white transition-all">
                        Bekijk Reserveringen
                    </a>
                    <a href="portfolio-bewerken.php"
                       class="block w-full border border-black text-black font-bold py-3 rounded uppercase tracking-widest text-xs hover:bg-black hover:text-white transition-all">
                        Portfolio Beheren
                    </a>
                    <hr class="my-6 border-gray-100">
                    <a href="logout.php"
                       class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-red-500 transition-colors">
                        Uitloggen
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <footer class="mt-12 text-center text-gray-400 text-[10px] uppercase tracking-widest">
            &copy; <?= date("Y") ?> HOEX Fotografie
        </footer>
    </section>
</main>

</body>
</html>