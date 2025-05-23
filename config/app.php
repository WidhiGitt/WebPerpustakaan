<?php
//Panggil koneksi PHP
include "koneksi.php";

//Fungsi menampilkan
function select($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row ;
    }
    return $rows;
}

//fungsi tambah pengguna-web
function create_user($post) {
    global $db;
    $nama = strip_tags($post ['nama']);
    $username = strip_tags($post ['username']);
    $password = strip_tags($post ['password']);
    $level = strip_tags($post ['level']);
    $status = strip_tags($post ['status']);

//query tambah data
$query = "INSERT INTO user (nama, username, password, level, status)
VALUES ('$nama', '$username', '$password', '$level', '$status')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit pengguna
function update_user($post) {
    global $db;
    $id = intval($post['id']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);
    $status = strip_tags($post['status']);

// Query update data
$query = "UPDATE user 
                SET nama = '$nama', 
                  username = '$username', 
                  password = '$password', 
                  level = '$level', 
                  status = '$status' 
              WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_user($id) {
    global $db; // Pastikan koneksi database tersedia
    $id = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM user WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

//fungsi tambah kategori
function create_ktgr($post) {
    global $db;
    $id = strip_tags($post ['id']);
    $nama = strip_tags($post ['nama']);

//query tambah data
$query = "INSERT INTO kategori (id, nama)
VALUES ('$id', '$nama')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit kategori
function update_ktgr($post) {
    global $db;
    $id = intval($post['id']);
    $nama = strip_tags($post['nama']);

// Query update data
$query = "UPDATE kategori 
                SET nama = '$nama'
              WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_ktgr($id) {
    global $db; // Pastikan koneksi database tersedia
    $id = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM kategori WHERE id = $id";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_buku($post) {
    global $db;
    $id_buku = strip_tags($post ['id_buku']);
    $judul_buku = strip_tags($post ['judul_buku']);
    $penulis = strip_tags($post ['penulis']);
    $penerbit = strip_tags($post ['penerbit']);
    $cover = strip_tags($post ['cover']);
    $cover_bg_color = strip_tags($post ['cover_bg_color']);
    $tahun_terbit = strip_tags($post ['tahun_terbit']);
    $jumlah_buku = strip_tags($post ['jumlah_buku']);
    $id_kategori = strip_tags($post ['id_kategori']);

//query tambah data
$query = "INSERT INTO buku (id_buku, judul_buku, penulis, penerbit, cover, cover_bg_color, tahun_terbit, jumlah_buku, id_kategori)
VALUES ('$id_buku', '$judul_buku', '$penulis', '$penerbit', '$cover', '$cover_bg_color', '$tahun_terbit', '$jumlah_buku', '$id_kategori')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit buku
function update_buku($post) {
    global $db;
    $id_buku = strip_tags($post ['id_buku']);
    $judul_buku = strip_tags($post ['judul_buku']);
    $penulis = strip_tags($post ['penulis']);
    $penerbit = strip_tags($post ['penerbit']);
    $cover = strip_tags($post ['cover']);
    $cover_bg_color = strip_tags($post ['cover_bg_color']);
    $tahun_terbit = strip_tags($post ['tahun_terbit']);
    $jumlah_buku = strip_tags($post ['jumlah_buku']);
    $id_kategori = strip_tags($post ['id_kategori']);

// Query update data
$query = "UPDATE buku 
                SET judul_buku = '$judul_buku', 
                  penulis = '$penulis', 
                  penerbit = '$penerbit',   
                  cover = '$cover', 
                  cover_bg_color = '$cover_bg_color', 
                  tahun_terbit = '$tahun_terbit', 
                  jumlah_buku = '$jumlah_buku', 
                  id_kategori = '$id_kategori'
              WHERE id_buku = $id_buku";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_buku($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_buku = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM buku WHERE id_buku = $id_buku";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_pmnjmn($post) {
    global $db;
    $tgl_peminjaman = strip_tags($post ['tgl_peminjaman']);
    $tgl_pengembalian = strip_tags($post ['tgl_pengembalian']);
    $tgl_bukukembali = strip_tags($post ['tgl_bukukembali']);
    $id = strip_tags($post ['id']);

//query tambah data
$query = "INSERT INTO peminjaman (tgl_peminjaman, tgl_pengembalian, tgl_bukukembali, id)
VALUES ('$tgl_peminjaman', '$tgl_pengembalian', '$tgl_bukukembali', '$id')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit peminjaman
function update_pmnjmn($post) {
    global $db;
    $id_peminjaman = intval($post['id_peminjaman']);
    $tgl_peminjaman = strip_tags($post ['tgl_peminjaman']);
    $tgl_pengembalian = strip_tags($post ['tgl_pengembalian']);
    $tgl_bukukembali = strip_tags($post ['tgl_bukukembali']);
    $id = strip_tags($post ['id']);

// Query update data
$query = "UPDATE peminjaman 
                SET tgl_peminjaman = '$tgl_peminjaman', 
                  tgl_pengembalian = '$tgl_pengembalian', 
                  tgl_bukukembali = '$tgl_bukukembali', 
                  id = '$id',  
              WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_pmnjmn($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_peminjaman = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM peminjaman WHERE id_peminjaman = $id_peminjaman";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_dp($post) {
    global $db;
    $id_peminjaman = strip_tags($post ['id_peminjaman']);
    $id_buku = strip_tags($post ['id_buku']);
    $status = strip_tags($post ['status']);

//query tambah data
$query = "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, status)
VALUES ('$id_peminjaman', '$id_buku', '$status')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit detail_peminjaman
function update_dp($post) {
    global $db;
    $id_DP = intval($post['id_DP']);
    $id_peminjaman = strip_tags($post['id_peminjaman']);
    $id_buku = strip_tags($post['id_buku']);
    $status = strip_tags($post['status']);

// Query update data
$query = "UPDATE user 
                SET id_peminjaman = '$id_peminjaman', 
                  id_buku = '$id_buku', 
                  status = '$status' 
              WHERE id_DP = $id_DP";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_dp($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_DP = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM user WHERE id_DP = $id_DP";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_du($post) {
    global $db;
    $nama_lengkap = strip_tags($post ['nama_lengkap']);
    $telepon = strip_tags($post ['telepon']);
    $alamat = strip_tags($post ['alamat']);

//query tambah data
$query = "INSERT INTO detail_user (nama_lengkap, telepon, alamat)
VALUES ('$nama_lengkap', '$telepon', '$alamat')";
mysqli_query($db, $query);
return mysqli_affected_rows($db);
}

// Fungsi edit pengguna
function update_du($post) {
    global $db;
    $id_DU = intval($post['id_DU']);
    $nama_lengkap = strip_tags($post['nama_lengkap']);
    $telepon = strip_tags($post['telepon']);
    $alamat = strip_tags($post['alamat']);

// Query update data
$query = "UPDATE detail_user 
                SET nama_lengkap = '$nama_lengkap', 
                  telepon = '$telepon', 
                  alamat = '$alamat' 
              WHERE id_DU = $id_DU";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function delete_du($id) {
    global $db; // Pastikan koneksi database tersedia
    $id_DU = intval($id); // Validasi ID menjadi angka
    $query = "DELETE FROM detail_user WHERE id_DU = $id_DU";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
?>
