<?php
include('config/controller.php');

    if (isset($_POST['tambah'])){
        if(create_user($_POST) > 0){
            echo "<script>
            alert('Data Berhasil Ditambahkan');
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Ditambahkan');
            document.location.href = 'formRegister.php';
            </script>";
        }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="./style/styleLogin.css">
</head>
<body>
<div class="container"> 
    <div class="row"> 
        <div class="col-md-6"> 
            <div class="card"> 
                <form action="" method="POST" class="box"> 
                    <h1>Sign Up</h1>  
                    <p class="text-muted"> Please enter your register!</p>

                    <div class="input-row">
                        <input type="text" name="nama_lengkap" placeholder="Full Name" required> 
                        <input type="text" name="nama" placeholder="Name" required> 
                    </div>

                    <div class="input-row">
                        <input type="text" name="telepon" placeholder="Phone Number" required> 
                        <input type="text" name="alamat" placeholder="Address" required> 
                    </div>

                    <div class="input-row">
                        <input type="text" name="username" placeholder="Username" required> 
                        <input type="password" name="password" placeholder="Password" required> 
                    </div>

                    <div class="input-row">
                        <input type="hidden" name="level"> 
                        <input type="hidden" name="status"> 
                    </div>

                    <input type="submit" name="tambah" value="Sign Up"> 
                    <p class="text-muted"> Already have an account? <a href="formLogin.php">Sign in</a></p>
                </form>
            </div> 
        </div> 
    </div> 
</div>
</body>
</html>
