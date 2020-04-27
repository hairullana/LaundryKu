<header>
    <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-left d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="index.php">Home</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <form action="" method="POST">
                                                <input type="text" name="Search" placeholder="Cari">
                                                <div class="search-icon">
                                                    <i class="fas fa-search special-tag"></i>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                    <li class="d-none d-lg-block">
                                        <?php
                                            if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ){
                                                echo "
                                                    <a href='logout.php' class='btn header-btn'><b>LOGOUT</b></a>
                                                ";
                                            }else {
                                                echo "
                                                    <a href='login.php' class='btn header-btn'><b>LOGIN</b></a>
                                                ";
                                            }
                                        ?>                                      
                                    </li>
                                    <li class="d-none d-lg-block"> 
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
                                                    <a href='pelanggan.php' class='btn header-btn'><b>$nama</b></a> (Pelanggan)
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
                                                    <a href='agen.php'><b>$nama</b></a> (Agen)
                                                ";
                                            }else if ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){
                                                echo "
                                                    <a href='admin.php' class='btn header-btn'><b>ADMIN</b></a> (Admin)
                                                ";
                                            }else {
                                                echo "
                                                    <a href='registrasi.php' class='btn header-btn'><b>REGISTRASI</b></a>
                                                ";
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>