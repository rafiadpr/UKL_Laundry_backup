<?php
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style-user2.css">
</head>
<body>

    <!-- CRUD user -->
    <div class="container">
        <div class="report">
            <div class="report-wrapper">
                <div class="report-card">
                    <div class="report-desc">
                        <h3>Karyawan</h3>
                    </div>

                    <form action="tampil_user.php" method="post">
                        <label for="gsearch">Search :</label>
                        <input type="search" id="gsearch" name="cari">
                        <input type="submit">
                    </form>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th colspan="3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        include "../koneksi.php";
                        if(isset($_POST['cari'])){
                            $cari = $_POST['cari'];
                            $qry_user=mysqli_query($conn, "select * from user where id = '$cari' or nama like '%$cari%' or username like '%$cari%' or role like '%$cari%'");
                        }
                        else{
                            $qry_user = mysqli_query($conn, "select * from user where role = 'kasir'");
                        }
                            $no = 0;
                            while ($data_user = mysqli_fetch_array($qry_user)) {
                            $no++;
                            $hapus = "<a href='hapus_user.php?id=$data_user[id]' style='color:red' onclick='return confirm(Apakah anda yakin menghapus data ini?)'>Hapus</a>";
                            $edit = "<a href='ubah_user.php?id=$data_user[id]' style='color:#D6E4E5' >Edit</a>";
                            $transaksi = "<a href='tambah_transaksi.php?id=$data_user[id]'>Transaksi</a>";
                        ?>
                            <tr>
                                <td><?= $data_user['id'] ?></td>
                                <td><?= $data_user['nama'] ?></td>
                                <td><?= $data_user['username'] ?></td>
                                <td><?= $data_user['role'] ?></td>
                                <td><?= $edit ?></td>
                                <td><?= $hapus ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                      </table>

                    <div class="register">
                        <a href="tambah_user.php"><button>Register</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://kit.fontawesome.com/9c74db1b34.js" crossorigin="anonymous"></script>
</html>