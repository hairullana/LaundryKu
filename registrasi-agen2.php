<<<<<<< HEAD
=======
<?php

session_start();
include 'connect-db.php';

if ( isset($_SESSION["login-pelanggan"]) && isset($_SESSION["pelanggan"]) || isset($_SESSION["login-admin"]) && isset($_SESSION["admin"]) ) {
    echo "
        <script>
            alert('Anda Bukan Agen !');
            document.location.href = 'index.php';
        </script>
    ";
    exit;
}

$idAgen = $_SESSION['agen'];

// ambil data agen
$query = "SELECT * FROM agen WHERE id_agen = '$idAgen'";
$result = mysqli_query($connect, $query);
$agen = mysqli_fetch_assoc($result);

function dataHarga($data){
    global $connect, $idAgen;

    $cuci = $data["cuci"];
    $setrika = $data["setrika"];
    $komplit = $data["komplit"];

    $query2 = "INSERT INTO harga VALUES(
        '',
        'cuci',
        '$idAgen',
        '$cuci'
    )";
    $query3 = "INSERT INTO harga VALUES(
        '',
        'setrika',
        '$idAgen',
        '$setrika'
    )";
    $query4 = "INSERT INTO harga VALUES(
        '',
        'komplit',
        '$idAgen',
        '$komplit'
    )";

    $result2 = mysqli_query($connect, $query2);
    $result3 = mysqli_query($connect, $query3);
    $result4 = mysqli_query($connect, $query4);

    return mysqli_affected_rows($connect);
}

if ( isset($_POST["submit"]) ){
    

    if ( dataHarga($_POST) > 0 ){
        echo "
            <script>
                alert('Data Berhasil Ditambahkan !');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan !');
            </script>
        ";
        echo mysqli_error($connect);
    }
}

?>

>>>>>>> 65102feb9724d1e75d7f10cbabd537d3008f8dc9
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Registrasi Agen</title>
=======
    <title>Registrasi Agen Lanjutan</title>
>>>>>>> 65102feb9724d1e75d7f10cbabd537d3008f8dc9
</head>
<body>
    <div id="header">
        <ul>
            <li><a href="index.php">Home</a></li>
<<<<<<< HEAD
            <li><a href='registrasi.php'>Registrasi</a></li>
            <li><a href='login.php'>Login</a></li>
        </ul>
    </div>
    <div id="body">
        <div class="body">
            <div><img src="files/laundryku.jpg" alt="laundryku" width=300 height=auto/></div>
            <div><b>Syarat dan Ketentuan :</b></div>
            <div>1. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non, accusamus? Excepturi officia inventore dolor, quisquam facere ipsum quis perspiciatis. Consequuntur rem molestiae sint, commodi atque magnam. Unde blanditiis quam quo.</div>
            <div>2. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic natus aut rerum similique ad, voluptatibus magnam tenetur velit sapiente dicta sunt molestiae culpa deleniti, corrupti dolor unde, beatae ea eos.</div>
            <div>3. Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt hic laboriosam beatae explicabo, et consequatur? Omnis error sapiente accusamus soluta cum minus libero quasi ab ut, quo rerum hic aspernatur?</div>
            <div>4. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente iusto eligendi ex odio quia reiciendis in expedita eveniet dicta tempore, maxime, laboriosam hic nostrum inventore assumenda accusantium perferendis illo voluptate!</div>
            <div>5. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error, eveniet suscipit repellendus non dolore repellat! At, reprehenderit tempora! Accusamus ut itaque veritatis doloremque delectus dolorem architecto quo perspiciatis reiciendis unde?</div>
        </div>
        <div class="body">
            <h3>Lengkapi Profil</h3>
            <form action="" method="post">
                <ul>
                    <li><a href="#">Cuci</a><span class="panah">&#9660</span>
                    <ul class="sub1">
                        <li><a href="#">Satu</a></li>
                        <li><a href="#">Dua</a></li>
                        <li><a href="#">Tiga</a></li>
                    </ul></li>
                    <li><input type="text" name="namaLaundry" placeholder="Harga"></li>
                    <li><a href="#">Cuci</a><span class="panah">&#9660</span>
                    <ul class="sub1">
                        <li><a href="#">Satu</a></li>
                        <li><a href="#">Dua</a></li>
                        <li><a href="#">Tiga</a></li>
                    </ul></li>
                    <li><input type="text" name="namaLaundry" placeholder="Harga"></li>
                    <li><a href="#">Cuci</a><span class="panah">&#9660</span>
                    <ul class="sub1">
                        <li><a href="#">Satu</a></li>
                        <li><a href="#">Dua</a></li>
                        <li><a href="#">Tiga</a></li>
                    </ul></li>
                    <li><input type="text" name="namaLaundry" placeholder="Harga"></li>
                    <li><button type="submit" name="daftar">Lanjutkan</button></li>
                </ul>
            </form>
        </div>
    </div>
</body>
</html>
=======
            <li><a href='agen.php'><?= $agen["nama_laundry"] ?></a></li>
            <li><a href='logout.php'>Logout</a></li>
        </ul>
    </div>
    <div id="body">
        <h3>Data Harga</h3>
        <form action="" method="post">
            <ul>
                <li>Cuci : <input type="text" name="cuci"> / Kg</li>
                <li>Setrika : <input type="text" name="setrika"> / Kg</li>
                <li>Cuci + Setrika : <input type="text" name="komplit"> / Kg</li>
                <li><button type="submit" name="submit">Simpan Harga</button></li>
            </ul>
        </form>
    </div>

</body>
</html>
>>>>>>> 65102feb9724d1e75d7f10cbabd537d3008f8dc9
