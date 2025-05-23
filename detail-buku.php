<?php
include 'config/controller.php';

// Cek apakah ada parameter id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID buku tidak ditemukan.";
    exit;
}

$id_buku = intval($_GET['id']);

// Query data buku sesuai id
$query = "SELECT buku.*, kategori.nama as nama_kategori 
          FROM buku 
          LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
          WHERE buku.id_buku = $id_buku
          LIMIT 1";

$result = $db->query($query);
if ($result->num_rows == 0) {
    echo "Buku tidak ditemukan.";
    exit;
}

$buku = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Buku - <?= htmlspecialchars($buku['judul_buku']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Dashboard</a>
        
        <div class="row">
            <div class="col-md-4">
                <img src="<?= htmlspecialchars($buku['cover']); ?>" alt="<?= htmlspecialchars($buku['judul_buku']); ?>" class="img-fluid" />
            </div>
            <div class="col-md-8">
                <h2><?= htmlspecialchars($buku['judul_buku']); ?></h2>
                <p><strong>Penulis:</strong> <?= htmlspecialchars($buku['penulis']); ?></p>
                <p><strong>Penerbit:</strong> <?= htmlspecialchars($buku['penerbit']); ?></p>
                <p><strong>Kategori:</strong> <?= htmlspecialchars($buku['nama_kategori']); ?></p>
                <hr />
                <p>sinopsis</p>
                <a href="tambahpeminjaman.php?id_buku=<?= $buku['id_buku']; ?>" class="btn btn-primary mt-3">Pinjam Buku</a>
            </div>
        </div>
    </div>
</body>
</html>
