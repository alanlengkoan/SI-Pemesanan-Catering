<script language="javascript">

function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }

  return (true);
}


function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}
</script>

<?php
// untuk koneksi
include_once "../config/koneksi.php";
// untuk rupiah
include_once "../config/fungsi_rupiah.php";

// Halaman utama (Home)
if ($_GET['module'] == 'home'){


}


// Modul detail produk
else if ($_GET['module'] == 'detailproduk'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  // Tampilkan detail produk berdasarkan produk yang dipilih
	$detail=mysqli_query($koneksi, "SELECT * FROM produk,kategori
                      WHERE kategori.id_kategori=produk.id_kategori
                      AND id_produk='$_GET[id]'");
	$d   = mysqli_fetch_array($detail);
	$tgl = tgl_indo($d['tanggal']);
  $harga     = number_format($d['harga_p'],0,",",".");

	echo "<span class=date>$tgl</span><br />";
	echo "<span class=judul>$d[nama_produk]</span><br />";
	echo "Kategori: <a href=kategori-$d[id_kategori].html><b>$d[nama_kategori]</b></a></span><br /><br />";
  // Apabila ada gambar dalam berita, tampilkan
 	if ($d['gambar']!=''){
		echo "<span class=image><img src='../foto_produk/$d[gambar]'></span>";
	}
	echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><p>";
	echo "$d[deskripsi] <h1><b>Harga : Rp. $harga</b></h1><br />
        <a href=aksi.php?module=keranjang&act=tambah&id=$d[id_produk]><img src='../images/beli.jpg' border=0></a><br />";
}


// Modul produk per kategori
elseif ($_GET['module'] == 'detailkategori'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  // Tampilkan nama kategori
  $sq = mysqli_query($koneksi, "SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysqli_fetch_array($sq);
  echo "<span class=judul_head>&#187; Kategori : <b>$n[nama_kategori]</b></span><br />";

  $p      = new Paging3;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
 	$sql    = "SELECT * FROM produk WHERE id_kategori='$_GET[id]' ORDER BY id_produk DESC LIMIT $posisi,$batas";
	$hasil  = mysqli_query($koneksi, $sql);
	$jumlah = mysqli_num_rows($hasil);

	// Apabila ditemukan produk dalam kategori
	if ($jumlah > 0){
    echo "<table><tr>";

    $i=0;
   while($r=mysqli_fetch_array($hasil)){
    $harga = number_format($r['harga_p'],0,",",".");
    // Tampilkan hanya sebagian isi berita
    $isi_produk = nl2br($r['deskripsi']); // membuat paragraf pada isi berita
    $isi = substr($isi_produk,0,300); // ambil sebanyak 120 karakter
    $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat

    if ($i >= $kolom){
      echo "</tr><tr>";
      $i=0;
    }
    $i++;
    echo "<td align=center><br><span class=image><img src='../foto_produk/small_$r[gambar]'></span><br /><br />Rp. <b>$harga</b><br /><br /></td>
          <td><br /><span class=judul><a href=produk-$r[id_produk].html>$r[nama_produk]</a></span><br /><br />
          $isi ... <a href=produk-$r[id_produk].html>Selengkapnya</a><br /><br />

          <a href=aksi.php?module=keranjang&act=tambah&id=$r[id_produk]><img src='../images/beli.jpg' border=0></a><br /><br /></td>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halkategori'], $jmlhalaman);

  echo "Hal: $linkHalaman<br /><br />";
  }
  else{
    echo "<p align=center>Maaf Menu belum tersedia.</p>";
  }
}

// Modul semua produk
elseif ($_GET['module']=='semuaproduk'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  // Tampilkan semua produk
  echo "<span class=judul>&#187; <b>Menu Yang Tersedia</b></span><br /><br />";
  $p      = new Paging2;
  $batas  = 2;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan semua produk
  $sql=mysqli_query($koneksi, "SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");
  while($r=mysqli_fetch_array($sql)){
    $harga = number_format($r['harga_p'],0,",",".");
		echo "<table><tr><td><span class=judul><a href=produk-$r[id_produk].html>$r[nama_produk]</a></span><br />";
 		// Apabila ada gambar dalam produk, tampilkan
    if ($r['gambar']!=''){
			echo "<span><img src='../foto_produk/$r[gambar]' width='35%' border=0></span>";

		}
    // Tampilkan hanya sebagian isi berita
    $isi_produk = nl2br($r['deskripsi']); // membuat paragraf pada isi berita
    $isi = substr($isi_produk,0,300); // ambil sebanyak 300 karakter
    $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    echo "$isi ... <a href=produk-$r[id_produk].html>Selengkapnya</a><br /><br />
         <h2><b> Harga : Rp. $harga</b></h2><br /><a href=aksi.php?module=keranjang&act=tambah&id=$r[id_produk]><img src='../images/beli.jpg' border=0></a><br />
          </td></tr></table><br />";
	 }

  $jmldata     = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halproduk'], $jmlhalaman);

  echo "Hal: $linkHalaman<br /><br />";
}


// Modul keranjang belanja
elseif ($_GET['module']=='keranjangbelanja'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
  echo "<span class=judul>&#187; <b>Keranjang Menu yang Dipesan</b></span><br /><br />";
	$sid = session_id();
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){

    echo "
          <script>window.alert('Keranjang Belanjanya Masih Kosong');
          window.location=('index.php')</script>
        ";

    } else {

    echo "<form method=post action=aksi.php?module=keranjang&act=update>
          <table border=0 cellpadding=3 align=center>
          <tr bgcolor=#66CCFF><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th>
          <th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";

  $no=1;
  while($r = mysqli_fetch_array($sql)){

    $subtotal    = $r['harga_p'] * $r['jumlah'];
    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r['harga_p']);

    echo "<tr bgcolor=#CCFFFF>
            <td>$no</td>
            <input type=hidden name=id[$no] value=$r[id_orders_temp]>
            <td align=center><br>
              <img src='../foto_produk/small_$r[gambar]'>
            </td>
            <td>$r[nama_produk]</td>
            <td>
            <select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
            for ($j=1;$j <= $r['stok'];$j++){

                if($j == $r['jumlah']){

                 echo "<option selected>$j</option>";

                }else{

                 echo "<option>$j</option>";

                }

            }
        echo "</select>
              </td>

              <td>
                $harga
                <input type='hidden' name='harga[$no]' value='$r[harga_p]' readonly>
              </td>

              <td>
                $subtotal_rp
              </td>

              <td align=center>
                <a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
                  <img src=../images/kali.png border=0 title=Hapus>
                </a>
              </td>

          </tr>";
    $no++;
  }
  echo "<tr>
          <td colspan=6 align=right><br><b>Total</b>:</td>

          <td colspan=2><br>Rp. <b>$total_rp</b></td></tr>

          <td colspan=4 align=right><br />
            <a href=selesai-belanja.html>
              <img src=../images/selesai.jpg  border=0>
            </a><br />
          </td>
        </tr>
        </table></form><br />";

  }
}

// Modul hubungi kami
elseif ($_GET['module'] == 'hubungikami'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  echo "<span class=judul>&#187; <b>Hubungi Kami</b></span><br /><br />";
  echo "<b>Hubungi kami secara online dengan mengisi form dibawah ini:</b>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=hubungi-aksi.html method=POST>
        <tr><td>Nama</td><td> : <input type=text name=nama size=40></td></tr>
        <tr><td>Email</td><td> : <input type=text name=email size=40></td></tr>
        <tr><td>Subjek</td><td> : <input type=text name=subjek size=55></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=pesan  style='width: 315px; height: 100px;'></textarea></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim></td></tr>
        </form></table><br />";
}



// Modul hubungi aksi
elseif ($_GET['module']=='hubungiaksi'){
  mysqli_query($koneksi, "INSERT INTO hubungi(nama,
                                   email,
                                   subjek,
                                   pesan,
                                   tanggal)
                        VALUES('$_POST[nama]',
                               '$_POST[email]',
                               '$_POST[subjek]',
                               '$_POST[pesan]',
                               '$tgl_sekarang')");
  echo "<span class=posting>&#187; <b>Hubungi Kami</b></span><br /><br />";
  echo "<p align=center><b>Terimakasih telah menghubungi kami. <br /> Kami akan segera meresponnya.</b></p>";
}

// Modul hasil pencarian produk
elseif ($_GET['module']=='hasilcari'){
  echo "<span class=judul_head>&#187; <b>Hasil Pencarian</b></span><br />";
  // menghilangkan spasi di kiri dan kanannya
  $kata = trim($_POST['kata']);
  // mencegah XSS
  $kata = htmlentities(htmlspecialchars($kata), ENT_QUOTES);

  // pisahkan kata per kalimat lalu hitung jumlah kata
  $pisah_kata = explode(" ",$kata);
  $jml_katakan = (integer)count($pisah_kata);
  $jml_kata = $jml_katakan-1;

  $cari = "SELECT * FROM produk WHERE " ;
    for ($i=0; $i<=$jml_kata; $i++){
      $cari .= "deskripsi LIKE '%$pisah_kata[$i]%' OR nama_produk LIKE '%$pisah_kata[$i]%'";
      if ($i < $jml_kata ){
        $cari .= " OR ";
      }
    }
  $cari .= " ORDER BY id_produk DESC LIMIT 7";
  $hasil  = mysqli_query($koneksi, $cari);
  $ketemu = mysqli_num_rows($hasil);

  if ($ketemu > 0){
    echo "<p>Ditemukan <b>$ketemu</b> produk dengan kata <font style='background-color:#00FFFF'><b>$kata</b></font> : </p>";
    while($t=mysqli_fetch_array($hasil)){
		echo "<table><tr><td><span class=judul><a href=produk-$t[id_produk]-$t[produk_seo].html>$t[nama_produk]</a></span><br />";
      // Tampilkan hanya sebagian isi produk
      $isi_produk = htmlentities(strip_tags($t['deskripsi'])); // mengabaikan tag html
      $isi = substr($isi_produk,0,250); // ambil sebanyak 250 karakter
      $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat

      echo "$isi ... <a href=produk-$t[id_produk]-$t[produk_seo].html>Selengkapnya</a>
            <br /><br /></td></tr>
            </table>";
    }
  }
  else{
    echo "<p>Tidak ditemukan produk dengan kata <b>$kata</b></p>";
  }
}


// Modul selesai belanja
elseif ($_GET['module'] == 'selesaibelanja'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";
  $sid  = session_id();
  $sql  = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu = mysqli_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{

    // pemberian kode otomatis id_order
    $sql    = "SELECT id_orders FROM orders";
    $carkod = mysqli_query($koneksi, $sql);
    $datkod = mysqli_fetch_array($carkod, MYSQLI_ASSOC);
    $jumdat = mysqli_num_rows($carkod);

    if ($datkod) {
      $nilkod  = substr($jumdat[0], 1);
      $kode    = (int) $nilkod;
      $kode    = $jumdat + 1;
      $kodeoto = "ODR-".str_pad($kode, 4, "0", STR_PAD_LEFT);
    } else {
      $kodeoto = "ODR-0001";
    }

    // pembelian berdasarka user id
    $user  = $_SESSION['username'];
    $sql   = "SELECT * FROM admins WHERE username = '$user'";
    $query = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $uid  = $data['uid'];
      $nma  = $data['nama_lengkap'];
      $tlp  = $data['no_telp'];
      $eml  = $data['email'];
    }

    // Form untuk input data pelanggan
    echo "
    <h2>Data Pelanggan</h2>

    <div class='row'>
      <div class='col-lg-12'>

        <div class='panel panel-default'>
          <div class='panel-body'>
            <form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">

              <div class='form-group'>
                  <label>ID Orders</label>
                  <input class='form-control' type='text' name='idorder' value='$kodeoto' readonly>
                  <input class='form-control' type='hidden' name='uid' value='$uid' readonly>
              </div>
              <div class='form-group'>
                  <label>Nama</label>
                  <input class='form-control' type='text' name='nama' value='$nma' required>
              </div>
              <div class='form-group'>
                  <label>No Telepon / HP</label>
                  <input class='form-control' type='number' name='telpon' value='$tlp' required>
              </div>
              <div class='form-group'>
                  <label>Email</label>
                  <input class='form-control' type='email' name='email' value='$eml' required>
              </div>
              <div class='form-group'>
                  <label>Jam Pengantaran</label>
                  <input class='form-control' type='time' name='jam_pengantaran' value='' required>
              </div>
              <div class='form-group'>
                  <label>Tanggal Pengantaran</label>
                  <input class='form-control' type='date' name='tgl_pengantaran' value='' required>
              </div>
              <div class='form-group'>
                  <label>Alamat Lengkap</label>
                  <textarea class='form-control' name='alamat' rows='3' required></textarea>
              </div>

              <button type='submit' name='proses' class='btn btn-success'>Proses</button>

            </form>

            <br>

            <div class='panel panel-default'>
              <div class='panel-body'>
                <b>Keterangan :</b>
                <p>
                  Untuk Pemesanan Produk 2 Hari Sebelum Pengataran !
                </p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    ";
  }
}


// Modul simpan transaksi
else if ($_GET['module'] == 'simpantransaksi') {

  $idor   = $_POST['idorder'];
  $uid    = $_POST['uid'];
  $nama   = $_POST['nama'];
  $almt   = $_POST['alamat'];
  $tlpn   = $_POST['telpon'];
  $email  = $_POST['email'];
  $jam_p  = $_POST['jam_pengantaran'];
  $tgl_p  = $_POST['tgl_pengantaran'];
  $stus_p = 'M';

  $tgl_skrg = date("Ymd");
  $jam_skrg = date("H:i:s");

  if (empty($nama) || empty($almt) || empty($tlpn) || empty($email)) {

    echo "Data yang Anda isikan belum lengkap ! <br>
          <a href='selesai-belanja.html'>
            <b>Ulangi Lagi</b>
          </a>
          ";

  } else {

    $sid   = session_id();
    $sql   = "SELECT * FROM orders_temp WHERE id_session = '$sid'";
    $query1 = mysqli_query($koneksi, $sql);
    $total = 0;

    while ($data = mysqli_fetch_array($query1)) {

      // untuk memasukkan total harga
      $total = $total + $data['harga'];

    }

    // simpan data pemesanan
    mysqli_query($koneksi, "INSERT INTO orders (id_orders, uid, nama_kustomer, alamat, telpon, email, status_pembayaran, jam_p, tgl_p, tgl_order, jam_order)
                            VALUES ('$idor', '$uid', '$nama', '$almt', '$tlpn', '$email', '$stus_p', '$jam_p', '$tgl_p', '$tgl_skrg', '$jam_skrg')");

    $sql2   = "SELECT * FROM orders_detail WHERE id_orders = '$idor'";
    $query  = mysqli_query($koneksi, $sql2);
    $result = mysqli_fetch_object($query);

    if ($result->id_orders == $idor) {

      echo "
        <script>
          alert('Mohon maaf silahkan Anda memesan kembali !');
          window.location=('index.php');
        </script>
      ";

    } else {

      // untuk menyimpan data ke dalam tabel orders_detail berdasarkan $sid
      foreach ($query1 as $value) {

        $id_produk = $value['id_produk'];
        $jumlah    = $value['jumlah'];
        $harga     = $value['harga'];

        $sql_tmp = "INSERT INTO orders_detail (id_orders, id_produk, jumlah, harga, total) VALUES ('$idor', '$id_produk', '$jumlah', '$harga', '$total')";
        mysqli_query($koneksi, $sql_tmp);

      }

    }

    // menampilkan data id_order
    $sql   = "SELECT * FROM orders";
    $query = mysqli_query($koneksi, $sql);
    while ($data  = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
      $idorders = $data['id_orders'];
      $nama     = $data['nama_kustomer'];
      $telpon   = $data['telpon'];
      $email    = $data['email'];
      $alamat   = $data['alamat'];
      $jam_p    = $data['jam_p'];
      $tgl_p    = $data['tgl_p'];
    }

    echo "

    <span class=judul_head>
      <h3>&#187; <b>Proses Transaksi Selesai</b> </h3>
    </span>

    <div class='row'>
      <div class='col-lg-4'>
        <a href='cetak_struck/cetak.php?id_orders=$idorders' class='btn btn-success' target='_blank'><i class='fa fa-print'></i> </a>
      </div>
    </div>

    <br>

    <div class='row'>

      <div class='col-lg-12'>
        <div class='panel panel-default'>

          <div class='panel-heading'>
              Data pemesan beserta ordernya adalah sebagai berikut:
          </div>

          <div class='panel-body'>
            <div class='table-responsive'>
              <table class='table table-striped'>
                <tbody>
                  <tr>
                    <td>ID Orders</td>
                    <td> : <b>$idorders</b> </td>
                  </tr>
                  <tr>
                    <td>Nama   </td>
                    <td> : $nama </td>
                  </tr>
                  <tr>
                    <td>Telpon </td>
                    <td> : $telpon </td>
                  </tr>
                  <tr>
                    <td>E-mail </td>
                    <td> : $email </td>
                  </tr>
                  <tr>
                    <td>Jam Pengantaran </td>
                    <td> : $jam_p </td>
                  </tr>
                  <tr>
                    <td>Tanggal Pemesanan </td>
                    <td> : $tgl_p </td>
                  </tr>
                  <tr>
                    <td>Alamat Lengkap </td>
                    <td> : $alamat </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>

    <h3>Nomor Order: <b>$idorders</b></h3>
    <br>";

    $daftarproduk = mysqli_query($koneksi, "SELECT * FROM orders_detail, produk WHERE orders_detail.id_produk = produk.id_produk AND id_orders='$idorders'");

    echo "
    <div class='row'>

      <div class='col-lg-12'>
        <div class='panel panel-default'>

          <div class='panel-heading'>
              Daftar Pembelian Anda
          </div>

          <div class='panel-body'>
            <div class='table-responsive'>
              <table class='table table-striped table-bordered table-hover'>
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody>";

                $pesan="Terimakasih telah melakukan pemesanan di Toko online kami <br /><br />
                        Nama: $_POST[nama] <br />
                        Alamat: $_POST[alamat] <br/>
                        Telpon: $_POST[telpon] <br /><hr />

                        Nomor Order: $id_orders <br />
                        Data order Anda adalah sebagai berikut: <br /><br />";

                $no = 1;
                $total = 0;
                while ($d = mysqli_fetch_array($daftarproduk)){

                   $total = $d['total'];

                   $subtotal_rp = format_rupiah($subtotal);
                   $total_rp    = format_rupiah($total);
                   $harga       = format_rupiah($d['harga']);

                   echo "<tr>
                           <td>$no</td>
                           <td>$d[nama_produk]</td>
                           <td align=center>$d[jumlah]</td>
                           <td>Rp. $d[harga_p]</td>
                           <td>Rp. $d[harga]</td>
                         </tr>";

                   $pesan.= "$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
                   $no++;
                }

                echo "<tr>
                        <td colspan=4 align=right>Total :</td>
                        <td><b>Rp. $total</b></td>
                      </tr>
                      <tr>
                        <td colspan=4 align=right>Grand Total :</td>
                        <td><b>Rp. $total</b></td>
                      </tr>
                      </table>";

          echo "</tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>";

    echo "
    <div class='row'>

      <div class='col-lg-12'>
        <div class='panel panel-default'>

          <div class='panel-body'>
            <p>Data order anda akan segera kami antar. <br> Terima Kasih atas pemesanan anda</p>
          </div>

        </div>
      </div>

    </div>";

  }

}
?>
