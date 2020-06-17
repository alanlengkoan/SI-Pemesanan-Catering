<?php
include "../../../config/koneksi.php";

$halamane=$_GET[halamane];
$act=$_GET[act];

// Hapus hubungi
if ($halamane=='hubungi' AND $act=='hapus'){
  mysqli_query($koneksi, "DELETE FROM hubungi WHERE id_hubungi='$_GET[id]'");
  header('location:../../bagian.php?halamane='.$halamane);
}
?>
