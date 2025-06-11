<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    if (delete_buku($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href ='dataBuku.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
            document.location.href ='dataBuku.php';
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
// $backLink = '#';
// if ($_SESSION['level'] == 1) {
//    $backLink = 'DashboardAdmin2.php';
// } elseif ($_SESSION['level'] == 2) {
//    $backLink = 'DashboardPetugas2.php';
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css" />
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

    <!-- Sidebar -->
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span> <span class="font-bold">DeSeven</span> </h2>
        <ul>
            <li><a href="DashboardPetugas2.php">Dashboard</a></li>
            <li><a href="dataBuku.php">Kelola Buku</a></li>
            <li><a href="dataKategori.php">Kelola Kategori</a></li>
            <li><a href="dataPeminjaman.php">Kelola Peminjaman Buku</a></li>
            <li><a href="AktivitasPetugas.php">Aktivitas</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Kelola Buku</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

    <div class="container my-5">
        <div class="mb-3">
            <a href="tambahbuku.php" class="btn btn-success">+ Add Book</a>
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
                            <th>Aksi</th>
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
                                <td class="text-center">
                                    <a href="editBuku.php?id=<?= $buku['id_buku']; ?>" class="btn btn-secondary btn-sm">Update</a>
                                    <a href="dataBuku.php?delete=<?= $buku['id_buku']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
