<?php
session_start();
include "config/controller.php";

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: formLogin.php?redirect=tambahpeminjaman.php");
    exit;
}

// Proses tambah peminjaman
if (isset($_POST['tambah'])) {
    if (create_pmnjmn($_POST) > 0) {
        echo "<script>alert('Data Berhasil Ditambahkan');</script>";
    } else {
        echo "<script>alert('Data Gagal Ditambahkan');</script>";
    }
}

// Ambil ID user dari session
$id_user = $_SESSION['id'];

// Cek jika ada id_buku dari URL (GET)
$id_buku_terpilih = $_GET['id_buku'] ?? '';
$judul_buku = '';

if ($id_buku_terpilih) {
    $buku = select("SELECT * FROM buku WHERE id_buku = '$id_buku_terpilih'");
    if ($buku) {
        $judul_buku = $buku[0]['judul_buku'];
    }
}

// Backlink sesuai level user
$backLink = '#';
if (isset($_SESSION['level'])) {
    if ($_SESSION['level'] == 2) {
        $backLink = 'DashboardPetugas2.php';
    } elseif ($_SESSION['level'] == 3) {
        $backLink = 'index.php';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="style/style2.css" />
</head>
<body>
    <div class="registration-form">
        <h2>Tambah Peminjaman Buku</h2>
        <form action="" method="POST">

            <!-- ID Peminjam otomatis dari session -->
            <div class="form-group">
                <label for="id">ID Peminjam</label><br><br>
                <input type="text" class="form-control item" name="id" value="<?= $id_user ?>" readonly>
            </div>

            <div class="form-group">
                <label for="tgl_peminjaman">Tanggal Peminjaman</label><br><br>
                <input type="date" class="form-control item" name="tgl_peminjaman" required>
            </div>

            <div class="form-group">
                <label for="tgl_pengembalian">Tanggal Pengembalian</label><br><br>
                <input type="date" class="form-control item" name="tgl_pengembalian" required>
            </div>

            <!-- Menampilkan judul buku (readonly) jika ada -->
            <?php if ($judul_buku): ?>
            <div class="form-group">
                <label for="judul_buku">Judul Buku</label><br><br>
                <input type="text" class="form-control item" name="judul_buku" value="<?= $judul_buku ?>" readonly>
            </div>
            <?php endif; ?>

            <!-- Tetap kirimkan id_buku -->
            <input type="hidden" name="id_buku" value="<?= $id_buku_terpilih ?>">

            <!-- Kolom tersembunyi untuk tgl_bukukembali -->
            <input type="hidden" name="tgl_bukukembali">

            <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
                <input type="submit" name="tambah" value="Add Borrowing Book" onclick="window.location.href='<?= $backLink ?>'">
                <button class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
            </div>
        </form>
    </div>
</body>
</html>