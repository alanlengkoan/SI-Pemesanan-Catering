<?php

// untuk koneksi
include_once 'config/koneksi.php';

if (isset($_POST['register'])) {

  $uid  = $_POST['uid'];
  $nama = $_POST['nama'];
  $emil = $_POST['email'];
  $nmor = $_POST['nomor'];
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $sql   = "SELECT * FROM admins WHERE username = '$user'";
  $query = mysqli_query($koneksi, $sql);
  $data  = mysqli_fetch_array($query, MYSQLI_ASSOC);

  if ($data['username'] == $user) {

    echo "
      <script>
        alert('Mohon Maaf Username yang Anda masukkan sudah terdaftar !');
        window.location=('register.php');
      </script>
    ";

  } else {

    // untuk proses penambahan user
    $k_pass = password_hash($pass, PASSWORD_DEFAULT);

    $sql   = "INSERT INTO admins (uid, username, password, nama_lengkap, email, no_telp)
              VALUES ('$uid', '$user', '$k_pass', '$nama', '$emil', '$nmor')";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {

      echo "
        <script>
          alert('Selamat Anda telah berhasil melakukan Register !');
          window.location=('index.php');
        </script>
      ";

    } else {

      echo "
        <script>
          alert('Maaf mohon periksa ulang data yang Anda masukkan !');
          window.location=('login.php');
        </script>
      ";

    }

  }

} else {

  echo "tidak ada";

}
