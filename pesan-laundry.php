<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

cekPelanggan();

// ambil data agen
$idAgen = $_GET["id"];
$query = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$idAgen'");
$agen = mysqli_fetch_assoc($query);

if (isset($_GET["jenis"])){
    $jenis = $_GET["jenis"];
}else {
    $jenis = NULL;
}


// ambil data pelanggan
$idPelanggan = $_SESSION["pelanggan"];
$query = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");
$pelanggan = mysqli_fetch_assoc($query);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'headtags.html' ?>
    <title>Pemesanan Laundry</title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php' ?>
    <!-- end header -->

    <!-- body -->

    <!-- info laundry -->
    <div class="row">
        <div class="col s2 offset-s4">
            <img src="img/logo.png" width="70%" />
            <a id="download-button" class="btn waves-effect waves-light red darken-3" href="pesan-laundry.php?id=<?= $idAgen ?>">PESAN LAUNDRY</a>
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
                </li>
                <li>Alamat : <?= $agen["alamat"] . ", " . $agen["kota"] ?></li>
                <li>No. HP : <?= $agen["telp"] ?></li>
            </ul>
        </div>
    </div>
    <!-- end info laundry -->
    
    <!-- info pemesanan -->
    <div class="row">
        <div class="col s10 offset-s1">
            <form action="" method="post">
                <div class="col s5">
                    <h3 class="header light center">Data Diri</h3>
                    <br>
                    <div class="input-field">
                        <label for="nama">Nama Penerima</label>
                        <input id="nama" type="text" disabled value="<?= $pelanggan['nama'] ?>">
                    </div>
                    <div class="input-field">
                        <label for="telp">No Telp</label>
                        <input id="telp" type="text" disabled value="<?= $pelanggan['telp'] ?>">
                    </div>
                    <div class="input-field">
                        <label for="alamat">Alamat</label>
                        <textarea class="materialize-textarea" name="alamat" id="alamat" cols="30" rows="10"><?= $pelanggan['alamat'] . ", " . $pelanggan['kota'] ?></textarea>
                    </div>
                </div>
                <div class="col s5 offset-s1">
                    <h3 class="header light center">Info Paket Laundry</h3>
                    <br>
                    <div class="input-field">
                        <label for="total">Total Pakaian</label>
                        <input type="text" name="total" value="1">
                    </div>
                    <div class="input-field">
                        <ul>
                            <li><label for="jenis">Jenis Paket</label></li>
                            <li>
                            <?php if ($jenis == NULL) : ?>
                                <label><input id="jenis" name="jenis" value="cuci" type="radio"/><span>Cuci</span> </label>
                                <label><input id="jenis" name="jenis" value="setrika" type="radio"/><span>Setrika</span> </label>
                                <label><input id="jenis" name="jenis" value="komplit" type="radio"/><span>Komplit</span></label><li>
                            <?php elseif ($jenis == "cuci") : ?>
                                <label><input id="jenis" name="jenis" value="cuci" type="radio" checked/><span>Cuci</span> </label>
                                <label><input id="jenis" name="jenis" value="setrika" type="radio"/><span>Setrika</span> </label>
                                <label><input id="jenis" name="jenis" value="komplit" type="radio"/><span>Komplit</span></label><li>
                            <?php elseif ($jenis == "setrika") : ?>
                                <label><input id="jenis" name="jenis" value="cuci" type="radio"/><span>Cuci</span> </label>
                                <label><input id="jenis" name="jenis" value="setrika" type="radio" checked/><span>Setrika</span> </label>
                                <label><input id="jenis" name="jenis" value="komplit" type="radio"/><span>Komplit</span></label><li>
                            <?php elseif ($jenis == "komplit") : ?>
                                <label><input id="jenis" name="jenis" value="cuci" type="radio"/><span>Cuci</span> </label>
                                <label><input id="jenis" name="jenis" value="setrika" type="radio"/><span>Setrika</span> </label>
                                <label><input id="jenis" name="jenis" value="komplit" type="radio" checked/><span>Komplit</span></label><li>
                            <?php else : ?>
                                <label><input id="jenis" name="jenis" value="cuci" type="radio"/><span>Cuci</span> </label>
                                <label><input id="jenis" name="jenis" value="setrika" type="radio"/><span>Setrika</span> </label>
                                <label><input id="jenis" name="jenis" value="komplit" type="radio"/><span>Komplit</span></label><li>
                            <?php endif; ?>

                        </ul>
                    </div>
                    <div class="input-field">
                        <label for="catatan">Catatan</label>
                        <textarea class="materialize-textarea" name="catatan" id="catatan" cols="30" rows="10" placeholder="Tulis catatan untuk agen"></textarea>
                    </div>
                    <div class="input-field center">
                        <button class="btn-large blue darken-2" type="submit" name="pesan">Buat Pesanan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end info pemesanan -->

    <!-- end body -->

    <!-- footer -->
    <?php include 'footer.php' ?>
    <!-- end footer -->
    
</body>
</html>

<?php

if (isset($_POST["pesan"])){
    $alamat = htmlspecialchars($_POST["alamat"]);
    $jenis = htmlspecialchars($_POST["jenis"]);
    $catatan = htmlspecialchars($_POST["catatan"]);
    $tgl = htmlspecialchars(date("Y-m-d H:i:s"));
    $total = htmlspecialchars($_POST["total"]);


    $query = mysqli_query($connect, "INSERT INTO cucian (id_agen, id_pelanggan, tgl_mulai, jenis, total_item, alamat, catatan, status_cucian) VALUES ($idAgen, $idPelanggan, '$tgl', '$jenis', $total, '$alamat', '$catatan', 'Penjemputan')");

    if (mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                Swal.fire('Pesanan Berhasil Dibuat','Silahkan Pergi Ke Halaman Status Cucian','success').then(function(){
                    window.location = 'status.php';
                });
            </script>
        ";
    }else {
        echo mysqli_error($connect);
    }
}



?>