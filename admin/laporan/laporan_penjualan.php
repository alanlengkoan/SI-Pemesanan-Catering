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
      <h2>Laporan Penjualan</h2>
      <p>Sistem Informasi Restoran Berbasis Website</p>
      <p><em>Indonesia, Sulawesi Tengah, Toli - toli</em> </p>
      <hr>
    </div>

    <table border="1" align="center">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Produk</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total Penjualan</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $sql   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk";
        $query = mysqli_query($koneksi, $sql);
        $no = 1;
        $total_pnjln = 0;

        while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

          $total_pnjln = $total_pnjln + $data['total'];

          // untuk total
          $total = $data['total'];

          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['id_produk'] ?></td>
            <td><?php echo $data['nama_produk'] ?></td>
            <td>Rp. <?php echo number_format($data['harga_p'], 0, ",", ".") ?></td>
            <td><?php echo $data['jumlah'] ?></td>
            <td>Rp. <?php echo number_format($total, 0, ",", ".") ?></td>
          </tr>
        <?php } ?>
          <tr>
            <td colspan="5" align="right">Total :</td>
            <td>Rp. <?php echo number_format($total_pnjln, 0, ",", ".") ?></td>
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

require_once('../vendors/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P', 'A4', 'en', 'utf-8');
$html2pdf->WriteHTML($content);
$html2pdf->Output('Laporan Barang.pdf');
 ?>
