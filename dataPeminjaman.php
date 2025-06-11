<?php
session_start();
include 'config/controller.php';

// Proses hapus data
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']); // Validasi ID menjadi angka
    if (delete_dp($id) > 0) {
        echo "<script>
            alert('Data Berhasil Dihapus');
            document.location.href = 'dataPeminjaman.php';
            </script>";
    } else {
        echo "<script>
            alert('Gagal Menghapus Data');
            document.location.href = 'dataPeminjaman.php';
            </script>";
    }
    exit();
}

//SQL menampilkan
$data_dp = select("
    SELECT dp.*, p.tgl_peminjaman, p.tgl_pengembalian, p.tgl_bukukembali, p.id
    FROM detail_peminjaman dp
    JOIN peminjaman p ON dp.id_peminjaman = p.id_peminjaman
");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="style/styleSiswa.css" />
    <style>
    body {
        background-color: #f5f5f5;
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

<!-- Sidebar -->
    <nav class="sidebar">
        <h2> <span class="font-normal">E-library</span> <span class="font-bold">DeSeven</span> </h2>
        <ul>
            <li><a href="DashboardPetugas2.php">Dashboard</a></li>
            <li><a href="dataBuku.php">Kelola Buku</a></li>
            <li><a href="dataKategori.php">Kelola Kategori</a></li>
            <li><a href="dataPeminjaman.php">Kelola Peminjaman Buku</a></li>
            <li><a href="AktivitasPetugas.php">Aktivitas</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Header -->
        <div class="header">
            <h1 class="page-title" style="font-weight: bold;">Kelola Peminjaman Buku</h1>
            <div class="search-bar">
                <a href="formLogin.php" class="profile-icon">
                    <i class="fas fa-circle-user"></i>
                </a>
            </div>
        </div>

    <div class ="container">
        <a href="formLogin.php" class="btn btn-success">+ Add Borrowing Book</a><br><br>
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID Detail Peminjaman</th>
                    <th>ID Peminjaman</th>
                    <th>ID Buku</th>
                    <th>ID Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Tanggal Buku Kembali</th>
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
                        <td><?= $dp['id']; ?></td>
                        <td><?= $dp['tgl_peminjaman']; ?></td>
                        <td><?= $dp['tgl_pengembalian']; ?></td>
                        <td><?= $dp['tgl_bukukembali']; ?></td>
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
    </div>
       
</body>
</html>
