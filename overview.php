<?php
require_once "includes/database.php";

$query = "SELECT * FROM afspraken";
$result = mysqli_query($db, $query);
$reservations = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reserveringen Overzicht - HOEX Fotografie</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body class="bg-gray-50 font-sans leading-normal tracking-normal">
<nav class="sticky-top">
    <p>HOEX</p>
    <ul>
        <li><a href="portfolio-bewerken.php">Portfolio bewerken</a></li>
        <li><a href="overview.php">Reserveringen</a></li>
    </ul>
</nav>
<main class="container mx-auto py-10 px-4">
    <section class="bg-white p-6 rounded-lg shadow-lg">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reserveringen Overzicht</h1>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                Totaal: <?= count($reservations) ?>
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-xs leading-normal">
                    <th class="py-3 px-4 text-left">Klant Naam</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-center">Telefoon</th>
                    <th class="py-3 px-4 text-center">Afspraak</th>
                    <th class="py-3 px-4 text-center">Opdracht</th>
                    <th class="py-3 px-4 text-left">Locatie</th>
                    <th class="py-3 px-4 text-left">Soort</th>
                    <th class="py-3 px-4 text-center">Inspiratie</th>
                    <th class="py-3 px-4 text-center">Acties</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">

                <?php if (empty($reservations)): ?>
                    <tr>
                        <td colspan="9" class="py-10 text-center text-gray-500 italic">
                            Er zijn momenteel geen reserveringen gevonden in de database.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($reservations as $res): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                            <td class="py-3 px-4 text-left whitespace-nowrap font-medium">
                                <?= htmlspecialchars($res['klant_naam']) ?>
                            </td>
                            <td class="py-3 px-4 text-left">
                                <?= htmlspecialchars($res['email']) ?>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <?= htmlspecialchars($res['telefoonnummer']) ?>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs">
                                    <?= htmlspecialchars($res['datum_afspraak']) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <?= htmlspecialchars($res['datum_opdracht']) ?>
                            </td>
                            <td class="py-3 px-4 text-left">
                                <?= htmlspecialchars($res['locatie']) ?>
                            </td>
                            <td class="py-3 px-4 text-left">
                                <span class="bg-gray-100 text-gray-700 py-1 px-2 rounded text-xs uppercase font-semibold">
                                    <?= htmlspecialchars($res['soort_opdracht']) ?>
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <?php if (!empty($res['inspiratie_bestand'])): ?>
                                    <a href="uploads/<?= htmlspecialchars($res['inspiratie_bestand']) ?>"
                                       class="text-blue-500 hover:underline flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.414a4 4 0 00-5.656-5.656l-6.415 6.414a6 6 0 108.486 8.486L20.5 13"></path>
                                        </svg>
                                        Bestand
                                    </a>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Geen</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="flex item-center justify-center space-x-3">
                                    <a href="edit_reservation.php?id=<?= $res['id'] ?>"
                                       class="w-4 transform hover:text-blue-500 hover:scale-110" title="Bewerken">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    <a href="delete_reservation.php?id=<?= $res['id'] ?>"
                                       onclick="return confirm('Weet je zeker dat je deze wilt verwijderen?')"
                                       class="w-4 transform hover:text-red-500 hover:scale-110" title="Verwijderen">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center text-gray-400 text-xs">
            &copy; <?= date("Y") ?> HOEX Fotografie
        </div>
    </section>
</main>

</body>
</html>