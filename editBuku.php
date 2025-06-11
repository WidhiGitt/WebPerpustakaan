<?php
session_start();
include 'config/controller.php';

// Pastikan variabel $user didefinisikan sebelum digunakan
$pmnjmn = null;

// Ambil data berdasarkan ID (parameter GET)
if (isset($_GET['id'])) {
    $id_buku = intval($_GET['id']); // Validasi ID menjadi angka
    $data = select("SELECT * FROM buku WHERE id_buku = $id_buku");

    // Jika data ditemukan, set ke $user
    if (count($data) > 0) {
        $buku = $data[0];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if (isset($_POST['update'])) {
    if (update_buku($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengupdate data');
            document.location.href = 'dataBuku.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengupdate data');
            document.location.href = 'dataBuku.php';
            </script>";
    }
}

$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backLink = 'DashboardPetugas2.php';
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
    <h2>Edit Data Buku</h2>

    <!-- Pastikan $buku tidak null -->
    <?php if ($buku): ?>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control item" name="id_buku" placeholder="ID Buku" value="<?= $buku['id_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="judul_buku" placeholder="Judul Buku" value="<?= $buku['judul_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="penulis" placeholder="Penulis" value="<?= $buku['penulis']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="penerbit" placeholder="Penerbit" value="<?= $buku['penerbit']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="cover" placeholder="Cover" value="<?= $buku['cover']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="cover_bg_color" placeholder="Cover Background" value="<?= $buku['cover_bg_color']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="tahun_terbit" placeholder="Tahun Terbit" value="<?= $buku['tahun_terbit']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="jumlah_buku" placeholder="Jumlah Buku" value="<?= $buku['jumlah_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="id_kategori" placeholder="ID Kategori" value="<?= $buku['id_kategori']; ?>">
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
