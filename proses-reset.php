<?php
   // session 
     session_start();
    include 'connect-db.php';
    if (isset($_POST['btnReset'])) 
    {
        $email = $_POST['email'];

        $cek = mysqli_query($connect, "SELECT email FROM agen WHERE email = '$email'");
        if (mysqli_num_rows($cek) == 1 ) 
        {
            $password   = $_POST['password'];
            $repassword = $_POST['repassword'];
            if($password != $repassword)
            {
                ?>
                    <script>
                        alert("Inputan password tidak sama");
                        window.location.href = 'lupa-kata-sandi.php';
                    </script>
                <?php
            }else
            {
                $pwd = md5($password);
                $sql = mysqli_query($connect, "UPDATE agen SET password = '$pwd' WHERE email = '$email' ");
                if ($sql) 
                {
                    ?>
                        <script>
                            alert("Password telah di perbarui");
                            window.location.href = 'login-agen.php';
                        </script>
                    <?php
                }else
                {
                    ?>
                        <script>
                            alert("Password gagal diperbaharui");
                            window.location.href = 'lupa-kata-sandi.php';
                        </script>
                    <?php
                }
            }
        }else
        {
            ?>
                <script>
                    alert("Pastikan email yang anda masukan benar!");
                    window.location.href = 'lupa-kata-sandi.php';
                </script>
            <?php
        }
    }
?>

