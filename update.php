<?php
// Sisipkan konfigurasi database
include 'config.php';

// Inisialisasi variabel untuk pesan kesalahan
$error = "";

// Tangani permintaan pembaruan data buku
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];
    $nama_buku = $_POST['nama_buku'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $nama_penulis = $_POST['nama_penulis'];

    // Query SQL untuk memperbarui data buku
    $sql = "UPDATE buku SET `nama_buku` = '$nama_buku', `nama_penerbit` = '$nama_penerbit', `nama_penulis` = '$nama_penulis'
            WHERE `id_buku` = $id_buku";

    if ($konek->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect kembali ke halaman daftar buku setelah pembaruan berhasil
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $konek->error;
    }
}

// Ambil data buku berdasarkan ID
$id_buku = $_GET['id'];
$sql = "SELECT * FROM buku WHERE `id_buku` = $id_buku";
$result = $konek->query($sql);
$row = $result->fetch_assoc();

// Tutup koneksi database
$konek->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-4 bg-gray-100">
    <h1 class="mb-4 text-2xl font-bold">Edit Buku</h1>

    <!-- Formulir untuk mengedit data buku -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="p-4 bg-white rounded shadow">
        <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>">
        <div class="mb-4">
            <label for="nama_buku" class="block text-gray-700">Nama Buku:</label>
            <input type="text" name="nama_buku" id="nama_buku" value="<?php echo $row['nama_buku']; ?>" class="form-input" required>
        </div>

        <div class="mb-4">
            <label for="nama_penerbit" class="block text-gray-700">Nama Penerbit:</label>
            <input type="text" name "nama_penerbit" id="nama_penerbit" value="<?php echo $row['nama_penerbit']; ?>" class="form-input" required>
        </div>

        <div class="mb-4">
            <label for="nama_penulis" class="block text-gray-700">Nama Penulis:</label>
            <input type="text" name="nama_penulis" id="nama_penulis" value="<?php echo $row['nama_penulis']; ?>" class="form-input" required>
        </div>

        <div class="text-red-500"><?php echo $error; ?></div>

        <button type="submit" class="btn btn-blue">Simpan Perubahan</button>
    </form>

    <a href="index.php" class="block mt-4 text-blue-500">Batal</a>
</body>
</html>
