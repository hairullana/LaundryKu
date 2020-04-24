<?php 

// mulai session
session_start();
include 'connect-db.php';

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
    $nama = $pelanggan["nama"];
    $email = $pelanggan["email"];
    $telp = $pelanggan["telp"];
    $kota = $pelanggan["kota"];
    $alamat = $pelanggan["alamat"];

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
    <title>Data Penggunan - <?= $data["nama"] ?></title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3>DATA PENGGUNA</h3>
        <form action="" method="post">
            <ul>
                <li><input type="text" name="nama" value="<?= $data['nama'] ?>"></li>
                <li><input type="text" name="email" value="<?= $data['email'] ?>"></li>
                <li><input type="text" name="telp" value="<?= $data['telp'] ?>"></li>
                <li><input type="text" name="kota" value="<?= $data['kota'] ?>"></li>
                <li><textarea name="alamat"><?= $data['alamat'] ?></textarea></li>
                <li><button type="submit" name="ubah-data">Ubah Data</button> <a href="lupa-kata-sandi.php">Lupa Kata Sandi ?</a></li>
            </ul>
        </form>
    </div>
</body>
</html>