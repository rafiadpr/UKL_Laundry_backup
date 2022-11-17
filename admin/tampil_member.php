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
                        <h3>Member</h3>
                    </div>

                    <form action="tampil_member.php" method="post">
                        <label for="gsearch">Search :</label>
                        <input type="search" id="gsearch" name="cari">
                        <input type="submit">
                    </form>
                    
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>No Telp</th>
                                <th colspan="3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        include "../koneksi.php";
                        if(isset($_POST['cari'])){
                            $cari = $_POST['cari'];
                            $qry_member=mysqli_query($conn, "select * from member where id_member = '$cari' or nama like '%$cari%' or alamat like '%$cari%' or tlp like '%$cari%' or jenis_kelamin like '%$cari%'");
                        }
                        else{
                            $qry_member = mysqli_query($conn, "select * from member");
                        }
                            $no = 0;
                            while ($data_member = mysqli_fetch_array($qry_member)) {
                            $no++;
                            $hapus = "<a href='hapus_member.php?id_member=$data_member[id_member]' style='color:red' onclick='return confirm(Apakah anda yakin menghapus data ini?)'>Hapus</a>";
                            $edit = "<a href='ubah_member.php?id_member=$data_member[id_member]' style='color:#D6E4E5' >Edit</a>";
                            $transaksi = "<a href='tambah_transaksi.php?id_member=$data_member[id_member]' style='color:#B6E2A1' >Transaksi</a>";
                        ?>
                            <tr>
                                <td><?= $data_member['id_member'] ?></td>
                                <td><?= $data_member['nama'] ?></td>
                                <td><?= $data_member['alamat'] ?></td>
                                <td><?= $data_member['jenis_kelamin'] ?></td>
                                <td><?= $data_member['tlp'] ?></td>
                                <td><?= $transaksi ?></td>
                                <td><?= $edit ?></td>
                                <td><?= $hapus ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                      </table>

                    <div class="register">
                        <a href="tambah_member.php"><button>Register</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="https://kit.fontawesome.com/9c74db1b34.js" crossorigin="anonymous"></script>
</html>