<?php

session_start();
include 'connect-db.php';


//konfirgurasi pagination
$jumlahDataPerHalaman = 3;
$query = mysqli_query($connect,"SELECT * FROM agen");
$jumlahData = mysqli_num_rows($query);
//ceil() = pembulatan ke atas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

//menentukan halaman aktif
//$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1; = versi simple
if ( isset($_GET["page"])){
    $halamanAktif = $_GET["page"];
}else{
    $halamanAktif = 1;
}

//data awal
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

//fungsi memasukkan data di db ke array
$agen = mysqli_query($connect,"SELECT * FROM agen LIMIT $awalData, $jumlahDataPerHalaman");

//ketika tombol cari ditekan
if ( isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];

    $query = "SELECT * FROM agen WHERE 
        kota LIKE '%$keyword%' OR
        nama_laundry LIKE '%$keyword%'
        LIMIT $awalData, $jumlahDataPerHalaman
        ";

    $agen = mysqli_query($connect,$query);
}

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
                        $id_agen = $_SESSION["agen"];
                        // cari data di db sesuai $id_agen
                        $data = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$id_agen'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama_laundry"];

                        echo "
                            <a href='agen.php'>$nama</a>
                        ";
                    }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                        echo "
                            <a href='admin.php'>Admin</a>
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
                <form action="" method="post">
                    <input type="text" name="keyword" placeholder="Kota / Kabupaten" />
                    <button type="submit" name="cari">CARI</button>
                </form>
            <?php endif ?>
        </div>
        </div>
        <div class="body">
            <div id="halaman">
                <?php if( $halamanAktif > 1 ) : ?>
                    <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
                <?php endif; ?>

                <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                    <?php if( $i == $halamanAktif ) : ?>
                        <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
                    <?php else : ?>
                        <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                    <?php endif; ?>
                <?php endfor; ?>

                <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                    <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
                <?php endif; ?>
            </div>
            <?php foreach ( $agen as $dataAgen) : ?>
                <div style="margin-top:20px" class="agen">
                    <div><img src="files/laundryku.jpg" width=80 height=80 alt="foto" style="float:left;margin-right:10px"></div>
                    <h3><?= $dataAgen["nama_laundry"] ?></h3>
                    <div>
                        <ul>
                            <li>Alamat : <?= $dataAgen["alamat"] ?></li>
                            <li>No. Telp : <?= $dataAgen["telp"] ?></li>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
