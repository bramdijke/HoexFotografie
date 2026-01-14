<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/styles/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Reservation Overview</title>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal">

<main class="container mx-auto py-10 px-4">
    <section class="bg-white p-6 rounded-lg shadow-lg">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Reserveringen Overzicht</h1>
            <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">Totaal: 5</span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Naam</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Telefoon</th>
                    <th class="py-3 px-6 text-center">Datum</th>
                    <th class="py-3 px-6 text-left">Locatie</th>
                    <th class="py-3 px-6 text-center">Acties</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <span class="font-medium">Bram van Dijke</span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        bram123@gmail.com
                    </td>
                    <td class="py-3 px-6 text-center">
                        0612345678
                    </td>
                    <td class="py-3 px-6 text-center">
                        <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-xs">20/04/2025</span>
                    </td>
                    <td class="py-3 px-6 text-left">
                        Rotterdam
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="#" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="#" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-center text-gray-400 text-xs">
            &copy; <?php echo date("Y"); ?> HOEX Fotografie
        </div>
    </section>
</main>

</body>
</html>