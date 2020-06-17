<?php
  error_reporting(0);
  session_start();
  include "config/koneksi.php";
	include "config/fungsi_indotgl.php";
	include "config/class_paging.php";
	include "config/fungsi_combobox.php";
	include "config/library.php";
  include "config/fungsi_autolink.php";
  include "config/fungsi_rupiah.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- untuk head -->
<?php include_once 'head.php'; ?>

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


    <img src="images/bar2.jpg" width="200" height="30" />
    <p>
      <?php include "kiri.php"; ?>
    </p>
  </div>
  <div id="rightcontent">
    <?php
      if ($_GET['module'] == 'home'){

    }
    ?>

    <h2>Selamat Datang, di Katering Restoran Sahabat </h2>

    <p>
      <?php include "isi.php"; ?>
    </p>
  </div>

  <div id="clearer"></div>

  <div id="footer"><h3>Copyright &copy;2018 Kasmawati</h3></div>
</div>

<!-- pemanggilan jquery.js -->
<script src="user/vendor/jquery/jquery.min.js"></script>

<!-- pemanggilan bootstrap.js -->
<script src="user/vendor/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
