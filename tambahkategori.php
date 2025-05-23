<?php
    include "config/controller.php";
    if (isset($_POST['tambah'])){
        if(create_ktgr($_POST) > 0){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href ='index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href ='index.php';
            </script>";
        }
        }
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
        <h2>Tambah Kategori Buku</h2>
        <form action="" method="POST">
        <div class="form-group">
                <input type="text" class="form-control item" name="id" placeholder="ID" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="nama" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <input type="submit" name="tambah" value="Add Category">
            </div><br>
            <div class="form-group">
                <a href="index.php" class="btn btn-block create-account" name="back">Back</a>
            </div>
        </form>
    </div>
</body>
</html>
