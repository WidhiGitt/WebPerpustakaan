<?php
include 'config/controller.php';

$queryRekomendasi = "SELECT buku.*, kategori.nama
          FROM buku 
          LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
          LIMIT 4";
$resultRekomendasi = $db->query($queryRekomendasi);

$queryKategori = "SELECT * FROM kategori ORDER BY nama ASC";
$resultKategori = $db->query($queryKategori);

$idKategoriTerpilih = isset($_GET['kategori']) ? intval($_GET['kategori']) : null;
$keyword = isset($_GET['keyword']) ? mysqli_real_escape_string($db, $_GET['keyword']) : null;

$querySemua = "SELECT buku.*, kategori.nama 
               FROM buku 
               LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
               WHERE buku.id_buku >= 5";

if ($idKategoriTerpilih) {
    $querySemua .= " AND buku.id_kategori = $idKategoriTerpilih";
}

if ($keyword) {
    $querySemua .= " AND buku.judul_buku LIKE '%$keyword%'";
}

$querySemua .= " LIMIT 4";
$resultSemua = $db->query($querySemua);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/styleSiswa.css">
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
            <h1 class="page-title" style="font-weight: bold;">Katalog</h1>
            <div class="search-bar">
                <form action="index.php" method="GET" style="display: flex;">
                        <input type="text" name="keyword" placeholder="Cari buku..." value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                        <?php if (isset($_GET['kategori'])): ?>
                            <input type="hidden" name="kategori" value="<?= intval($_GET['kategori']) ?>">
                        <?php endif; ?>
                    </form>
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>

    <div class="content">
        <!-- Navigation Bar for Categories -->
        <div class="category-nav">
            <a href="index.php"><button>Semua</button></a>
                <?php while ($row = mysqli_fetch_assoc($resultKategori)) : ?>
                    <a href="index.php?kategori=<?= $row['id_kategori'] ?>">
                        <button><?= htmlspecialchars($row['nama']) ?></button>
                    </a>
                <?php endwhile; ?>
        </div>

        <!-- Recommended Books Section -->
        <div class="recommended-books">
            <h2>Rekomendasi Buku</h2>
           <div class="book-list">
                <?php while($row = $resultRekomendasi->fetch_assoc()): ?>
                    <div class="book-card">
                        <div class="cover-area" style="background-color: <?= htmlspecialchars($row['cover_bg_color']); ?>">
                            <img 
                                src="<?= htmlspecialchars($row['cover']); ?>" 
                                alt="<?= htmlspecialchars($row['judul_buku']); ?>" 
                                class="cover-image"
                            >
                        </div>
                        <div class="book-info">
                            <h3><?= htmlspecialchars($row['judul_buku']); ?></h3>
                            <p><?= htmlspecialchars($row['penulis']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        <div class="list-books">
            <h2>Buku</h2>
            <div class="book-list">
                <?php while($row = $resultSemua->fetch_assoc()): ?>
                    <div class="book-card">
                        <div class="cover-area" style="background-color: <?= htmlspecialchars($row['cover_bg_color']); ?>">
                            <img 
                                src="<?= htmlspecialchars($row['cover']); ?>" 
                                alt="<?= htmlspecialchars($row['judul_buku']); ?>" 
                                class="cover-image"
                            >
                        </div>
                        <div class="book-info">
                            <h3><?= htmlspecialchars($row['judul_buku']); ?></h3>
                            <p><?= htmlspecialchars($row['penulis']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

</body>
</html>