<?php
session_start();
include "../../../config/koneksi.php";

$halamane=$_GET['halamane'];
$act=$_GET['act'];

if ($halamane=='order' AND $act=='update'){
   // Jika status sebelumnya Lunas dan status baru bukan Lunas
   if ($_POST['status_order_lama'] == 'Lunas' AND $_POST['status_pembayaran'] != 'Lunas'){

      // Update untuk menambah stok
      mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update untuk menambah produk yang dibeli (best seller = produk yang paling laris)
      mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update status order dan status pembayaran
      mysqli_query($koneksi, "UPDATE orders SET status_order='$_POST[status_pembayaran]', status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");
      mysqli_query($koneksi, "UPDATE dataimage SET status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");
  }

  // Jika status sebelumnya bukan Lunas dan status baru Lunas
  elseif ($_POST['status_order_lama'] != 'Lunas' AND $_POST['status_pembayaran'] == 'Lunas'){

      // Update untuk mengurangi stok
      mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.stok=produk.stok-orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
      mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah WHERE orders_detail.id_orders='$_POST[id]'");

      // Update status order dan status pembayaran
      mysqli_query($koneksi, "UPDATE orders SET status_order='$_POST[status_pembayaran]', status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");
      mysqli_query($koneksi, "UPDATE dataimage SET status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");

  // Jika status sebelumnya lunas dan status baru bukan lunas
  }

  else{

    // Update status order dan status pembayaran
     mysqli_query($koneksi, "UPDATE orders SET status_order='$_POST[status_pembayaran]', status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");
     mysqli_query($koneksi, "UPDATE dataimage SET status_pembayaran='$_POST[status_pembayaran]' where id_orders='$_POST[id]'");

  }
  header('location:../../bagian.php?halamane='.$halamane);
}


?>
