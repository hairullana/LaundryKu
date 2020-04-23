<?php

session_start();

include 'connect-db.php';

// jika sudah login
// if ( isset($_COOKIE["[pelanggan"])){
//     $_SESSION["login-pelanggan"] = true;
// }

//jika sudah login kemudian ke halaman login.php
if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    header("Location : index.php");
    exit;
}


if ( isset($_POST["login"]) ){

    $email = $_POST["email"];
    $password = $_POST["password"];

    //cek apakah ada email atau tidak
    $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE email = '$email'");
    
    //jika ada username
    if ( mysqli_num_rows($result) === 1 ){   //fungsi menghitung jumlah baris di db
        
        //memasukkan data db ke array assosiative
        $data = mysqli_fetch_assoc($result);

        //cek apakah password sama
        if ( password_verify($password, $data["password"]) ){
            //session login 
            $_SESSION["pelanggan"] = $data["id_pelanggan"];
            $_SESSION["login-pelanggan"] = true;

            // BELAKANGAN AJA DIBUAT HEHE, YANG PENTING JALAN DULU
            // if ( isset($_POST["remember"]) ){
            //     //buat cookie yg di hash
            //     setcookie('id',$data['id'], time() + 60*60);
            //     setcookie('pengguna',hash('sha256',$data['username']), time() + 60*60);
            // }
            echo "
                <script>
                    alert('Berhasil Login !');
                    document.location.href = 'index.php';
                </script>
            ";
            
        }else {
            echo "
                <script>
                    alert('Password Salah !');
                </script>
            ";
        }
    }else {
        echo "
            <script>
                alert('Email Tidak Ditemukan !');
            </script>
        ";
    }
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
</head>
<body>
    <h3>Login Pelanggan</h3>
    <form action="" method="post">
            <ul>
                <li>Email : <input type="text" name="email"></li>
                <li>Password : <input type="password" name="password"></li>
                <li><button type="submit" name="login">Login</button> <a href="/lupa-kata-sandi.php">Lupa Kata Sandi ?</a></li>
            </ul>
    </form>
</body>
</html>