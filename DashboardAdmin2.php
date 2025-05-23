

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>


    <div class="content">
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
                <h2>Kelola Petugas</h2>
                <p>Manajemen data petugas perpustakaan.</p>
                <a href="dataUser.php?filter=petugas"><button>Kelola</button></a>
            </div>
            <div class="manage-box">
                <h2>Kelola Siswa</h2>
                <p>Manajemen data siswa perpustakaan.</p>
                <a href="dataUser.php?filter=siswa"><button>Kelola</button></a>
            </div>
        </div>
    </div>


</body>
</html>