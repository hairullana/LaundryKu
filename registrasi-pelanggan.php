<?php

    // koneksi ke db
    session_start();
    include 'connect-db.php';
    include 'functions/functions.php';

    cekLogin();

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
    <div class="row">
        <div class="col s6 offset-s3">
            <form action="" method="POST">
                <div class="input-field inline">
                    <ul>
                        <li>
                            <label for="nama">Nama</label>
                            <input type="text" size=70 id="nama" placeholder="Nama" name="nama">
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="text" size=70 id="email" placeholder="E-mail" name="email">
                        </li>
                        <li>
                            <label for="telp">No Telp</label>
                            <input type="text" size=70 id="telp" placeholder="No Telp" name="noTelp">
                        </li>
                        <li>
                            <label for="kota">Kota / Kabupaten</label>
                            <input type="text" size=70 id="kota" placeholder="Kota / Kabupaten" name="kota">
                        </li>
                        <li>
                            <label for="alamat">Alamat Lengkap</label>
                            <input type="text" size=70 id="alamat" placeholder="Alamat Lengkap" name="alamat">
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="Password" name="password">
                        </li>
                        <li>
                            <label for="repassword">Re-type Password</label>
                            <input type="password" id="repassword" placeholder="Re-type Password" name="password2">
                        </li>
                        <li>
                            <div class="center">
                                <button class="btn-large blue darken-3" type="submit" name="registrasi">Daftar</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
            <div class="center">
                Ingin menjadi mitra kami ?<br/>
                Dafar sebagai agen sekarang !<br/>
                <br>
                <a class="btn-large red darken-2" href="registrasi-agen.php">Registrasi Sebagai Agen</a>
            </div>
        </div>
    </div>
    <!-- end body -->


    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->

</body>
</html>

<?php

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
                Swal.fire('Pendaftaran Gagal','Email Sudah Terdaftar','error');
            </script>
        ";
        // RETURN FALSE
        return false;
    }

    //cek konfirmasi password
    if ($password != $password2) {
        echo "
            <script>   
                Swal.fire('Pendaftaran Gagal','Password Tidak Sama','error');
            </script>
        ";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // masukkan data user ke db
    mysqli_query($connect, "INSERT INTO pelanggan VALUES ('','$nama','$email','$noTelp','$kota','$alamat','default.png','$password')");

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
                Swal.fire('Pendaftaran Berhasil','Selamat Bergabung Dengan LaundryKu','success').then(function() {
                    window.location = 'index.php';
                });
            </script>
        ";
    }else {
        echo mysqli_error($connect);
    }

}

?>