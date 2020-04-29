<?php 

// mulai session
session_start();
include 'connect-db.php';
include 'functions/function.php';

if ( !isset($_SESSION["pelanggan"]) && !isset($_SESSION["login-pelanggan"]) ){
    echo "
        <script>
            alert ('Anda Belum Login Sebagai Pelanggan !');
            document.location.href = 'index.php';
        </script>
    ";
}

// mengambil email di session
$idPelanggan = $_SESSION["pelanggan"];

// ambil data di db
$data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");

// jadikan array assoc
$data = mysqli_fetch_assoc($data);

//var_dump($idPelanggan);die;


// AKSI UBAH DATA
function ubah($pelanggan){
    global $connect;
    global $idPelanggan;

    // mengambil pelanggan
    $nama = htmlspecialchars($pelanggan["nama"]);
    $email = htmlspecialchars($pelanggan["email"]);
    $telp = htmlspecialchars($pelanggan["telp"]);
    $kota = htmlspecialchars($pelanggan["kota"]);
    $alamat = htmlspecialchars($pelanggan["alamat"]);

    // validasi
    validasiNama($nama);
    validasiEmail($email);
    validasiTelp($telp);
    validasiNama($kota);

    
    $query = "UPDATE pelanggan SET
        nama = '$nama',
        email = '$email',
        telp = '$telp',
        kota = '$kota',
        alamat = '$alamat'
        WHERE id_pelanggan = $idPelanggan
    ";

    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}


if ( isset($_POST["ubah-data"]) ){
    if ( ubah($_POST) > 0 ){

        // panggis isi db
        $pelanggan = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan");
        $pelanggan = mysqli_fetch_assoc($pelanggan);

        // mengganti session
        $_SESSION["pelanggan"] = $pelanggan["id_pelanggan"];
        echo "
            <script>
                alert('Data Berhasil Diupdate !');
                document.location.href = 'pelanggan.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Gagal Diupdate !');
            </script>
        ";
    }
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Data Penggunan - <?= $data["nama"] ?></title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h3 class="header light center">DATA PENGGUNA</h3>
        <form action="" method="post" class="center">
            <div class="input-field inline">
                <ul>
                    <li><input type="text" size=60 name="nama" value="<?= $data['nama'] ?>"></li>
                    <li><input type="text" size=60 name="email" value="<?= $data['email'] ?>"></li>
                    <li><input type="text" size=60 name="telp" value="<?= $data['telp'] ?>"></li>
                    <li><input type="text" size=60 name="kota" value="<?= $data['kota'] ?>"></li>
                    <li><textarea class="materialize-textarea" name="alamat"><?= $data['alamat'] ?></textarea></li>
                    <li><button class="btn-large blue darken-2" type="submit" name="ubah-data">Simpan Data</button></li>
                    <br>
                    <li><a class="btn red darken-2" href="ganti-kata-sandi.php">Ganti Kata Sandi</a></li>
                </ul>
            </div>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>