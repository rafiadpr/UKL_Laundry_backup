<?php
session_start();
if($_POST){
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $tlp=$_POST['tlp'];
    $id_user = @$_SESSION['id'];
        include "../koneksi.php";
        $insert=mysqli_query($conn,"insert into outlet (nama, alamat, tlp, id_user) value ('".$nama."', '".$alamat."', '".$tlp."', '".$id_user."')") or die(mysqli_error($conn));
        if($insert){
            echo "<script>alert('Sukses menambahkan outlet');location.href='tampil_outlet.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan outlet');location.href='tambah_outlet.php';</script>";
        }
    }
?>