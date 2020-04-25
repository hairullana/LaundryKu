<?php

session_start();
include 'connect-db.php';

if ( !(isset($_SESSION["login-admin"])) ){
    if ( !(isset($_SESSION["admin"])) ){
        echo "
            <script>
                alert('Anda Belum Login Sebagai Admin !');
                document.location.href = 'index.php';
            </script>
        ";
        exit;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Panel</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3>Control Panel</h3>
        <table border=1 cellpadding=40>
            <tr>
                <td><a href="list-agen.php">List Agen</a></td>
                <td><a href="list-pelanggan.php">List Pelanggan</a></td>
            </tr>
            <tr>
                <td><a href="riwayat.php">Riwayat Transaksi</a></td>
                <td><a href="status.php">Status Transaksi</a></td>
            </tr>
        </table>
    </div>
</body>
</html>