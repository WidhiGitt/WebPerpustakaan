<?php
session_start();
include 'config/controller.php';

// Ambil semua aktivitas
$data_aktivitas = select("
    SELECT la.*, u.nama
    FROM log_aktivitas la
    JOIN user u ON la.id = u.id
    ORDER BY la.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css">
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
        .badge {
            text-transform: capitalize;
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
        <h1 class="page-title" style="font-weight: bold;">Aktivitas</h1>
        <div class="search-bar">
            <a href="formLogin.php" class="profile-icon">
                <i class="fas fa-circle-user"></i>
            </a>
        </div>
    </div>

    <div class="container my-5">
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-light table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID</th>
                            <th>Pengguna</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_aktivitas as $log): ?>
                            <tr>
                                <td class="text-center"><?= $log['id_aktivitas']; ?></td>
                                <td><?= htmlspecialchars($log['nama']); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-<?= 
                                        $log['aksi'] === 'tambah' ? 'success' : 
                                        ($log['aksi'] === 'ubah' ? 'warning text-dark' : 
                                        ($log['aksi'] === 'hapus' ? 'danger' : 'secondary')) ?>">
                                        <?= htmlspecialchars($log['aksi']); ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($log['deskripsi']); ?></td>
                                <td class="text-center"><?= date('d-m-Y H:i', strtotime($log['waktu'])); ?></td>
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
