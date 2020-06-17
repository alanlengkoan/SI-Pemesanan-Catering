<?php
// untuk koneksi
include_once 'config/koneksi.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$login  = mysqli_query($koneksi, "SELECT * FROM admins WHERE username = '$user' AND blokir= 'N'");
$r      = mysqli_fetch_array($login, MYSQLI_ASSOC);

$cek_user = $r['username'];
$hash     = $r['password'];
$cek_pass = password_verify($pass, $hash);

// Apabila username dan password ditemukan
if ($cek_user) {

  if ($cek_pass) {

    session_start();

    $_SESSION['username'] = $r['username'];
    $_SESSION['level']    = $r['level'];

    if ($r['level'] == "admin") {
      header('location:admin/bagian.php?halamane=home');
    } else if ($r['level'] == "user") {
      header('location:user/index.php');
    } else if ($r['level'] == "kurir") {
      header('location:kurir/index.php');
    } else if ($r['level'] == "") {
      echo "
        <script>
          alert('Maaf akun Anda belum dikonfirmasi !');
          window.location=('index.php');
        </script>
      ";
    }

  } else {

    echo "<link href=config/adminstyle.css rel=stylesheet type=text/css>";
    echo "<center>LOGIN GAGAL! <br>
          Username atau Password Anda tidak benar.<br>
          Atau account Anda sedang diblokir.<br>";
    echo "<a href=login.php><b>ULANGI LAGI</b></a></center>";

  }

} else {

  echo "<link href=config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>LOGIN GAGAL! <br>
        Username atau Password Anda tidak benar.<br>
        Atau account Anda sedang diblokir.<br>";
  echo "<a href=login.php><b>ULANGI LAGI</b></a></center>";

}

?>
