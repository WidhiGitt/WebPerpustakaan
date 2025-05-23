<?php
session_start();
include 'config/controller.php';

if (isset($_POST['id_dp']) && isset($_POST['status'])) {
    $id_dp = intval($_POST['id_dp']);
    $status = $_POST['status'];

    // Query update status
    $query = "UPDATE detail_peminjaman SET status = '$status' WHERE id_DP = $id_dp";
    mysqli_query($db, $query);

    // Kembali ke halaman sebelumnya
    header("Location: dataPeminjaman.php");
    exit;
}
?>
