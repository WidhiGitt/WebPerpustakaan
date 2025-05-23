<?php
session_start();
include 'config/controller.php';

    // Ambil level user
    $userLevel = $_SESSION['level'];

    // Kalau siswa login, tolak akses
    if ($userLevel == 3) {
        echo "<script>alert('Kamu tidak punya akses ke halaman ini'); window.location.href = 'index.php';</script>";
        exit;
    }

    // Jika ada permintaan hapus
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        if (delete_user($id) > 0) {
            echo "<script>
                alert('Data Berhasil Dihapus');
                document.location.href ='dataUser.php';
                </script>";
        } else {
            echo "<script>
                alert('Gagal Menghapus Data');
                document.location.href ='dataUser.php';
                </script>";
        }
        exit;
    }

    // Query tampilkan data tergantung role
    if ($userLevel == 2) {
        // Petugas hanya lihat siswa
        $data_user = select("SELECT * FROM user WHERE level = 3");
    } else {
        // Admin lihat semua
        $data_user = select("SELECT * FROM user");
    }

        $filter = $_GET['filter'] ?? 'all';

    if ($filter == 'petugas') {
        $data_user = select("SELECT * FROM user WHERE level = 2");
        $judul = "Data Petugas";
    } elseif ($filter == 'siswa') {
        $data_user = select("SELECT * FROM user WHERE level = 3");
        $judul = "Data Siswa";
    } else {
        $data_user = select("SELECT * FROM user");
        $judul = "Semua Data User";
    }

    $backLink = '#'; // Default fallback
    if ($_SESSION['level'] == 1) {
        $backLink = 'DashboardAdmin2.php';
    } elseif ($_SESSION['level'] == 2) {
        $backLink = 'DashboardPetugas2.php';
    }
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
        <h1 class="text-center mt-5">DATA USER</h1>
        <br><br>
        <a href="tambahuser.php" class="btn btn-success">Add User</a><br><br>
        <div class="form-group">
        <table class ="table table-light table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                 <?php $id = 1; ?>
                 <?php foreach ($data_user as $user): ?>
                    <tr>
                        <td><?= $user['id']; ?></td>
                        <td><?= $user['nama']; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['password']; ?></td>
                        <td><?= $user['level']; ?></td>
                        <td><?= $user['status']; ?></td>
                        <td>
                        <a href="edit.php?id=<?= $user['id']; ?>" class="btn btn-secondary">Update</a>
                        <a href="dataUser.php?delete=<?= $user['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                 <?php endforeach; ?>
            </tbody>
        </table>
        </div><br>
        <a href="<?= $backLink ?>" class="btn btn-success">Back</a>
    </div>
       
</body>
</html>
