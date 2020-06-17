<?php

//koneksi ke database
include "../config/koneksi.php";

if (isset($_POST['simpan'])){

  //menangkap posting dari field input form
  $idorder  = $_POST['id_orders'];
  $iduser   = $_POST['uid'];
  $nama     = $_POST['nama'];
  $transfer = $_POST['transfer'];
  $bank     = $_POST['bank'];
  $norek    = $_POST['no_rek'];

  $sql2   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk WHERE id_orders='$idorder'";
  $query2 = mysqli_query($koneksi, $sql2);

  while ($data = mysqli_fetch_array($query2, MYSQLI_ASSOC)) {

    // jumlah total
    $total = $data['total'];

    }

    if ($transfer > $total) {

      echo "<script>
              alert('Mohon Maaf Jumlah Transfer yang Anda Masukkan Lebih dari Total : ".$total." !');
              window.location = 'pembelian.php';
            </script>";

    } else if ($transfer >= $total) {

      // jika lunas
      $stus_p = "L";
      $stus_o = "Menunggu";
      $sisah  = 0;

      $lokasi_file = $_FILES['files']['tmp_name'];
      $tipe_file   = $_FILES['files']['type'];
      $nama_file   = $_FILES['files']['name'];
      $direktori   = "../files/$nama_file";

      $sql   = "INSERT INTO dataimage (id_orders, uid, nama, transfer, sisah, bank, no_rek, status_pembayaran, image) VALUES ('$idorder', '$iduser', '$nama', '$transfer', '$sisah', '$bank', '$norek', '$stus_p', '$nama_file')";
      $query = mysqli_query($koneksi, $sql);

      // untuk update order status pembayaran
      $sql2 = "UPDATE orders SET  status_order = '$stus_o', status_pembayaran = '$stus_p' WHERE id_orders = '$idorder'";
      mysqli_query($koneksi, $sql2);

      // untuk update order detail jumlah transfer dan sisah uang jika user memanjar
      $sql3 = "UPDATE orders_detail set transfer = '$transfer', sisah = '$sisah' where id_orders = '$idorder'" ;
      mysqli_query($koneksi, $sql3);

      move_uploaded_file($lokasi_file, $direktori);

      if ($query) {
        echo "<script>
                alert('Terima Kasih telah memesan !');
                window.location = 'pembelian.php';
              </script>";
      } else {
        echo "<script>
                alert('Gagal Konfirmasi Pembayaran !');
                window.location = 'index.php';
              </script>";
      }

    } else {

      // jika panjar
      $stus_p = "P";
      $sisah  = $total - $transfer;

      $lokasi_file = $_FILES['files']['tmp_name'];
      $tipe_file   = $_FILES['files']['type'];
      $nama_file   = $_FILES['files']['name'];
      $direktori   = "../files/$nama_file";

      $sql   = "INSERT INTO dataimage (id_orders, uid, nama, transfer, sisah, bank, no_rek, status_pembayaran, image) VALUES ('$idorder', '$iduser', '$nama', '$transfer', '$sisah', '$bank', '$norek', '$stus_p', '$nama_file')";
      $query = mysqli_query($koneksi, $sql);

      // untuk update order status pembayaran
      $sql2 = "UPDATE orders SET status_pembayaran = '$stus_p' WHERE id_orders = '$idorder'";
      mysqli_query($koneksi, $sql2);

      // untuk update order detail jumlah transfer dan sisah uang jika user memanjar
      $sql3 = "UPDATE orders_detail set transfer = '$transfer', sisah = '$sisah' where id_orders = '$idorder'" ;
      mysqli_query($koneksi, $sql3);

      move_uploaded_file($lokasi_file, $direktori);

      if ($query) {
        echo "<script>
                alert('Anda telah melakukan Panjar Produk !');
                window.location = 'pembelian.php';
              </script>";
      } else {
        echo "<script>
                alert('Gagal Konfirmasi Pembayaran !');
                window.location = 'index.php';
              </script>";
      }

    }

}

?>
