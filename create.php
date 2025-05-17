<?php
// create.php

// Menampilkan error jika ada (untuk debugging)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi ke SQLite
$conn = new PDO("sqlite:database.db");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $deskripsi = $_POST["deskripsi"] ?? '';
    $waktu = $_POST["waktu"] ?? 0;

    // Validasi sederhana
    if (!empty($deskripsi) && is_numeric($waktu) && $waktu > 0) {
        $sql = 'INSERT INTO tugas (deskripsi, waktu) VALUES (:deskripsi, :waktu)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':deskripsi' => $deskripsi,
            ':waktu' => $waktu
        ]);

        header("Location: tampil.php");
        exit;
    } else {
        $error = "Deskripsi dan waktu harus diisi dengan benar.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
</head>
<body>
    <h1>Tambah Tugas</h1>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="create.php">
        <label>Deskripsi:</label><br>
        <input type="text" name="deskripsi" required><br><br>

        <label>Waktu (menit):</label><br>
        <input type="number" name="waktu" required min="1"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="tampil.php">Lihat Daftar Tugas</a></p>
</body>
</html>
