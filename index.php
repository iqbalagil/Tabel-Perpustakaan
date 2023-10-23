<?php
// Sisipkan konfigurasi database
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Query SQL untuk mengambil data buku
$sql = "SELECT * FROM buku";

$result = $konek->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container mx-auto mt-8">
        <h1 class="mb-4 text-2xl font-bold">Daftar Buku</h1>
        <table class="w-full border border-collapse border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2">ID Buku</th>
                    <th class="px-4 py-2">Nama Buku</th>
                    <th class="px-4 py-2">Nama Penerbit</th>
                    <th class="px-4 py-2">Nama Penulis</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='px-4 py-2'>" . $row["id_buku"] . "</td>";
                        echo "<td class='px-4 py-2'>" . $row["nama_buku"] . "</td>";
                        echo "<td class='px-4 py-2'>" . $row["nama_penerbit"] . "</td>";
                        echo "<td class='px-4 py-2'>" . $row["nama_penulis"] . "</td>";
                        echo "<td class='px-4 py-2'><a class='text-blue-500' href='update.php?id=" . $row["id_buku"] . "'>Edit</a> | <a class='text-red-500' href='delete.php?id=" . $row["id_buku"] . "'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td class='px-4 py-2' colspan='5'>Tidak ada data buku.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a class="block mt-4 text-blue-500" href="add.php">Tambah Buku Baru</a>
    </div>
</body>
</html>
