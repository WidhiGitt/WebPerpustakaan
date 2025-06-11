<?php
session_start();
    include "config/controller.php";
    if (isset($_POST['tambah'])){
        if(create_user($_POST) > 0){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan');
            </script>";
        }
        }

$backLink = '#';
if ($_SESSION['level'] == 2) {
    $backLink = 'DashboardPetugas2.php';
}elseif($_SESSION['level'] == 1){
    $backLink = 'DashboardAdmin2.php';
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
        <h2>Tambah User</h2>
        <form action="" method="POST">
        <div class="form-group">
                <input type="text" class="form-control item" name="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
            <input type="password" class="form-control item" for="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="level" placeholder="Level" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="status" placeholder="Status" required>
            </div>
            <label style="display: flex; justify-content: center;">Data Peminjam</label>
            <div class="form-group">
                <input type="text" class="form-control item" name="nama_lengkap" placeholder="Nama Lengkap" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="telepon" placeholder="Telepon" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="alamat" placeholder="Alamat" required>
            </div>
             <div class="form-group" style="display: flex; justify-content: center; gap: 10px;">
                <input type="submit" name="tambah" value="Add User" onclick="window.location.href='<?= $backLink ?>'">
                <button class="btn btn-success" onclick="window.location.href='<?= $backLink ?>'">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
