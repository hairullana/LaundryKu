<nav class="blue darken2">
    <div class="container">
        <div class="nav-wrapper">
            <a id="logo-container" href="index.php" class="brand-logo"><i class="material-icons left large">home</i>LaundryKu</a>
            <ul class="right hide-on-med-and-down">
                <li> 
                <?php
                    global $connect;

                    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])){
                        // mengambil email dari session
                        $idPelanggan = $_SESSION["pelanggan"];
                        // cari data di db sesuai $email
                        $data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama"];

                        echo "
                            <a href='pelanggan.php'><b>$nama</b> (Pelanggan)</a>
                        ";
                    }else if ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])){
                        // mengambil email dari session
                        $id_agen = $_SESSION["agen"];
                        // cari data di db sesuai $id_agen
                        $data = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$id_agen'");
                        // memasukkan ke array asosiatif
                        $data = mysqli_fetch_assoc($data);
                        // mengambil data nama dari array
                        $nama = $data["nama_laundry"];

                        echo "
                            <a href='agen.php'><b>$nama</b> (Agen)</a>
                        ";
                    }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                        echo "
                            <a href='admin.php'><span><b>Admin</b> (Admin)</a>
                        ";
                    }else {
                        echo "
                            <a href='registrasi.php'><b>Registrasi</b></a>
                        ";
                    }
                ?>
                </li>
                <li>
                <?php
                    if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ){
                        echo "
                            <a href='logout.php'><b>Logout</b></a>
                        ";
                    }else {
                        echo "
                            <a href='login.php'><b>Login</b></a>
                        ";
                    }
                ?>                                      
                </li>
            </ul>

            <ul id="nav-mobile" class="sidenav">
                <li>
                    <?php
                        if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ){
                            echo "
                                <a href='logout.php'><b>Logout</b></a>
                            ";
                        }else {
                            echo "
                                <a href='login.php'><b>Login</b></a>
                            ";
                        }
                    ?>                                      
                </li>
                <li> 
                    <?php
                        global $connect;

                        if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])){
                            // mengambil email dari session
                            $idPelanggan = $_SESSION["pelanggan"];
                            // cari data di db sesuai $email
                            $data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");
                            // memasukkan ke array asosiatif
                            $data = mysqli_fetch_assoc($data);
                            // mengambil data nama dari array
                            $nama = $data["nama"];

                            echo "
                                <a href='pelanggan.php'><b>$nama</b> (Pelanggan)</a>
                            ";
                        }else if ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])){
                            // mengambil email dari session
                            $id_agen = $_SESSION["agen"];
                            // cari data di db sesuai $id_agen
                            $data = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$id_agen'");
                            // memasukkan ke array asosiatif
                            $data = mysqli_fetch_assoc($data);
                            // mengambil data nama dari array
                            $nama = $data["nama_laundry"];

                            echo "
                                <a href='agen.php'><b>$nama</b> (Agen)</a>
                            ";
                        }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                            echo "
                                <a href='admin.php'><b>Admin</b> (Admin)</a>
                            ";
                        }else {
                            echo "
                                <a href='registrasi.php'><b>Registrasi</b></a>
                            ";
                        }
                    ?>
                </li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </div>
</nav>
<br/>