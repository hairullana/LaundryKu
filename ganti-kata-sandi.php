<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

// sesuaikan dengan jenis login
if((isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]))){

    $login = "Admin";
    $idAdmin = $_SESSION["admin"];

}else if( (isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]))){

    $idAgen = $_SESSION["agen"];
    $login = "Agen";

}else if ((isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]))){

    $idPelanggan = $_SESSION["pelanggan"];
    $login = "Pelanggan";

}else {
    echo "
        <script>
            document.location.href = 'index.php';
        </script>
    ";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Ganti Kata Sandi</title>
</head>
<body> 
    <?php include 'header.php'; ?>
    <h3 class="header col s24 light center">Ganti Kata Sandi</h3>
    <form action="" method="POST" class="col s18 center"> 
        <div class="input-field inline">
            <input type="password" name="passwordLama" placeholder="Password Lama">
            <input type="password" name="password" placeholder="Password Baru">
            <input type="password" name="repassword" placeholder="Konfirmasi Password Baru">
            <button class="waves-effect blue darken-2 btn" type="submit" name="gantiPassword">Ganti Password</button>
        </div>
    </form>
    <br>
    <?php include "footer.php"; ?>
    </body>
</html>

<?php

// ubah sandi
if (isset($_POST["gantiPassword"])){
    $passwordLama = htmlspecialchars($_POST["passwordLama"]);
    $password = htmlspecialchars($_POST["password"]);
    $repassword = htmlspecialchars($_POST["repassword"]);

    if ($login == 'Admin'){
        $idAdmin = $_SESSION["admin"];
        $data = mysqli_query($connect, "SELECT * FROM admin WHERE id_admin = $idAdmin");
        $data = mysqli_fetch_assoc($data);

        if ($passwordLama != $data["password"]) {
            echo "
                <script>   
                    Swal.fire('Password Lama Salah','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        if ($password != $repassword) {
            echo "
                <script>   
                    Swal.fire('Password Baru Tidak Sama','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        $query = mysqli_query($connect, "UPDATE admin SET password = '$password' WHERE id_admin = $idAdmin");
        
        if (mysqli_affected_rows($connect) > 0) {
            echo "
                <script>   
                    Swal.fire('Password Berhasil Diganti','','success').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
        }


    }else if ($login == "Agen"){
        $idAgen = $_SESSION["agen"];
        $data = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = $idAgen");
        $data = mysqli_fetch_assoc($data);

        if (password_verify($passwordLama, $data["password"])) {
            echo "
                <script>   
                    Swal.fire('Password Lama Salah','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        if ($password != $repassword) {
            echo "
                <script>   
                    Swal.fire('Password Baru Tidak Sama','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        //hash
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($connect, "UPDATE agen SET password = '$password' WHERE id_agen = $idAgen");
        
        if (mysqli_affected_rows($connect) > 0) {
            echo "
                <script>   
                    Swal.fire('Password Berhasil Diganti','','success').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
        }
    }else if ($login = "Pelanggan"){
        $idPelanggan = $_SESSION["pelanggan"];
        $data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan");
        $data = mysqli_fetch_assoc($data);

        // hash
        $passwordLama = password_hash($passwordLama, PASSWORD_DEFAULT);

        if (password_verify($passwordLama, $data["password"])) {
            echo "
                <script>   
                    Swal.fire('Password Lama Salah','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        if ($password != $repassword) {
            echo "
                <script>   
                    Swal.fire('Password Baru Tidak Sama','','error').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
            exit;
        }

        // hash
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($connect, "UPDATE pelanggan SET password = '$password' WHERE id_pelanggan = $idPelanggan");
        
        if (mysqli_affected_rows($connect) > 0) {
            echo "
                <script>   
                    Swal.fire('Password Berhasil Diganti','','success').then(function() {
                        window.location = 'ganti-kata-sandi.php';
                    });
                </script>
            ";
        }
    }
}

?>