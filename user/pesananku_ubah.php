<?php

// untuk koneksi
include_once "../config/koneksi.php";

$idorder  = $_POST['idorders'];
$idproduk = $_POST['idproduk'];
$jumlah   = $_POST['jumlah']; // quantity
$harga_h  = $_POST['harga']; // harga
$jmldata  = count($idproduk);

$total = 0;

for ($i = 0; $i < $jmldata ; $i++) {

  $subtotal = $jumlah[$i] * $harga_h[$i];
  $total = $total + $subtotal;

  $sqlu = "UPDATE orders_detail SET jumlah = '$jumlah[$i]', harga = jumlah * '$harga_h[$i]' WHERE id_produk = '$idproduk[$i]'";
  $ubah = mysqli_query($koneksi, $sqlu);

  $sql   = "UPDATE orders_detail SET total = '$total' WHERE id_orders = '$idorder'";
  $ubah2 = mysqli_query($koneksi, $sql);

  if ($ubah) {
    header("Location:pesanan_ubah.php?id_orders=".$idorder."");
    // echo "Berhasil";
  } else {
    echo "Gagal";
  }

}
