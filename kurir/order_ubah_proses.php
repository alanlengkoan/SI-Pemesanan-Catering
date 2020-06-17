<?php

error_reporting(0);
session_start();

// untuk koneksi
include_once "../config/koneksi.php";

if (isset($_POST['proses'])) {

  $id_order = $_POST['id_order'];
  $s_order  = $_POST['s_order'];

  // untuk mengambil tanggal sekarng
  $tgl_order = date('Y-m-d');

  // untuk mengambil waktu dengan php
  date_default_timezone_set('Asia/Jakarta');
  $jam_order = date("H:i:s");
  $jam = date("H");

  $sql   = "SELECT * FROM orders WHERE id_orders = '$id_order'";
  $query = mysqli_query($koneksi, $sql);
  $data  = mysqli_fetch_object($query);

  if ($tgl_order >= $data->tgl_p || $jam >= $data->jam_p) {

    $sql   = "UPDATE orders SET status_order = '$s_order', jam_p = '$jam_order', tgl_p = '$tgl_order' WHERE id_orders = '$id_order'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {

      echo "
      <script>
        alert('Berhasil!');
        window.location=('../index.php');
      </script>
      ";

    } else {

      echo "
      <script>
        alert('Gagal!');
        window.location=('../index.php');
      </script>
      ";

    }

  } else {

    echo "
    <script>
      alert('Gagal!');
      window.location=('../index.php');
    </script>
    ";

  }

} else {

  // echo "Tidak Ada!";

}
