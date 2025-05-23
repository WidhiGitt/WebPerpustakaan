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
$querySemua = "SELECT buku.*, kategori.nama 
               FROM buku 
               LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
               WHERE buku.id_buku >= 5
               LIMIT 4";
if ($idKategoriTerpilih) {
    $querySemua .= " AND buku.id_kategori = $idKategoriTerpilih";
}
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

    <style>
    @keyframes slideUp {
    0% {
        transform: translateY(30px);
    }
    100% {
        transform: translateY(0);
    }
    }

    .animate-slide-up {
    animation: slideUp 0.8s ease-out forwards;
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
            <h1 class="page-title" style="font-weight: bold;">Dashboard</h1>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <a class="profile-icon" href="formLogin.php">👤</a>
            </div>
        </div>

    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="8000">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner" style="height: 300px;">
    <div class="carousel-item active">
      <img src="https://i.pinimg.com/736x/11/05/79/110579741c2e557d39f9f1bc13ba969f.jpg" class="d-block w-100 h-100 object-fit-cover" alt="slide1">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.pinimg.com/736x/30/a8/bd/30a8bdf7406249fb5e6c718b1c3da6a9.jpg" class="d-block w-100 h-100 object-fit-cover" alt="slide2">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="https://i.pinimg.com/736x/da/75/85/da7585deb1f0d31d0e8230f0e6da7d0b.jpg" class="d-block w-100 h-100 object-fit-cover" alt="slide3">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <div class="content" id="mainContent">
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
                                    <a href="detail-buku.php?id=<?= $row['id_buku'] ?>">
                                        <img 
                                            src="<?= htmlspecialchars($row['cover']); ?>" 
                                            alt="<?= htmlspecialchars($row['judul_buku']); ?>" 
                                            class="cover-image"
                                        >
                                    </a>
                                </div>
                                <div class="book-info">
                                    <h3>
                                        <a href="detail-buku.php?id=<?= $row['id_buku'] ?>" style="text-decoration:none; color:inherit;">
                                            <?= htmlspecialchars($row['judul_buku']); ?>
                                        </a>
                                    </h3>
                                    <p><?= htmlspecialchars($row['penulis']); ?></p>
                                </div>
                            </div>
                                            <?php endwhile; ?>
                                </div>
                            </div>


        <div class="list-books">
            <h2>Buku</h2>
            <div class="book-list">
                <?php while($row = $resultSemua->fetch_assoc()): ?>
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
                            <h3>
                                <a href="detail-buku.php?id=<?= $row['id_buku'] ?>" style="text-decoration:none; color:inherit;">
                                    <?= htmlspecialchars($row['judul_buku']); ?>
                                </a>
                            </h3>
                            <p><?= htmlspecialchars($row['penulis']); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?><br>
            <div style="display: flex; justify-content: flex-end;">
                <a href="KatalogPengguna.php" class="btn btn-success">Lihat Semua</a>
            </div>
        </div>
    </div>

    <script>
    // Pastikan carousel diinisialisasi
    const myCarousel = document.querySelector('#carouselExampleDark');
    const carousel = new bootstrap.Carousel(myCarousel, {
        interval: 3000,
        ride: 'carousel',
        pause: false, // agar tidak berhenti saat hover
        wrap: true     // agar loop terus
    });
    </script>

    <script>
    window.addEventListener("DOMContentLoaded", () => {
        const el = document.getElementById("mainContent");
        el.classList.remove("opacity-0");
        el.classList.add("animate-slide-up");
    });
    </script>

</body>
</html>