<?php

session_start();
include 'connect-db.php';

if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Bukan Agen !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

$idAgen = $_SESSION['agen'];

// ambil data agen
$query = "SELECT * FROM agen WHERE id_agen = '$idAgen'";
$result = mysqli_query($connect, $query);
$agen = mysqli_fetch_assoc($result);
$idAgen = $agen["id_agen"];

if ( isset($_POST["simpan"]) ){
    //ambil data
    $namaLaundry = $_POST["namaLaundry"];
    $namaPemilik = $_POST["namaPemilik"];
    $email = $_POST["email"];
    $telp = $_POST["telp"];
    $platDriver = $_POST["platDriver"];
    $kota = $_POST["kota"];
    $alamat = $_POST["alamat"];

    // memastikan no hp angka saja
    // memecah no telp
    $telp = str_split($telp);
    $total = count($telp);

    // cek no hp
    for ($i=0 ; $i<$total ; $i++){
        // mengecek no telp harus angka
        if ($telp[$i] != "1" && $telp[$i] != "2" && $telp[$i] != "3" && $telp[$i] != "4" && $telp[$i] != "5" && $telp[$i] != "6" && $telp[$i] != "7" && $telp[$i] != "8" && $telp[$i] != "9" && $telp[$i] != "0"){
            $telp[$i] = "";
        }
    }

    // menggabungkan string
    $telp = implode($telp);

    
    $query = "UPDATE agen SET
        nama_laundry = '$namaLaundry',
        nama_pemilik = '$namaPemilik',
        email = '$email',
        telp = '$telp',
        kota = '$kota',
        plat_driver = '$platDriver',
        alamat = '$alamat'
        WHERE id_agen = $idAgen
    ";

    mysqli_query($connect,$query);

    if ( mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                alert('Data Berhasil Di Update !');
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Gagal Di Update !');
            </script>
        ";
        echo mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Agen</title>
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href='agen.php'><?= $agen["nama_laundry"] ?></a></li>
            <li><a href='logout.php'>Logout</a></li>
        </ul>
    </div>
    <div id="body">
        <h3>Data Agen</h3>
        <form action="" method="post">
            <ul>
                <li><input type="text" name="namaLaundry" value="<?= $agen['nama_laundry']?>"></li>
                <li><input type="text" name="namaPemilik" value="<?= $agen['nama_pemilik']?>"></li>
                <li><input type="text" name="email" value="<?= $agen['email']?>"></li>
                <li><input type="text" name="telp" value="<?= $agen['telp']?>"></li>
                <li><input type="text" name="platDriver" value="<?= $agen['plat_driver']?>"></li>
                <li><input type="text" name="kota" value="<?= $agen['kota']?>"></li>
                <li><textarea name="alamat"><?= $agen['alamat']?></textarea></li>
                <li><button type="submit" name="simpan">Simpan Data</button>   <a href="">Lupa Kata Sandi ?</a></li>

                
                <p><a href="edit-harga.php">Ubah Data Harga</a></p>

            </ul>
        </form>
    </div>
</body>
</html>
