<?php
// untuk koneksi
include_once '../../../config/koneksi.php';

error_reporting(0);
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {

  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../login.php><b>LOGIN</b></a></center>";

}
else{
$aksi="halaman/hal_order/aksi_order.php";
switch($_GET['act']){
  // Tampil Order
  default:
    echo"<div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Data Order</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>

  									<table id='Data-Table' class='table table-bordered table table-striped' cellspacing='0' width='100%'>
                      <thead>
                        <tr>
                          <th>no.order</th><th>nama konsumen</th>
                          <th>tgl. order</th>
                          <th>jam</th>
                          <th>status Order</th>
                          <th>status Pembayaran</th>
                          <th>aksi</th>
                        </tr>
                      </thead>
                      <tbody>";

                      $tampil=mysqli_query($koneksi, "SELECT * FROM orders ORDER BY id_orders DESC");
                      $no=1;
                      while($r=mysqli_fetch_array($tampil)){
                        $tanggal=tgl_indo($r[tgl_order]);
                        echo "
                        <tr>
                          <td align=center>$r[id_orders]</td>
                          <td>$r[nama_kustomer]</td>
                          <td>$tanggal</td>
                          <td>$r[jam_order]</td>
                          <td>$r[status_order]</td>
                          <td>$r[status_pembayaran]</td>
                          <td>
                            <a class='btn btn-primary' href=?halamane=order&act=detailorder&id_order=$r[id_orders]>Detail</a>
                            <a class='btn btn-danger' href=?halamane=order&act=hapusorder&id_order=$r[id_orders]>Hapus</a>
                          </td>
                        </tr>";
                        $no++;
                      }

										echo"</tbody>
									</table>
                                </div>
                            </div>
                        </div>";

    break;


  case "detailorder":

    $idorder = $_GET['id_order'];
    $sql     = "SELECT orders.*, orders_detail.* FROM orders, orders_detail WHERE orders.id_orders=orders_detail.id_orders AND orders.id_orders = '$idorder' AND orders_detail.id_orders = '$idorder'";
    $edit = mysqli_query($koneksi, $sql);
    $r    = mysqli_fetch_array($edit, MYSQLI_ASSOC);
    $tanggal=tgl_indo($r['tgl_order']);

    $tgl_pengantaran = tgl_indo($r['tgl_p']);

    // untuk ubah status pembayaran
    $pilihan_status = array('Lunas', 'Panjar', 'Menunggu');
    $pilihan_order = '';
    foreach ($pilihan_status as $status) {
      $pilihan_order .= "<option value=$status";
      if ($status == $r['status_pembayaran']) {
        $pilihan_order .= " selected";
      }
      $pilihan_order .= ">$status</option>\r\n";
    }

    echo "<div class='row-fluid'>
                         <!-- block -->
                            <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                            <div class='muted pull-left'>Detail Order</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
          <form method=POST action=$aksi?halamane=order&act=update>

          <input type=hidden name=id value=$r[id_orders]>
          <input type=hidden name=status_order_lama value='$r[status_pembayaran]'>

          <table class='table table-condensed' border='0'>
          <tr>
            <td>No. Order</td>
            <td> : $r[id_orders]</td>
          </tr>
          <tr>
            <td>Tgl. & Jam Order</td>
            <td> : $tanggal & $r[jam_order]</td>
          </tr>
          <tr>
            <td>Status Order </td>
            <td> : $r[status_order]</td>
          </tr>
          <tr>
            <td>Status Pembayaran</td>
            <td> : <select name=status_pembayaran>$pilihan_order</select>
              <input class='btn btn-primary' type=submit value='Ubah Status'>
            </td>
          </tr>
          <tr>
            <td>Jumlah Transfer</td>
            <td> : Rp. $r[transfer]</td>
          </tr>
          <tr>
            <td>Sisah Transfer</td>
            <td> : Rp. $r[sisah]</td>
          </tr>
          <tr>
            <td>Jam Pengantaran</td>
            <td> : $r[jam_p]</td>
          </tr>
          <tr>
            <td>Tanggal Pengantaran</td>
            <td> : $tgl_pengantaran</td>
          </tr>
          </table></form>";

  // tampilkan rincian produk yang di order
  $sql2  = "SELECT orders_detail.*, produk.* FROM orders_detail INNER JOIN produk ON orders_detail.id_produk=produk.id_produk WHERE id_orders = '$idorder'";
  $query = mysqli_query($koneksi, $sql2);

  echo "<table class='table table-condensed' border=0 width=500>
        <tr>
          <th>Nama Produk</th>
          <th>Jumlah</th>
          <th>Harga Satuan</th>
          <th>Sub Total</th>
        </tr>";

  while($s = mysqli_fetch_array($query, MYSQLI_ASSOC)) {

    $ongkos = $s['total'];

    echo "<tr>
            <td>$s[nama_produk]</td>
            <td align=center>$s[jumlah]</td>
            <td>Rp. $s[harga_p]</td>
            <td>Rp. $s[harga]</td>
          </tr>";
  }

echo "
      <tr><td colspan=3 align=right>Grand Total        Rp. : </td><td align=right><b>Rp. $ongkos</b></td></tr>
      </table>";

  // tampilkan data kustomer
  echo "<table class='table table-condensed' border=0 width=500>
        <tr><th colspan=2>Data Pemesan</th></tr>
        <tr><td>Nama Pembeli</td><td> : $r[nama_kustomer]</td></tr>
        <tr><td>Alamat Pengiriman</td><td> : $r[alamat]</td></tr>
        <tr><td>No. Telpon/HP</td><td> : $r[telpon]</td></tr>
        <tr><td>Email</td><td> : $r[email]</td></tr>

        </table></div></div></div></div>";

    break;

    case "hapusorder":

      $idorder = $_GET['id_order'];
      $sql     = "DELETE FROM orders WHERE id_orders = '$idorder'";
      $hapus   = mysqli_query($koneksi, $sql);

      if ($hapus) {

        echo "<script> alert('Data Berhasil dengan ID Order = ".$idorder." Berhasil di Hapus !');parent.location='bagian.php?halamane=order'; </script>";

      }


      break;
}
}
?>
