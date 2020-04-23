
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Agen</title>
</head>
<body>
    <h3>Login Agen</h3>
    <?php if(isset($error)) : ?>
        <p>email atau password salah</p>
    <?php endif; ?>


    <p>
        <ul>
            <li>Email : <input type="text" id="email" name="email"></li>
            <li>Password : <input type="password" id="password" name="password"></li>
            <li><input type="submit" name="login">Login</input> <a href="/lupa-kata-sandi.php">Lupa Kata Sandi ?</a></li>
        </ul>
    </p>
</body>
</html>

<?php
 
 session_start();
 include 'connect-db.php'

if ( isset($_POST["login"]) ){
     $email = $_POST["email"];
     $password = $_POST["password"];

    $result = mysqli_query($connect, "SELECT * FROM agen WHERE email = '$email'");

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            header("Location: index.php");
            exit;
        }
    }

    $error = true;
 }
    
?>


