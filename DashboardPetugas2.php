

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/stylePetugas2.css">
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span>
            <span class="font-bold">DeSeven</span>
        </h2>
        <ul>
            <li><a href="DashboardPetugas2.php">Dashboard</a></li>
            <li><a href="dataBuku.php">Kelola Buku</a></li>
            <li><a href="dataKategori.php">Kelola Kategori</a></li>
            <li><a href="dataPeminjaman.php">Kelola Peminjaman Buku</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Dashboard</h1>
            <div class="search-bar">
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats">
            <div class="card">
                <span>📖</span>
                <div>
                    <h2>Total Books</h2>
                    <h3>100</h3>
                </div>
            </div>
            <div class="card">
                <span>📘</span>
                <div>
                    <h2>Books Borrowed</h2>
                    <h3>37</h3>
                </div>
            </div>
            <div class="card">
                <span>📕</span>
                <div>
                    <h2>Overdue Books</h2>
                    <h3>25</h3>
                </div>
            </div>
        </div>

        <!-- Management Sections -->
        <div class="management">
            <div class="manage-box">
                <h2>Kelola Siswa</h2>
                <p>Manajemen data siswa perpustakaan.</p>
                <a href="dataUser.php"><button>Kelola</button><a>
            </div>
        </div>
    </div>

</body>
</html>