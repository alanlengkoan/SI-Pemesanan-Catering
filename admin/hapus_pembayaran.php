<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";
$aksi = $_GET['id_img'];
$query = mysql_query("DELETE FROM dataimage  WHERE id_img='".$aksi."'");
if ($query) {
	echo "<script> alert('Data berhasil terhapus');parent.location='pembayaran.php';</script>";
}
else
	echo "<script> alert('data gagal terhapus'); </script>";
 ?>
