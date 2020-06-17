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

<div class="judul">
  <h2 class="judul-text">Selamat Datang Dalam Sitem Informasi Katering Restoran Sahabat</h2>
</div>

<body>
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

    // $sql = "SELECT orders.*, orders_detail.* FROM orders, orders_detail WHERE orders.id_orders=orders_detail.id_orders AND orders.id_orders = '$idorder' AND orders_detail.id_orders = '$idorder'";
    $idorder = $_GET['id_orders'];
    $sql   = "SELECT orders.*, orders_detail.* FROM orders, orders_detail WHERE orders.id_orders=orders_detail.id_orders AND orders.id_orders = '$idorder' AND orders_detail.id_orders = '$idorder'";
    $query = mysqli_query($koneksi, $sql);

    while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

      $status = $data['status_pembayaran'];

    }

    if ($status == "P" || $status == "L" || $status == "M") {

      echo "<script>
              alert('Status Bayar Anda Masih Dalam Proses Pengecekan !');
              window.location = 'pembelian.php';
            </script>";

    } else {

      if ($status == "Panjar") {

        ?>

        <h2>Konfirmasi Pelunasan</h2>
        <div style="border:0; padding:10px; width:760px; height:auto;">

          <div class="row">

            <!-- untuk tabel -->
            <div class="col-lg-12">
              <div class="panel panel-default">

                <div class="panel-heading">
                    Daftar Pembelian Produk
                </div>

                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Orders</th>
                          <th>Jumlah Transfer</th>
                          <th>Sisah Transfer</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        $sql2   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk WHERE id_orders='$idorder'";
                        $query2 = mysqli_query($koneksi, $sql2);
                        $no = 1;

                        while ($data = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

                          // total
                          $total = $data['total'];

                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_orders'] ?></td>
                            <td>Rp. <?php echo number_format($data['transfer'], 0, ",", ".") ?></td>
                            <td>Rp. <?php echo number_format($data['sisah'], 0, ",", ".") ?></td>
                            <td>Rp. <?php echo number_format($total, 0, ",", ".") ?></td>
                          </tr>
                        <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- untuk form -->
            <div class="col-lg-12">
              <div class="panel panel-default">

                <div class="panel-heading">
                    Form Pelunasan Produk
                </div>

                <div class="panel-body">

                  <form class="" action="konfir_bayar_pelunasan.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>ID Orders</label>
                        <input class="form-control" type="hidden" name="uid" value="<?php echo $uid ?>" readonly required>
                        <input class="form-control" type="text" name="id_orders" value="<?php echo $idorder; ?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label>Pilih Struck</label>
                        <input class="" type="file" name="files" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Transfer</label>
                        <input class="form-control" type="number" name="transfer" required>
                    </div>
                    <div class="form-group">
                        <label>Bank</label>
                        <select class="form-control" name="bank" id="bank" onchange="proses()" required>
                          <option value="Anda Belum Memilih Bank">- Pilih Bank -</option>
                          <option value="11">BRI</option>
                          <option value="22">BCA</option>
                          <option value="33">BNI</option>
                          <option value="44">Mandiri</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Rekening</label>
                        <input class="form-control" type="text" name="no_rek" id="no_rek" readonly required>
                    </div>

                    <a href="pembelian.php" class="btn btn-danger">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-success">Konfirmasi</button>

                  </form>

                </div>

              </div>
            </div>

          </div>

        </div>

      <?php

      } else if ($status == "Lunas") {

        echo "<script>
                alert('Anda Sudah Melunasi Orderan ini, Terima Kasih !');
                window.location = 'pembelian.php';
              </script>";

      } else {

        ?>

        <h2>Konfirmasi Pembayaran</h2>
        <div style="border:0;padding:10px;width:760px;height:auto;">

          <div class="row">

            <!-- untuk tabel -->
            <div class="col-lg-12">
              <div class="panel panel-default">

                <div class="panel-heading">
                    Daftar Pembelian Produk
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
                        </tr>
                      </thead>
                      <tbody>

                        <?php

                        $sql2   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk WHERE id_orders='$idorder'";
                        $query2 = mysqli_query($koneksi, $sql2);
                        $no = 1;

                        while ($data = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

                          // total
                          $total = $data['total'];

                          ?>
                          <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['id_orders'] ?></td>
                            <td><?php echo $data['nama_produk'] ?></td>
                            <td><?php echo $data['jumlah']; ?></td>
                            <td>Rp. <?php echo number_format($data['harga_p'], 0, ",", ".") ?></td>
                            <td>Rp. <?php echo number_format($data['harga'], 0, ",", ".") ?></td>
                          </tr>
                        <?php } ?>
                          <tr>
                            <td colspan="5" align="right">Total :</td>
                            <td>Rp. <?php echo number_format($total, 0, ",", "."); ?></td>
                          </tr>
                          <tr>
                            <td colspan="5" align="right">Grand Total :</td>
                            <td>Rp. <?php echo number_format($total, 0, ",", "."); ?></td>
                          </tr>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

              <!-- untuk form -->
              <div class="col-lg-12">
                <div class="panel panel-default">

                  <div class="panel-heading">
                      Form Pembayaran Produk
                  </div>

                  <div class="panel-body">

                    <form class="" action="konfir_bayar_pembayaran.php" method="post" enctype="multipart/form-data">

                      <div class="form-group">
                          <label>ID Orders</label>
                          <input class="form-control" type="hidden" name="uid" value="<?php echo $uid ?>" readonly required>
                          <input class="form-control" type="text" name="id_orders" value="<?php echo $idorder; ?>" readonly required>
                      </div>
                      <div class="form-group">
                          <label>Pilih Struck</label>
                          <input class="" type="file" name="files" required>
                      </div>
                      <div class="form-group">
                          <label>Nama</label>
                          <input class="form-control" type="text" name="nama" required>
                      </div>
                      <div class="form-group">
                          <label>Jumlah Transfer</label>
                          <input class="form-control" type="number" name="transfer" required>
                      </div>
                      <div class="form-group">
                          <label>Bank</label>
                          <select class="form-control" name="bank" id="bank" onchange="proses()" required>
                            <option value="Anda Belum Memilih Bank">- Pilih Bank -</option>
                            <option value="11">BRI</option>
                            <option value="22">BCA</option>
                            <option value="33">BNI</option>
                            <option value="44">Mandiri</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>No Rekening</label>
                          <input class="form-control" type="text" name="no_rek" id="no_rek" readonly required>
                      </div>

                      <a href="pembelian.php" class="btn btn-danger">Kembali</a>
                      <button type="submit" name="simpan" class="btn btn-success">Konfirmasi</button>

                    </form>

                  </div>

                </div>
              </div>

            </div>

        </div>

      <?php

      }

    }

    ?>

    <p>
      <?php include "isi.php"; ?>
    </p>

  </div>
  <div id="clearer"></div>
  <div id="footer"><h3>Copyright &copy;2018 Kasmawati</h3></div>
</div>

<script type="text/javascript">

  function proses(){
    var bank = document.getElementById('bank').value;
    document.getElementById('no_rek').value = bank;
  }

</script>

</body>
</html>
