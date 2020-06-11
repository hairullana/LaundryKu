<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';


// harus agen yg kesini
cekAgen();

// ambil data agen
$idAgen = $_SESSION["agen"];
$query = "SELECT * FROM agen WHERE id_agen = '$idAgen'";
$result = mysqli_query($connect, $query);
$agen = mysqli_fetch_assoc($result);
$idAgen = $agen["id_agen"];



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
            <br><br>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="center">
                    <img src="img/agen/<?= $agen['foto'] ?>" class="circle responsive-img" width=25% alt="">
                </div>
                <div class="file-field input-field">
                    <div class="btn blue darken-2">
                        <span>Foto Profil</span>
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload foto profil">
                    </div>
                </div>
                <div class="input-field">
                    <ul>
                        <li>
                            <label for="namaLaundry">Nama Laundry</label>
                            <input type="text" id="namaLaundry" name="namaLaundry" value="<?= $agen['nama_laundry']?>">
                        </li>
                        <li>
                            <label for="namaPemilik">Nama Pemilik</label>
                            <input type="text" id="namaPemilik" name="namaPemilik" value="<?= $agen['nama_pemilik']?>">
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" value="<?= $agen['email']?>">
                        </li>
                        <li>
                            <label for="telp">No Telp</label>
                            <input type="text" id="telp" name="telp" value="<?= $agen['telp']?>">
                        </li>
                        <li>
                            <label for="plat">Plat Driver</label>
                            <input type="text" id="plat" name="platDriver" value="<?= $agen['plat_driver']?>">
                        </li>
                        <li>
                            <label for="kota">Kota / Kabupaten</label>
                            <input type="text" name="kota" value="<?= $agen['kota']?>">
                        </li>
                        <li>
                            <label for="alamat">Alamat</label>
                            <textarea class="materialize-textarea" name="alamat"><?= $agen['alamat']?></textarea>
                        </li>
                        <li>
                            <div class="center">
                                <button class="btn-large blue darken-2" type="submit" name="simpan">Simpan Data</button>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </form>
            <div class="center">
                <a class="btn red darken-2" href="ganti-kata-sandi.php">Ganti Kata Sandi</a>
                <a class="btn red darken-2" href="edit-harga.php">Ganti Data Harga</a>
            </div>

        </div>
    </div>
    <!-- end data agen -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->
</body>
</html>


<?php



// klo ubah data agen
if ( isset($_POST["simpan"]) ){

    function uploadFoto(){
        //data foto
        $ukuranFile = $_FILES["foto"]["size"];
        $temp = $_FILES["foto"]["tmp_name"];
        $namaFile = $_FILES["foto"]["name"];
        $error = $_FILES["foto"]["error"];

        if ($namaFile == NULL){
            return NULL;
            exit;
        }

        //cek apakah file adalah gambar
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        // explode = memecah string menjadi array (dg pemisah delimiter)
        $ekstensiGambar = explode('.',$namaFile);
        //mengambil ekstensi gambar yg paling belakang dg strltolower (mengecilkan semua huruf)
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        //CEK $ekstensiGambar ada di array $ekstensiGambarValid
        if ( !in_array($ekstensiGambar,$ekstensiGambarValid) ){
            echo "
                <script>
                    Swal.fire('Masukkan Format Gambar','','warning');
                </script>
            ";
            return false;
            exit;
        }

        //CEK ukuran file
        if ( $ukuranFile > 3000000 ) {
            echo "
                <script>
                    Swal.fire('Ukuran Gambar Terlalu Besar','','warning');
                </script>
            ";
            return false;
            exit;
        }

        //LOLOS CEK BROOO
        //generate nama baru random
        $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
        move_uploaded_file($temp,'img/agen/'.$namaFileBaru);

        return $namaFileBaru;
    }

    //ambil data
    $namaLaundry = htmlspecialchars($_POST["namaLaundry"]);
    $namaPemilik = htmlspecialchars($_POST["namaPemilik"]);
    $email = htmlspecialchars($_POST["email"]);
    $telp = htmlspecialchars($_POST["telp"]);
    $platDriver = htmlspecialchars($_POST["platDriver"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $foto = uploadFoto();

    if ($foto == NULL){
        $foto = $agen["foto"];
    }

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
        alamat = '$alamat',
        foto = '$foto'
        WHERE id_agen = $idAgen
    ";

    mysqli_query($connect,$query);

    if ( mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                Swal.fire('Data Berhasil Di Update','','success').then(function() {
                    window.location = 'agen.php';
                });
            </script>
        ";
    }
}


?>