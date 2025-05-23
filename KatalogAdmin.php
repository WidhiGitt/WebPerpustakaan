<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (delete_ktgr($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');            
            </script>";
    }
    exit();
}

$data_buku = select("
    SELECT buku.*, kategori.nama
    FROM buku 
    JOIN kategori ON buku.id_kategori = kategori.id_kategori
");

// Redirect berdasarkan level
$backLink = '#';
if ($_SESSION['level'] == 1) {
    $backLink = 'DashboardAdmin2.php';
} elseif ($_SESSION['level'] == 2) {
    $backLink = 'DashboardPetugas2.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .form-group {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        img.cover-img {
            max-width: 60px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Data Buku</h1>
        <div class="mb-3">
        </div>
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Penulis</th>
                            <th>Penerbit</th>
                            <th>Cover</th>
                            <th>Warna BG</th>
                            <th>Tahun</th>
                            <th>Jumlah</th>
                            <th>Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_buku as $buku): ?>
                            <tr>
                                <td class="text-center"><?= $buku['id_buku']; ?></td>
                                <td><?= $buku['judul_buku']; ?></td>
                                <td><?= $buku['penulis']; ?></td>
                                <td><?= $buku['penerbit']; ?></td>
                                <td class="text-center">
                                    <?php if (!empty($buku['cover'])): ?>
                                        <img src="<?= htmlspecialchars($buku['cover']) ?>" class="cover-img" alt="Cover">
                                    <?php else: ?>
                                        <span class="text-muted">No image</span>
                                    <?php endif; ?>
                                </td>
                                <td style="background-color: <?= htmlspecialchars($buku['cover_bg_color']); ?>;"></td>
                                <td class="text-center"><?= $buku['tahun_terbit']; ?></td>
                                <td class="text-center"><?= $buku['jumlah_buku']; ?></td>
                                <td class="text-center"><?= $buku['nama']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <a href="<?= $backLink ?>" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
