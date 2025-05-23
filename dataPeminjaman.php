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
$data_dp = select("SELECT * FROM detail_peminjaman");
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
        <a href="tambahpeminjaman.php" class="btn btn-success">Add Borrowing Book</a><br><br>
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID Detail Peminjaman</th>
                    <th>ID Peminjaman</th>
                    <th>ID Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($data_dp as $dp): ?>
                    <tr>
                    <td><?= $dp['id_DP']; ?></td>
                    <td><?= $dp['id_peminjaman']; ?></td>
                    <td><?= $dp['id_buku']; ?></td>
                    <td>
                        <form action="ubahStatus.php" method="POST">
                            <input type="hidden" name="id_dp" value="<?= $dp['id_DP']; ?>">
                            <select name="status" onchange="this.form.submit()" class="form-select w-auto" style="min-width: 130px;">
                                <option value="dipinjam" <?= $dp['status'] == 'dipinjam' ? 'selected' : ''; ?>>Dipinjam</option>
                                <option value="dikembalikan" <?= $dp['status'] == 'dikembalikan' ? 'selected' : ''; ?>>Dikembalikan</option>
                            </select>
                        </form>
                    </td>
                    <td>
                        <a href="editPeminjaman.php?id=<?= $dp['id_peminjaman']; ?>" class="btn btn-secondary btn-sm">Update</a>
                        <a href="dataPeminjaman.php?delete=<?= $dp['id_peminjaman']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                    </td>
                </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
         <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
    </div>
       
</body>
</html>
