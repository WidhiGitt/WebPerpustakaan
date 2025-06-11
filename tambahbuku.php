<?php
session_start();
include "config/controller.php";

    if (isset($_POST['tambah'])){
        if(create_buku($_POST) > 0){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href ='dataBuku.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href ='dataBuku.php';
            </script>";
        }
        }

    $kategori = select("SELECT * FROM kategori");

// Redirect berdasarkan level
$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backLink = 'DashboardPetugas2.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
    <div class="registration-form">
        <h2>Tambah Buku</h2>
        <form action="" method="POST">
        <div class="form-group">
                <input type="text" class="form-control item" name="id_buku" placeholder="ID Buku" required>
            </div>
        <div class="form-group">
                <input type="text" class="form-control item" name="judul_buku" placeholder="Judul Buku" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="penulis" placeholder="Penulis" required>
            </div>
            <div class="form-group">
            <input type="text" class="form-control item"  name="penerbit" placeholder="Penerbit" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="cover" placeholder="Cover" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="cover_bg_color" placeholder="Cover Background" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="tahun_terbit" placeholder="Tahun Terbit" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="jumlah_buku" placeholder="Jumlah Buku" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="sinopsis" placeholder="Sinopsis">
            </div>
            <select name="id_kategori" id="kategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategori as $ktgr): ?>
                    <option value="<?= $ktgr['id_kategori'] ?>">
                        <?= $ktgr['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
                <input type="submit" name="tambah" value="Add Book" onclick="window.location.href='<?= $backLink ?>'">
                <button class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
