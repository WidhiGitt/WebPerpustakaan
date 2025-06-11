<?php
session_start();
include('config/controller.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            logAktivitas($user['id'], 'Login', 'Login berhasil');

            if ($_SESSION['level'] == 1) {
                header("Location: DashboardAdmin2.php");
                exit;
            } elseif ($_SESSION['level'] == 2) {
                header("Location: DashboardPetugas2.php");
                exit;
            } else {
                header("Location: index.php");
                exit;
            }
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }

    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-library Deseven</title>
    <link rel="stylesheet" href="./style/styleLogin.css">
</head>
<body>
<div class="container"> 
    <div class="row"> 
        <div class="col-md-6"> 
            <div class="card"> 
                <form action="" method="POST" class="box"> 
                    <h1>Sign In</h1>  
                    <p class="text-muted">Please enter your login and password!</p>
                    <input type="text" name="username" placeholder="Username" required> 
                    <input type="password" name="password" placeholder="Password" required> 
                    <a class="forgot text-muted" href="#">Forgot password?</a> 
                    <input type="submit" value="Sign In"> 
                    <p class="text-muted">Don't have an account? <a href="formRegister.php">Sign up</a></p>
                </form> 
            </div> 
        </div> 
    </div> 
</div>

<?php if (!empty($error)) : ?>
<script>
    window.onload = function() {
        alert("<?= $error ?>");
    };
</script>
<?php endif; ?>
</body>
</html>
