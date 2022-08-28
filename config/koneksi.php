<?php
$host = "localhost";
$user = "my_root";
$pass = "my_pass";
$dbnm = "si_pemesanan_catering";

// Koneksi dan memilih database di server
$koneksi = mysqli_connect($host, $user, $pass, $dbnm);

if ($koneksi) {
	// echo "Berhasil";
} else {
	echo "Gagal";
}
