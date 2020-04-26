

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
</head>
<body> 
     <?php include 'header.php'; ?>
        <div class="box-login"> 
            <h2>Reset Password</h2> 
            <form action="proses-reset.php" method="POST"> 
                <div class="inputan">
                    <label>Email :</label> 
                    <input type="text" name="email" placeholder=""> 
                </div> 
                <div class="inputan"> 
                    <label>Password Baru :</label> 
                    <input type="password" name="password" placeholder=""> 
                </div> 
                <div class="inputan"> 
                    <label>Konfirmasi Password Baru :</label> 
                    <input type="password" name="repassword" placeholder=""> 
                </div> 
               
                 <li><button type="submit" name="btnReset">Reset</button></li>
            </form> 
        </div> 
    </body> 

</html>




