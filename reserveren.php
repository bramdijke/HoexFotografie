<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< Updated upstream
<<<<<<< Updated upstream
    <title>Maak een Afspraak - HOEX Fotografie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Adding the custom color from your reference if not defined in tailwind config */
        .text-shadow-grey {
            color: #333333;
        }

        .border-shadow-grey {
            border-color: #333333;
        }

        .bg-shadow-grey {
            background-color: #333333;
        }

        .text-dark-grey {
            color: #666666;
        }
    </style>
=======
    <title>Edit Page</title>
    <link rel="stylesheet" href="styles/stylesheet.css">
>>>>>>> Stashed changes
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-shadow-grey">

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
                <a href="portfolio-bewerken.php" class="text-black font-medium transition duration-300 text-sm">Portfolio
                    bewerken</a>
            </li>
            <li>
                <a href="overview.php" class="text-black font-semibold pb-1 text-sm">Reserveringen</a>
            </li>
        </ul>
    </div>
</nav>

<main class="container mx-auto py-10 px-4">
    <section class="max-w-2xl mx-auto bg-white p-8 rounded shadow-xl border-t-4 border-shadow-grey">

        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-black uppercase tracking-tighter text-shadow-grey">Maak een Afspraak</h1>
            <a href="index.php"
               class="text-xs font-bold uppercase tracking-widest text-dark-grey hover:text-black transition-colors">
                &larr; Annuleren
            </a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">

            <div>
                <label for="name"
                       class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Naam</label>
                <input type="text" name="name" id="name" placeholder="Uw volledige naam" required
                       class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="email@voorbeeld.nl" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label for="phone"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Telefoonnummer</label>
                    <input type="tel" id="phone" name="phone" placeholder="06 12345678" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="appointment"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        afspraak</label>
                    <input type="date" id="appointment" name="appointment" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label for="job"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        klus</label>
                    <input type="datetime-local" id="job" name="job" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label for="deadline"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        deadline</label>
                    <input type="date" id="deadline" name="deadline" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label for="files"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Bestanden
                        toevoegen</label>
                    <input type="file" id="files" name="files[]" multiple accept="image/*,.pdf"
                           class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-black hover:file:bg-gray-200 cursor-pointer">
                </div>
            </div>

            <div>
                <label for="task" class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Soort
                    opdracht</label>
                <textarea id="task" name="task" rows="4" placeholder="Beschrijf hier de opdracht..." required
                          class="w-full border resize-none
 border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none"></textarea>
            </div>
           <div>
            <input type="radio" id="zakelijk" name="option" value="zakelijk" />
            <label for="zakelijk">zakelijk</label>

            <input type="radio" id="particulier" name="option" value="particulier" />
            <label for="particulier">particulier</label>
           </div>
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs shadow-lg transform transition-all duration-300 ease-in-out hover:scale-105 hover:bg-shadow-grey">
                    Afspraak Maken
                </button>
            </div>
        </form>

        <footer class="mt-8 text-center text-gray-400 text-[10px] uppercase tracking-widest">
            &copy; <?= date("Y") ?> HOEX Fotografie
        </footer>
    </section>
</main>
=======
    <title>Edit Page</title>
    <link rel="stylesheet" href="styles/stylesheet.css">
</head>

<header>
    <nav class="sticky-top">
        <p>HOEX</p>
        <ul>
            <li><a href="portfolio.php">Portfolio</a></li>
            <li><a href="reserveren.php">Reserveren</a></li>
            <li><a href="about.php">Over</a></li>
        </ul>
    </nav>
>>>>>>> Stashed changes
</body>
</html>
