<?php

//session 
session_start();
include 'connect-db.php';

// mengambil id agen dg method get
$idAgen = $_GET["id"];

// ambil data agen
$query = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$idAgen'");
$agen = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title><?= $agen["nama_laundry"] ?></title>
</head>

<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->
    <br><br>
    <!-- data agen -->
    <div class="row">
        <div class="col s2 offset-s4">
            <img src="img/agen/<?= $agen['foto'] ?>" class="circle responsive-img" width="70%" />
            <a id="download-button" class="btn red darken-3" href="pesan-laundry.php?id=<?= $idAgen ?>">PESAN LAUNDRY</a>
        </div>
        <div class="col s6">
            <h3><?= $agen["nama_laundry"] ?></h3>
            <ul>
                <li>
                    <?php
                        $temp = $agen["id_agen"];
                        $queryStar = mysqli_query($connect,"SELECT * FROM transaksi WHERE id_agen = '$temp'");
                        $totalStar = 0;
                        $i = 0;
                        while ($star = mysqli_fetch_assoc($queryStar)){

                            // kalau belum kasi rating gak dihitung
                            if ($star["rating"] != 0){
                                $totalStar += $star["rating"];
                                $i++;
                                $fixStar = ceil($totalStar / $i);
                            }
                        }
                            
                        if ( $totalStar == 0 ) {
                    ?>
                        <fieldset class="bintang"><span class="starImg star-0"></span></fieldset>
                    <?php }else { ?>
                        <fieldset class="bintang"><span class="starImg star-<?= $fixStar ?>"></span></fieldset>
                    <?php } ?>
                </li>
                <li>Alamat : <?= $agen["alamat"] . ", " . $agen["kota"] ?></li>
                <li>No. HP : <?= $agen["telp"] ?></li>
            </ul>
        </div>
    </div>

        <!-- data harga -->
    <div class="row">
        <div class="col s3 offset-s2">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <a href="pesan-laundry.php?id=<?= $idAgen ?>&jenis=cuci" style="margin:0% 15%"><button class="btn blue darken-3">CUCI</button></a>
                    <div>
                        <?php
                            $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'cuci'");
                            $harga = mysqli_fetch_assoc($harga);
                            echo "Rp. " . $harga['harga'] . " /Kg";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <a href="pesan-laundry.php?id=<?= $idAgen ?>&jenis=setrika" style="margin:0% 15%"><button class="btn blue darken-3">SETRIKA</button></a>
                    <div>
                        <?php
                            $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'setrika'");
                            $harga = mysqli_fetch_assoc($harga);
                            echo "Rp. " . $harga['harga'] . " /Kg";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s3">
            <div class="card-panel grey lighten-5 z-depth-1">
                <div class="row valign-wrapper">
                    <a href="pesan-laundry.php?id=<?= $idAgen ?>&jenis=komplit" style="margin:0% 15%"><button class="btn blue darken-3">KOMPLIT</button></a>
                    <div>
                        <?php
                            $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'komplit'");
                            $harga = mysqli_fetch_assoc($harga);
                            echo "Rp. " . $harga['harga'] . " /Kg";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end agen -->


    <hr><br>

    <!-- komentar -->
    <h3 class="header light center">Ulasan Pengguna</h3>
    <br>

    <div class="row">
        <?php

        $temp = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_agen = $idAgen");
        while ( $transaksi = mysqli_fetch_assoc($temp) ) :
        
        $idPelanggan = $transaksi["id_pelanggan"];
        $temp2 = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan");
        $pelanggan = mysqli_fetch_assoc($temp2);

        ?>


        <div class="container">
        <div class="col s3 offset-s1">
        <table border=0>
            <tr>
                <td width=100px rowspan=3><img src="img/pelanggan/<?= $pelanggan['foto'] ?>" class="circle responsive-img" width=100px alt="foto"></td>
                <td><?= "<h6 class='light'>" . $pelanggan["nama"] . "</h6>";?></td>
            </tr>
            <tr>
                <td><fieldset class="bintang"><span class="starImg star-<?= $transaksi['rating'] ?>"></span></fieldset></td>
            </tr>
            <tr>
                <td><?= $transaksi["komentar"]; ?></td>
            </tr>
        </table>
        </div>
        </div>






        <!-- <div class="col s5 offset-s1">
            <div class="col s2">
                <img src="img/pelanggan/<?= $pelanggan['foto'] ?>" class="circle responsive-img" width=100% alt="foto">
            </div>

            <?= "<h6 class='light'>" . $pelanggan["nama"] . "</h6>";?>

            <div class="col s4">
                <fieldset class="bintang"><span class="starImg star-<?= $transaksi['rating'] ?>"></span></fieldset>
                <?= $transaksi["komentar"]; ?>
            </div>
        </div> -->
        <?php endwhile; ?>
    </div>

    <?php include "footer.php"; ?>

</body>
</html>