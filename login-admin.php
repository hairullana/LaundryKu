<?php

// mulai session 
session_start();
include 'connect-db.php';

//jika sudah login kemudian ke halaman login.php
if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert ('Anda Sudah Login !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

// AKSI
if ( isset($_POST["login"]) ) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // cek di db
    $data = mysqli_query($connect, "SELECT * FROM admin WHERE email = '$email'");

    // jika email ada
    if ( mysqli_num_rows($data) === 1 ){

        // jadikan array asosiatif
        $data = mysqli_fetch_assoc($data);

        // jika password benar
        if ( $password === $data["password"])   {
            //session login 
            $_SESSION["login-admin"] = true;
            $_SESSION["admin"] = $email;

            //jika remember me di checklist (NANTI DULU)
            // if ( isset($_POST["remember"]) ){
            //     //buat cookie yg di hash
            //     setcookie('id',$data['id'], time() + 60*60);
            //     setcookie('pengguna',hash('sha256',$data['username']), time() + 60*60);
            // }
            
        }
    }else {
        echo "
            <script>
                alert ('Email Tidak Terdaftar');
                document.location.href = 'login-admin.php';
            </script>
        ";
        exit;
    }

    header("Location: index.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href='registrasi.php'>Registrasi</a></li>
            <li><a href='login.php'>Login</a></li>
        </ul>
    </div>

    <div id="body">

        <h3>Login Admin</h3>    

        <form action="" method="post">
            <ul>
                <li>Email : <input type="text" name="email"></li>
                <li>Password : <input type="text" name="password"></li>
                <li><button type="submit" name="login">Login</button> <a href="/lupa-kata-sandi.php">Lupa Kata Sandi ?</a></li>
            </ul>
        </form>
    </div>
</body>
</html>