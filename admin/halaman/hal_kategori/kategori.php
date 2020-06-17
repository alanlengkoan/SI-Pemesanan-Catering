<?php
// untuk koneksi
include_once '../../../config/koneksi.php';

$aksi="halaman/hal_kategori/aksi_kategori.php";
switch($_GET['act']){
  // Tampil Kategori
  default:
    echo "
      <button class='btn btn-success btn-large' onclick=\"window.location.href='?halamane=kategori&act=tambahkategori';\">Tambah Kategori Menu</button><div class='block'>
        <div class='navbar navbar-inner block-header'>
            <div class='muted pull-left'>Data Kategori Menu</div>
        </div>
        <div class='block-content collapse in'>
            <div class='span12'>
              <table id='Data-Table' class='table table-bordered table table-striped' cellspacing='0' width='100%'>
                <thead>
                  <tr>
                    <th><center>No</center></th>
                    <th>Nama kategori Menu</th>
                    <th><center>aksi</center></th>
                  </tr>
                </thead>
                <tbody>";

                $tampil=mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                $no=1;
                while ($r=mysqli_fetch_array($tampil)){
                   echo "<tr>
                            <td><center>$no</center></td>
                            <td>$r[nama_kategori]</td>
                            <td>
                              <center>
                                <a class='btn btn-primary' href=?halamane=kategori&act=editkategori&id=$r[id_kategori]>Ubah</a>
                                <a class='btn btn-danger' href=$aksi?halamane=kategori&act=hapus&id=$r[id_kategori]>Hapus</a>
                              </center>
                            </td>
                        </tr>";
                  $no++;
                }

                echo"</tbody>
                </table>
              </div>
            </div>
          </div>";


    break;

  // Form Tambah Kategori
  case "tambahkategori":
echo"<div class='row-fluid'>
                          <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Form Tambah Menu Kategori</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
					<!-- BEGIN FORM-->
					<form method=POST action='$aksi?halamane=kategori&act=input' id='form_sample_1' class='form-horizontal'>
						<fieldset>
  							<div class='control-group'>
  								<label class='control-label'>Name<span class='required'>*</span></label>
  								<div class='controls'>
  									<input type='text' name='nama_kategori' data-required='1' class='span6 m-wrap'/>

  								</div>
  							</div>

  							<div class='form-actions'>
  								<button type='submit' class='btn btn-primary'>Simpan</button>
  								<button type='button' onclick=\"window.location.href='bagian.php?halamane=kategori';\">Cancel</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div></div></div></div>";
     break;

  // Form Edit Kategori
  case "editkategori":
    $edit=mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysqli_fetch_array($edit);
echo"<div class='row-fluid'>
                         <!-- block -->
                        <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Form Edit Menu Kategori</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
					<!-- BEGIN FORM-->
					<form method=POST action=$aksi?halamane=kategori&act=update id='form_sample_1' class='form-horizontal'>
						<fieldset>
							 <input type=hidden name=id value='$r[id_kategori]'>
  							<div class='control-group'>
  								<label class='control-label'>Name<span class='required'>*</span></label>
  								<div class='controls'>
  									<input type='text' name='nama_kategori' value='$r[nama_kategori]' data-required='1' class='span6 m-wrap'/>

  								</div>
  							</div>

  							<div class='form-actions'>
  								<button type='submit' class='btn btn-primary'>Validate</button>
  								<button type='button' class='btn'>Cancel</button>
  							</div>
						</fieldset>
					</form>
					<!-- END FORM-->
				</div>
			    </div>
			</div>
                     	<!-- /block -->
		    </div>
        ";

    break;
}
?>
