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
  <h2 class="judul-text">Selamat Datang Dalam Sitem Informasi Catering Sahabat</h2>
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
    if ($_GET['module'] == 'home'){

    }
    ?>

    <h2>Selamat Datang, <?php echo $nama; ?></h2>
    <h3>Ubah Pesanan Anda</h3>

    <?php

    $idorder = $_GET['id_orders'];
    $sql   = "SELECT orders.*, orders_detail.* FROM orders, orders_detail WHERE orders.id_orders=orders_detail.id_orders AND orders.id_orders = '$idorder' AND orders_detail.id_orders = '$idorder'";
    $query = mysqli_query($koneksi, $sql);

    while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

      $status = $data['status_pembayaran'];

    }

    if ($status == "Lunas" || $status == "Panjar" || $status == "Menunggu") {

      echo "<script>
              alert('Anda Sudah Memesan Orderan ini, Terima Kasih !');
              window.location = 'pembelian.php';
            </script>";

    } else {

      $sql2   = "SELECT * FROM orders_detail, produk WHERE id_orders = '$idorder' AND orders_detail.id_produk=produk.id_produk";
      $query2 = mysqli_query($koneksi, $sql2);
      $no = 1;

        ?>

        <form method="post" action=pesananku_ubah.php>

          <table border=0 cellpadding=3 align=center>
            <tr bgcolor=#66CCFF>
              <th>No</th>
              <th>Produk</th>
              <th>Nama Produk</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Sub Total</th>
              <th>Hapus</th>
            </tr>

            <input type="hidden" name="idorders" value="<?php echo $idorder; ?>" readonly>

          <?php

          while($r = mysqli_fetch_array($query2, MYSQLI_ASSOC)){

            $subtotal    = $r['harga_p'] * $r['jumlah'];
            $total       = $total + $subtotal;
            $subtotal_rp = format_rupiah($subtotal);
            $total_rp    = format_rupiah($total);
            $harga       = format_rupiah($r['harga_p']);

            $status = $r['status_pembayaran'];

            // id produk
            $idproduk = $r['id_produk'];
            // nama produk
            $nama = $r['nama_produk'];
            // jumlah
            $jumlah = $r['jumlah'];
            // harga
            $harga_p = $r['harga_p'];
            // gambar
            $gambar = $r['gambar'];
            // stok
            $stok = $r['stok'];
              ?>

              <tr>
                <td align="center"><?php echo $no++; ?></td>

                <td align=center>
                  <input type="hidden" name="idproduk[]" value="<?php echo $idproduk; ?>" readonly>
                  <br>
                  <img src="../foto_produk/small_<?php echo $gambar; ?>">
                </td>

                <td><?php echo $nama; ?></td>

                <td>
                  <select name="jumlah[]" value="<?php echo $jumlah; ?>" onchange="this.form.submit()">

                    <?php

                    for ($j = 1; $j <= $stok; $j++){

                        if($j == $jumlah){

                         echo "<option selected>$j</option>";

                        }else{

                         echo "<option>$j</option>";

                        }

                    }

                     ?>

                  </select>
                </td>

                <td>
                  <?php echo $harga; ?>
                  <input type="hidden" name="harga[]" value="<?php echo $harga_p; ?>" readonly>
                </td>

                <td>
                  <?php echo $subtotal_rp; ?>
                  <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>" readonly>
                </td>

                <td align=center>
                  <a href="pesananku_hapus.php?id_produk=<?php echo $idproduk; ?>&id_orders=<?php echo $idorder; ?>">
                    <img src=../images/kali.png border=0 title=Hapus>
                  </a>
                </td>
              </tr>

            <?php } ?>

        <tr>
          <td colspan=6 align=right>
            <br><b>Total</b>:
          </td>

          <td colspan=2>
            <br>Rp. <b><?php echo $total_rp; ?></b>
          </td>
        </tr>

        <td colspan=4><br />
          <a href="pembelian.php" class="btn btn-success">Selesai</a>
        </td>

      </table>

    </form>

  <?php } ?>

    <p>
      <?php include "isi.php"; ?>
    </p>

  </div>

  <div id="clearer"></div>

  <div id="footer"><h3>Copyright &copy;2018 Kasmawati</h3></div>
</div>


</body>
</html>
