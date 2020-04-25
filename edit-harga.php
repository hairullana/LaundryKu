<?php

session_start();
include 'connect-db.php';


$idAgen = $_SESSION["agen"];
$cuci = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'cuci'");
$cuci = mysqli_fetch_assoc($cuci);
$setrika = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'setrika'");
$setrika = mysqli_fetch_assoc($setrika);
$komplit = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'komplit'");
$komplit = mysqli_fetch_assoc($komplit);


function ubahHarga($data){
    global $connect, $idAgen;

    $hargaCuci = $data["cuci"];
    $hargaSetrika = $data["setrika"];
    $hargaKomplit = $data["komplit"];

    $query1 = "UPDATE harga SET
        harga = $hargaCuci
        WHERE jenis = 'cuci' AND id_agen = $idAgen
    ";
    $query2 = "UPDATE harga SET
        harga = $hargaSetrika
        WHERE jenis = 'setrika' AND id_agen = $idAgen
    ";
    $query3 = "UPDATE harga SET
        harga = $hargaKomplit
        WHERE jenis = 'komplit' AND id_agen = $idAgen
    ";

    mysqli_query($connect,$query1);
    $hasil1 = mysqli_affected_rows($connect);
    mysqli_query($connect,$query2);
    $hasil2 = mysqli_affected_rows($connect);
    mysqli_query($connect,$query3);
    $hasil3 = mysqli_affected_rows($connect);

    return $hasil1+$hasil2+$hasil3;
}

if (isset($_POST["simpan"])) {

    if ( ubahHarga($_POST) > 0)   {
        echo "
            <script>
                alert('Harga Berhasil Di Ubah');
                document.location.href = 'edit-harga.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Harga Gagal Di Ubah');
            </script>
        ";
        mysqli_error($connect);
    }

}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Harga</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3>DATA HARGA</h3>
        <form action="" method="post">
            <ul>
                <li>Cuci : <input type="text" name="cuci" value="<?= $cuci['harga'] ?>"> / Kg</li>
                <li>Setrika : <input type="text" name="setrika" value="<?= $setrika['harga'] ?>"> / Kg</li>
                <li>Cuci+Setrika : <input type="text" name="komplit" value="<?= $komplit['harga'] ?>"> / Kg</li>
                <li><button type="submit" name="simpan">Simpan Data</button></li>
            </ul>
        </form>
    </div>
</body>
</html>