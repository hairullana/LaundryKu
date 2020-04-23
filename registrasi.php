<?php

// mulai session
session_start();
include 'connect-db.php';


// kalau sudah login, dialihkan ke index
if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Sudah Mendaftar !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
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
        <ul>
            <li><a href="registrasi-pelanggan.php">Registrasi Sebagai Pelanggan</a></li>
            <li><a href="registrasi-agen.php">Registrasi Sebagai Agen</a></li>
        </ul>
    </div>
</body>
</html>