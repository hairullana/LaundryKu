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
            <li><a href="index.php">Home</a></li>
            <li>
                <?php
                    global $connect;

                    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])){
                        // mengambil email dari session
                        $idPelanggan = $_SESSION["pelanggan"];
                        // cari data di db sesuai $email
                        $data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama"];

                        echo "
                            <a href='pelanggan.php'>$nama</a>
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
                            <a href'agen.php'>$nama</a>
                        ";
                    }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                        echo "
                            <a href'admin.php'>Admin</a>
                        ";
                    }else {
                        echo "
                            <a href='registrasi.php'>Registrasi</a>
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
    </div>
    <div id="body">
        <div class="body">
            <h1>LaundryKu</h1>
            <h3>Solusi Laundry Praktis Tanpa Keluar Rumah</h3>
            <?php if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) ) : ?>
                <div>
                    <form action="" method="post">
                        <input type="text" name="keyword" placeholder="Kota / Kabupaten" />
                        <button type="submit" name="cari">CARI</button>
                    </form>
                </div>
                <ul>
                    <li><button type="button"><a href="pelanggan.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status-cucian.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="riwayat-transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php elseif ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) ) : ?>
                <div>
                    <form action="" method="post">
                        <input type="text" name="keyword" placeholder="Kota / Kabupaten" />
                        <button type="submit" name="cari">CARI</button>
                    </form>
                </div>
                <ul>
                    <li><button type="button"><a href="agen.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status-cucian.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="riwayat-transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php elseif ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) : ?>
                <div>
                    <form action="" method="post">
                        <input type="text" name="keyword" placeholder="Kota / Kabupaten" />
                        <button type="submit" name="cari">CARI</button>
                    </form>
                </div>
                <ul>
                    <li><button type="button"><a href="admin.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status-cucian.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="riwayat-transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php else : ?>
                <a href='registrasi-pelanggan.php'><button type='button'>Daftar Sekarang</button></a>
            <?php endif ?>
        </div>
    </div>
    <div id="body">
    LIST AGEN
    </div>
    </div>
</body>
</html>