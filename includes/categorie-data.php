<?php

// expects: $db already exists

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
if (!$category_id) {
    die("Geen geldige categorie gekozen.");
}

// category ophalen
$stmt = $db->prepare("SELECT category_id, name, year, cover FROM categories WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$stmt->bind_result($cid, $cname, $cyear, $ccover);

if (!$stmt->fetch()) {
    die("Categorie niet gevonden.");
}
$stmt->close();

// fotos ophalen
$fotos = [];
$stmtFotos = $db->prepare("SELECT id, image FROM photos WHERE category_id = ? ORDER BY id DESC");
$stmtFotos->bind_param("i", $category_id);
$stmtFotos->execute();
$stmtFotos->bind_result($foto_id, $foto_image);

while ($stmtFotos->fetch()) {
    $fotos[] = ['id' => $foto_id, 'image' => $foto_image];
}
$stmtFotos->close();

?>
