<?php 

// session
session_start();
include 'connect-db.php';

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
            alert('Anda Belum Login');
            document.location.href = 'index.php';
        </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transasksi - <?= $login ?></title>
</head>
<body>
<?php include 'header.php'; ?>
    <div id="body">
        <h3>LIST TRANSAKSI</h3>
        <?php if ($login == "Admin") : $query = mysqli_query($connect, "SELECT * FROM transaksi"); ?>
            <table border=1 cellpadding=10>
                <tr>
                    <td>Kode Transaksi</td>
                    <td>Agen</td>
                    <td>Pelanggan</td>
                    <td>Total Item</td>
                    <td>Berat</td>
                    <td>Jenis</td>
                    <td>Tanggal Pesan</td>
                    <td>Tanggal Selesai</td>
                    <td>Rating</td>
                    <td>Komentar</td>
                </tr>
                <?php while ($transaksi = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?php echo $kodeTransaksi = $transaksi["kode_transaksi"] ?></td>
                    <td>
                        <?php
                            // ambil id agen
                            $cucian = mysqli_query($connect, "SELECT * FROM transaksi INNER JOIN cucian ON transaksi.id_cucian = cucian.id_cucian WHERE transaksi.kode_transaksi = $kodeTransaksi");
                            $cucian = mysqli_fetch_assoc($cucian);
                            $idAgen = $cucian["id_agen"];
                            $idCucian = $cucian["id_cucian"];
                            $agen = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = $idAgen");
                            $agen = mysqli_fetch_assoc($agen);
                            echo $agen["nama_laundry"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $pelanggan = mysqli_query($connect, "SELECT * FROM cucian INNER JOIN pelanggan ON pelanggan.id_pelanggan = cucian.id_pelanggan WHERE id_cucian = $idCucian");
                            $pelanggan = mysqli_fetch_assoc($pelanggan);
                            echo $pelanggan["nama"];
                        ?>
                    </td>
                    <td><?= $cucian["total_item"] ?></td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $cucian["tgl_mulai"] ?></td>
                    <td><?= $cucian["tgl_selesai"] ?></td>
                    <td><?= $cucian["rating"] . "/5" ?></td>
                    <td><?= $cucian["komentar"] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($login == "Agen") : $query = mysqli_query($connect, "SELECT * FROM cucian WHERE id_agen = $idAgen AND status_cucian != 'Selesai'"); ?>
            <table border=1 cellpadding=10>
                <tr>
                    <td>ID Cucian</td>
                    <td>Pelanggan</td>
                    <td>Total Item</td>
                    <td>Berat</td>
                    <td>Jenis</td>
                    <td>Tanggal Dibuat</td>
                    <td>Status</td>
                    <td>Aksi</td>
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
                                <input type="text" name="berat"> Kg
                                <button type="submit" name="simpan">&raquo;</button>
                            </form>
                        <?php else : echo $cucian["berat"]; endif;?>
                    </td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $cucian["tgl_mulai"] ?></td>
                    <td><?= $cucian["status_cucian"] ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id_cucian" value="<?= $idCucian ?>">
                            <select name="status_cucian" id="status_cucian">
                                <option disabled selected>Status :</option>
                                <option value="Penjemputan">Penjemputan</option>
                                <option value="Sedang di Cuci">Sedang di Cuci</option>
                                <option value="Sedang Di Jemur">Sedang Di Jemur</option>
                                <option value="Sedang di Setrika">Sedang di Setrika</option>
                                <option value="Pengantaran">Pengantaran</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <button type="submit" name="ubah">&raquo;</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        <?php elseif ($login == "Pelanggan") : $query = mysqli_query($connect, "SELECT * FROM cucian WHERE id_pelanggan = $idPelanggan AND status_cucian != 'Selesai'"); ?>
            <table border=1 cellpadding=10>
                <tr>
                    <td>ID Cucian</td>
                    <td>Agen</td>
                    <td>Total Item</td>
                    <td>Berat</td>
                    <td>Jenis</td>
                    <td>Tanggal Dibuat</td>
                    <td>Status</td>
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
        <?php endif; ?>
    </div>
</body>
</html>