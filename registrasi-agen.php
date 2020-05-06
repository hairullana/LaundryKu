<?php

// mulai session
session_start();
include 'connect-db.php';
include 'functions/functions.php';

// kalau sudah login
cekLogin();
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
                    <p>1.	Memiliki lokasi usaha laundry yang strategis dan teridentifikasi oleh google map</p>
                    <p>2.	Agen memiliki nama usaha serta logo perusahaan agar dapat diposting di website laundryKU</p>
                    <p>3.	Mampu memberikan layanan Laundry dengan kualitas prima dan harga yang bersaing</p>
                    <p>4.	Memiliki driver yang bersedia untuk melakukan penjemputan dan pengantaran terhadap laundry pelanggan</p>
                    <p>5.	Harga dari jenis laundry ditentukan berdasarkan berat per kilo (kg) ditambah dengan biaya ongkos kirim</p>
                    <p>6.	Bersedia untuk memberikan informasi kepada pelanggan mengenai harga Laundry Kiloan</p>
                    <p>7.	Bersedia untuk menerapkan sistem poin kepada pelanggan</p>
                    <p>8.	Bersedia memberikan kompensasi untuk setiap kemungkinan terjadinya seperti kehilangan pakaian atau kerusakan pakaian pada saat proses Laundry dilakukan</p>
                    <p>9.	Agen tidak diperkenankan untuk melakukan kerjasama dengan pihak Laundry lainnya</p>
                    <p>10.	Sebagai kompensasi atas kerjasama adalah sistem bagi hasil sebesar 5%, yang diperhitungkan dari setiap 7 hari</p>
                    <p>11.	Status agen secara otomatis dicabut apabila melanggar kesepakatan yang telah ditetapkan dalam surat perjanjian kerjasama ataupun agen ingin mengundurkan diri</p>
                </div>
                <div class="card-action">
                    <a href="term.php">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        <!-- end term -->

        <!-- regis -->
        <div class="col s4 offset-s1">
            <h3 class="header light center">DAFTAR SEBAGAI AGEN</h3>
            <form action="" method="post">
                <div class="input-field inline">
                    <ul>
                        <li>
                            <label for="namaLaundry">Nama Laundry</label>
                            <input type="text" size=50 id="namaLaundry" name="namaLaundry" placeholder="Nama Laundry">
                        </li>
                        <li>
                            <label for="namaPemilik">Nama Pemilik</label>
                            <input type="text" size=50 id="namaPemilik" name="namaPemilik" placeholder="Nama Pemilik">
                        </li>
                        <li>
                            <label for="telp">No Telp</label>
                            <input type="text" size=50 id="telp" name="telp" placeholder="No Telp">
                        </li>
                        <li>
                            <label for="email">E-mail</label>
                            <input type="text" size=50 id="email" name="email" placeholder="Email">
                        </li>
                        <li>
                            <label for="plat">Plat Driver</label>
                            <input type="text" size=50 id="plat" name="platDriver" placeholder="Plat Driver">
                        </li>
                        <li>
                            <label for="kota">Kota / Kabupaten</label>
                            <input type="text" size=50 id="kota" name="kota" placeholder="Kota / Kabupaten">
                        </li>
                        <li>
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea class="materialize-textarea" id="alamat" name="alamat" placeholder="Alamat Lengkap"></textarea>
                        </li>
                        <li>
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password">
                        </li>
                        <li>
                            <label for="repassword">Re-type Password</label>
                            <input type="password" id="repassword" name="password2" placeholder="Re-type Password">
                        </li>
                        <li>
                            <div id="setuju" class="center"><button class='btn-large blue darken-2' type='submit' name='daftar'>Daftar</button></div>
                        </li>
                    </ul>        
                </div>
            </form>
        </div>
    </div>
    <!-- end regis -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->
</body>
</html>

<?php

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

    // validasi
    validasiNama($namaLaundry);
    validasiEmail($email);
    validasiTelp($telp);
    validasiNama($kota);

    // enskripsi password
    $password = mysqli_real_escape_string($connect , $agen["password"]);
    $password2 = mysqli_real_escape_string($connect , $agen["password2"]);

    //cek username apakah ada yg sama
    
    $result = mysqli_query($connect, "SELECT email FROM agen WHERE email = '$email'");
    if ( mysqli_fetch_assoc($result) ){ //jika ada ada
        echo "
            <script>
                Swal.fire('Pendaftaran Agen Gagal','Email Yang Anda Masukkan Sudah Terdaftar','error');
            </script>
        ";
        // RETURN FALSE
        return false;
    }

    //cek konfirmasi password
    if ($password != $password2) {
        echo "
            <script>   
                Swal.fire('Pendaftaran Agen Gagal','Password Tidak Sama','error');
            </script>
        ";
        return false;
    }

    //enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    $query = "INSERT INTO agen VALUES (
        '',
        '$namaLaundry',
        '$namaPemilik',
        '$telp',
        '$email',
        '$kota',
        '$alamat',
        '$platDriver',
        'default.png',
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
                Swal.fire('Pendaftaran Agen Berhasil','Silahkan Mengisi Data Harga Cucian','success').then(function(){
                    window.location = 'registrasi-agen2.php';
                });
            </script>
            
        ";
    }else {
        echo mysqli_error($connect);
    }


}

?>