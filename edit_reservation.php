<?php
require_once "../../includes/database.php";

// Check if ID is present
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: overview.php");
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id']);

// Handle the update logic
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klant_naam = mysqli_real_escape_string($db, $_POST['klant_naam']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $telefoon = mysqli_real_escape_string($db, $_POST['telefoonnummer']);
    $datum_afspraak = mysqli_real_escape_string($db, $_POST['datum_afspraak']);
    $datum_opdracht = mysqli_real_escape_string($db, $_POST['datum_opdracht']);
    $locatie = mysqli_real_escape_string($db, $_POST['locatie']);
    $soort = mysqli_real_escape_string($db, $_POST['soort_opdracht']);

    if (empty($klant_naam) || empty($email)) {
        $errors[] = "Naam en Email zijn verplichte velden.";
    }

    if (empty($errors)) {
        $updateQuery = "UPDATE afspraken SET 
                        klant_naam = '$klant_naam', 
                        email = '$email', 
                        telefoonnummer = '$telefoon', 
                        datum_afspraak = '$datum_afspraak',
                        datum_opdracht = '$datum_opdracht',
                        locatie = '$locatie', 
                        soort_opdracht = '$soort' 
                        WHERE id = '$id'";

        if (mysqli_query($db, $updateQuery)) {
            header("Location: overview.php?success=1");
            exit;
        } else {
            $errors[] = "Database fout: " . mysqli_error($db);
        }
    }
}

// Fetch current data
$query = "SELECT * FROM afspraken WHERE id = '$id'";
$result = mysqli_query($db, $query);
$res = mysqli_fetch_assoc($result);

if (!$res) {
    die("Reservering niet gevonden.");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering Bewerken - HOEX Fotografie</title>
    <link href="styles/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans leading-normal tracking-normal text-shadow-grey">

<main class="container mx-auto py-10 px-4">
    <section class="max-w-2xl mx-auto bg-white p-8 rounded shadow-xl border-t-4 border-shadow-grey">

        <div class="flex justify-between items-center mb-8 border-b border-gray-100 pb-4">
            <h1 class="text-2xl font-black uppercase tracking-tighter text-shadow-grey">Reservering Bewerken</h1>
            <a href="overview.php"
               class="text-xs font-bold uppercase tracking-widest text-dark-grey hover:text-black transition-colors">
                &larr; Terug
            </a>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 text-sm">
                <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-6">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Klant
                    Naam</label>
                <input type="text" name="klant_naam" value="<?= htmlspecialchars($res['klant_naam']) ?>"
                       class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($res['email']) ?>"
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Telefoonnummer</label>
                    <input type="text" name="telefoonnummer" value="<?= htmlspecialchars($res['telefoonnummer']) ?>"
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        Afspraak</label>
                    <input type="text" name="datum_afspraak" value="<?= $res['datum_afspraak'] ?>"
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Datum
                        Opdracht (Shoot)</label>
                    <input type="text" name="datum_opdracht" value="<?= htmlspecialchars($res['datum_opdracht']) ?>"
                           class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Locatie</label>
                <input type="text" name="locatie" value="<?= htmlspecialchars($res['locatie']) ?>"
                       class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-dark-grey mb-2">Soort
                    Opdracht</label>
                <select name="soort_opdracht"
                        class="w-full border border-gray-200 p-3 rounded text-sm focus:ring-1 focus:ring-shadow-grey outline-none bg-white">
                    <option value="Portret" <?= $res['soort_opdracht'] == 'Portret' ? 'selected' : '' ?>>Portret
                    </option>
                    <option value="Bruiloft" <?= $res['soort_opdracht'] == 'Bruiloft' ? 'selected' : '' ?>>Bruiloft
                    </option>
                    <option value="Zakelijk" <?= $res['soort_opdracht'] == 'Zakelijk' ? 'selected' : '' ?>>Zakelijk
                    </option>
                    <option value="Anders" <?= $res['soort_opdracht'] == 'Anders' ? 'selected' : '' ?>>Anders</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs shadow-lg transform transition-all duration-300 ease-in-out hover:scale-105 hover:bg-shadow-grey">
                    Wijzigingen Opslaan
                </button>
            </div>
        </form>

        <div class="mt-8 text-center text-gray-400 text-[10px] uppercase tracking-widest">
            &copy; <?= date("Y") ?> HOEX Fotografie
        </div>
    </section>
</main>

</body>
</html>