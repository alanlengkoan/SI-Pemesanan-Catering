<?php

  error_reporting(0);
  session_start();

  // untuk koneksi
  include_once "../config/koneksi.php";
  include_once "../config/fungsi_indotgl.php";
  include_once "../config/class_paging.php";
  include_once "../config/fungsi_combobox.php";
  include_once "../config/library.php";
  include_once "../config/fungsi_autolink.php";
  include_once "../config/fungsi_rupiah.php";

  $user  = $_SESSION['username'];
  $sql   = "SELECT * FROM admins WHERE username = '$user'";
  $query = mysqli_query($koneksi, $sql);
  while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
    $uid  = $data['uid'];
    $nama = $data['nama_lengkap'];
  }

  if ($_SESSION['level'] == "user") {
    // echo "Halo";
  } else {
    echo "
    <script>
      alert('Maaf Anda bukan User Kami!');
      window.location=('../index.php');
    </script>
    ";
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <!-- untuk head -->
  <?php include_once 'head.php'; ?>

</head>

<body>

  <div class="judul">
    <h2 class="judul-text">Selamat Datang Dalam Sistem Informasi Katering Restoran Sahabat</h2>
  </div>
  
<div id="wrapper">
  <div id="header">

    <!-- untuk menu -->
    <?php include_once 'menu.php'; ?>

  </div>
  <div id="leftcontent">
    <p>&nbsp;</p>
  </div>
  <div id="middlecontent">


    <img src="../images/bar2.jpg" width="200" height="30" />
    <p>
      <?php include "kiri.php"; ?>
    </p>
  </div>
  <div id="rightcontent">

    <?php
    if ($_GET['module'] == 'home'){

    }
    ?>

    <h2>Selamat Datang, <?php echo $nama; ?></h2>
    <h3>Daftar Pembelian Anda</h3>

    <!-- untuk menampilkan daftar pembelian berdasarkan order dan uid -->

    <!-- untuk menampilkan daftar pembelian berdasarkan order dan uid -->

    <div class="row">

      <!-- untuk tabel -->
      <div class="col-lg-12">
        <div class="panel panel-default">

          <div class="panel-heading">
              Daftar Pembelian Anda
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>ID Orders</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                    <th>Total</th>
                    <th>Jumlah Transfer</th>
                    <th>Sisah Transfer</th>
                    <th>Status Order</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                  $sql   = "SELECT a.*, b.*, c.* FROM orders AS a
                            INNER JOIN orders_detail AS b ON a.id_orders=b.id_orders
                            INNER JOIN produk AS c ON b.id_produk=c.id_produk WHERE uid = '$uid' ORDER BY uid DESC";
                  $query = mysqli_query($koneksi, $sql);
                  $no = 1;

                  while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

                    $status = $data['status_pembayaran'];

                    if ($status == "P" || $status == "L" || $status == "M") {
                      $ket = "Dalam Proses";
                    } else if ($status == "Panjar") {
                      $ket = "Panjar";
                    } else if ($status == "Lunas") {
                      $ket = "Lunas";
                    } else if ($status == "Menunggu") {
                      $ket = "Menunggu";
                    } else {
                      $ket = "Tidak di Proses";
                    }

                  ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><b><?php echo $data['id_orders']; ?></b> </td>
                    <td><?php echo $data['nama_produk']; ?></td>
                    <td><?php echo $data['jumlah']; ?></td>

                    <td>Rp. <?php echo number_format($data['harga_p'], 0, ",", ".") ?></td>
                    <td>Rp. <?php echo number_format($data['harga'], 0, ",", ".") ?></td>
                    <td>Rp. <?php echo number_format($data['total'], 0, ",", ".") ?></td>

                    <td align="center">Rp. <?php echo number_format($data['transfer'], 0, ",", ".") ?> </td>
                    <td align="center">Rp. <?php echo number_format($data['sisah'], 0, ",", ".") ?> </td>

                    <td align="center"><?php echo $data['status_order']; ?></td>
                    <td align="center"><?php echo $ket; ?></td>
                    <td align="center">
                      <a class="btn btn-success" href="konfir_bayar.php?id_orders=<?php echo $data['id_orders']; ?>"><i class="fa fa-money fa-fw"></i> </a>
                      <a class="btn btn-primary" href="pesanan_ubah.php?id_orders=<?php echo $data['id_orders']; ?>"><i class="fa fa-edit fa-fw"></i> </a>
                      <a class="btn btn-danger" href="pesanan_batal.php?id_orders=<?php echo $data['id_orders']; ?>"><i class="fa fa-trash fa-fw"></i> </a>
                    </td>
                  </tr>

                  <?php } ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

    <p>
      <?php include "isi.php"; ?>
    </p>
  </div>

  <div id="clearer"></div>

  <div id="footer"><h3>Copyright &copy;2018 Kasmawati</h3></div>
</div>


</body>
</html>
