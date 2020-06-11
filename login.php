<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

// validasi login
cekLogin();

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

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <!-- body -->
    <div class="container center">  
        <h3 class="header light center">Halaman Login</h3>
        <form action="" method="post">
            <div class="input-field inline">
                <ul>
                <li>
                        <label><input name="akun" value="admin" type="radio"/><span>Admin</span> </label>
                        <label><input name="akun" value="agen" type="radio"/><span>Agen</span> </label>
                        <label><input name="akun" value="pelanggan" type="radio"/><span>Pelanggan</span></label>
                    </li>
                    <li>
                        <input type="text" id="email" name="email" placeholder="Email">
                    </li>
                    <li>
                        <input type="password" id="password" name="password" placeholder="Password">
                        <p class="tes"></p>
                    </li>
                    <br>
                    <li>
                        <div class="center">
                            <button class="waves-effect blue darken-2 btn" type="submit" name="login">Login</button>
                        </div>
                    </li>
                </ul>
            </div>
        </form>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->

</body>
</html>

<?php

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
                        document.location.href = 'index.php';
                    </script>
                ";
                exit;
            }else {
                echo "
                    <script>
                        Swal.fire('Gagal Login','Password Yang Anda Masukkan Salah','warning');
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    Swal.fire('Gagal Login','Email Belum Terdaftar','warning');
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

                echo "
                    <script>
                        document.location.href = 'index.php';
                    </script>
                ";
                
            }else {
                echo "
                    <script>
                        Swal.fire('Gagal Login','Password Yang Anda Masukkan Salah','warning');
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    Swal.fire('Gagal Login','Email Belum Terdaftar','warning');
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

                echo "
                    <script>
                        document.location.href = 'index.php';
                    </script>
                ";
                
            }else {
                echo "
                    <script>
                        Swal.fire('Gagal Login','Password Yang Anda Masukkan Salah','warning');
                    </script>
                ";
            }
        }else {
            echo "
                <script>
                    Swal.fire('Gagal Login','Username Tidak Terdaftar Sebagai Admin','warning');
                </script>
            ";
        }
    }else {
        echo "
            <script>
                Swal.fire('Gagal Login','Pilih Jenis Akun Terlebih Dahulu','warning');
            </script>
        ";
    }
}

?>