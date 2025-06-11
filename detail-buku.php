<?php
session_start();
include 'config/controller.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID buku tidak ditemukan.";
    exit;
}

$id_buku = intval($_GET['id']);

$query = "SELECT buku.*, kategori.nama as nama_kategori 
          FROM buku 
          LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
          WHERE buku.id_buku = $id_buku
          LIMIT 1";

$result = $db->query($query);
if ($result->num_rows == 0) {
    echo "Buku tidak ditemukan.";
    exit;
}

$buku = $result->fetch_assoc();
$loggedIn = isset($_SESSION['id']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-library Deseven - <?= htmlspecialchars($buku['judul_buku']); ?></title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color:rgb(223, 223, 223);
        }

        .detail-box {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .book-cover {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .book-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .book-meta strong {
            width: 100px;
            display: inline-block;
        }

        .btn-pinjam {
            font-weight: bold;
            padding: 10px 20px;
        }

        .back-btn {
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="mb-4">
            <a href="index.php" class="btn btn-outline-secondary back-btn">← Kembali ke Dashboard</a>
        </div>

        <?php if (isset($_GET['login_required'])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Anda harus login terlebih dahulu untuk meminjam buku.
                <a href="formLogin.php" class="btn btn-sm btn-warning ms-2">Login Sekarang</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="detail-box">
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <img src="<?= htmlspecialchars($buku['cover']); ?>" alt="<?= htmlspecialchars($buku['judul_buku']); ?>" class="book-cover" />
                </div>
                <div class="col-md-8">
                    <div class="book-title" style="font-size: 34px;"><?= htmlspecialchars($buku['judul_buku']); ?></div>
                    <div class="book-meta">
                        <p><strong>Penulis:</strong> <?= htmlspecialchars($buku['penulis']); ?></p>
                        <p><strong>Penerbit:</strong> <?= htmlspecialchars($buku['penerbit']); ?></p>
                        <p><strong>Kategori:</strong> <?= htmlspecialchars($buku['nama_kategori']); ?></p><br>
                    </div>

                    <?php if (!empty($buku['sinopsis'])): ?>
                        <hr />
                        <p><?= nl2br(htmlspecialchars($buku['sinopsis'])); ?></p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <div class="mt-4" style="display: flex; justify-content: flex-end;">
        <?php if ($loggedIn): ?>
            <a href="tambahpeminjaman.php?id_buku=<?= $buku['id_buku']; ?>" class="btn btn-success btn-pinjam">Pinjam Buku</a>
        <?php else: ?>
            <a href="?id=<?= $buku['id_buku']; ?>&login_required=true" class="btn btn-outline-success btn-pinjam">Pinjam Buku</a>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
