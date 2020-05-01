<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

cekAdmin();

$idPelanggan = $_GET["id"];

$query = mysqli_query($connect, "DELETE FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");

if ( mysqli_affected_rows($connect) > 0 ){
    echo "
        <script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'list-pelanggan.php';
        </script>
    ";
}

?>