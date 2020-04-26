<?php

session_start();
include 'connect-db.php';

if ( !(isset($_SESSION["login-admin"])) ){
    if ( !(isset($_SESSION["admin"])) ){
        echo "
            <script>
                alert('Belum Login Sebagai Admin !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}

//konfirgurasi pagination
$jumlahDataPerHalaman = 3;
$query = mysqli_query($connect,"SELECT * FROM pelanggan");
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
$pelanggan = mysqli_query($connect,"SELECT * FROM pelanggan LIMIT $awalData, $jumlahDataPerHalaman");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
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
        <table cellpadding=10 border=1>
            <tr>
                <td>ID Pelanggan</td>
                <td>Nama</td>
                <td>No Telp</td>
                <td>Email</td>
                <td>Kota</td>
                <td>Alamat Lengkap</td>
                <td>Aksi</td>
            </tr>

            <?php foreach ($pelanggan as $dataPelanggan) : ?>
            
            <tr>
                <td><?= $dataPelanggan["id_pelanggan"] ?></td>
                <td><?= $dataPelanggan["nama"] ?></td>
                <td><?= $dataPelanggan["telp"] ?></td>
                <td><?= $dataPelanggan["email"] ?></td>
                <td><?= $dataPelanggan["kota"] ?></td>
                <td><?= $dataPelanggan["alamat"] ?></td>
                <td><a href="hapus-pelanggan.php?id=<?= $dataPelanggan['id_pelanggan'] ?>">Hapus Data</a></td>
            </tr>

            <?php endforeach ?>
        </table>
        
    </div>

</body>
</html>