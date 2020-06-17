<?php
	// untuk koneksi
	include_once "../config/koneksi.php";

	$sid = session_id();
	$query = mysqli_fetch_array(mysqli_query($koneksi, "SELECT SUM(jumlah) as totaljumlah FROM orders_temp WHERE id_session='$sid'"));
  if ($query['totaljumlah'] != ""){
    echo "<p align=right><img src='../images/keranjang.jpg'><b><i><a href='keranjang-belanja.html'>Menu Anda ($query[totaljumlah])</a></i></b></p>";
  }
  else{
    echo "<p align=right><img src='../images/keranjang.jpg'><b><i>Keranjang Belanja (0)</i></b></p>";
  }
?>
