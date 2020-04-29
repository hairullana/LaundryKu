<?php


// USERNAME
function validasiUsername($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[a-zA-Z0-9]*$/",$objek)){
        echo "
            <script>
                alert('Username Hanya Diperbolehkan Huruf dan Angka !');
                document.location.href = '';
            </script>
        ";
        exit;
    }
}

// NO HP
function validasiTelp($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Nomor Telp Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// Berat
function validasiBerat($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Satuan Berat Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// HARGA
function validasiHarga($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[0-9]*$/",$objek)){
        echo "
            <script>
                alert('Harga Hanya Diperbolehkan Angka !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// EMAIL
function validasiEmail($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!filter_var($objek, FILTER_VALIDATE_EMAIL)){
        echo "
            <script>
                alert('Masukkan Format Email Yang Benar !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

// NAMA ORANG
function validasiNama($objek){
    if (empty($objek)){
        echo "
            <script>
                alert('Form Tidak Boleh Kosong !');
                document.location.href = '';
            </script>
        ";
        exit;
    }else if (!preg_match("/^[a-zA-Z .]*$/",$objek)){
        echo "
            <script>
                alert('Hanya Huruf dan Spasi Yang Diijinkan Untuk Nama !');
                document.location.href= '';
            </script>
        ";
        exit;
    }
}

?>