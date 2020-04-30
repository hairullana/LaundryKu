<?php

    // koneksi ke db
    session_start();
    include 'connect-db.php';
    include 'functions/functions.php';

    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
        echo "
            <script>
                alert('Anda Sudah Mendaftar !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }

    // fungsi registrasi
    function registrasi ($data) {
        global $connect;

        //mengambil data
        $nama = htmlspecialchars($data["nama"]);
        $email = htmlspecialchars($data["email"]);
        $noTelp = htmlspecialchars($data["noTelp"]);
        $kota = htmlspecialchars($data["kota"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $password = htmlspecialchars($data["password"]);
        $password2 = htmlspecialchars($data["password2"]);

        // validasi
        validasiNama($nama);
        validasiEmail($email);
        validasiTelp($noTelp);
        validasiNama($kota);

        // enskripsi password
        $password = mysqli_real_escape_string($connect , $data["password"]);
        $password2 = mysqli_real_escape_string($connect , $data["password2"]);

        //cek username apakah ada yg sama        
        $result = mysqli_query($connect, "SELECT email FROM pelanggan WHERE email = '$email'");
        if ( mysqli_fetch_assoc($result) ){ //jika ada (TRUE)
            echo "
                <script>
                    alert('Email Sudah Terdaftar :)');
                </script>
            ";
            // RETURN FALSE
            return false;
        }

        //cek konfirmasi password
        if ($password != $password2) {
            echo "
                <script>   
                    alert('Password Tidak Sama :)');
                </script>
            ";
            return false;
        }

        //enskripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // masukkan data user ke db
        mysqli_query($connect, "INSERT INTO pelanggan VALUES ('','$nama','$email','$noTelp','$kota','$alamat','$password')");

        // RETURN TRUE
        return mysqli_affected_rows($connect);
    }


    // ketika tombol registrasi di klik
    if ( isset($_POST["registrasi"]) ){
        if ( registrasi($_POST) > 0 ) {

            $email = $_POST["email"];
            $query = mysqli_query($connect, "SELECT * FROM pelanggan WHERE email = '$email'");
            $pelanggan = mysqli_fetch_assoc($query);
            $_SESSION["pelanggan"] = $pelanggan["id_pelanggan"];
            $_SESSION["login-pelanggan"] = true;
            echo "
                <script>
                    alert('Registrasi Berhasil !!!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else {
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
    <title>Registrasi Pelanggan</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <h3 class="header light center">Registrasi Pelanggan</h3>

    <!-- body -->
    <div class="container center">
        <form action="" method="POST">
            <div class="input-field inline">
                <ul>
                    <li><input type="text" size=70 placeholder="Nama" name="nama"></li>
                    <li><input type="text" size=70 placeholder="E-mail" name="email"></li>
                    <li><input type="text" size=70 placeholder="No Telp" name="noTelp"></li>
                    <li><input type="text" size=70 placeholder="Kota / Kabupaten" name="kota"></li>
                    <li><input type="text" size=70 placeholder="Alamat Lengkap" name="alamat"></li>
                    <li><input type="password" placeholder="Password" name="password"></li>
                    <li><input type="password" placeholder="Re-type Password" name="password2"></li>
                    <li><button class="btn-large blue darken-3" type="submit" name="registrasi">Daftar</button></li>
                </ul>
            </div>
        </form>
        <div>
            <br>
            Ingin menjadi mitra kami ?<br/>
            Dafar sebagai agen sekarang !<br/>
            <br>
            <a class="btn-large red darken-2" href="registrasi-agen.php">Registrasi Sebagai Agen</a>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
