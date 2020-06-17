<?php

//koneksi ke database
include "../config/koneksi.php";

if (isset($_POST['simpan'])){

  //menangkap posting dari field input form
  $idorder  = $_POST['id_orders'];
  $iduser   = $_POST['uid'];
  $transfer = $_POST['transfer'];
  $bank     = $_POST['bank'];
  $norek    = $_POST['no_rek'];

  $sql2   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk WHERE id_orders='$idorder'";
  $query2 = mysqli_query($koneksi, $sql2);

  while ($data = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

    // jumlah total
    $total = $data['total'];
    // jumlah transfer
    $trans = $data['transfer'];
    // jumlah sisah
    $sisa = $data['sisah'];

    }

    if ($transfer > $sisa) {

      echo "<script>
              alert('Maaf Anda harus membayar sesuai dengan Sisah Transfer, Terima Kasih !');
              window.location = 'pembelian.php';
            </script>";

    } else {

      // jika lunas
      $stus_p = "L";
      $stus_o = "Menunggu";
      $lunas  = $trans + $transfer;
      $sisah  = $sisa - $transfer;

      $lokasi_file = $_FILES['files']['tmp_name'];
      $tipe_file   = $_FILES['files']['type'];
      $nama_file   = $_FILES['files']['name'];
      $direktori   = "../files/$nama_file";

      $sql   = "UPDATE dataimage SET transfer = '$lunas', sisah = '$sisah', status_pembayaran = '$stus_p', bank = '$bank', no_rek = '$norek', image2 = '$nama_file' WHERE id_orders = '$idorder'";
      $query = mysqli_query($koneksi, $sql);

      // untuk update order status pembayaran
      $sql2 = "UPDATE orders SET status_order = '$stus_o', status_pembayaran = '$stus_p' WHERE id_orders = '$idorder'";
      mysqli_query($koneksi, $sql2);

      // untuk update order detail jumlah transfer dan sisah uang jika user memanjar
      $sql3 = "UPDATE orders_detail set transfer = '$lunas', sisah = '$sisah' WHERE id_orders = '$idorder'" ;
      mysqli_query($koneksi, $sql3);

      move_uploaded_file($lokasi_file, $direktori);

      if ($query) {
        echo "<script>
                alert('Terima Kasih telah memesan dan melunasi Orderan Anda!');
                window.location = 'pembelian.php';
              </script>";
      } else {
        echo "<script>
                alert('Gagal Konfirmasi Pelunasan !');
                window.location = 'index.php';
              </script>";
      }

    }

}

?>
