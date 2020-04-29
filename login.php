<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Sudah Login !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

if ( isset($_POST["login"]) ){

    if ($_POST["akun"] == 'agen'){
        // masukkan ke var
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        validasiEmail($email);

        // cari data di db
        $result = mysqli_query($connect, "SELECT * FROM agen WHERE email = '$email'");

        // kalau ada email
        if(mysqli_num_rows($result) == 1){
            // masukan ke array assoc
            $row = mysqli_fetch_assoc($result);
            // verif password
            if(password_verify($password, $row["password"])){
                $_SESSION["agen"] = $row["id_agen"];
                $_SESSION["login-agen"] = true;
                echo "
                    <script>
                        alert('Berhasil Login Sebagai Agen !');
                        document.location.href = 'index.php';
                    </script>
                ";
                exit;
            }else {
                echo "
                    <script>
                        alert('Password Salah !');
                        document.location.href = 'login.php';
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    alert('Email Belum Terdaftar !');
                    document.location.href = 'login.php';
                </script>
            ";
        }
    }else if ($_POST["akun"] == 'pelanggan'){
        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        validasiEmail($email);

        //cek apakah ada email atau tidak
        $result = mysqli_query($connect, "SELECT * FROM pelanggan WHERE email = '$email'");
        
        //jika ada username
        if ( mysqli_num_rows($result) === 1 ){   //fungsi menghitung jumlah baris di db
            
            //memasukkan data db ke array assosiative
            $data = mysqli_fetch_assoc($result);

            //cek apakah password sama
            if ( password_verify($password, $data["password"]) ){
                //session login 
                $_SESSION["pelanggan"] = $data["id_pelanggan"];
                $_SESSION["login-pelanggan"] = true;

                // BELAKANGAN AJA DIBUAT HEHE, YANG PENTING JALAN DULU
                // if ( isset($_POST["remember"]) ){
                //     //buat cookie yg di hash
                //     setcookie('id',$data['id'], time() + 60*60);
                //     setcookie('pengguna',hash('sha256',$data['username']), time() + 60*60);
                // }
                echo "
                    <script>
                        alert('Berhasil Login !');
                        document.location.href = 'index.php';
                    </script>
                ";
                
            }else {
                echo "
                    <script>
                        alert('Password Salah !');
                        document.location.href = 'login.php';
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    alert('Email Tidak Ditemukan !');
                    document.location.href = 'login.php';
                </script>
            ";
        }
    }else if ($_POST["akun"] == 'admin' ){
        $username = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        validasiUsername($username);
    
        // cek di db
        $data = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$username'");
    
        // jika email ada
        if ( mysqli_num_rows($data) === 1 ){
    
            // jadikan array asosiatif
            $data = mysqli_fetch_assoc($data);
            $idAdmin = $data["id_admin"];
    
            // jika password benar
            if ( $password === $data["password"])   {
                //session login 
                $_SESSION["login-admin"] = true;
                $_SESSION["admin"] = $idAdmin;
    
                //jika remember me di checklist (NANTI DULU)
                // if ( isset($_POST["remember"]) ){
                //     //buat cookie yg di hash
                //     setcookie('id',$data['id'], time() + 60*60);
                //     setcookie('pengguna',hash('sha256',$data['username']), time() + 60*60);
                // }
                
            }else{
                echo "
                <script>
                    alert ('Username Tidak Terdaftar !');
                    document.location.href = 'login.php';
                </script>
            ";
            }
        }else {
            echo "
                <script>
                    alert ('Username Tidak Terdaftar !');
                    document.location.href = 'login.php';
                </script>
            ";
            exit;
        }
    
        echo "
            <script>
                alert ('Berhasil Login Sebagai Admin !');
                document.location.href = 'index.php';
            </script>
            
        ";
    }
    
    echo "
        <script>
            alert ('Harap Isi Checklist Untuk Login !');
            document.location.href = 'login.php';
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
    <title>Halaman Login</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3 class="header col s24 light center">Halaman Login</h3>
        <form action="" class="col s18 center" method="post">
            <div class="input-field inline">
                <ul>
                    <li><input type="text" size=40 id="email" name="email" placeholder="Email"></li>
                    <li><input type="password" size=40 id="password" name="password" placeholder="Password"></li>
                    <li>
                        <label><input name="akun" value="admin" type="radio"/><span>Admin</span> </label>
                        <label><input name="akun" value="agen" type="radio"/><span>Agen</span> </label>
                        <label><input name="akun" value="pelanggan" type="radio"/><span>Pelanggan</span></label>
                    </li>
                    <br>
                    <li><button class="waves-effect blue darken-2 btn" type="submit" name="login">Login</button></li>
                </ul>
                
            </div>
            
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>