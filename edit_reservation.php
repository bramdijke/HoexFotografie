<?php
require_once "includes/database.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: overview.php");
    exit;
}

$id = mysqli_real_escape_string($db, $_GET['id']);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize all inputs including surname
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']); // Added
    $email = mysqli_real_escape_string($db, $_POST['e-mail']);
    $phone = mysqli_real_escape_string($db, $_POST['phone']);
    $appointment = mysqli_real_escape_string($db, $_POST['appointment']);
    $job = mysqli_real_escape_string($db, $_POST['job']);
    $deadline = mysqli_real_escape_string($db, $_POST['deadline']);
    $customer_type = mysqli_real_escape_string($db, $_POST['customer_type']);

    if (empty($name) || empty($surname) || empty($email)) {
        $errors[] = "Voornaam, Achternaam en Email zijn verplichte velden.";
    }

    if (empty($errors)) {
        // Updated query to include surname
        $updateQuery = "UPDATE appointments SET 
                        name = '$name', 
                        surname = '$surname', 
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
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-black uppercase tracking-tighter">Reservering Bewerken</h1>
        <a href="overview.php" class="text-[10px] font-bold uppercase text-gray-400 hover:text-black">&larr; Terug</a>
    </div>

    <?php if (!empty($errors)): ?>
        <div class="bg-red-50 text-red-600 p-4 mb-6 rounded text-xs font-bold uppercase tracking-widest">
            <?php foreach ($errors as $error) echo $error . "<br>"; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-6">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Voornaam</label>
                <input type="text" name="name" value="<?= htmlspecialchars($res['name']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Achternaam</label>
                <input type="text" name="surname" value="<?= htmlspecialchars($res['surname']) ?>"
                       class="w-full border p-3 rounded text-sm outline-none focus:ring-1 focus:ring-black">
            </div>
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
                <label class="block text-[10px] font-bold uppercase text-gray-500 mb-2">Opdracht (Datum/Tijd)</label>
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
                class="w-full bg-black text-white font-bold py-4 rounded uppercase tracking-widest text-xs hover:bg-gray-800 transition-all shadow-lg">
            Wijzigingen Opslaan
        </button>
    </form>
</main>

</body>
</html>