<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_futsal"; // GANTI NAMA INI sesuai database di PHPMyAdmin Bos

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>