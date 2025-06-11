<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_ktgr($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href ='DashboardAdmin.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
            document.location.href ='DashboardAdmin.php';
            </script>";
    }
    exit();
}

//SQL menampilkan
$data_ktgr = select("SELECT * FROM kategori");
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
        background-color: #e0e0e0;
    }
    .form-group {
        background-color: rgb(255, 255, 255);
        padding: 20px;
        border-radius: 8px;
        box-shadow:rgb(155, 155, 155) 0px 10px 20px 0px;
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
            <h1 class="page-title" style="font-weight: bold;">Data Kategori</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>


    <div class ="container">
    <div class="mb-3">
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                 <?php $id = 1; ?>
                 <?php foreach ($data_ktgr as $ktgr): ?>
                    <tr>
                        <td><?= $ktgr['id_kategori']; ?></td>
                        <td><?= $ktgr['nama']; ?></td>
                 <?php endforeach; ?>
            </tbody>
        </table>
    </div>
       
</body>
</html>
