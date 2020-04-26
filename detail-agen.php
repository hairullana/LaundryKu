<?php

//session 
session_start();
include 'connect-db.php';

$idAgen = $_GET["id"];

$query = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$idAgen'");
$agen = mysqli_fetch_assoc($query);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/rating.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $agen["nama_laundry"] ?></title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <div class="detail">
            <div>
                <div style="float:left;">
                    <img src="files/laundryku.jpg" alt="" height=100 width=100><br/>
                    <button><a href="pesan-laundry.php?id=<?= $idAgen ?>">PESAN LAUNDRY</a></button>
                </div>
                <div>
                    <h3><?= $agen["nama_laundry"] ?></h3>
                    <ul>
                        <li>Alamat : <?= $agen["alamat"] . ", " . $agen["kota"] ?></li>
                        <li>No. HP : <?= $agen["telp"] ?></li>
                        <li>RATING / BINTANG</li>
                    </ul>
                </div>
            </div>
            <table>
                <td>
                    <div style="margin-top:50px">
                        <blockquote>
                            <button>CUCI</button>
                            <p>
                                Rp. 
                                <?php
                                    $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'cuci'");
                                    $harga = mysqli_fetch_assoc($harga);
                                    echo $harga['harga'];
                                ?>
                                ,- / Kg
                            </p>
                        </blockquote>
                    </div>
                </td>
                <td>
                    <div style="margin-top:50px">
                        <blockquote>
                            <button>SETRIKA</button>
                            <p>
                                Rp. 
                                <?php
                                    $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'setrika'");
                                    $harga = mysqli_fetch_assoc($harga);
                                    echo $harga['harga'];
                                ?>
                                ,- / Kg
                            </p>
                        </blockquote>
                    </div>
                </td>
                <td>
                    <div style="margin-top:50px">
                        <blockquote>
                            <button>CUCI + SETRIKA</button>
                            <p>
                                Rp. 
                                <?php
                                    $harga = mysqli_query($connect, "SELECT * FROM harga WHERE id_agen = '$idAgen' AND jenis = 'komplit'");
                                    $harga = mysqli_fetch_assoc($harga);
                                    echo $harga['harga'];
                                ?>
                                ,- / Kg
                            </p>
                        </blockquote>
                    </div>
                </td>
            </table>
        </div>
        <div id="komentar">
            <?php
                $temp = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_agen = $idAgen");
                

                while ( $transaksi = mysqli_fetch_assoc($temp) ) :
            ?>
            
            <div style="margin-top:20px" class="agen">
                <div><img src="files/laundryku.jpg" width=120 height=120 alt="foto" style="float:left;margin-right:10px"></div>
                <h3>
                    <?php
                        $idPelanggan = $transaksi["id_pelanggan"];
                        $temp = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan");
                        $pelanggan = mysqli_fetch_assoc($temp);
                        echo $pelanggan["nama"]
                    ?>
                </h3>
                <ul>
                    <li><fieldset class="bintang"><span class="starImg star-<?= $$transaksi['rating'] ?>"></span></fieldset></li>
                    <li><?= $transaksi["komentar"]; ?></li>
                </ul>
            </div>

            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>