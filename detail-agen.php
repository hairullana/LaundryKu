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
    </div>
</body>
</html>