<?php
    include 'navbar.php';
    $id_user = @$_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Outlet</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style-register-outlet3.css">
</head>
<body>
    <!-- Login -->
    <div class="container">
        <div class="login">
            <div class="login-logo">
                <h2>Register Outlet</h2>
            </div>
            <div class="login-form">
                <form action="proses_tambah_outlet.php" method="post">
                    <input type="text" id="name" name="nama" placeholder="Name"><br>
                    <div class="line-dark"></div>

                    <input type="text" id="address" name="alamat" placeholder="Address"><br>
                    <div class="line-dark"></div>

                    <input type="text" id="telp" name="tlp" placeholder="No. Telepon"><br>
                    <div class="line-dark"></div>

                    <input type="hidden" id="name" name="id_user" value="<?=$_SESSION['id']?>">

                    <input type="submit" id="login" value="Register">
                </form> 
            </div>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/9c74db1b34.js" crossorigin="anonymous"></script>
</html>