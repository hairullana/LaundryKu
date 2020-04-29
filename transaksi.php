<?php 

// session
session_start();
include 'connect-db.php';

// sesuaikan dengan jenis login
if(isset($_SESSION["login-admin"]) && isset($_SESSION["admin"])){

    $idAdmin = $_SESSION["admin"];
    $login = "Admin";

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

// jika pelanggan rating
if ( isset($_POST["simpanRating"]) ){

    $rating = $_POST["rating"];
    $kodeTransaksiRating = $_POST["kodeTransaksi"];

    mysqli_query($connect, "UPDATE transaksi SET rating = $rating WHERE kode_transaksi = $kodeTransaksiRating");
    echo "
        <script>
        document.location.href = 'transaksi.php';
        </script>
    ";
}

if ( isset($_POST["kirimKomentar"])){

    $komentar = htmlspecialchars($_POST["komentar"]);
    $kodeTransaksiRating = $_POST["kodeTransaksi"];

    mysqli_query($connect, "UPDATE transaksi SET komentar = '$komentar' WHERE kode_transaksi = $kodeTransaksiRating");
    echo "
        <script>
        document.location.href = 'transaksi.php';
        </script>
    ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Transasksi - <?= $login ?></title>
</head>
<body>
<?php include 'header.php'; ?>
    <div id="body">
        <h3 class="header col s12 light center">Status Cucian</h3>
        <br>
        <?php if ($login == "Admin") : $query = mysqli_query($connect, "SELECT * FROM transaksi"); ?>
        <div class="container">
            <table border=1 cellpadding=10>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Agen</th>
                    <th>Pelanggan</th>
                    <th>Total Item</th>
                    <th>Berat</th>
                    <th>Jenis</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                </tr>
                <?php while ($transaksi = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?php echo $kodeTransaksi = $transaksi["kode_transaksi"] ?></td>
                    <td>
                        <?php
                            $temp = $transaksi["id_agen"];
                            $agen = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$temp'");
                            $agen = mysqli_fetch_assoc($agen);
                            echo $agen["nama_laundry"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $temp = $transaksi["id_pelanggan"];
                            $pelanggan = mysqli_query($connect,"SELECT * FROM pelanggan WHERE id_pelanggan = '$temp'");
                            $pelanggan = mysqli_fetch_assoc($pelanggan);
                            echo $pelanggan["nama"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $idCucian = $transaksi["id_cucian"];
                            $cucian = mysqli_query($connect, "SELECT * FROM cucian WHERE id_cucian = $idCucian");
                            $cucian = mysqli_fetch_assoc($cucian);
                            echo $cucian["total_item"];
                        ?>
                    </td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $transaksi["tgl_mulai"] ?></td>
                    <td><?= $transaksi["tgl_selesai"] ?></td>
                    <td>
                        <?php
                            $star = mysqli_query($connect,"SELECT * FROM transaksi WHERE kode_transaksi = $kodeTransaksi");
                            $star = mysqli_fetch_assoc($star);
                            $star = ceil($star["rating"]);
                        ?>
                        <fieldset class="bintang"><span class="starImg star-<?= $star ?>"></span></fieldset>
                    </td>
                    <td><?= $transaksi["komentar"] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php elseif ($login == "Agen") : $query = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_agen = '$idAgen'"); ?>
        <div class="container">
        <table border=1 cellpadding=10>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Pelanggan</th>
                    <th>Total Item</th>
                    <th>Berat</th>
                    <th>Jenis</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                </tr>
                <?php while ($transaksi = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?php echo $kodeTransaksi = $transaksi["kode_transaksi"] ?></td>
                    <td>
                        <?php
                            $temp = $transaksi["id_pelanggan"];
                            $pelanggan = mysqli_query($connect,"SELECT * FROM pelanggan WHERE id_pelanggan = '$temp'");
                            $pelanggan = mysqli_fetch_assoc($pelanggan);
                            echo $pelanggan["nama"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $idCucian = $transaksi["id_cucian"];
                            $cucian = mysqli_query($connect, "SELECT * FROM cucian WHERE id_cucian = $idCucian");
                            $cucian = mysqli_fetch_assoc($cucian);
                            echo $cucian["total_item"];
                        ?>
                    </td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $transaksi["tgl_mulai"] ?></td>
                    <td><?= $transaksi["tgl_selesai"] ?></td>
                    <td>
                        <?php
                            $star = mysqli_query($connect,"SELECT * FROM transaksi WHERE kode_transaksi = $kodeTransaksi");
                            $star = mysqli_fetch_assoc($star);
                            $star = ceil($star["rating"]);
                        ?>
                        <fieldset class="bintang"><span class="starImg star-<?= $star ?>"></span></fieldset>
                    </td>
                    <td><?= $transaksi["komentar"] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php elseif ($login == "Pelanggan") : $query = mysqli_query($connect, "SELECT * FROM transaksi WHERE id_pelanggan = $idPelanggan"); ?>
        <div class="container">
            <table border=1 cellpadding=10>
                <tr>
                    <th>Kode Transaksi</th>
                    <th>Agen</th>
                    <th>Total Item</th>
                    <th>Berat</th>
                    <th>Jenis</th>
                    <th>Tanggal Pesan</th>
                    <th>Tanggal Selesai</th>
                    <th>Rating</th>
                    <th>Komentar</th>
                </tr>
                <?php while ($transaksi = mysqli_fetch_assoc($query)) : ?>
                <tr>
                    <td><?php echo $kodeTransaksi = $transaksi["kode_transaksi"] ?></td>
                    <td>
                        <?php
                            $temp = $transaksi["id_agen"];
                            $agen = mysqli_query($connect, "SELECT * FROM agen WHERE id_agen = '$temp'");
                            $agen = mysqli_fetch_assoc($agen);
                            echo $agen["nama_laundry"];
                        ?>
                    </td>
                    <td>
                        <?php
                            $idCucian = $transaksi["id_cucian"];
                            $cucian = mysqli_query($connect, "SELECT * FROM cucian WHERE id_cucian = $idCucian");
                            $cucian = mysqli_fetch_assoc($cucian);
                            echo $cucian["total_item"];
                        ?>
                    </td>
                    <td><?= $cucian["berat"] ?></td>
                    <td><?= $cucian["jenis"] ?></td>
                    <td><?= $transaksi["tgl_mulai"] ?></td>
                    <td><?= $transaksi["tgl_selesai"] ?></td>
                    <td>
                        <?php if ( $transaksi["rating"] == 0 ) : ?>
                            <form action="" method="post">
                                <input type="hidden" value="<?= $kodeTransaksi ?>" name="kodeTransaksi">
                                <select name="rating" id="">
                                    <option disabled>Rating</option>
                                    <option value="2">1</option>
                                    <option value="4">2</option>
                                    <option value="6">3</option>
                                    <option value="8">4</option>
                                    <option value="10">5</option>
                                </select>
                                <button type="submit" name="simpanRating">&raquo;</button>
                            </form>
                        <?php else : ?>
                            <?php
                                $star = mysqli_query($connect,"SELECT * FROM transaksi WHERE kode_transaksi = $kodeTransaksi");
                                $star = mysqli_fetch_assoc($star);
                                $star = ceil($star["rating"]);
                            ?>
                            <fieldset class="bintang"><span class="starImg star-<?= $star ?>"></span></fieldset>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $transaksi["komentar"] == "" ) : ?>
                            <form action="" method="post">
                                <input type="hidden" value="<?= $kodeTransaksi ?>" name="kodeTransaksi">
                                <textarea name="komentar" id="" cols="30" rows="10" placeholder="Masukkan Komentar"></textarea>
                                <button type="submit" name="kirimKomentar">Kirim</button>
                            </form>
                        <?php else : ?>
                        <?= $transaksi["komentar"] ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>