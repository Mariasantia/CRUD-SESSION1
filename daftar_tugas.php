<?php
// koneksi ke database (pastikan sudah ada $conn)
$sql = 'SELECT id, deskripsi, waktu FROM tugas';
$statement = $conn->query($sql);
$tugas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Daftar Tugas</h1>
<ul>
<?php if ($tugas): ?>
    <?php foreach ($tugas as $t): ?>
        <li>
            <a href="detail_tugas.php?id=<?= htmlspecialchars($t['id']) ?>">
                <?= htmlspecialchars($t['deskripsi']) ?> (<?= htmlspecialchars($t['waktu']) ?>)
            </a>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <li>Tidak ada tugas.</li>
<?php endif; ?>
</ul>
