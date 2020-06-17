<?php
session_start();
ob_start();
include_once "../../config/koneksi.php";

ob_start();

// isi laporan
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1991/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>Laporan Penjualan</title>

    <!-- koding CSS -->
    <style media="screen">

    .judul {
      padding: 4mm;
      text-align: center;
    }

    .ttd {
      margin-left: 495px;
      margin-bottom: 0;
    }

    .admin {
      font-weight: bold;
      margin-left: 550px;
    }

    .nama {
      text-decoration: underline;
      margin-left: 555px;
    }

    </style>

  </head>
  <body>

    <div class="judul">
      <h2>Struck Pembayaran</h2>
      <p>Sistem Informasi Restoran Berbasis Website</p>
      <p><em>Indonesia, Sulawesi Tengah, Toli - toli</em> </p>
      <hr>
    </div>

    <p><b>Detail Anda</b> </p>

    <table>

      <?php

      $idorder = $_GET['id_orders'];
      $sql     = "SELECT * FROM orders WHERE id_orders = '$idorder'";
      $query   = mysqli_query($koneksi, $sql);

      while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
        ?>
        <tr>
          <td>ID Orders</td>
          <td> : <?php echo $data['id_orders'] ?></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td> : <?php echo $data['nama_kustomer'] ?></td>
        </tr>
        <tr>
          <td>Telepon</td>
          <td> : <?php echo $data['telpon'] ?></td>
        </tr>
        <tr>
          <td>E-mail</td>
          <td> : <?php echo $data['email'] ?></td>
        </tr>
        <tr>
          <td>Jam Pengantaran</td>
          <td> : <?php echo $data['jam_p'] ?></td>
        </tr>
        <tr>
          <td>Tanggal Pemesanan</td>
          <td> : <?php echo $data['tgl_p'] ?></td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : <?php echo $data['alamat'] ?></td>
        </tr>
      <?php } ?>

    </table>

    <p style="text-align: center;"><b>Produk Yang Anda Pesan</b> </p>

    <table border="1" align="center">
      <thead>
        <tr align="center">
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
        $total_rp = 0;

        while ($data = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

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

    <p class="ttd">Yang bertanda tangan dibawah ini :</p>
    <p class="admin">Administrator</p>
    <br>
    <br>
    <br>
    <p class="nama">Administrator</p>

  </body>
</html>

<?php
// isi laporan

require_once('../../admin/vendors/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Laporan Barang.pdf');
 ?>
