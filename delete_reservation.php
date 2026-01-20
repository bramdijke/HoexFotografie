<?php
require_once "includes/database.php";

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = mysqli_real_escape_string($db, $_GET['id']);

    $query_file = "SELECT inspiratie_bestand FROM afspraken WHERE id = '$id'";
    $result_file = mysqli_query($db, $query_file);
    $reservation = mysqli_fetch_assoc($result_file);
    $query = "DELETE FROM afspraken WHERE id = '$id'";

    if (mysqli_query($db, $query)) {
        if (!empty($reservation['inspiratie_bestand'])) {
            $filePath = "uploads/" . $reservation['inspiratie_bestand'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        header("Location: overview.php?status=deleted");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($db);
    }
} else {
    header("Location: overview.php");
    exit;
}

mysqli_close($db);