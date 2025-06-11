<?php
include 'config/controller.php';

// Ambil data berdasarkan level
$petugas = mysqli_query($db, "SELECT * FROM user WHERE level = 2");
$siswa = mysqli_query($db, "SELECT * FROM user WHERE level = 3");

// Contoh data dinamis dari database
$totalBooks = 9;
$booksBorrowed = 1;
$overdueBooks = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleAdmin2.css">
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
            <h1 class="page-title" style="font-weight: bold;">Dashboard</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>


     <!-- Stats Cards -->
        <div class="stats">
            <div class="card">
                <i class="fas fa-book-open icon"></i>
                <div>
                    <h2>Total Books</h2>
                    <h3><?= $totalBooks ?></h3>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-book-reader icon"></i>
                <div>
                    <h2>Books Borrowed</h2>
                    <h3><?= $booksBorrowed ?></h3>
                </div>
            </div>
            <div class="card">
                <i class="fas fa-exclamation-triangle icon"></i>
                <div>
                    <h2>Overdue Books</h2>
                    <h3><?= $overdueBooks ?></h3>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
       <div class="management">
        <div class="manage-box">
            <div class="manage-icon">
                <i class="fa-solid fa-headset"></i>
            </div>
            <h2>Kelola Petugas</h2>
            <p>Manajemen data petugas perpustakaan.</p>
            <a href="dataUser.php?filter=petugas"><button>Kelola</button></a>
        </div>

        <div class="manage-box">
            <div class="manage-icon">
                <i class="fas fa-users"></i>
            </div>
            <h2>Kelola Siswa</h2>
            <p>Manajemen data siswa perpustakaan.</p>
            <a href="dataUser.php?filter=siswa"><button>Kelola</button></a>
        </div>
    </div>


    </div>


</body>
</html>