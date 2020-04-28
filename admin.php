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

$idAdmin = $_SESSION["admin"];
$data = mysqli_query($connect, "SELECT * FROM admin WHERE id_admin = '$idAdmin'");
$admin = mysqli_fetch_assoc($data);

if ( isset($_POST["simpan"]) ){
    $username = $_POST["username"];

    mysqli_query($connect, "UPDATE admin SET username = '$username' WHERE id_admin = '$idAdmin'");

    if ( mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                alert('Data Berhasil Di Update !');
                document.location.href = 'admin.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Gagal Di Update !');
            </script>
        ";
        echo mysqli_error($connect);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'headtags.html'; ?>
    <title>Profil Admin</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3>DATA ADMIN</h3>
        <form action="" method="post">
            <ul>
                <li><input type="text" name="username" value="<?= $admin['username'] ?>"></li>
                <li><button type="submit" name="simpan">Simpan Data</button></li>
            </ul>
        </form>
        <button type="buttom"><a href="ubah-kata-sandi.php">Ubah Kata Sandi</a></button>
    </div>
</body>
</html>