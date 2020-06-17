<?php
// untuk koneksi ke database
include_once 'config/koneksi.php';

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

<!DOCTYPE html>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- Bootstrap -->
    <link href="admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="admin/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="admin/assets/styles.css" rel="stylesheet" media="screen">

  </head>
  <body id="login">

    <!-- container -->
    <div class="container">
      <form class="form-signin" action="register_cek.php" method="POST">
        <h2 class="form-signin-heading">Silahkan Registrasi</h2>

        <!-- untuk user id -->
        <input name="uid" type="hidden" class="input-block-level" value="<?php echo $kodeoto; ?>" readonly>
        <!-- untuk user id -->

        <input name="nama" type="text" class="input-block-level" placeholder="Masukkan Nama Lengkap" required>
        <input name="email" type="email" class="input-block-level" placeholder="Masukkan Email" required>
        <input name="nomor" type="number" class="input-block-level" placeholder="Masukkan Nomor Telepon" required>
        <input name="username" type="text" class="input-block-level" placeholder="Masukkan Username" required>
        <input name="password" type="password" class="input-block-level" placeholder="Masukkan Password" required>

        <p>Sudah punya Akun ? Klik <a href="login.php">disini</a> untuk Login. </p>

        <input class="btn btn-large btn-primary" type="submit" name="register" value="Register">

      </form>
    </div>
    <!-- /container -->

  </body>
</html>
