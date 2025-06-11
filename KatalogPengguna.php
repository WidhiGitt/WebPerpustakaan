<?php
include 'config/controller.php';

// Ensure $db is properly initialized from controller.php
if (!isset($db)) {
    die("Database connection not established. Check config/controller.php");
}

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
               WHERE 1"; // Start with a true condition to easily append AND clauses

// Filter for books with id_buku >= 5 only if no specific category or keyword is chosen
// Otherwise, the general search and category filters should apply to all books
if (!$idKategoriTerpilih && !$keyword) {
    $querySemua .= " AND buku.id_buku >= 5";
}


if ($idKategoriTerpilih) {
    $querySemua .= " AND buku.id_kategori = $idKategoriTerpilih";
}

if ($keyword) {
    // Modify to search in title, penulis, or other relevant fields
    $querySemua .= " AND (buku.judul_buku LIKE '%$keyword%' OR buku.penulis LIKE '%$keyword%')";
}

$querySemua .= " LIMIT 10";
$resultSemua = $db->query($querySemua);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css">
</head>
<body>
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span>
            <span class="font-bold">DeSeven</span>
        </h2>
        <ul>
            <li><a href="index.php">Dashboard</a></li>
            <li><a href="KatalogPengguna.php">Katalog</a></li>
            <li><a href="Buku-dipinjam.php">Buku yang Dipinjam</a></li>
            <li><a href="PanduanPengguna.php">Panduan</a></li>
            <li><a href="AktivitasPengguna.php">Aktivitas Saya</a></li>
        </ul>
    </nav>

    <div class="content">
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Katalog</h1>
            <div class="search-bar">
                <form method="GET" action="KatalogPengguna.php" style="display: flex; gap: 5px; align-items: center;">
                    <input
                        type="text"
                        name="keyword"
                        placeholder="Cari buku..."
                        value="<?= htmlspecialchars($keyword ?? '') ?>"
                        style="padding: 6px;"
                    />
                    <?php if ($idKategoriTerpilih): ?>
                        <input type="hidden" name="kategori" value="<?= $idKategoriTerpilih ?>" />
                    <?php endif; ?>
                    <button type="submit" class="btn btn-lg">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

        <div class="content">
            <div class="category-nav">
                <a href="KatalogPengguna.php"><button>Semua</button></a>
                <?php
                // Rewind resultKategori to ensure it can be iterated if already used
                if ($resultKategori->num_rows > 0) {
                    $resultKategori->data_seek(0);
                }
                while ($row = mysqli_fetch_assoc($resultKategori)) :
                ?>
                    <a href="KatalogPengguna.php?kategori=<?= $row['id_kategori'] ?><?= $keyword ? '&keyword=' . urlencode($keyword) : '' ?>">
                        <button><?= htmlspecialchars($row['nama']) ?></button>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="recommended-books">
                <h2>Rekomendasi Buku</h2>
                <div class="book-list">
                    <?php while($row = $resultRekomendasi->fetch_assoc()): ?>
                        <div class="book-card">
                            <div class="cover-area" style="background-color: <?= htmlspecialchars($row['cover_bg_color']); ?>">
                                <a href="detail-buku.php?id=<?= $row['id_buku'] ?>">
                                    <img 
                                        src="<?= htmlspecialchars($row['cover']); ?>" 
                                        alt="<?= htmlspecialchars($row['judul_buku']); ?>" 
                                        class="cover-image"
                                    >
                                </a>
                            </div>
                                <div class="book-info">
                                    <h3><?= htmlspecialchars($row['judul_buku']); ?></h3>
                                    <p><?= htmlspecialchars($row['penulis']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <div class="list-books">
                <h2>Buku</h2>
                <div class="book-list">
                    <?php
                    // Rewind resultSemua to ensure it can be iterated if already used (unlikely here but good practice)
                    if ($resultSemua->num_rows > 0) {
                        $resultSemua->data_seek(0);
                    }
                    while($row = $resultSemua->fetch_assoc()): ?>
                        <div class="book-card">
                            <div class="cover-area" style="background-color: <?= htmlspecialchars($row['cover_bg_color']); ?>">
                                <a href="detail-buku.php?id=<?= $row['id_buku'] ?>">
                                    <img 
                                        src="<?= htmlspecialchars($row['cover']); ?>" 
                                        alt="<?= htmlspecialchars($row['judul_buku']); ?>" 
                                        class="cover-image"
                                    >
                                </a>
                            </div>
                                <div class="book-info">
                                    <h3><?= htmlspecialchars($row['judul_buku']); ?></h3>
                                    <p><?= htmlspecialchars($row['penulis']); ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>