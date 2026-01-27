<?php
require_once "includes/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $appointment = mysqli_real_escape_string($db, $_POST['appointment']);
    $job = mysqli_real_escape_string($db, $_POST['job']);
    $deadline = mysqli_real_escape_string($db, $_POST['deadline']);
    $info = mysqli_real_escape_string($db, $_POST['task']);
    $customer_type = mysqli_real_escape_string($db, $_POST['option']);

    $query = "INSERT INTO appointments (name, surname, `e-mail`, phone, appointment, job, deadline, info, file, customer_type) 
              VALUES ('$name', '$surname', '$email', '$phone', '$appointment', '$job', '$deadline', '$info', '', '$customer_type')";

    if (mysqli_query($db, $query)) {
        echo "<script>alert('Afspraak succesvol verzonden!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($db);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maak een Afspraak - HOEX Fotografie</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="datetime-local"]::-webkit-calendar-picker-indicator {
            filter: grayscale(100%) brightness(0%);
            cursor: pointer;
            opacity: 0.6;
        }

        input[type="date"]::-webkit-calendar-picker-indicator:hover,
        input[type="datetime-local"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-gray-900">

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
                <img src="images/hoexfotografie-logo.png" alt="hoex logo" class="h-10 md:h-14 w-auto object-contain">
            </a>
        </div>

        <div class="hidden md:flex justify-end order-3">
            <div class="flex space-x-4 text-gray-500">
                <a href="#" class="hover:text-black transition"><i class="fa-brands fa-instagram text-lg"></i></a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto py-10 px-4">
    <section class="max-w-2xl mx-auto bg-white p-8 rounded shadow-xl border-t-4 border-black">

        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-black uppercase tracking-tighter text-black">Maak een Afspraak</h1>
            <a href="index.php"
               class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">
                &larr; Annuleren
            </a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data" class="space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Voornaam</label>
                    <input type="text" name="name" id="name" placeholder="Bijv. Jan" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                </div>
                <div>
                    <label for="surname"
                           class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Achternaam</label>
                    <input type="text" name="surname" id="surname" placeholder="Bijv. Jansen" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="email@voorbeeld.nl" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                </div>
                <div>
                    <label for="phone" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Telefoonnummer</label>
                    <input type="tel" id="phone" name="phone" placeholder="06 12345678" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="appointment"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        afspraak</label>
                    <input type="date" id="appointment" name="appointment" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none">
                </div>
                <div>
                    <label for="job"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        klus</label>
                    <input type="datetime-local" id="job" name="job" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none">
                </div>
                <div>
                    <label for="deadline"
                           class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        deadline</label>
                    <input type="datetime-local" id="deadline" name="deadline" required
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none">
                </div>
                <div>
                    <label for="files" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Bestand</label>
                    <input type="file" id="files" name="files" accept="image/*,.pdf"
                        class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-bold file:bg-gray-100 file:text-black hover:file:bg-gray-200 cursor-pointer">
                </div>
            </div>

            <div>
                <label for="task" class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-2">Soort
                    opdracht</label>
                <textarea id="task" name="task" rows="4" placeholder="Beschrijf hier de opdracht..." required
                          class="w-full border resize-none border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-black focus:border-black outline-none"></textarea>
            </div>

            <div class="py-2">
                <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-500 mb-4">Type
                    Klant</label>
                <div class="flex space-x-6"><label class="flex items-center cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" id="zakelijk" name="option" value="zakelijk" class="hidden peer"
                                   required>
                            <div class="w-4 h-4 border border-gray-300 rounded-full peer-checked:border-black transition-all"></div>
                            <div class="absolute w-2 h-2 bg-black rounded-full scale-0 peer-checked:scale-100 transition-transform duration-200"></div>
                        </div>
                        <span class="ml-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 peer-checked:text-black transition-colors">Zakelijk</span>
                    </label>

                    <label class="flex items-center cursor-pointer group">
                        <div class="relative flex items-center justify-center">
                            <input type="radio" id="particulier" name="option" value="particulier" class="hidden peer">
                            <div class="w-4 h-4 border border-gray-300 rounded-full peer-checked:border-black transition-all"></div>
                            <div class="absolute w-2 h-2 bg-black rounded-full scale-0 peer-checked:scale-100 transition-transform duration-200"></div>
                        </div>
                        <span class="ml-2 text-[10px] font-bold uppercase tracking-widest text-gray-400 peer-checked:text-black transition-colors">Particulier</span>
                    </label>

                </div>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs shadow-lg transform transition-all duration-300 hover:bg-gray-800">
                    Afspraak Maken
                </button>
            </div>
        </form>

        <footer class="mt-8 text-center text-gray-400 text-[10px] uppercase tracking-widest">
            &copy; <?= date("Y") ?> HOEX Fotografie
        </footer>
    </section>
</main>
</body>
</html>