<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_ktgr($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href ='DashboardAdmin.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
            document.location.href ='DashboardAdmin.php';
            </script>";
    }
    exit();
}

$backLink = '#'; // Default fallback
    if ($_SESSION['level'] == 1) {
        $backLink = 'DashboardAdmin2.php';
    } elseif ($_SESSION['level'] == 2) {
        $backLink = 'DashboardPetugas2.php';
    }

//SQL menampilkan
$data_ktgr = select("SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <style>
    body {
        background-color: #e0e0e0;
    }
    .form-group {
        background-color: rgb(255, 255, 255);
        padding: 20px;
        border-radius: 8px;
        box-shadow:rgb(155, 155, 155) 0px 10px 20px 0px;
    }
</style>
</head>
<body>
    <div class ="container">
        <h1 class="text-center mt-5">DATA KATEGORI</h1>
        <br><br>
        <a href="tambahkategori.php" class="btn btn-success">Add Category</a><br><br>
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                 <?php $id = 1; ?>
                 <?php foreach ($data_ktgr as $ktgr): ?>
                    <tr>
                        <td><?= $ktgr['id_kategori']; ?></td>
                        <td><?= $ktgr['nama']; ?></td>
                        <td>
                        <a href="editKategori.php?id=<?= $ktgr['id_kategori']; ?>" class="btn btn-secondary">Update</a>
                        <a href="dataKategori.php?delete=<?= $ktgr['id_kategori']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
         <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
    </div>
       
</body>
</html>
