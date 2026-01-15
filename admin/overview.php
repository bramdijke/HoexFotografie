<?php
$reservations = [
        [
                "klant_naam" => "Bram van Dijke",
                "email" => "bram123@gmail.com",
                "telefoonnummer" => "0612345678",
                "datum_afspraak" => "20/04/2025",
                "datum_opdracht" => "25/04/2025",
                "locatie" => "Rotterdam",
                "soort_opdracht" => "Portret",
                "inspiratie_bestand" => "moodboard_urban.pdf"
        ],
        [
                "klant_naam" => "Anouk de Vries",
                "email" => "anouk.v@outlook.com",
                "telefoonnummer" => "0687654321",
                "datum_afspraak" => "22/04/2025",
                "datum_opdracht" => "01/05/2025",
                "locatie" => "Amsterdam",
                "soort_opdracht" => "Bruiloft",
                "inspiratie_bestand" => "wedding_vibes.jpg"
        ],
        [
                "klant_naam" => "Mark Janssen",
                "email" => "m.janssen@ziggo.nl",
                "telefoonnummer" => "0611223344",
                "datum_afspraak" => "05/05/2025",
                "datum_opdracht" => "10/05/2025",
                "locatie" => "Utrecht",
                "soort_opdracht" => "Productfotografie",
                "inspiratie_bestand" => "product_lighting.png"
        ],
        [
                "klant_naam" => "Sophie Bakker",
                "email" => "sophie@bakker.nl",
                "telefoonnummer" => "0655443322",
                "datum_afspraak" => "12/05/2025",
                "datum_opdracht" => "20/05/2025",
                "locatie" => "Den Haag",
                "soort_opdracht" => "Familie",
                "inspiratie_bestand" => "family_beach.pdf"
        ],
        [
                "klant_naam" => "Lars Mulder",
                "email" => "lars.m@gmail.com",
                "telefoonnummer" => "0699887766",
                "datum_afspraak" => "18/05/2025",
                "datum_opdracht" => "25/05/2025",
                "locatie" => "Eindhoven",
                "soort_opdracht" => "Evenement",
                "inspiratie_bestand" => "concert_refs.docx"
        ],
        [
                "klant_naam" => "Emma Smit",
                "email" => "emma.smit@xs4all.nl",
                "telefoonnummer" => "0612398745",
                "datum_afspraak" => "02/06/2025",
                "datum_opdracht" => "05/06/2025",
                "locatie" => "Groningen",
                "soort_opdracht" => "Zwangerschap",
                "inspiratie_bestand" => "maternity_nature.jpg"
        ],
        [
                "klant_naam" => "Thomas de Boer",
                "email" => "t.deboer@live.nl",
                "telefoonnummer" => "0644332211",
                "datum_afspraak" => "10/06/2025",
                "datum_opdracht" => "15/06/2025",
                "locatie" => "Tilburg",
                "soort_opdracht" => "Architectuur",
                "inspiratie_bestand" => "modern_minimalism.pdf"
        ],
        [
                "klant_naam" => "Lieke Hermans",
                "email" => "lieke_h@kpnmail.nl",
                "telefoonnummer" => "0677889900",
                "datum_afspraak" => "20/06/2025",
                "datum_opdracht" => "22/06/2025",
                "locatie" => "Maastricht",
                "soort_opdracht" => "Fashion",
                "inspiratie_bestand" => "vogue_style.zip"
        ],
        [
                "klant_naam" => "Daan Visser",
                "email" => "daanvisser@telfort.nl",
                "telefoonnummer" => "0622446688",
                "datum_afspraak" => "01/07/2025",
                "datum_opdracht" => "04/07/2025",
                "locatie" => "Nijmegen",
                "soort_opdracht" => "Interieur",
                "inspiratie_bestand" => "indoor_lighting.pdf"
        ],
        [
                "klant_naam" => "Julia Bosch",
                "email" => "j.bosch@home.nl",
                "telefoonnummer" => "0633557799",
                "datum_afspraak" => "15/07/2025",
                "datum_opdracht" => "20/07/2025",
                "locatie" => "Haarlem",
                "soort_opdracht" => "Zakelijk",
                "inspiratie_bestand" => "headshots_clean.jpg"
        ]
];
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reserveringen Overzicht - HOEX Fotografie</title>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

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
                            <a href="#" class="text-blue-500 hover:underline flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.414a4 4 0 00-5.656-5.656l-6.415 6.414a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <?= htmlspecialchars($res['inspiratie_bestand']) ?>
                            </a>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <div class="flex item-center justify-center space-x-3">
                                <a href="#" class="w-4 transform hover:text-blue-500 hover:scale-110" title="Bewerken">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                </a>
                                <a href="#" class="w-4 transform hover:text-red-500 hover:scale-110"
                                   title="Verwijderen">
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