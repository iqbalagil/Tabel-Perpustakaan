<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "perpustakaan";

// Koneksi Ke Table
$konek = mysqli_connect($host, $username, $password, $database);

//Check Koneksi
if (!$konek) {
    die("Koneksi Gagal" . mysqli_connect_error());
}

?>