<?php
$host = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'hoexfotographie';

$db = mysqli_connect($host, $username, $password, $database);

if (!$db) {
    die("Verbinding mislukt: " . mysqli_connect_error());
}
?>