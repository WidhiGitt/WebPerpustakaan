<?php
include 'config/controller.php';

// Pastikan variabel $ktgr didefinisikan sebelum digunakan
$ktgr = null;

// Ambil data berdasarkan ID (parameter GET)
if (isset($_GET['id'])) {
    $id_kategori = intval($_GET['id']); // Validasi ID menjadi angka
    $data = select("SELECT * FROM kategori WHERE id_kategori = $id_kategori");

    // Jika data ditemukan, set ke $ktgr
    if (count($data) > 0) {
        $ktgr = $data[0];
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if (isset($_POST['update'])) {
    if (update_ktgr($_POST) > 0) {
        echo "<script>
            alert('Berhasil mengedit data');
            document.location.href ='index.php';
            </script>";
        exit();
    } else {
        echo "<script>
            alert('Gagal mengedit data');
            document.location.href ='index.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="registration-form">
    <h2>Edit Data Kategori Buku</h2>

    <!-- Pastikan $ktgr tidak null -->
    <?php if ($ktgr): ?>
        <form method="POST">
            <div class="form-group">
                <input type="hidden" class="form-control item" name="id" placeholder="id" value="<?= $ktgr['id_kategori']; ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="nama" placeholder="Nama" value="<?= $ktgr['nama']; ?>">
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
