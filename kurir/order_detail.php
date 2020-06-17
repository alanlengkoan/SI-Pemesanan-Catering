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

    <?php

    $id_order = $_GET['id_order'];
    $sql      = "SELECT orders.*, orders_detail.* FROM orders INNER JOIN orders_detail ON orders.id_orders=orders_detail.id_orders WHERE orders.id_orders = '$id_order' AND orders_detail.id_orders = '$id_order'";
    $query    = mysqli_query($koneksi, $sql);
    $data     = mysqli_fetch_object($query);

     ?>

     <!-- container -->
     <div class="container">

       <div class="row">
         <div class="col-lg-8 col-lg-offset-2">

           <br>

           <div class="panel panel-default">
             <div class="panel-body text-center">

               <b>Tanggal / Waktu</b>
               <p id="getwaktu"></p>

             </div>
           </div>

           <div class="panel panel-default">
             <div class="panel-heading">
               Detail Order
             </div>
             <div class="panel-body">

               <!-- form -->
               <form role="form">

                   <div class="form-group">
                       <label>ID Order</label>
                       <input class="form-control" type="text" value="<?= $data->id_orders ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Tgl / Jam Order</label>
                       <input class="form-control" type="text" value="<?= date('d F Y', strtotime($data->tgl_order))." / ".$data->jam_order ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Status Order</label>
                       <input class="form-control" type="text" value="<?= $data->status_order ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Status Pembayaran</label>
                       <input class="form-control" type="text" value="<?= $data->status_pembayaran ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Jumlah Transfer</label>
                       <div class="input-group">
                         <span class="input-group-addon">Rp.</span>
                         <input class="form-control" type="text" value="<?= $data->transfer ?>" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label>Sisah Transfer</label>
                       <div class="input-group">
                         <span class="input-group-addon">Rp.</span>
                         <input class="form-control" type="text" value="<?= $data->sisah ?>" readonly>
                       </div>
                   </div>
                   <div class="form-group">
                       <label>Tanggal Pengantaran</label>
                       <input class="form-control" type="text" value="<?= date('d F Y', strtotime($data->tgl_p)) ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Batas Jam Pengantaran</label>
                       <input class="form-control" type="text" value="<?= $data->jam_p ?>" readonly>
                   </div>

               </form>
               <!-- form -->

               <!-- table -->
               <div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover">
                   <thead>
                     <tr>
                       <th>Nama Produk</th>
                       <th>Jumlah</th>
                       <th>Harga Satuan</th>
                       <th>Sub Total</th>
                     </tr>
                   </thead>
                   <tbody>

                     <?php

                     $sql2  = "SELECT orders_detail.*, produk.* FROM orders_detail INNER JOIN produk ON orders_detail.id_produk=produk.id_produk WHERE id_orders = '$id_order'";
                     $query = mysqli_query($koneksi, $sql2);

                     while ($row  = mysqli_fetch_object($query)) {

                       // untuk total
                       $total = $row->total;

                      ?>

                      <tr>
                        <td><?= $row->nama_produk ?></td>
                        <td><?= $row->jumlah ?></td>
                        <td>Rp. <?= $row->harga_p ?></td>
                        <td>Rp. <?= $row->harga ?></td>
                      </tr>

                     <?php } ?>

                   </tbody>
                 </table>
               </div>
               <!-- table -->

               <!-- form -->
               <form role="form">

                   <div class="form-group">
                       <label>Nama Pemesan</label>
                       <input class="form-control" type="text" value="<?= $data->nama_kustomer ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>No. Telepon / HP</label>
                       <input class="form-control" type="text" value="<?= $data->telpon ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>E-mail</label>
                       <input class="form-control" type="text" value="<?= $data->email ?>" readonly>
                   </div>
                   <div class="form-group">
                       <label>Alamat</label>
                       <textarea class="form-control" rows="3" readonly><?= $data->alamat ?></textarea>
                   </div>

                   <a href="javascript:history.back()" class="btn btn-primary">Kembali</a>

               </form>
               <!-- form -->

             </div>
           </div>

         </div>
       </div>
     </div>
     <!-- container -->

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
