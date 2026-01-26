<?php
require_once "includes/database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: overview.php");
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id']);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Koppelen aan de juiste database kolommen
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $email = mysqli_real_escape_string($db, $_POST['e-mail']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $appointment = mysqli_real_escape_string($db, $_POST['appointment']);
    $job = mysqli_real_escape_string($db, $_POST['job']);
    $deadline = mysqli_real_escape_string($db, $_POST['deadline']);
    $customer_type = mysqli_real_escape_string($db, $_POST['customer_type']);

    if (empty($name) || empty($email)) {
        $errors[] = "Naam en Email zijn verplichte velden.";
    }

    if (empty($errors)) {
        // Query aangepast naar de tabel 'appointments' en de juiste kolomnamen
        $updateQuery = "UPDATE appointments SET 
                        name = '$name', 
                        `e-mail` = '$email', 
                        phone = '$phone', 
                        appointment = '$appointment',
                        job = '$job',
                        deadline = '$deadline',
                        customer_type = '$customer_type' 
                        WHERE id = '$id'";

        if (mysqli_query($db, $updateQuery)) {
            header("Location: overview.php?success=1");
            exit;
        } else {
            $errors[] = "Database fout: " . mysqli_error($db);
        }
    }
}

$query = "SELECT * FROM appointments WHERE id = '$id'";
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
    <title>Reservering Bewerken - HOEX Fotografie</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans p-10">

<main class="max-w-2xl mx-auto bg-white p-8 rounded shadow-xl border-t-4 border-black">
    <h1 class="text-2xl font-black uppercase mb-8">Reservering Bewerken</h1>

    <form action="" method="POST" class="space-y-6">
        <div>
            <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Volledige Naam</label>
            <input type="text" name="name" value="<?= htmlspecialchars($res['name']) ?>"
                   class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Email</label>
                <input type="email" name="e-mail" value="<?= htmlspecialchars($res['e-mail']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Telefoon</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($res['phone']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Afspraak (Datum)</label>
                <input type="text" name="appointment" value="<?= htmlspecialchars($res['appointment']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Opdracht</label>
                <input type="text" name="job" value="<?= htmlspecialchars($res['job']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Deadline</label>
                <input type="text" name="deadline" value="<?= htmlspecialchars($res['deadline']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Soort (Klant Type)</label>
                <input type="text" name="customer_type" value="<?= htmlspecialchars($res['customer_type']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
        </div>

        <button type="submit"
                class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs hover:bg-gray-800 transition-all">
            Wijzigingen Opslaan
        </button>
    </form>
</main>

</body>
</html>