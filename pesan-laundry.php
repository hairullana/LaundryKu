<?php

session_start();
include 'connect-db.php';

if ( !isset($_SESSION["pelanggan"])){
    if (!isset($_SESSION["login-pelanggan"])){
        echo "
            <script>
                alert('Anda Harus Login Sebagai Pelanggan');
                document.location.href = 'index.php';
            </script>
        ";
    }
}

// ambil data agen
$idAgen = $_GET["id"];
$query = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$idAgen'");
$agen = mysqli_fetch_assoc($query);

// ambil data pelanggan
$idPelanggan = $_SESSION["pelanggan"];
$query = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");
$pelanggan = mysqli_fetch_assoc($query);

if (isset($_POST["pesan"])){
    $alamat = $_POST["alamat"];
    $jenis = $_POST["jenis"];
    $catatan = $_POST["catatan"];
    $tgl = date("Y-m-d H:i:s");
    $total = $_POST["total"];

    $query = mysqli_query($connect, "INSERT INTO cucian (id_agen, id_pelanggan, tgl_mulai, jenis, total_item, alamat, catatan, status_cucian) VALUES ($idAgen, $idPelanggan, '$tgl', '$jenis', $total, '$alamat', '$catatan', 'Penjemputan')");

    if (mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                alert('Pesanan Berhasil Dibuat');
                document.location.href = 'status.php';
            </script>
        ";
    }else {
        echo mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'header.php' ?>
    <div id="body">
        <h1><?= $agen["nama_laundry"] ?></h1>
        <h4><?= "( " . $agen["alamat"] . ", " . $agen["kota"] . " )" ?></h4>
        <div>RATING</div>
        <br/>
        <hr/>
        <form action="" method="post">
            <div>
                <h3>DATA DIRI</h3>
                <ul>
                    <li><input type="text" disabled value="<?= $pelanggan['nama'] ?>"></li>
                    <li><input type="text" disabled value="<?= $pelanggan['telp'] ?>"></li>
                    <li><textarea name="alamat" id="alamat" cols="30" rows="10"><?= $pelanggan['alamat'] . ", " . $pelanggan['kota'] ?></textarea></li>
                </ul>
            </div>
            <div>
                <h3>Info Paket Laundry</h3>
                <ul>
                    <li>Total Item :
                        <input type="text" name="total" value="1">
                    </li>
                    <li>Jenis Paket :
                        <select name="jenis" id="jenis">
                            <option value="Cuci">Cuci</option>
                            <option value="Setrika">Setrika</option>
                            <option value="Cuci + Setrika">Cuci + Setrika</option>
                        </select>
                    </li>
                    <li>Catatan :
                        <textarea name="catatan" id="catatan" cols="30" rows="10" placeholder="Tulis catatan untuk agen"></textarea>
                    </li>
                    <li><button type="submit" name="pesan">Buat Pesanan</button></li>
                </ul>
            </div>
        </form>

    </div>
</body>
</html>