<?php
session_start();
error_reporting(0);
include "../config/koneksi.php";
include "../config/library.php";

$module = $_GET['module'];
$act    = $_GET['act'];

if ($module == 'keranjang' AND $act == 'tambah'){

	$sid = session_id();

	$sql2 = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk='$_GET[id]'");
	$r=mysqli_fetch_array($sql2);
	$stok=$r['stok'];

  if ($stok == 0){
      echo "stok habis";
  } else {

	// check if the product is already
	// in cart table for this session
	$sql    = mysqli_query($koneksi, "SELECT id_produk FROM orders_temp WHERE id_produk='$_GET[id]' AND id_session='$sid'");
	$ketemu = mysqli_num_rows($sql);

	if ($ketemu == 0){

		$sql_m = "SELECT * FROM produk WHERE id_produk='$_GET[id]'";
		$query = mysqli_query($koneksi, $sql_m);

		while ($data = mysqli_fetch_array($query)) {

			$harga = $data['harga_p'];

		}

		mysqli_query($koneksi, "INSERT INTO orders_temp (id_produk, jumlah, harga, id_session, tgl_order_temp, jam_order_temp, stok_temp)
				VALUES ('$_GET[id]', 1, '$harga', '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");

	} else {

		// update product quantity in cart table
		mysqli_query($koneksi, "UPDATE orders_temp SET jumlah = jumlah + 1, total = jumlah * '$harga' WHERE id_session ='$sid' AND id_produk='$_GET[id]'");

	}
	deleteAbandonedCart();
	header('Location:keranjang-belanja.html');

	}
}

else if ($module == 'keranjang' AND $act == 'hapus'){

	mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
	header('Location:keranjang-belanja.html');

}

else if ($module == 'keranjang' AND $act == 'update'){

  $id       = $_POST['id'];
  $jumlah   = $_POST['jml']; // quantity
	$harga_h  = $_POST['harga']; // harga
	$jml_data = count($id);

  for ($i=1; $i <= $jml_data; $i++){

		$sqlu = mysqli_query($koneksi, "UPDATE orders_temp SET jumlah = '$jumlah[$i]', harga = jumlah * '$harga_h[$i]' WHERE id_orders_temp = '$id[$i]'");
		header('Location:keranjang-belanja.html');

  }
}


/*
	Delete all cart entries older than one day
*/
function deleteAbandonedCart(){
	$kemarin = date('Y-m-d', mktime(0,0,0, date('m'), date('d') - 1, date('Y')));
	mysqli_query($koneksi, "DELETE FROM orders_temp WHERE tgl_order_temp < '$kemarin'");
}
?>
