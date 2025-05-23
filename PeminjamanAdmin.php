<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_ktgr($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
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
$data_pmnjmn = select("SELECT * FROM peminjaman");
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
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Tanggal Buku Kembali</th>
                    <th>Peminjam</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($data_pmnjmn as $pmnjmn): ?>
                    <tr>
                        <td><?= $pmnjmn['id_peminjaman']; ?></td>
                        <td><?= $pmnjmn['tgl_peminjaman']; ?></td>
                        <td><?= $pmnjmn['tgl_pengembalian']; ?></td>
                        <td><?= $pmnjmn['tgl_bukukembali']; ?></td>
                        <td><?= $pmnjmn['id']; ?></td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
         <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
    </div>
       
</body>
</html>
