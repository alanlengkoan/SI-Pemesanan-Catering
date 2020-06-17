<?php
$host = "localhost";
$user = "root";
$pass = "0sampai1";
$dbnm = "simresto";

// Koneksi dan memilih database di server
$koneksi = mysqli_connect($host, $user, $pass, $dbnm);

if ($koneksi) {
	// echo "Berhasil";
} else {
	echo "Gagal";
}

?>
