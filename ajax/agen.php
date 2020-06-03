<?php

include "../connect-db.php";

$keyword = htmlspecialchars($_GET["keyword"]);

$query = "SELECT * FROM agen WHERE 
    kota LIKE '%$keyword%' OR
    nama_laundry LIKE '%$keyword%'
";

$agen = mysqli_query($connect,$query);

//konfirgurasi pagination
$jumlahDataPerHalaman = 3;
$jumlahData = mysqli_num_rows($agen);
//ceil() = pembulatan ke atas
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

//menentukan halaman aktif
//$halamanAktif = ( isset($_GET["page"]) ) ? $_GET["page"] : 1; = versi simple

if ( isset($_GET["page"])){
    $halamanAktif = $_GET["page"];
}else{
    $halamanAktif = 1;
}

$awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

$query = "SELECT * FROM agen WHERE 
    kota LIKE '%$keyword%' OR
    nama_laundry LIKE '%$keyword%'
    LIMIT $awalData, $jumlahDataPerHalaman
";

$agen = mysqli_query($connect,$query);


?>

<!-- pagination -->
<div id="search">
    <ul class="pagination center">
    <?php if( $halamanAktif > 1 ) : ?>
        <li class="disabled-effect blue darken-1">
            <!-- halaman pertama -->
            <a href="?page=<?= $halamanAktif - 1; ?>"><i class="material-icons">chevron_left</i></a>
        </li>
    <?php endif; ?>
    <?php for( $i = 1; $i <= $jumlahHalaman; $i++ ) : ?>
        <?php if( $i == $halamanAktif ) : ?>
            <li class="active grey"><a href="?page=<?= $i; ?>"><?= $i ?></a></li>
        <?php else : ?>
            <li class="waves-effect blue darken-1"><a href="?page=<?= $i; ?>"><?= $i ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
    <?php if( $halamanAktif < $jumlahHalaman ) : ?>
        <li class="waves-effect blue darken-1">
            <a class="page-link" href="?page=<?= $halamanAktif + 1; ?>"><i class="material-icons">chevron_right</i></a>
        </li>
    <?php endif; ?>
    </ul>
</div>
<!-- pagination -->


<!-- sorting -->
<!-- <div class="row">
    <div class="col s4 offset-s4">
        <form action="" method="post">
            <label for="sorting">Sorting</label>
            <select class="browser-default" name="sorting" id="sorting">
                <option disabled>Sorting</option>
                <option value="hargaDown">Harga Terendah</option>
            </select>
            <div class="center"><button class="btn blue darken-2" type="submit" name="submitSorting"><i class="material-icons">send</i></button></div>
        </form>
    </div>
</div> -->
<!-- end sorting -->

<!-- list agen -->

<div class="container">
    <div class="section">

        <!--   Icon Section   -->
        <div class="row card">
            <?php foreach ( $agen as $dataAgen) : ?>
                <div class="col s12 m4">
                    <div class="icon-block center">
                        <h2 class="center light-blue-text"><a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>"><img src="img/agen/<?= $dataAgen['foto'] ?>" class="circle resposive-img" width=60% /></a></h2>
                        <h5 class="center"><a href="detail-agen.php?id=<?= $dataAgen['id_agen'] ?>"><?= $dataAgen["nama_laundry"] ?></a></h5>
                        <?php
                            $temp = $dataAgen["id_agen"];
                            $queryStar = mysqli_query($connect,"SELECT * FROM transaksi WHERE id_agen = '$temp'");
                            $totalStar = 0;
                            $i = 0;
                            while ($star = mysqli_fetch_assoc($queryStar)){

                                // kalau belum kasi rating gk dihitung
                                if ($star["rating"] != 0){
                                    $totalStar += $star["rating"];
                                    $i++;
                                    $fixStar = ceil($totalStar / $i);
                                }
                            }
                                
                            if ( $totalStar == 0 ) {
                        ?>
                            <center><fieldset class="bintang"><span class="starImg star-0"></span></fieldset></center>
                        <?php }else { ?>
                            <center><fieldset class="bintang"><span class="starImg star-<?= $fixStar ?>"></span></fieldset></center>
                        <?php } ?>

                        <p class="light">
                            Alamat : <?= $dataAgen["alamat"] . ", " . $dataAgen["kota"]  ?>
                            <br/>Telp : <?= $dataAgen["telp"] ?></p>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <br><br>
</div>