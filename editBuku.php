<?php
include 'config/controller.php';

// Pastikan variabel $user didefinisikan sebelum digunakan
$pmnjmn = null;

// Ambil data berdasarkan ID (parameter GET)
if (isset($_GET['id'])) {
    $id_buku = intval($_GET['id']); // Validasi ID menjadi angka
    $data = select("SELECT * FROM buku WHERE id_buku = $id_buku");

    // Jika data ditemukan, set ke $user
    if (count($data) > 0) {
        $pmnjmn = $data[0];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if (isset($_POST['update'])) {
    if (update_user($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengupdate data');
            document.location.href ='index.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengupdate data');
            document.location.href ='index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="registration-form">
    <h2>Edit Data Buku</h2>

    <!-- Pastikan $buku tidak null -->
    <?php if ($buku): ?>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control item" name="id" placeholder="id" value="<?= $pmnjmn['id_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="nama" placeholder="Nama" value="<?= $pmnjmn['judul_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="username" placeholder="Username" value="<?= $pmnjmn['penulis']; ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="password" placeholder="Password" value="<?= $pmnjmn['penerbit']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="level" placeholder="Level" value="<?= $pmnjmn['cover']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" value="<?= $pmnjmn['cover_bg_color']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" value="<?= $pmnjmn['tahun_terbit']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" value="<?= $pmnjmn['jumlah_buku']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" value="<?= $pmnjmn['id_kategori']; ?>">
            </div>
    
            <div class="form-group">
                <button type="submit" class="btn btn-block create-account" name="update">Update</button>
                <a href="index.php" class="btn btn-block create-account" name="back">Back</a>
            </div>
        </form>
    <?php else: ?>
        <p>Data tidak ditemukan atau belum dimuat.</p>
    <?php endif; ?>
</div>
</body>
</html>
