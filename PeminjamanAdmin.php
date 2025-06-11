<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_ktgr($id) > 0) {
        echo "<script>alert('Data Berhasil Dihapus');</script>";
    } else {
        echo "<script>alert('Gagal Menghapus Data');</script>";
    }
    exit();
}

//SQL menampilkan
$data_dp = select("
    SELECT dp.*, dp.status, p.tgl_peminjaman, p.tgl_pengembalian, p.tgl_bukukembali, p.id
    FROM detail_peminjaman dp
    JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
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
    <link rel="stylesheet" href="style/styleSiswa.css" />
    <style>
        body {
            background-color: #e0e0e0;
        }
        .form-group {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 10px 20px 0px rgb(155, 155, 155);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h2><span class="font-normal">E-library</span> <span class="font-bold">DeSeven</span></h2>
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
            <h1 class="page-title fw-bold">Data Peminjaman</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

        <div class="container">
            <div class="mb-3">
                <div class="form-group">
                    <table class="table table-light table-hover">
                        <thead>
                            <tr>
                                <th>ID Detail Peminjaman</th>
                                <th>ID Peminjaman</th>
                                <th>ID Buku</th>
                                <th>ID Peminjam</th>
                                <th>Tanggal Peminjaman</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Tanggal Buku Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_dp as $dp): ?>
                                <tr>
                                    <td><?= $dp['id_DP']; ?></td>
                                    <td><?= $dp['id_peminjaman']; ?></td>
                                    <td><?= $dp['id_buku']; ?></td>
                                    <td><?= $dp['id']; ?></td>
                                    <td><?= $dp['tgl_peminjaman']; ?></td>
                                    <td><?= $dp['tgl_pengembalian']; ?></td>
                                    <td><?= $dp['tgl_bukukembali']; ?></td>
                                    <td>
                                        <?php if ($dp['status'] == 'dikembalikan'): ?>
                                            <span class="badge bg-success">Dikembalikan</span>
                                        <?php elseif ($dp['status'] == 'dipinjam'): ?>
                                            <span class="badge bg-warning text-dark">Dipinjam</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Tidak Diketahui</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
