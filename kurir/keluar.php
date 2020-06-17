<?php
  error_reporting(0);
  session_start();
  session_destroy();
  echo "
        <script>
          window.alert('Anda telah sukses keluar sistem ')
        </script>
        ";
  echo "<meta http-equiv='refresh' content='0; url=../index.php'>";

?>
