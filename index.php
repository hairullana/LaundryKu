<?php

session_start();
include 'connect-db.php';


//konfirgurasi pagination
$jumlahDataPerHalaman = 3;
$query = mysqli_query($connect,"SELECT * FROM agen");
$jumlahData = mysqli_num_rows($query);
//ceil() = pembulatan ke atas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

//menentukan halaman aktif
//$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1; = versi simple
if ( isset($_GET["page"])){
    $halamanAktif = $_GET["page"];
}else{
    $halamanAktif = 1;
}

//data awal
$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

//fungsi memasukkan data di db ke array
$agen = mysqli_query($connect,"SELECT * FROM agen LIMIT $awalData, $jumlahDataPerHalaman");

//ketika tombol cari ditekan
if ( isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];

    $query = "SELECT * FROM agen WHERE 
        kota LIKE '%$keyword%' OR
        nama_laundry LIKE '%$keyword%'
        LIMIT $awalData, $jumlahDataPerHalaman
        ";

    $agen = mysqli_query($connect,$query);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="assets/img/Mag1cwind0w-O-Sunny-Day-Osd-sun.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="css/rating.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Laundryku</title>
</head>
<body>
    <!-- header -->
        <?php include 'header.php'; ?>
    <!--header end -->

    <!-- slider Area Start -->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
        <div class="single-slider slider-height" data-background="assets/img/hero/h1_hero.jpg">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                        <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                            <img src="assets/img/hero/hero_man.png" alt="">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                        <div class="hero__caption">
                            <span data-animation="fadeInRight" data-delay=".4s">Daftarkan Diri Anda</span>
                            <h1 data-animation="fadeInRight" data-delay=".6s">LAUNDRY <br> KU</h1>
                            <p data-animation="fadeInRight" data-delay=".8s">Solusi Laundry Praktis Tanpa Keluar Rumah</p>
                            <!-- menu kalo login -->
                            <div id="body">
                                <div class="body">
                                    <?php if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) ) : ?>
                                        <div class="row">
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="pelanggan.php">Profil Saya</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="status.php">Status Cucian</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">    
                                                <button type="button" class="btn black-btn"><a href="transaksi.php">Riwayat Transaksi</a></button>
                                            </div>
                                        </div>
                                    <?php elseif ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) ) : ?>
                                        <div class="row">
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="agen.php">Profil Saya</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="status.php">Status Cucian</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="transaksi.php">Riwayat Transaksi</a></button></li>
                                            </div>
                                        </div>
                                    <?php elseif ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) : ?>
                                        <div class="row">
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="admin.php">Profil Saya</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="status.php">Status Cucian</a></button>
                                            </div>
                                            <div class="class="col-xl-4 col-lg-6">
                                                <button type="button" class="btn black-btn"><a href="transaksi.php">Riwayat Transaksi</a></button>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <!-- Hero-btn -->
                                        <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                            <a href="registrasi-pelanggan.php" class="btn black-btn">DAFTAR</a>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <!-- menu akhir kalo login -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Category Area Start-->
    <section class="category-area section-padding">
        <div class="container-fluid">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-85">
                        <h2>Daftar Laundry</h2>
                        <!-- jumlah halaman database -->
                        <nav aria-label="...">
                        <ul class="pagination">
                        <?php if( $halamanAktif > 1 ) : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="?page=<?= $halamanAktif - 1; ?>" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                        <?php endif; ?>
                        <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                            <?php if( $i == $halamanAktif ) : ?>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="?page=<?= $i; ?>"><?= $i ?></a>
                            </li>
                            <?php else : ?>
                            <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $halamanAktif + 1; ?>">Next</a>
                            </li>
                        <?php endif; ?>
                        </ul>
                        </nav>
                        <!--- jumlah halaman db akhir -->
                    </div>
                </div>
            </div>
        <?php foreach ( $agen as $dataAgen) : ?>
        <div class="row">
            <div class="col-xl-4 col-lg-9">
                <div class="single-category mb-30">
                    <a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>">
                        <div class="category-img text-right">
                            <img src="assets/img/categori/cat2.jpg" alt="">
                            <div class="category-caption">
                                <h2>
                                    <a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>">
                                        <?= $dataAgen["nama_laundry"] ?>
                                    </a>
                                </h2>
                                <p>Alamat : <?= $dataAgen["alamat"] . ", " . $dataAgen["kota"]  ?>
                                <br>Telp : <?= $dataAgen["telp"] ?></p>
                                <br>
                                <div class="category-caption text-right">
                                <?php
                                    $temp = $dataAgen["id_agen"];
                                    $queryStar = mysqli_query($connect,"SELECT * FROM transaksi WHERE id_agen = '$temp'");
                                    $totalStar = 0;
                                    $i = 0;
                                    while ($star = mysqli_fetch_assoc($queryStar)){
                                        $totalStar += $star["rating"];
                                        $i++;
                                        $fixStar = ceil($totalStar / $i);
                                    }
                                        
                                    if ( $totalStar == 0 ) {
                                    ?>
                                    <br><br><br><br><br>
                                        <fieldset class="bintang"><span class="starImg star-0"></span></fieldset>
                                        <?php }else { ?>
                                            <br><br><br><br><br>
                                        <fieldset class="bintang"><span class="starImg star-<?= $fixStar ?>"></span></fieldset>
                                        <?php } ?>
                                </div> 
                            </div>
                        </div>
                    </a>
                </div>
            </div>     
        </div>
        <?php endforeach; ?> 
        </div>
    </section>
   <!-- daftar laundry End-->
   
    	<!-- JS here -->
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
		<!-- Jquery, Popper, Bootstrap -->
		<script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.min.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>

		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>

		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
    
</body>
</html>