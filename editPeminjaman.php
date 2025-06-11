<?php
session_start();
include 'config/controller.php';

// Pastikan variabel $ktgr didefinisikan sebelum digunakan
$pmnjmn = null;

// Ambil data berdasarkan ID (parameter GET)
if (isset($_GET['id'])) {
    $id_peminjaman = intval($_GET['id']); // Validasi ID menjadi angka
    $data = select("SELECT * FROM peminjaman WHERE id_peminjaman = $id_peminjaman");

    // Jika data ditemukan, set ke $ktgr
    if (count($data) > 0) {
        $pmnjmn = $data[0];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if (isset($_POST['update'])) {
    if (update_pmnjmn($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengedit data');
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengedit data');
            </script>";
    }
}

$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backlink = 'DashboardPetugas2.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="registration-form">
    <h2>Edit Data Peminjaman Buku</h2>

    <!-- Pastikan $pmnjmn tidak null -->
    <?php if ($pmnjmn): ?>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control item" name="id_peminjaman" placeholder="id" value="<?= $pmnjmn['id_peminjaman']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="tgl_peminjaman" placeholder="Tanggal Peminjaman" value="<?= $pmnjmn['tgl_peminjaman']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="tgl_pengembalian" placeholder="Tanggal Pengembalian" value="<?= $pmnjmn['tgl_pengembalian']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="tgl_bukukembali" placeholder="Tanggal Buku Kembali" value="<?= $pmnjmn['tgl_bukukembali']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="id" placeholder="ID Peminjam" value="<?= $pmnjmn['id']; ?>">
            </div>
            <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
                <input type="submit" name="update" value="Edit" onclick="window.location.href='<?= $backLink ?>'">
                <button class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
            </div>
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan atau belum dimuat.</p>
    <?php endif; ?>
</div>
</body>
</html>
