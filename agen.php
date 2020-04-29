<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';


// harus agen yg kesini
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

// klo ubah data agen
if ( isset($_POST["simpan"]) ){
    //ambil data
    $namaLaundry = htmlspecialchars($_POST["namaLaundry"]);
    $namaPemilik = htmlspecialchars($_POST["namaPemilik"]);
    $email = htmlspecialchars($_POST["email"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $platDriver = htmlspecialchars($_POST["platDriver"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    // validasi
    validasiNama($namaPemilik);
    validasiEmail($email);
    validasiTelp($telp);
    validasiNama($kota);

    
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
    <?php include 'headtags.html'; ?>
    <title>Profil Agen</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <!-- data agen -->
    <div class="row">
        <div class="col s6 offset-s3">
            <h3 class="header light center">Data Agen</h3>
            <form action="" method="post">
                <div class="input-field">
                    <label for="namaLaundry">Nama Laundry</label>
                    <input type="text" id="namaLaundry" name="namaLaundry" value="<?= $agen['nama_laundry']?>">
                </div>
                <div class="input-field">
                    <label for="namaPemilik">Nama Pemilik</label>
                    <input type="text" id="namaPemilik" name="namaPemilik" value="<?= $agen['nama_pemilik']?>">
                </div>
                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="<?= $agen['email']?>">
                </div>
                <div class="input-field">
                    <label for="telp">No Telp</label>
                    <input type="text" id="telp" name="telp" value="<?= $agen['telp']?>">
                </div>
                <div class="input-field">
                    <label for="plat">Plat Driver</label>
                    <input type="text" id="plat" name="platDriver" value="<?= $agen['plat_driver']?>">
                </div>
                <div class="input-field">
                    <label for="kota">Kota / Kabupaten</label>
                    <input type="text" name="kota" value="<?= $agen['kota']?>">
                </div>
                <div class="input-field">
                    <label for="alamat">Alamat</label>
                    <textarea class="materialize-textarea" name="alamat"><?= $agen['alamat']?></textarea>
                </div>
                <div class="input-field center">
                    <button class="btn-large blue darken-2" type="submit" name="simpan">Simpan Data</button>
                </div>

                <div class="center">
                    <a class="btn red darken-2" href="ganti-kata-sandi.php">Ganti Kata Sandi</a>
                    <a class="btn red darken-2" href="edit-harga.php">Ganti Data Harga</a>
                </div>

                </div>
            </form>
        </div>
    </div>
    <!-- end data agen -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->
</body>
</html>
