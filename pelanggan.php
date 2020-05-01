<?php 

// mulai session
session_start();
include 'connect-db.php';
include 'functions/functions.php';

cekPelanggan();

// mengambil email di session
$idPelanggan = $_SESSION["pelanggan"];

// ambil data di db
$data = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = '$idPelanggan'");

// jadikan array assoc
$data = mysqli_fetch_assoc($data);

//var_dump($idPelanggan);die;


// AKSI UBAH DATA
function ubah($pelanggan){
    global $connect;
    global $idPelanggan;

    function uploadFoto(){
        //data foto
        $ukuranFile = $_FILES["foto"]["size"];
        $temp = $_FILES["foto"]["tmp_name"];
        $namaFile = $_FILES["foto"]["name"];
        $error = $_FILES["foto"]["error"];

        //cek apakah file adalah gambar
        $ekstensiGambarValid = ['jpg','jpeg','png'];
        // explode = memecah string menjadi array (dg pemisah delimiter)
        $ekstensiGambar = explode('.',$namaFile);
        //mengambil ekstensi gambar yg paling belakang dg strltolower (mengecilkan semua huruf)
        $ekstensiGambar = strtolower(end($ekstensiGambar));

        //CEK $ekstensiGambar ada di array $ekstensiGambarValid
        if ( !in_array($ekstensiGambar,$ekstensiGambarValid) ){
            echo "
                <script>
                    alert('Yang Anda Masukkan Bukan Gambar');
                </script>
            ";
            return false;
        }

        //CEK ukuran file
        if ( $ukuranFile > 3000000 ) {
            echo "
                <script>
                    alert('Ukuran Gambar Terlalu Besar');
                </script>
            ";
            return false;
        }

        //LOLOS CEK BROOO
        //generate nama baru random
        $namaFileBaru = uniqid() . '.' . $ekstensiGambar;
        move_uploaded_file($temp,'img/pelanggan/'.$namaFileBaru);

        return $namaFileBaru;
    }

    // mengambil pelanggan
    $nama = htmlspecialchars($pelanggan["nama"]);
    $email = htmlspecialchars($pelanggan["email"]);
    $telp = htmlspecialchars($pelanggan["telp"]);
    $kota = htmlspecialchars($pelanggan["kota"]);
    $alamat = htmlspecialchars($pelanggan["alamat"]);
    $foto = uploadFoto();

    // validasi
    validasiNama($nama);
    validasiEmail($email);
    validasiTelp($telp);
    validasiNama($kota);

    
    $query = "UPDATE pelanggan SET
        nama = '$nama',
        email = '$email',
        telp = '$telp',
        kota = '$kota',
        alamat = '$alamat',
        foto = '$foto'
        WHERE id_pelanggan = $idPelanggan
    ";

    mysqli_query($connect,$query);

    return mysqli_affected_rows($connect);
}


if ( isset($_POST["ubah-data"]) ){
    if ( ubah($_POST) > 0 ){

        // panggis isi db
        $pelanggan = mysqli_query($connect, "SELECT * FROM pelanggan WHERE id_pelanggan = $idPelanggan");
        $pelanggan = mysqli_fetch_assoc($pelanggan);

        // mengganti session
        $_SESSION["pelanggan"] = $pelanggan["id_pelanggan"];
        echo "
            <script>
                alert('Data Berhasil Diupdate !');
                document.location.href = 'pelanggan.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data Gagal Diupdate !');
            </script>
        ";
    }
}
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "headtags.html"; ?>
    <title>Data Penggunan - <?= $data["nama"] ?></title>
</head>
<body>

    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- end header -->

    <!-- body -->
    <div class="row">
        <div class="col s6 offset-s3">
            <h3 class="header light center">DATA PENGGUNA</h3>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="input-field inline">
                    <div class="center">
                        <img src="img/pelanggan/<?= $data['foto'] ?>" class="circle responsive-img" width=25% alt="">
                    </div>
                    <div class="file-field input-field">
                        <div class="btn blue darken-2">
                            <span>Foto Profil</span>
                            <input type="file" name="foto" id="foto">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload foto profil">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <label for="nama">Nama</label>
                            <input type="text" size=60 id="nama" name="nama" value="<?= $data['nama'] ?>">
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <input type="text" size=60 id="email" name="email" value="<?= $data['email'] ?>">
                        </li>
                        <li>
                            <label for="telp">No Telp</label>
                            <input type="text" size=60 name="telp" name="telp" value="<?= $data['telp'] ?>">
                        </li>
                        <li>
                            <label for="kota">Kota / Kabupaten</label>
                            <input type="text" size=60 id="kota" name="kota" value="<?= $data['kota'] ?>">
                        </li>
                        <li>
                            <label for="alamat">Alamat</label>
                            <textarea class="materialize-textarea" id="alamat" name="alamat"><?= $data['alamat'] ?></textarea>
                        </li>
                        <li>
                            <div class="center">
                                <button class="btn-large blue darken-2" type="submit" name="ubah-data">Simpan Data</button>
                            </div>
                        </li>
                        <br>
                        <li>
                            <div class="center">
                                <a class="btn red darken-2" href="ganti-kata-sandi.php">Ganti Kata Sandi</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
    <!-- end body -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- end footer -->

</body>
</html>