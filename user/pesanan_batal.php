<?php

// untuk koneksi
include_once "../config/koneksi.php";

$idorder  = $_GET['id_orders'];
$sql      = "DELETE FROM orders_detail WHERE id_orders = '$idorder'";
$sql2     = "DELETE FROM orders WHERE id_orders = '$idorder'";
$hapus    = mysqli_query($koneksi, $sql);
mysqli_query($koneksi, $sql2);

print_r($sql);

if ($hapus) {

  header("Location:pembelian.php");

} else {
  echo "Gagal";
}
