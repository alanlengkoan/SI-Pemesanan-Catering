<?php

session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";
$aksi  = $_GET['id_hubungi'];
$sql   = "DELETE FROM hubungi  WHERE id_hubungi='$aksi'";
$query = mysqli_query($koneksi, $sql);
if ($query) {
	echo "<script> alert('Data berhasil terhapus');parent.location='hubungi_kami.php';</script>";
}
else
	echo "<script> alert('data gagal terhapus'); </script>";

 ?>
