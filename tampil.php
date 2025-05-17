<?php
// create.php

// Koneksi ke database SQLite
$conn = new PDO("sqlite:database.db");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $deskripsi = $_POST["deskripsi"] ?? '';
    $waktu = $_POST["waktu"] ?? 0;

    // Validasi sederhana
    if (!empty($deskripsi) && is_numeric($waktu) && $waktu > 0) {
        // Siapkan dan jalankan query INSERT
        $sql = 'INSERT INTO tugas (deskripsi, waktu) VALUES (:deskripsi, :waktu)';
        $statement = $conn->prepare($sql);
        $statement->execute([
            ':deskripsi' => $deskripsi,
            ':waktu' => $waktu
        ]);

        // Ambil ID terakhir
        $tugas_id = $conn->lastInsertId();

        // Redirect setelah sukses
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
    <h1>Tambah Tugas Baru</h1>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="create.php">
        <label>Deskripsi:</label><br>
        <input type="text" name="deskripsi" required><br><br>

        <label>Waktu (menit):</label><br>
        <input type="number" name="waktu" required min="1"><br><br>

        <button type="submit">Simpan</button>
    </form>

    <p><a href="tampil.php">Kembali ke daftar tugas</a></p>
</body>
</html>
