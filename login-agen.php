<?php

// session 
session_start();
include 'connect-db.php';

// kalau sudah login
if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Sudah Login !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

if ( isset($_POST["login"]) ){
    // masukkan ke var
    $email = $_POST["email"];
    $password = $_POST["password"];

    // cari data di db
    $result = mysqli_query($connect, "SELECT * FROM agen WHERE email = '$email'");

    // kalau ada email
    if(mysqli_num_rows($result) == 1){
        // masukan ke array assoc
        $row = mysqli_fetch_assoc($result);
        // verif password
        if(password_verify($password, $row["password"])){
            $_SESSION["agen"] = $row["id_agen"];
            $_SESSION["login-agen"] = true;
            echo "
                <script>
                    alert('Berhasil Login Sebagai Agen !');
                    document.location.href = 'index.php';
                </script>
            ";
            exit;
        }else {
            echo "
                <script>
                    alert('Password Salah !');
                    document.location.href = 'login-agen.php';
                </script>
            ";
        }
    }else {
        echo "
            <script>
                alert('Email Belum Terdaftar !');
                document.location.href = 'login-agen.php';
            </script>
        ";
    }

    $error = true;
}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Agen</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3>Login Agen</h3>
        <form action="" method="post">
            <ul>
                <li>Email : <input type="text" id="email" name="email" placeholder="Email"></li>
                <li>Password : <input type="password" id="password" name="password" placeholder="Password"></li>
                <li><button type="submit" name="login">Login</button> <a href="lupa-kata-sandi.php">Lupa Kata Sandi ?</a></li>
            </ul>
        </form>
    </div>
</body>
</html>




