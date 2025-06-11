<?php
session_start();
include 'config/controller.php';

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: formLogin.php");
    exit;
}

$user_id = $_SESSION['id']; // Ambil ID pengguna dari session

// Ambil aktivitas spesifik untuk pengguna yang sedang login
// Filter 'aksi' hanya untuk 'Login berhasil', 'meminjam', 'mengembalikan'
$data_aktivitas = select("
    SELECT la.*, u.nama
    FROM log_aktivitas la
    JOIN user u ON la.id = u.id
    WHERE la.id = '$user_id'
    AND (la.deskripsi LIKE '%Login berhasil%' OR la.deskripsi LIKE '%meminjam buku%' OR la.deskripsi LIKE '%mengembalikan buku%')
    ORDER BY la.id DESC
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven - Aktivitas Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css"> <style>
        body {
            background-color: #f5f5f5;
        }
        .form-group { /* This class name might be misleading for a table container, consider renaming in your CSS */
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }
        .badge {
            text-transform: capitalize;
            /* Ensure text contrast for warning badge */
            color: #212529 !important; /* For warning, ensures dark text */
        }
        /* Specific badge colors for user activities */
        .badge.bg-login { background-color: #0d6efd !important; color: white !important;} /* Blue for login */
        .badge.bg-pinjam { background-color: #198754 !important; color: white !important;} /* Green for borrowed */
        .badge.bg-kembali { background-color: #fd7e14 !important; color: white !important;} /* Orange for returned */
        /* If you have different 'aksi' values for these in the DB, adjust the badge logic */
    </style>
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
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Panduan</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

    <div class="container my-5">
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-light table-hover">
                    <thead class="table-light text-center">
                        <tr>
                            <th>ID Aktivitas</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data_aktivitas)): ?>
                            <?php foreach ($data_aktivitas as $log): ?>
                                <tr>
                                    <td class="text-center"><?= $log['id_aktivitas']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $badge_class = 'secondary';
                                        $aksi_text = htmlspecialchars($log['aksi']); // Default from DB or use $log['deskripsi'] for more detail

                                        // Determine badge color and action text based on description
                                        if (strpos($log['deskripsi'], 'Login berhasil') !== false) {
                                            $badge_class = 'login';
                                            $aksi_text = 'Login';
                                        } elseif (strpos($log['deskripsi'], 'meminjam buku') !== false) {
                                            $badge_class = 'pinjam';
                                            $aksi_text = 'Peminjaman';
                                        } elseif (strpos($log['deskripsi'], 'mengembalikan buku') !== false) {
                                            $badge_class = 'kembali';
                                            $aksi_text = 'Pengembalian';
                                        }
                                        ?>
                                        <span class="badge bg-<?= $badge_class ?>">
                                            <?= $aksi_text; ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($log['deskripsi']); ?></td>
                                    <td class="text-center"><?= date('d-m-Y H:i', strtotime($log['waktu'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada aktivitas yang tercatat untuk Anda.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>