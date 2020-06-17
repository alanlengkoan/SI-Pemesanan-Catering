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

  <!-- untuk css -->
  <style type="text/css" media="screen">
    table {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;}
    input {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;height: 20px;}
  </style>

</head>

<body>

  <div class="judul">
    <h2 class="judul-text">Selamat Datang Dalam Sistem Informasi Restoran Berbasis Website</h2>
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

    <h2>Selamat Datang, <?php echo $nama; ?></h2>

    <h2>Hubungi Kami</h2>
    <div style="border:0; padding:10px; width:760px; height:auto;">

      <input type="hidden" name="tanggal" value="<?php echo tgl_indo(date('Y-m-d')); ?>">

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-body">

              <form class="" action="hub_kami.php" method="post">

                <div class="form-group">
                    <label>Nama</label>
                    <input class="form-control" type="text" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Subjek</label>
                    <input class="form-control" type="text" name="subjek" required>
                </div>
                <div class="form-group">
                    <label>Komentar</label>
                    <textarea class="form-control" name="pesan" rows="3" required></textarea>
                </div>

                <button type="submit" name="kirim" class="btn btn-success">Kirim</button>

              </form>
              
            </div>
          </div>
        </div>
      </div>

    </div>

<?php

  // untuk koneksi
  include "config/koneksi.php";

  if (isset($_POST['kirim'])) {

    $nama    = $_POST['nama'];
    $email   = $_POST['email'];
    $subjek  = $_POST['subjek'];
    $pesan   = $_POST['pesan'];
    $tanggal = date("Y-m-d");

    $sql   = "INSERT INTO hubungi VALUES ('', '$nama', '$email', '$subjek', '$pesan', '$tanggal')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {

      echo "<script> alert('Terima Kasih telah memberikan saran');parent.location='index.php'; </script>";

    }
    else {

      echo "<script> alert('data_gagal_tersimpan'); </script>";

    }

  } else {

    // echo "Tidak ada !";

  }

?>

    <p>
      <?php include "isi.php"; ?>
    </p>

  </div>
  <div id="clearer"></div>
  <div id="footer"><h3>Copyright &copy;2018 Kasmawati</h3></div>
</div>
</body>
</html>
