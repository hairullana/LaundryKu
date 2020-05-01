<?php


// USERNAME
function validasiUsername($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[a-zA-Z0-9]*$/",$objek)){
        echo "
            <script>
                alert('Username Hanya Diperbolehkan Huruf dan Angka !');
                document.location.href = '';
            </script>
        ";
        exit;
    }
}

// NO HP
function validasiTelp($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Nomor Telp Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// Berat
function validasiBerat($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Satuan Berat Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// HARGA
function validasiHarga($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Harga Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// EMAIL
function validasiEmail($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!filter_var($objek, FILTER_VALIDATE_EMAIL)){
        echo "
            <script>
                alert('Masukkan Format Email Yang Benar !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// NAMA ORANG
function validasiNama($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[a-zA-Z .]*$/",$objek)){
        echo "
            <script>
                alert('Hanya Huruf dan Spasi Yang Diijinkan Untuk Nama !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}






// SESSION

// admin
function cekAdmin(){
    if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ){

        $idAdmin = $_SESSION["admin"];
        
    }else {
        echo "
            <script>
                alert('Belum Login Sebagai Admin !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}


// agen
function cekAgen(){
    if (isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) ){

        $idAgen = $_SESSION["agen"];
    }else {
        echo "
            <script>
                alert('Kamu Belum Login Sebagai Agen !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}


// pengguna
function cekPelanggan(){
    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) ){

        $idPengguna = $_SESSION["pelanggan"];
    }else {
        echo "
            <script>
                alert('Kamu Belum Login Sebagai Pelanggan !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}


// login
function cekLogin(){
    if ( (isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])) || (isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])) || (isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])) ) {
        echo "
            <script>
                alert('Kamu Sudah Login !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}

// belum login
function cekBelumLogin(){
    if ( !(isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])) && !(isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])) && !(isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])) ) {
        echo "
            <script>
                alert('Kamu Belum Login !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}


?>