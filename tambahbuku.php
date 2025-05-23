<?php
include "config/controller.php";

    if (isset($_POST['tambah'])){
        if(create_buku($_POST) > 0){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href ='DashboardPetugas2.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href ='DashboardPetugas2.php';
            </script>";
        }
        }

    $kategori = select("SELECT * FROM kategori");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <label for="kategori">Kategori:</label>
            <select name="id_kategori" id="kategori" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                <?php foreach ($kategori as $ktgr): ?>
                    <option value="<?= $ktgr['id_kategori'] ?>">
                        <?= $ktgr['nama'] ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <div class="form-group">
                <input type="submit" name="tambah" value="Add Book">
                <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
