<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_ktgr($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href ='dataKategori.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
            document.location.href ='dataKategori.php';
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
    <link rel="stylesheet" href="style/styleSiswa.css" />
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
            <h1 class="page-title" style="font-weight: bold;">Kelola Kategori</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

    <div class ="container">
        <a href="tambahkategori.php" class="btn btn-success">+ Add Category</a><br><br>
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                 <?php $id = 1; ?>
                 <?php foreach ($data_ktgr as $ktgr): ?>
                    <tr>
                        <td><?= $ktgr['id_kategori']; ?></td>
                        <td><?= $ktgr['nama']; ?></td>
                        <td>
                        <a href="editKategori.php?id=<?= $ktgr['id_kategori']; ?>" class="btn btn-secondary">Update</a>
                        <a href="dataKategori.php?delete=<?= $ktgr['id_kategori']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
    </div>
       
</body>
</html>
