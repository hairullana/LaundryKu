<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

cekAdmin();

$idAgen = $_GET["id"];

$query = mysqli_query($connect, "DELETE FROM agen WHERE id_agen = '$idAgen'");

if ( mysqli_affected_rows($connect) > 0 ){
    echo "
        <script>
            alert('Data Berhasil Di Hapus');
            document.location.href = 'list-agen.php';
        </script>
    ";
}

?>