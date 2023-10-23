<?php
// Sisipkan konfigurasi database
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Inisialisasi variabel untuk pesan kesalahan
$error = "";

// Tangani permintaan penghapusan data buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];

    // Query SQL untuk menghapus data buku
    $sql = "DELETE FROM buku WHERE `id_buku` = $id_buku";

    if ($konek->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect kembali ke halaman daftar buku setelah penghapusan berhasil
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $konek->error;
    }
}

// Tutup koneksi database
$konek->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4 bg-gray-100">
    <h1 class="text-2xl font-bold">Hapus Buku</h1>

    <p class="text-gray-700">Apakah Anda yakin ingin menghapus buku ini?</p>

    <!-- Formulir untuk mengkonfirmasi penghapusan buku -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="id_buku" value="<?php echo $_GET['id']; ?>">
        <button type="submit" class="p-2 text-white bg-red-500 rounded">Hapus Buku</button>
    </form>

    <div class="text-red-500"><?php echo $error; ?></div>

    <a href="index.php" class="block mt-4 text-blue-500">Batal</a>
</body>
</html>
