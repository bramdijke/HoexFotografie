<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header>
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-2 flex justify-between items-center">

            <div class="flex items-center">
                <a href="index.php" class="flex items-center">
                    <img src="images/hoexfotografie-logo.png"
                         alt="hoexfotografie logo"
                         class="h-10 w-auto py-1 object-contain hover:opacity-80 transition duration-300">
                </a>
            </div>

            <ul class="flex items-center space-x-6">
                <li>
                    <a href="portfolio.php"
                       class="text-black font-semibold pb-1 text-sm">
                        Portfolio
                    </a>
                </li>
                <li>
                    <a href="reserveren.php"
                       class="text-black font-semibold pb-1 text-sm">
                        Reserveren
                    </a>
                </li>
                <li>
                    <a href="about.php"
                       class="text-black font-semibold pb-1 text-sm">
                        Over mij
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container mx-auto min-h-[80vh] flex items-center justify-center px-6 py-12">
    <div class="flex flex-col md:flex-row items-center max-w-5xl w-full gap-20">

        <div class="w-full md:w-2/5">
            <div class="relative group">
                <div class="absolute"></div>
                <img src="images/hoexselfie.png"
                     alt="selfie van hoex"
                     class="relative w-full grayscale object-cover shadow-2xl">
            </div>
        </div>

        <div class="w-full md:w-3/5 space-y-6">
            <div>
                <h1 class="text-6xl md:text-7xl font-black uppercase tracking-tighter text-slate-900 leading-none">
                    About Me
                </h1>
                <p class="text-gray-700 font-bold uppercase tracking-widest text-sm mt-4">
                    KJELL HOEXUM - FOTOGRAAF
                </p>
            </div>

            <div class="max-w-xl">
                <p class="text-gray-500 leading-relaxed text-lg">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore
                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla
                    pariatur.
                </p>
            </div>

            <div class="flex space-x-8 pt-4">
                <a href="https://www.linkedin.com/in/hoexfotografie/" target="_blank"
                   class="text-slate-800 hover:text-slate-600 transition-colors text-3xl">
                    <i class="fa-brands fa-linkedin"></i>
                </a>
                <a href="https://www.instagram.com/hoexfotografie/" target="_blank"
                   class="text-slate-800 hover:text-slate-600 transition-colors text-3xl">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="text-slate-800 hover:text-slate-600 transition-colors text-3xl">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>

    </div>
</main>

<footer class="text-center py-8 text-gray-400 text-xs uppercase tracking-widest">
    &copy; <?= date("Y") ?> HOEX Fotografie
</footer>

</body>
</html>