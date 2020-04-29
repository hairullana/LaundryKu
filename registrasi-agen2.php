<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Bukan Agen !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

$idAgen = $_SESSION["agen"];

// ambil data agen
$query = "SELECT * FROM agen WHERE id_agen = '$idAgen'";
$result = mysqli_query($connect, $query);
$agen = mysqli_fetch_assoc($result);

function dataHarga($data){
    global $connect, $idAgen;

    $cuci = htmlspecialchars($data["cuci"]);
    $setrika = htmlspecialchars($data["setrika"]);
    $komplit = htmlspecialchars($data["komplit"]);

    validaiHarga($cuci);
    validaiHarga($setrika);
    validaiHarga($komplit);

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
    <?php include "headtags.html"; ?>
    <title>Registrasi Agen Lanjutan</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php' ?>
    <!-- end header -->

    <!-- term -->
    <div class="row">
        <div class="col s4 offset-s1">
            <div class="card">
                <div class="col center" style="margin:20px">
                    <img src="img/banner.png" alt="laundryku" width=100%/><br><br>
                    <span class="card-title black-text">Syarat dan Ketentuan :</span>
                </div>
            <div class="card-content">
                <p>1. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, accusamus? Excepturi officia inventore dolor, quisquam facere ipsum quis perspiciatis. Consequuntur rem molestiae sint, commodi atque magnam. Unde blanditiis quam quo.</p>
                <p>2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic natus aut rerum similique ad, voluptatibus magnam tenetur velit sapiente dicta sunt molestiae culpa deleniti, corrupti dolor unde, beatae ea eos.</p>
                <p>3. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt hic laboriosam beatae explicabo, et consequatur? Omnis error sapiente accusamus soluta cum minus libero quasi ab ut, quo rerum hic aspernatur?</p>
                <p>4. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente iusto eligendi ex odio quia reiciendis in expedita eveniet dicta tempore, maxime, laboriosam hic nostrum inventore assumenda accusantium perferendis illo voluptate!</p>
                <p>5. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error, eveniet suscipit repellendus non dolore repellat! At, reprehenderit tempora! Accusamus ut itaque veritatis doloremque delectus dolorem architecto quo perspiciatis reiciendis unde?</p>
            </div>
            <div class="card-action">
                <a href="term.php">Baca Selengkapnya</a>
            </div>
        </div>
    </div>
    <!-- end term -->

    
    <div class="col s4 offset-s1">
        <h3 class="header light center">Data Harga</h3>
        <form action="" method="post">
            <div class="input-field inline">
                    Cuci : <input type="text" name="cuci" value="0">
                    Setrika : <input type="text" name="setrika" value="0">
                    Cuci + Setrika : <input type="text" name="komplit" value="0">
                    <div class="center"><button class="btn-large blue darken-2" type="submit" name="submit">Simpan Harga</button></div>
            </div>
        </form>
    </div>

</body>
</html>