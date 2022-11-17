<?php
$id = @$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/style-home-owner2.css">
</head>
<body>
    <!-- Earnings & Customer -->
    <div class="container">
        <section class="earnings">
            <div class="earnings-wrapper">
                <div class="earnings-card">
                    <div class="earnings-desc">
                        <?php
                        include "../koneksi.php";
                        $sql = mysqli_query($conn, "SELECT t.id_transaksi, m.nama, t.tgl, t.batas_waktu, t.tgl_bayar, m.tlp, t.status, t.dibayar, t.id_member, o.id_outlet FROM transaksi t JOIN member m ON t.id_member=m.id_member JOIN outlet o order by id_transaksi desc");
                        $customer = mysqli_query($conn,'SELECT t.id_member FROM transaksi t JOIN outlet o WHERE t.id_outlet=o.id_outlet');
                        $customer_count = mysqli_fetch_array($customer);
                        $no = 0;
                        
                        while ($data_transaksi = mysqli_fetch_array($sql)) {
                            $pan = mysqli_query($conn, "SELECT d.id_detail_transaksi, d.id_transaksi, t.id_outlet, d.subtotal FROM detail_transaksi d JOIN transaksi t ON d.id_transaksi=t.id_transaksi JOIN outlet o ON t.id_outlet=o.id_outlet WHERE o.id_outlet = ".$data_transaksi['id_outlet']."");
                            // $f = mysqli_fetch_array($pan);
                            $total = 0;
                            while ($data_detail = mysqli_fetch_array($pan)){
                                $total += $data_detail['subtotal'];
                            }
                            
                            $no++;
                            $cetak = "<a href='cetak_transaksi.php?id_transaksi=$data_transaksi[id_transaksi]'>Cetak</a>";
                            $edit = "<a href='ubah_transaksi.php?id_transaksi=$data_transaksi[id_transaksi]'>Edit</a>";
                        }
                        ?>
                        <h3>Earnings (Monthly)</h3>
                        <h2>RP. <?= $total ?></h2>
                    </div>
                </div>
                <div class="earnings-card">
                    <div class="earnings-desc">
                        <h3>Earnings (Annual)</h3>
                        <h2>RP. <?= $total ?></h2>
                    </div>
                </div>
                <div class="earnings-card">
                    <div class="earnings-desc">
                        <h3>Customer (Weekly)</h3>
                        <h2><?= count($customer_count) ?></h2>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- Report -->
    <div class="container">
        <div class="report">
            <div class="report-wrapper">
                <div class="report-card">
                    <div class="report-desc">
                        <h3>Report Outlet</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Pendapatan</th>
                                <th colspan="2">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        include "../koneksi.php";
                        $sql = mysqli_query($conn, "SELECT o.id_outlet, o.nama, o.alamat, o.tlp FROM outlet o WHERE o.id_owner = '$id'");
                        $customer = mysqli_query($conn,'SELECT id_member FROM transaksi');
                        $customer_count = mysqli_fetch_array($customer);
                        $no = 0;
                        
                        while ($data_outlet = mysqli_fetch_array($sql)) {
                            $pan = mysqli_query($conn, "SELECT d.id_detail_transaksi, d.id_transaksi, t.id_outlet, d.subtotal FROM detail_transaksi d JOIN transaksi t ON d.id_transaksi=t.id_transaksi JOIN outlet o ON t.id_outlet=o.id_outlet WHERE o.id_outlet = ".$data_outlet['id_outlet']."");
                            // $f = mysqli_fetch_array($pan);
                            $total = 0;
                            while ($data_detail = mysqli_fetch_array($pan)){
                                $total += $data_detail['subtotal'];
                            }
                            
                            $no++;
                            $hapus = "<a href='hapus_outlet.php?id=$data_outlet[id_outlet]' style='color:red' onclick='return confirm(Apakah anda yakin menghapus data ini?)' >Hapus</a>";
                            $edit = "<a href='ubah_outlet.php?id=$data_outlet[id_outlet]' style='color:#D6E4E5' >Edit</a>";
                            $transaksi = "<a href='ubah_outlet.php?id=$data_outlet[id_outlet] '>Transaksi</a>";
                        ?>
                            <tr>
                                <td><?= $data_outlet['id_outlet'] ?></td>
                                <td><?= $data_outlet['nama'] ?></td>
                                <td><?= $data_outlet['alamat'] ?></td>
                                <td><?= $total ?></td>
                                <td><?= $edit ?></td>
                                <td><?= $hapus ?></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/9c74db1b34.js" crossorigin="anonymous"></script>
</html>