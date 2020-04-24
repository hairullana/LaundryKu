<?php

// mulai session
session_start();
include 'connect-db.php';

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
    $namaLaundry = $agen["namaLaundry"];
    $namaPemilik = $agen["namaPemilik"];
    $email = $agen["email"];
    $telp = $agen["telp"];
    $kota = $agen["kota"];
    $alamat = $agen["alamat"];
    $platDriver = $agen["platDriver"];
    $password = $agen["password"];
    $password2 = $agen["password2"];

    // enskripsi password
    $password = mysqli_real_escape_string($connect , $agen["password"]);
    $password2 = mysqli_real_escape_string($connect , $agen["password2"]);

    //cek username apakah ada yg sama
    
    $result = mysqli_query($connect, "SELECT email FROM pelanggan WHERE email = '$email'");
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
    <title>Registrasi Agen</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <div class="body">
            <div><img src="files/laundryku.jpg" alt="laundryku" width=300 height=auto/></div>
            <div><b>Syarat dan Ketentuan :</b></div>
            <div>1. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, accusamus? Excepturi officia inventore dolor, quisquam facere ipsum quis perspiciatis. Consequuntur rem molestiae sint, commodi atque magnam. Unde blanditiis quam quo.</div>
            <div>2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic natus aut rerum similique ad, voluptatibus magnam tenetur velit sapiente dicta sunt molestiae culpa deleniti, corrupti dolor unde, beatae ea eos.</div>
            <div>3. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt hic laboriosam beatae explicabo, et consequatur? Omnis error sapiente accusamus soluta cum minus libero quasi ab ut, quo rerum hic aspernatur?</div>
            <div>4. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente iusto eligendi ex odio quia reiciendis in expedita eveniet dicta tempore, maxime, laboriosam hic nostrum inventore assumenda accusantium perferendis illo voluptate!</div>
            <div>5. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error, eveniet suscipit repellendus non dolore repellat! At, reprehenderit tempora! Accusamus ut itaque veritatis doloremque delectus dolorem architecto quo perspiciatis reiciendis unde?</div>
        </div>
        <div class="body">
            <h3>DAFTAR SEBAGAI AGEN</h3>
            <form action="" method="post">
                <ul>
                    <li><input type="text" name="namaLaundry" placeholder="Nama Laundry"></li>
                    <li><input type="text" name="namaPemilik" placeholder="Nama Pemilik"></li>
                    <li><input type="text" name="telp" placeholder="No Telp"></li>
                    <li><input type="text" name="email" placeholder="Email"></li>
                    <li><input type="text" name="platDriver" placeholder="Plat Driver"></li>
                    <li><input type="text" name="kota" placeholder="Kota / Kabupaten"></li>
                    <li><textarea name="alamat" placeholder="Alamat Lengkap"></textarea></li>
                    <li><input type="password" name="password" placeholder="Password"></li>
                    <li><input type="password" name="password2" placeholder="Ulangi Password"></li>
                    <li><button type="submit" name="daftar">Daftar</button></li>
                </ul>
            </form>
        </div>
    </div>
</body>
</html>