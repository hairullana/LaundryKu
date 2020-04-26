<?php

session_start();
include 'connect-db.php';

if ( !(isset($_SESSION["login-admin"])) ){
    if ( !(isset($_SESSION["admin"])) ){
        echo "
            <script>
                alert('Belum Login Sebagai Admin !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}

$idAgen = $_GET["id"];

$query = mysqli_query($connect, "DELETE FROM agen WHERE id_pelanggan = '$idAgen'");

if ( mysqli_affected_rows($connect) > 0 ){
    echo "
        <script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'list-pelanggan.php';
        </script>
    ";
}

?>