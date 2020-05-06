<?php

session_start();
include 'connect-db.php';
include 'functions/functions.php';

cekBelumLogin();


// sesuaikan dengan jenis login
if(isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){

    $login = "Admin";
    $idAdmin = $_SESSION["admin"];

}else if(isset($_SESSION["login-agen"]) && isset($_SESSION["agen"])){

    $idAgen = $_SESSION["agen"];
    $login = "Agen";

}else if (isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"])){

    $idPelanggan = $_SESSION["pelanggan"];
    $login = "Pelanggan";

}else {
    echo "
        <script>
            window.location = 'login.php';
        </script>
    ";
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html" ?>
    <title>Status Cucian - <?= $login ?></title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div id="body">
        <h3 class="header col s10 light center">Status Cucian</h3>
        <br>
        <?php if ($login == "Admin") : $query = mysqli_query($connect, "SELECT * FROM cucian WHERE status_cucian != 'Selesai'"); ?>
        <div class="col s10 offset-s1">
            <table border=1 cellpadding=10 class="responsive-table centered">
                <tr>
                    <td style="font-weight:bold;">ID Cucian</td>
                    <td style="font-weight:bold;">Nama Agen</td>
                    <td style="font-weight:bold;">Pelanggan</td>
                    <td style="font-weight:bold;">Total Item</td>
                    <td style="font-weight:bold;">Berat (kg)</td>
                    <td style="font-weight:bold;">Jenis</td>
                    <td style="font-weight:bold;">Tanggal Dibuat</td>
                    <td style="font-weight:bold;">Status</td>
                </tr>
                <?php while ($cucian = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td>
                        <?php
                            echo $idCucian = $cucian['id_cucian'];
                        ?>
                    </td>
                    <td>
                        <?php
                            $data = mysqli_query($connect, "SELECT agen.nama_laundry FROM cucian INNER JOIN agen ON agen.id_agen = cucian.id_agen WHERE id_cucian = $idCucian");
                            $data = mysqli_fetch_assoc($data);
                            echo $data["nama_laundry"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $data = mysqli_query($connect, "SELECT pelanggan.nama FROM cucian INNER JOIN pelanggan ON pelanggan.id_pelanggan = cucian.id_pelanggan WHERE id_cucian = $idCucian");
                            $data = mysqli_fetch_assoc($data);
                            echo $data["nama"];
                        ?>
                    </td>
                    <td><?= $cucian["total_item"] ?></td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $cucian["tgl_mulai"] ?></td>
                    <td><?= $cucian["status_cucian"] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php elseif ($login == "Agen") : $query = mysqli_query($connect, "SELECT * FROM cucian WHERE id_agen = $idAgen AND status_cucian != 'Selesai'"); ?>
        <div class="col s10 offset-s1">
            <table border=1 cellpadding=10 class="responsive-table centered">
                <tr>
                    <td style="font-weight:bold;">ID Cucian</td>
                    <td style="font-weight:bold;">Pelanggan</td>
                    <td style="font-weight:bold;">Total Item</td>
                    <td style="font-weight:bold;">Berat (kg)</td>
                    <td style="font-weight:bold;">Jenis</td>
                    <td style="font-weight:bold;">Tanggal Dibuat</td>
                    <td style="font-weight:bold;">Status</td>
                    <td style="font-weight:bold;">Aksi</td>
                </tr>
                <?php while ($cucian = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td>
                        <?php
                            echo $idCucian = $cucian['id_cucian'];
                        ?>
                    </td>
                    <td>
                        <?php
                            $data = mysqli_query($connect, "SELECT pelanggan.nama FROM cucian INNER JOIN pelanggan ON pelanggan.id_pelanggan = cucian.id_pelanggan WHERE id_cucian = $idCucian");
                            $data = mysqli_fetch_assoc($data);
                            echo $data["nama"];
                        ?>
                    </td>
                    <td><?= $cucian["total_item"] ?></td>
                    <td>
                        <?php if ($cucian["berat"] == NULL) : ?>
                            <form action="" method="post">
                                <input type="hidden" name="id_cucian" value="<?= $idCucian ?>">
                                <div class="input-field">
                                    <input type="text" size=1 name="berat">
                                    <div class="center"><button class="btn blue darken-2" type="submit" name="simpanBerat"><i class="material-icons">send</i></button></div>
                                </div>
                            </form>
                        <?php else : echo $cucian["berat"]; endif;?>
                    </td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $cucian["tgl_mulai"] ?></td>
                    <td><?= $cucian["status_cucian"] ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_cucian" value="<?= $idCucian ?>">
                            <select class="browser-default" name="status_cucian" id="status_cucian">
                                <option disabled selected>Status :</option>
                                <option value="Penjemputan">Penjemputan</option>
                                <option value="Sedang di Cuci">Sedang di Cuci</option>
                                <option value="Sedang Di Jemur">Sedang Di Jemur</option>
                                <option value="Sedang di Setrika">Sedang di Setrika</option>
                                <option value="Pengantaran">Pengantaran</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                                
                            <div class="center">
                                <button class="btn blue darken-2" type="submit" name="simpanStatus"><i class="material-icons">send</i></button>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php elseif ($login == "Pelanggan") : $query = mysqli_query($connect, "SELECT * FROM cucian WHERE id_pelanggan = $idPelanggan AND status_cucian != 'Selesai'"); ?>
        <div class="col s10 offset-s1">
            <table border=1 cellpadding=10 class="responsive-table centered">
                <tr>
                    <td style="font-weight:bold">ID Cucian</td>
                    <td style="font-weight:bold">Agen</td>
                    <td style="font-weight:bold">Total Item</td>
                    <td style="font-weight:bold">Berat (kg)</td>
                    <td style="font-weight:bold">Jenis</td>
                    <td style="font-weight:bold">Tanggal Dibuat</td>
                    <td style="font-weight:bold">Status</td>
                </tr>
                <?php while ($cucian = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td>
                        <?php
                            echo $idCucian = $cucian['id_cucian'];
                        ?>
                    </td>
                    <td>
                        <?php
                            $data = mysqli_query($connect, "SELECT agen.nama_laundry FROM cucian INNER JOIN agen ON agen.id_agen = cucian.id_agen WHERE id_cucian = $idCucian");
                            $data = mysqli_fetch_assoc($data);
                            echo $data["nama_laundry"];
                        ?>
                    </td>
                    <td><?= $cucian["total_item"] ?></td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $cucian["tgl_mulai"] ?></td>
                    <td><?= $cucian["status_cucian"] ?></td>
                    
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>

<?php


// STATUS CUCIAN
if ( isset($_POST["simpanStatus"]) ){

    // ambil data method post
    $statusCucian = $_POST["status_cucian"];
    $idCucian = $_POST["id_cucian"];

    // cari data
    $query = mysqli_query($connect, "SELECT * FROM cucian INNER JOIN harga ON harga.jenis = cucian.jenis WHERE id_cucian = $idCucian");
    $cucian = mysqli_fetch_assoc($query);
    $status = "Selesai";
    // kalau status selesai
    if ( $statusCucian == $status){

        // isi data di tabel transaksi
        $tglMulai = $cucian["tgl_mulai"];
        $tglSelesai = date("Y-m-d H:i:s");
        $totalBayar = $cucian["berat"] * $cucian["harga"];
        $idCucian = $cucian["id_cucian"];
        $idPelanggan = $cucian["id_pelanggan"];
        // masukkan ke tabel transaksi
        mysqli_query($connect,"INSERT INTO transaksi (id_cucian, id_agen, id_pelanggan, tgl_mulai, tgl_selesai, total_bayar, rating) VALUES ($idCucian, $idAgen, $idPelanggan, '$tglMulai', '$tglSelesai', $totalBayar, 0)");
        if (mysqli_affected_rows($connect) == 0){
            echo mysqli_error($connect);
        }
    }

    mysqli_query($connect, "UPDATE cucian SET status_cucian = '$statusCucian' WHERE id_cucian = '$idCucian'");
    if (mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                Swal.fire('Status Berhasil Di Ubah','','success').then(function() {
                    window.location = 'status.php';
                });
            </script>   
        ";
    }

    
}

// total berat
if (isset($_POST["simpanBerat"])){

    $berat = htmlspecialchars($_POST["berat"]);
    $idCucian = $_POST["id_cucian"];

    // validasi 
    validasiBerat($berat);

    mysqli_query($connect, "UPDATE cucian SET berat = $berat WHERE id_cucian = $idCucian");

    if (mysqli_affected_rows($connect) > 0){
        echo "
            <script>
                Swal.fire('Data Berhasil Di Ubah','','success').then(function() {
                    window.location = 'status.php';
                });
            </script>
        ";
    }

    

}

?>