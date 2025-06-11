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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css">
    <style>
        body {
            background-color: #f5f5f5;
        }
        .form-group {
        background-color: rgb(255, 255, 255);
        padding: 20px;
        border-radius: 8px;
        box-shadow:rgb(155, 155, 155) 0px 10px 20px 0px;
    }
        img.cover-img {
            max-width: 60px;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span>
            <span class="font-bold">DeSeven</span>
        </h2>
        <ul>
            <li><a href="DashboardAdmin2.php">Dashboard</a></li>
            <li><a href="KatalogAdmin.php">Data Buku</a></li>
            <li><a href="KategoriAdmin.php">Data Kategori</a></li>
            <li><a href="PeminjamanAdmin.php">Data Peminjaman</a></li>
            <li><a href="dataAktivitas.php">Aktivitas</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Data Buku</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

    <div class="container my-5">
        <div class="mb-3">
        </div>
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-light table-hover">
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
        </div>
    </div>
</body>
</html>
