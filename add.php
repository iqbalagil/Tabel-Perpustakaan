<?php
// Sisipkan konfigurasi database
include 'config.php';

// Inisialisasi variabel untuk pesan kesalahan
$error = "";

// Tangani permintaan penambahan data buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_buku = $_POST['nama_buku'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $nama_penulis = $_POST['nama_penulis'];

    // Query SQL untuk menambahkan data buku dengan nilai ID buku yang diinkrementasi otomatis
    $sql = "INSERT INTO buku (`nama_buku`, `nama_penerbit`, `nama_penulis`)
            VALUES ('$nama_buku', '$nama_penerbit', '$nama_penulis')";

    if ($konek->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect kembali ke halaman daftar buku setelah penambahan berhasil
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
    <title>Tambah Buku Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4 bg-gray-100">
    <h1 class="mb-4 text-2xl font-bold">Tambah Buku Baru</h1>

    <!-- Formulir untuk menambahkan buku -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="p-4 bg-white rounded shadow">
        <div class="mb-4">
            <label for="nama_buku" class="block text-gray-700">Nama Buku:</label>
            <input type="text" name="nama_buku" id="nama_buku" class="form-input" required>
        </div>

        <div class="mb-4">
            <label for="nama_penerbit" class="block text-gray-700">Nama Penerbit:</label>
            <input type="text" name="nama_penerbit" id="nama_penerbit" class="form-input" required>
        </div>

        <div class="mb-4">
            <label for="nama_penulis" class="block text-gray-700">Nama Penulis:</label>
            <input type="text" name="nama_penulis" id="nama_penulis" class="form-input" required>
        </div>

        <div class="text-red-500"><?php echo $error; ?></div>

        <button type="submit" class="btn btn-blue">Tambahkan Buku</button>
    </form>

    <a href="index.php" class="block mt-4 text-blue-500">Kembali ke Daftar Buku</a>
</body>
</html>
