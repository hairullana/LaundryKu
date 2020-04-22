<?php

session_start();
include 'connect-db.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laundryku</title>
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="/">Home</a></li>
            <li>
                <?php
                    global $connect;

                    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])){
                        // mengambil email dari session
                        $email = $_SESSION["pelanggan"];
                        // cari data di db sesuai $email
                        $data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE email = '$email'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama"];

                        echo "
                            <a href'/profil-pelanggan.php'>$nama</a>
                        ";
                    }else if ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])){
                        // mengambil email dari session
                        $email = $_SESSION["agen"];
                        // cari data di db sesuai $email
                        $data = mysqli_query($connect, "SELECT * FROM agen WHERE email = '$email'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama"];

                        echo "
                            <a href'/profil-agen.php'>$nama</a>
                        ";
                    }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                        echo "
                            <a href'/profil-admin.php'>Admin</a>
                        ";
                    }else {
                        echo "
                            <a href='/registrasi.php'>Registrasi</a>
                        ";
                    }
                ?>
            </li>
            <li>
                <?php
                    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ){
                        echo "
                            <a href='logout.php'>Logout</a>
                        ";
                    }else {
                        echo "
                            <a href='login.php'>Login</a>
                        ";
                    }
                ?>
            </li>
        </ul>
        <p>
            <h1>LaundryKu</h1>
            <h3>Solusi Laundry Praktis Tanpa Keluar Rumah</h3>
            <a href="/registrasi-pelanggan.php"><button type="button">Daftar Sekarang</button></a>
        </p>
    </div>
    <div id="body">
        
    </div>
</body>
</html>