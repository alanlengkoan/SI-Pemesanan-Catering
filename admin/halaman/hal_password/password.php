<?php
    echo "<div class='row-fluid'>
                         <!-- block -->
                        <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Ganti Password</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
          <form method=POST action=halaman/hal_password/aksi_password.php>
          <table>
          <tr><td>Masukkan Password Lama</td><td> : <input type=text name='pass_lama'></td></tr>
          <tr><td>Masukkan Password Baru</td><td> : <input type=text name='pass_baru'></td></tr>
          <tr><td>Masukkan Lagi Password Baru</td><td> : <input type=text name='pass_ulangi'></td></tr>
          <tr><td colspan=2><br/><input class='btn btn-success' type=submit value=Proses>
                            <input class='btn btn-danger' type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form></div></div></div></div>";
?>
