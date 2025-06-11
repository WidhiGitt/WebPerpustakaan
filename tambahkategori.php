<?php
session_start();
include "config/controller.php";

if (isset($_POST['tambah'])) {
    if (create_ktgr($_POST) > 0) {
        echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href ='dataKategori.php';
            </script>";
    } else {
       echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href ='dataKategori.php';
            </script>";
    }
}

$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backLink = 'DashboardPetugas2.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>
<div class="registration-form">
    <h2>Tambah Kategori Buku</h2>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control item" name="id_kategori" placeholder="ID Kategori" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control item" name="nama" placeholder="Nama" required>
        </div>
        <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
            <input type="submit" name="tambah" value="Add Category">
            <button type="button" class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
        </div>
    </form>
</div>
</body>
</html>
