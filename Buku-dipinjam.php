<?php
session_start();
include 'config/controller.php';

if (!isset($_SESSION['id'])) {
    die("Akses ditolak. Silakan login terlebih dahulu.");
}

$id = intval($_SESSION['id']); // ID user login

$query = "SELECT 
            buku.judul_buku,
            buku.cover,
            peminjaman.tgl_peminjaman,
            peminjaman.tgl_pengembalian,
            detail_peminjaman.status
        FROM 
            detail_peminjaman
        JOIN buku ON buku.id_buku = detail_peminjaman.id_buku
        JOIN peminjaman ON peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman
        WHERE 
            peminjaman.id = $id AND detail_peminjaman.status = 'dipinjam'";

$result = mysqli_query($db, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku Dipinjam</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/styleSiswa.css">
    <style>
    body {
        background-color: #f0f4f8;
    }
    table {
        border-collapse: collapse;
        width: 90%;
        margin: 20px auto;
        font-family: 'Arial', sans-serif;
    }
    th, td {
        padding: 12px;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f3f8ff;
    }
    th {
        background-color: #5f8b4c;
        color: white;
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
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="KatalogPengguna.php">Katalog</a></li>
            <li><a href="Buku-dipinjam.php">Buku yang Dipinjam</a></li>
            <li><a href="PanduanPengguna.php">Panduan</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Panduan</h1>
            <div class="search-bar">
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>

    <h2 style="text-align: center; font-family: 'Arial', sans-serif;">Daftar Buku yang Sedang Dipinjam</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Cover</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
        </tr>
        <?php 
        $no = 1;
        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)) :
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['judul_buku']; ?></td>
                <td><img src="uploads/<?= $row['cover']; ?>" alt="cover" width="60" height="90"></td>
                <td><?= date('d-m-Y', strtotime($row['tgl_peminjaman'])); ?></td>
                <td><?= date('d-m-Y', strtotime($row['tgl_pengembalian'])); ?></td>
            </tr>
        <?php endwhile; else: ?>
            <tr><td colspan="5">Tidak ada data buku dipinjam</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
