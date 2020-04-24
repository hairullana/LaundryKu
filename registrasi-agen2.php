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

function dataHarga($data){
    global $connect, $idAgen;

    $cuci = $data["cuci"];
    $setrika = $data["setrika"];
    $komplit = $data["komplit"];

    $query2 = "INSERT INTO harga VALUES(
        '',
        'cuci',
        '$idAgen',
        '$cuci'
    )";
    $query3 = "INSERT INTO harga VALUES(
        '',
        'setrika',
        '$idAgen',
        '$setrika'
    )";
    $query4 = "INSERT INTO harga VALUES(
        '',
        'komplit',
        '$idAgen',
        '$komplit'
    )";

    $result2 = mysqli_query($connect, $query2);
    $result3 = mysqli_query($connect, $query3);
    $result4 = mysqli_query($connect, $query4);

    return mysqli_affected_rows($connect);
}

if ( isset($_POST["submit"]) ){
    

    if ( dataHarga($_POST) > 0 ){
        echo "
            <script>
                alert('Data Berhasil Ditambahkan !');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan !');
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
    <title>Registrasi Agen Lanjutan</title>
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
        <h3>Data Harga</h3>
        <form action="" method="post">
            <ul>
                <li>Cuci : <input type="text" name="cuci"> / Kg</li>
                <li>Setrika : <input type="text" name="setrika"> / Kg</li>
                <li>Cuci + Setrika : <input type="text" name="komplit"> / Kg</li>
                <li><button type="submit" name="submit">Simpan Harga</button></li>
            </ul>
        </form>
    </div>

</body>
</html>
