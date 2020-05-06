<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

// cek apakah sudah login sebagai agen
cekAgen();

// mengambil id agen di session
$idAgen = $_SESSION["agen"];

// mengambil data harga pada db
$cuci = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'cuci'");
$cuci = mysqli_fetch_assoc($cuci);
$setrika = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'setrika'");
$setrika = mysqli_fetch_assoc($setrika);
$komplit = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'komplit'");
$komplit = mysqli_fetch_assoc($komplit);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Ubah Data Harga</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <!-- body -->
    <div class="container">
        <h3 class="header light center">Data Harga</h3>
        <form action="" method="post">
            <div class="input field">
                <label for="cuci">Cuci</label>
                <input type="text" id="cuci" name="cuci" value="<?= $cuci['harga'] ?>">
            </div>
            <div class="input field">
                <label for="setrika">Setrika</label>
                <input type="text" id="setrika" name="setrika" value="<?= $setrika['harga'] ?>">
            </div>
            <div class="input field">
                <label for="komplit">Cuci + Setrika</label><input type="text" id="komplit" name="komplit" value="<?= $komplit['harga'] ?>">
            </div>
            <div class="input field center">
                <button class="btn-large blue darken-2" type="submit" name="simpan">Simpan Data</button>
            </div>
        </form>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php include "footer.php" ?>
    <!-- end footer -->

</body>
</html>

<?php


// fungsi mengubah harga
function ubahHarga($data){
    global $connect, $idAgen;

    $hargaCuci = htmlspecialchars($data["cuci"]);
    $hargaSetrika = htmlspecialchars($data["setrika"]);
    $hargaKomplit = htmlspecialchars($data["komplit"]);

    validasiHarga($hargaCuci);
    validasiHarga($hargaSetrika);
    validasiHarga($hargaKomplit);

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


// jika user menekan tombol simpan harga
if (isset($_POST["simpan"])) {

    if ( ubahHarga($_POST) > 0)   {
        echo "
            <script>
                Swal.fire('Data Berhasil Di Update','','success').then(function() {
                    window.location = 'edit-harga.php';
                });
            </script>
        ";
    }else {
        echo "
            <script>
                Swal.fire('Data Gagal Di Update','','error');
            </script>
        ";
        mysqli_error($connect);
    }

}

?>