<?php
// koneksi database sudah ada $conn

// Ambil id tugas dari URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $sql = 'SELECT id, deskripsi, waktu FROM tugas WHERE id = :tugas_id';
    $statement = $conn->prepare($sql);
    $statement->bindParam(':tugas_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $tugas = $statement->fetch(PDO::FETCH_ASSOC);

    if ($tugas) {
        echo '<h1>Detail Tugas</h1>';
        echo '<p><strong>ID:</strong> ' . htmlspecialchars($tugas['id']) . '</p>';
        echo '<p><strong>Deskripsi:</strong> ' . htmlspecialchars($tugas['deskripsi']) . '</p>';
        echo '<p><strong>Waktu:</strong> ' . htmlspecialchars($tugas['waktu']) . '</p>';
    } else {
        echo "Tugas dengan id $id tidak ditemukan.";
    }
} else {
    echo "ID tugas tidak valid.";
}
