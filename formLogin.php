<?php
session_start();
include('config/controller.php');

// Cek apakah form login sudah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data username dan password dari form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan username
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    
    // Cek apakah ada data user yang sesuai
    if (mysqli_num_rows($result) > 0) {
        // Ambil data user
        $user = mysqli_fetch_assoc($result);

        // Cek apakah password yang dimasukkan sesuai (TANPA hash)
        if ($password === $user['password']) {
            // Set session berdasarkan level user
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];  // level 1=admin, 2=petugas, 3=siswa

            // Redirect user ke halaman sesuai level
            if ($_SESSION['level'] == 1) {
                header("Location: DashboardAdmin2.php");  // Admin
            } elseif ($_SESSION['level'] == 2) {
                header("Location: DashboardPetugas2.php");  // Petugas
            } elseif ($_SESSION['level'] == 3) {
                header("Location: index.php");  // Siswa
            }
            exit;
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }

    // Tutup koneksi
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/styleLogin.css">
</head>
<body>
<div class="container"> 
    <div class="row"> 
        <div class="col-md-6"> 
            <div class="card"> 
                <form action="" method="POST" class="box"> 
                    <h1>Login</h1>  
                    <p class="text-muted"> Please enter your login and password!</p>
                    <input type="text" name="username" placeholder="Username" required> 
                    <input type="password" name="password" placeholder="Password" required> 
                    <a class="forgot text-muted" href="#">Forgot password?</a> 
                    <input type="submit" value="Login"> 
                    <p class="text-muted"> Don't have an account? <a href="#">Sign up</a></p>
                </form> 
            </div> 
        </div> 
    </div> 
</div>
</body>
</html>
