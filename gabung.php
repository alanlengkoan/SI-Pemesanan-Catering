<?php
  error_reporting(0);

  // untuk koneksi ke database
  include "config/koneksi.php";

  // pemberian user id secara otomatis
  $sql    = "SELECT uid FROM admins";
  $carkod = mysqli_query($koneksi, $sql);
  $datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
  $jumdat = mysqli_num_rows($carkod);

  if ($datkod) {
    $nilkod  = substr($jumdat[0], 1);
    $kode    = (int) $nilkod;
    $kode    = $jumdat + 1;
    $kodeoto = "UID-".str_pad($kode, 4, "0", STR_PAD_LEFT);
  } else {
    $kodeoto = "UID-0001";
  }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<!-- untuk head -->
<?php include_once 'head.php'; ?>

<style type="text/css" media="screen">
  table {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;}
  input {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 11px;height: 20px;}
</style>

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


      <img src="images/bar2.jpg" width="200" height="30" />
      <p>
        <?php include "kiri.php"; ?>
      </p>
    </div>
    <div id="rightcontent">

      <h2 style="text-transform: uppercase;">Bergabung dengan kami sekarang!</h2>
      <p>Ingin bergabung dengan kami sebagai Kurir. Silahkan isi form dibawah ini dengan lengkap sesuai dengan data diri Anda.</p>
      <div style="border:0; padding:10px; width:760px; height:auto;">

        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-body">

                <form class="" action="gabung.php" method="post">

                  <!-- untuk pemberian kode otomatis -->
                  <input type="hidden" name="kid" value="<?= $kodeoto ?>" readonly>

                  <!-- untuk pemberian level kurir -->
                  <input type="hidden" name="level" value="kurir" readonly>

                  <div class="form-group">
                      <label>Nama Depan*</label>
                      <input class="form-control" type="text" name="nma_d" placeholder="Nama Depan*" required>
                  </div>
                  <div class="form-group">
                      <label>Nama Belakang*</label>
                      <input class="form-control" type="text" name="nma_b" placeholder="Nama Belakang*" required>
                  </div>
                  <div class="form-group">
                      <label>Username*</label>
                      <input class="form-control" type="text" name="username" placeholder="Username*" required>
                  </div>
                  <div class="form-group">
                      <label>Password*</label>
                      <input class="form-control" type="password" name="password" placeholder="Password*" required>
                  </div>
                  <div class="form-group">
                      <label>Alamat Email*</label>
                      <input class="form-control" type="email" name="email" placeholder="Contoh: xxxxx@gmail.com" required>
                  </div>
                  <div class="form-group">
                      <label>Nomor Hp / Telepon*</label>
                      <div class="form-group input-group">
                          <span class="input-group-addon">+62</span>
                          <input class="form-control" type="text" name="no_telp" placeholder="Contoh: 812xxxxx" required>
                      </div>
                  </div>

                  <button type="submit" name="daftar" class="btn btn-success">Daftar</button>

                </form>

              </div>
            </div>
          </div>
        </div>

      </div>

  <?php

    // untuk koneksi
    include "config/koneksi.php";

    if (isset($_POST['daftar'])) {

      $uid     = $_POST['kid'];
      $nma_d   = $_POST['nma_d'];
      $nma_b   = $_POST['nma_b'];
      $user    = $_POST['username'];
      $pass    = $_POST['password'];
      $email   = $_POST['email'];
      $no_telp = $_POST['no_telp'];
      $level   = $_POST['level'];


      $sql   = "SELECT * FROM admins WHERE username = '$user'";
      $query = mysqli_query($koneksi, $sql);
      $data  = mysqli_fetch_array($query, MYSQLI_ASSOC);

      if ($data['username'] == $user) {

        echo "
          <script>
            alert('Mohon Maaf Username yang Anda masukkan sudah terdaftar !');
            window.location=('gabung.php');
          </script>
        ";

      } else {

        // untuk menggabungkan nama depan dan nama belakang
        $nma_lengkap = $nma_d." ".$nma_b;

        // untuk mengubah pasword menjadi hash
        $k_pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql   = "INSERT INTO admins (uid, username, password, nama_lengkap, email, no_telp, level)
                  VALUES ('$uid', '$user', '$k_pass', '$nma_lengkap', '$email', '$no_telp', '$level')";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {

          echo "<script> alert('Terima Kasih Anda telah mendaftar !');parent.location='index.php'; </script>";

        }
        else {

          echo "<script> alert('Anda gagal mendaftar, silahkan coba lagi !'); </script>";

        }

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
