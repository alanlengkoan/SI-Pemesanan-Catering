<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";

$halamane=$_GET['halamane'];
$act=$_GET['act'];

// Hapus Kategori
if ($halamane == 'kategori' AND $act=='hapus'){
  mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
  header('location:../../bagian.php?halamane='.$halamane);
}

// Input kategori
elseif ($halamane=='kategori' AND $act=='input'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysqli_query($koneksi, "INSERT INTO kategori(nama_kategori,kategori_seo) VALUES('$_POST[nama_kategori]','$kategori_seo')");
  header('location:../../bagian.php?halamane='.$halamane);
}

// Update kategori
elseif ($halamane=='kategori' AND $act=='update'){
  $kategori_seo = seo_title($_POST['nama_kategori']);
  mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$_POST[nama_kategori]', kategori_seo='$kategori_seo' WHERE id_kategori = '$_POST[id]'");
  header('location:../../bagian.php?halamane='.$halamane);
}
?>
