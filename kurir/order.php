<?php
  error_reporting(0);
  session_start();

  // untuk koneksi
  include_once "../config/koneksi.php";

  $user  = $_SESSION['username'];
  $sql   = "SELECT * FROM admins WHERE username = '$user'";
  $query = mysqli_query($koneksi, $sql);

  while ($data  = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $nama = $data['nama_lengkap'];
  }

  if ($_SESSION['level'] == "kurir") {

    // echo "Halo!";

  } else {

    echo "
    <script>
      alert('Maaf Anda bukan Kurir Kami!');
      window.location=('../index.php');
    </script>
    ";

  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Kurir Katering Restoran Sahabat</title>

  <!-- Bootstrap -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- css -->
  <link rel="stylesheet" href="css/style.css">

</head>
  <body onload="setInterval('reloadwaktu()');">

    <!-- untuk navbar menu -->
    <?php require_once 'navbar.php'; ?>

    <section class="content">

      <!--container  -->
      <div class="container">
        <h2>Selamat Datang Kurir, <?= $nama ?></h2>

        Tanggal / Waktu<p id="getwaktu"></p>

        <div class="panel panel-default">
          <div class="panel-heading">
            Daftar Order
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id Order</th>
                    <th>Nama Pemesan</th>
                    <th>Telepon</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Status Order</th>
                    <th>Tanggal Pengantaran</th>
                    <th>Batas Jam Pengantaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $sql   = "SELECT * FROM orders";
                  $query = mysqli_query($koneksi, $sql);
                  $no = 1;

                  while ($row = mysqli_fetch_object($query)) {
                    ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $row->id_orders ?></td>
                      <td><?= $row->nama_kustomer ?></td>
                      <td><?= $row->telpon ?></td>
                      <td><?= $row->email ?></td>
                      <td><?= $row->alamat ?></td>
                      <td><?= $row->status_order ?></td>
                      <td><?= $row->tgl_p ?></td>
                      <td><?= $row->jam_p ?></td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="order_detail.php?id_order=<?= $row->id_orders ?>"><span class="glyphicon glyphicon-file"></span> </a>
                        <a class="btn btn-success btn-sm" href="order_ubah.php?id_order=<?= $row->id_orders ?>"><span class="glyphicon glyphicon-send"></span> </a>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
      <!-- /container -->
    </section>

    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <p class="text-center">Copyright &copy; 2018 Kasmawati</p>
      </div>
    </footer>
    <!-- footer -->

    <!-- jquery -->
    <script src="vendor/jquery/jquery-3.2.1.min.js" charset="utf-8"></script>

    <!-- bootstrap js -->
    <script src="vendor/bootstrap/js/bootstrap.min.js" charset="utf-8"></script>

    <!-- Javascript -->
    <script type="text/javascript">

    // metode get
    function reloadwaktu() {

      var getwaktu = new Date();
      var bulan    = ['January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

      var tanggal = getwaktu.getDate();
      var _bulan  = getwaktu.getMonth();
      var tahun   = getwaktu.getFullYear();
      var jam     = getwaktu.getHours();
      var menit   = getwaktu.getMinutes();
      var second  = getwaktu.getSeconds();

      // untuk mengambil bulan wilayah indonesia
      var bulan = bulan[_bulan];

      // untuk menampilkan waktu
      document.getElementById('getwaktu').innerHTML =
      tanggal + " " + bulan + " " + tahun +
      " / " + jam + ":" + menit + ":" + second;

    }

    </script>

  </body>
</html>
