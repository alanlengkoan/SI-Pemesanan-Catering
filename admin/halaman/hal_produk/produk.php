<?php
// untuk koneksi
include_once '../../../config/koneksi.php';

error_reporting(0);
session_start();

// pemberian kode otomatis id_order
$sql    = "SELECT id_produk FROM produk";
$carkod = mysqli_query($koneksi, $sql);
$datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
$jumdat = mysqli_num_rows($carkod);

if ($datkod) {
  $nilkod  = substr($jumdat[0], 1);
  $kode    = (int) $nilkod;
  $kode    = $jumdat + 1;
  $kodeoto = "PDR-".str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
  $kodeoto = "PDR-0001";
}

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {

  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses halaman, Anda harus login <br>";
  echo "<a href=../login.php><b>LOGIN</b></a></center>";

}
else{
$aksi="halaman/hal_produk/aksi_produk.php";
switch($_GET['act']){
  // Tampil Produk
  default:
   echo "<button class='btn btn-success btn-large' onclick=\"window.location.href='?halamane=produk&act=tambahproduk';\">Tambah Menu</button><div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Daftar Menu</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>

  									<table id='Data-Table' class='table table-bordered table table-striped' cellspacing='0' width='100%'>
										<thead>
											<tr>
                        <th>No</th>
                        <th>ID Produk</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
										</thead>
										<tbody>";
										 $tampil = mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC");
    $no=1;
    while($r=mysqli_fetch_array($tampil)){
      $tanggal = tgl_indo($r['tgl_masuk']);
      $harga   = format_rupiah($r['harga_p']);
      echo "<tr>
              <td>$no</td>
              <td>$r[id_produk]</td>
              <td>$r[nama_produk]</td>
              <td>$harga</td>
		          <td>
                <a class='btn btn-primary' href=?halamane=produk&act=editproduk&id=$r[id_produk]>Edit</a>
		            <a class='btn btn-danger' href=$aksi?halamane=produk&act=hapus&id=$r[id_produk]>Hapus</a>
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

  case "tambahproduk":
    echo "<div class='row-fluid'>
                         <!-- block -->
                        <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Form Tambah Menu</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
          <form method=POST action='$aksi?halamane=produk&act=input' enctype='multipart/form-data'>
          <table>
          <tr>
            <td width=70>ID Produk</td>
            <td> : <input type=text name='id_produk' value='$kodeoto' size=60 readonly></td>
          </tr>
          <tr>
            <td width=70>Nama Produk</td>
            <td> : <input type=text name='nama_produk' size=60></td>
          </tr>
          <tr><td>Kategori</td>  <td> :
          <select name='kategori'>
            <option value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysqli_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' size=10></td></tr>
          <tr><td>Target Harian</td>     <td> : <input type=text name='stok' size=3></td></tr>
          <tr><td>Deskripsi</td>  <td>  <div class='block-content collapse in'>
		                               <textarea name='deskripsi' id='tinymce_full'></textarea>
		                            </div></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40>
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>
          <tr><td colspan=2><div class='form-actions'><input class='btn btn-primary' type=submit value=Simpan>
                            <input class='btn' type=button value=Batal onclick=self.history.back()></div></td></tr>
          </table></form>
		  </div></div></div></div>";
     break;

  case "editproduk":
    $edit = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$_GET[id]'");
    $r    = mysqli_fetch_array($edit);

    echo "<div class='row-fluid'>
                         <!-- block -->
                        <div class='block'>
                            <div class='navbar navbar-inner block-header'>
                                <div class='muted pull-left'>Form Edit Produk</div>
                            </div>
                            <div class='block-content collapse in'>
                                <div class='span12'>
          <form method=POST enctype='multipart/form-data' action=$aksi?halamane=produk&act=update>
          <input type=hidden name=id value=$r[id_produk]>
          <table>
          <tr><td width=70>Nama Produk</td>     <td> : <input type=text name='nama_produk' size=60 value='$r[nama_produk]'></td></tr>
          <tr><td>Kategori</td>  <td> : <select name='kategori'>";

          $tampil=mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r['id_kategori']==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }

          while($w=mysqli_fetch_array($tampil)){
            if ($r['id_kategori'] == $w['id_kategori']){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>
          <tr><td>Harga</td>     <td> : <input type=text name='harga' value=$r[harga_p] size=10></td></tr>
          <tr><td>Target Harian</td>     <td> : <input type=text name='stok' value=$r[stok] size=3></td></tr>
          <tr><td>Deskripsi</td>   <td><div class='block-content collapse in'>
		                               <textarea name='deskripsi' id='tinymce_full'>$r[deskripsi]</textarea>
		                            </div></td></tr>
          <tr><td>Gambar</td>       <td> :
          <img src='../foto_produk/small_$r[gambar]'></td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2><br/><input class='btn btn-primary' type=submit value=Update>
                            <input type=submit class='btn btn-warning' value=Batal onclick=self.history.back()></td></tr>
         </table></form></div></div></div></div>";
    break;
}
}
?>
