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
                            <!-- Hero-btn -->
                            <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                <a href="regirtrasi-pelanggan.php" class="btn hero-btn">DAFTAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!-- Category Area Start-->
    <section class="category-area section-padding30">
        <div class="container-fluid">
            <!-- Section Tittle -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tittle text-center mb-85">
                        <h2>Daftar Laundry</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="single-category mb-30">
                        <div class="category-img">
                            <img src="assets/img/categori/cat1.jpg" alt="">
                            <div class="category-caption">
                                <h2>Nadya Laundry</h2>
                                <p>Alamat : Jl. Diponegoro <br>No 55, Denpasar<br>No. Telp : 0361222</p>
                                    <span class="best"><a href="#">LIHAT SELENGKAPNYA</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-xl-4 col-lg-6">
                        <div class="single-category mb-30">
                            <div class="category-img text-center">
                                <img src="assets/img/categori/cat2.jpg" alt="">
                                <div class="category-caption">
                                    <h2>Laundry 2</h2>
                                    <p>Alamat : Jl. Surabaya <br>No 12, Surabaya<br>No. Telp : 3875120</p>
                                    <span class="best"><a href="#">LIHAT SELENGKAPNYA</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6">
                        <div class="single-category mb-30">
                            <div class="category-img text-right">
                                <img src="assets/img/categori/cat3.jpg" alt="">
                                <div class="category-caption">
                                    <h2>Laundry<br>Wina Gans</h2>
                                    <p>Alamat : Kuta No 22, Badung<br>No. Telp : 57109</p>
                                    <span class="best"><a href="#">LIHAT SELENGKAPNYA</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category Area End-->

    <!-- menu kalo login -->
    <div id="body" class>
        <div class="body">
            <?php if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) ) : ?>
                <ul>
                    <li><button type="button"><a href="pelanggan.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php elseif ( isset($_SESSION["login-agen"]) && isset($_SESSION["agen"]) ) : ?>
                <ul>
                    <li><button type="button"><a href="agen.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php elseif ( isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) : ?>
                <ul>
                    <li><button type="button"><a href="admin.php">Profil Saya</a></button></li>
                    <li><button type="button"><a href="status.php">Status Cucian</a></button></li>
                    <li><button type="button"><a href="transaksi.php">Riwayat Transaksi</a></button></li>
                </ul>
            <?php else : ?>
                <a href='registrasi-pelanggan.php'><button type='button' class="btn black-btn">Daftar Sekarang</button></a>
            <?php endif ?>
        </div>
    </div>
    <!-- menu akhir kalo login -->

    <!-- daftar laundry dari database -->
    <div class="body">      
        <?php foreach ( $agen as $dataAgen) : ?>
            <div style="margin-top:20px" class="agen">
                <div><a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>"><img src="files/laundryku.jpg" width=120 height=120 alt="foto" style="float:left;margin-right:10px"></a></div>
                <h3><a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>"><?= $dataAgen["nama_laundry"] ?></a></h3>
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
                        <fieldset class="bintang"><span class="starImg star-0"></span></fieldset>
                        <?php }else { ?>
                        <fieldset class="bintang"><span class="starImg star-<?= $fixStar ?>"></span></fieldset>
                        <?php } ?>
                    <div>
                        <ul>
                            <li>Alamat : <?= $dataAgen["alamat"] . ", " . $dataAgen["kota"]  ?></li>
                            <li>No. Telp : <?= $dataAgen["telp"] ?></li>
                        </ul>
                    </div>
                </div>
        <?php endforeach; ?>
        <br>
        <div id="halaman">
            <?php if( $halamanAktif > 1 ) : ?>
                <a href="?page=<?= $halamanAktif - 1; ?>">&laquo;</a>
            <?php endif; ?>

            <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
                <?php if( $i == $halamanAktif ) : ?>
                    <a href="?page=<?= $i; ?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
                <?php else : ?>
                    <a href="?page=<?= $i; ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if( $halamanAktif < $jumlahHalaman ) : ?>
                <a href="?page=<?= $halamanAktif + 1; ?>">&raquo;</a>
            <?php endif; ?>
        </div>
    </div>            
</body>
</html>
