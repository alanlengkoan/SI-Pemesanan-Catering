<?php

// untuk koneksi
include_once "../config/koneksi.php";

$idorder  = $_GET['id_orders'];
$idproduk = $_GET['id_produk'];
$sql      = "DELETE FROM orders_detail WHERE id_produk = '$idproduk' AND id_orders = '$idorder'";
$hapus    = mysqli_query($koneksi, $sql);

print_r($sql);

if ($hapus) {
  header("Location:pesanan_ubah.php?id_orders=".$idorder."");
  // echo "Berhasil";
} else {
  echo "Gagal";
}
