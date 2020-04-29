<?php

// mulai session
session_start();
include 'connect-db.php';
include 'functions/functions.php';

// kalau sudah login
if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Sudah Mendaftar !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

function registrasi($agen){

    global $connect;

    // ambil data agen
    $namaLaundry = htmlspecialchars($agen["namaLaundry"]);
    $namaPemilik = htmlspecialchars($agen["namaPemilik"]);
    $email = htmlspecialchars($agen["email"]);
    $telp = htmlspecialchars($agen["telp"]);
    $kota = htmlspecialchars($agen["kota"]);
    $alamat = htmlspecialchars($agen["alamat"]);
    $platDriver = htmlspecialchars($agen["platDriver"]);
    $password = htmlspecialchars($agen["password"]);
    $password2 = htmlspecialchars($agen["password2"]);

    // enskripsi password
    $password = mysqli_real_escape_string($connect , $agen["password"]);
    $password2 = mysqli_real_escape_string($connect , $agen["password2"]);

    //cek username apakah ada yg sama
    
    $result = mysqli_query($connect, "SELECT email FROM agen WHERE email = '$email'");
    if ( mysqli_fetch_assoc($result) ){ //jika ada ada
        echo "
            <script>
                alert('Email Sudah Terdaftar !');
            </script>
        ";
        // RETURN FALSE
        return false;
    }

    //cek konfirmasi password
    if ($password != $password2) {
        echo "
            <script>   
                alert('Password Tidak Sama !');
            </script>
        ";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    //pastikan nomor hp hanya angka
    $telp = $agen["telp"];
    // memecah no telp
    $telp = str_split($telp);
    $totaltelp = count($telp);

    // cek no hp
    for ($i=0 ; $i<$totaltelp ; $i++){
        // mengecek no telp harus angka
        if ($telp[$i] != "1" && $telp[$i] != "2" && $telp[$i] != "3" && $telp[$i] != "4" && $telp[$i] != "5" && $telp[$i] != "6" && $telp[$i] != "7" && $telp[$i] != "8" && $telp[$i] != "9" && $telp[$i] != "0"){
            $telp[$i] = "";
        }
    }

    // menggabungkan string
    $telp = implode($telp);

    $query = "INSERT INTO agen VALUES (
        '',
        '$namaLaundry',
        '$namaPemilik',
        '$telp',
        '$email',
        '$kota',
        '$alamat',
        '$platDriver',
        '$password'
    )";

    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

// AKSI DAFTAR
if (isset($_POST["daftar"])) {

    if  ( registrasi($_POST) > 0) {
        // ambil data agen di db
        $email = $_POST['email'];
        $query  = "SELECT * FROM agen WHERE email = '$email'";
        $result = mysqli_query($connect,$query);
        $agen = mysqli_fetch_assoc($result);

        // buat session
        $_SESSION["agen"] = $agen["id_agen"];
        $_SESSION["login-agen"] = true;
        
        echo "
            <script>
                alert ('Registrasi Sebagai Agen Berhasil !');
                document.location.href = 'registrasi-agen2.php';
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
    <?php include "headtags.html" ?>
    <title>Registrasi Agen</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <div class="row">

        <!-- term -->
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
        <!-- end term -->
    </div>

    <!-- regis -->
    <div class="col s4 offset-s1">
        <h3 class="header light center">DAFTAR SEBAGAI AGEN</h3>
        <form action="" class="col center" method="post">
            <div class="input-field inline">
                <ul>
                    <li><input type="text" size=50 name="namaLaundry" placeholder="Nama Laundry"></li>
                    <li><input type="text" size=50 name="namaPemilik" placeholder="Nama Pemilik"></li>
                    <li><input type="text" size=50 name="telp" placeholder="No Telp"></li>
                    <li><input type="text" size=50 name="email" placeholder="Email"></li>
                    <li><input type="text" size=50 name="platDriver" placeholder="Plat Driver"></li>
                    <li><input type="text" size=50 name="kota" placeholder="Kota / Kabupaten"></li>
                    <li><textarea class="materialize-textarea" name="alamat" placeholder="Alamat Lengkap"></textarea></li>
                    <li><input type="password" name="password" placeholder="Password"></li>
                    <li><input type="password" name="password2" placeholder="Ulangi Password"></li>
                    <li><button class="btn-large blue darken-2" type="submit" name="daftar">Daftar</button></li>
                </ul>        
            </div>
        </form>
    </div>
    <!-- end regis -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->
</body>
</html>