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
include_once "config/koneksi.php";
// untuk rupiah
include_once "config/fungsi_rupiah.php";

// Halaman utama (Home)
if ($_GET['module'] == 'home'){


}


// Modul detail produk
else if ($_GET['module'] == 'detailproduk'){
  // Tampilkan berapa item yang sudah dimasukkan ke Keranjang Belanja
  require_once "item.php";

  // Tampilkan detail produk berdasarkan produk yang dipilih
  $idproduk = $_GET['id'];
	$detail = mysqli_query($koneksi, "SELECT * FROM produk, kategori WHERE kategori.id_kategori=produk.id_kategori AND id_produk = '$idproduk'");
	$d      = mysqli_fetch_array($detail);
	$tgl    = tgl_indo($d['tanggal']);
  $harga  = number_format($d['harga_p'],0,",",".");

	echo "<span class=date>$tgl</span><br />";
	echo "<span class=judul>$d[nama_produk]</span><br />";
	echo "Kategori: <a href=kategori-$d[id_kategori]-$d[kategori_seo].html><b>$d[nama_kategori]</b></a></span><br /><br />";

  // Apabila ada gambar dalam berita, tampilkan
 	if ($d['gambar']!=''){
		echo "<span class=image><img src='foto_produk/$d[gambar]'></span>";
	}
	echo "<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><p>";
	echo "$d[deskripsi] <h1><b>Harga : Rp. $harga</b></h1><br />
        <a href=login.php><img src='images/beli.jpg' border=0></a><br />";
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
    echo "<td align=center>
            <br><span class=image><img src='foto_produk/small_$r[gambar]'></span><br /><br />Rp. <b>$harga</b><br /><br /></td>
          <td><br /><span class=judul><a href=produk-$r[id_produk].html>$r[nama_produk]</a></span><br /><br />
          $isi ... <a href=produk-$r[id_produk].html>Selengkapnya</a><br /><br />

          <a href=login.php><img src='images/beli.jpg' border=0></a><br /><br /></td>";
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

// Menu utama di header



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
			echo "<span><img src='foto_produk/$r[gambar]' width='35%' border=0></span>";

		}
    // Tampilkan hanya sebagian isi berita
    $isi_produk = nl2br($r['deskripsi']); // membuat paragraf pada isi berita
    $isi = substr($isi_produk,0,300); // ambil sebanyak 300 karakter
    $isi = substr($isi_produk,0,strrpos($isi," ")); // potong per spasi kalimat
    echo "$isi ... <a href=produk-$r[id_produk].html>Selengkapnya</a><br /><br />
         <h2><b> Harga : Rp. $harga</b></h2><br /><a href=login.php><img src='images/beli.jpg' border=0></a><br />
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
	$sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk
			                WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanjanya Masih Kosong');
        window.location=('index.php')</script>";
    }
  else{
    echo "<form method=post action=aksi.php?module=keranjang&act=update>
          <table border=0 cellpadding=3 align=center>
          <tr bgcolor=#66CCFF><th>No</th><th>Produk</th><th>Nama Produk</th><th>Jumlah</th>
          <th>Harga</th><th>Sub Total</th><th>Hapus</th></tr>";

  $no=1;
  while($r=mysqli_fetch_array($sql)){
    $subtotal    = $r['harga'] * $r['jumlah'];
    $total       = $total + $subtotal;
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r['harga']);

    echo "<tr bgcolor=#CCFFFF><td>$no</td><input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><br><img src='foto_produk/small_$r[gambar]'></td>
              <td>$r[nama_produk]</td>
              <td><select name='jml[$no]' value=$r[jumlah] onChange='this.form.submit()'>";
              for ($j=1;$j <= $r['stok'];$j++){
                  if($j == $r['jumlah']){
                   echo "<option selected>$j</option>";
                  }else{
                   echo "<option>$j</option>";
                  }
              }
        echo "</select></td>

              <td>$harga</td>
              <td>$subtotal_rp</td>
              <td align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>
              <img src=images/kali.png border=0 title=Hapus></a></td>
          </tr>";
    $no++;
  }
  echo "<tr><td colspan=6 align=right><br><b>Total</b>:</td><td colspan=2><br>Rp. <b>$total_rp</b></td></tr>
        <td colspan=4 align=right><br /><a href=selesai-belanja.html><img src=images/selesai.jpg  border=0></a><br /></td></tr>
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
  $sid = session_id();
  $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp, produk WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysqli_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
   	 exit(0);
	}
	else{
  // Form untuk input data pelanggan
  echo "<span class=judul_head>&#187; <b>Data Pelanggan</b></span><br /><br />
      <form name=form action=simpan-transaksi.html method=POST onSubmit=\"return validasi(this)\">
      <table>
        <tr>
          <td>Nama</td>
          <td> : <input type='text' name='nama' size='35' required></td>
        </tr>

        <tr>
          <td>Alamat Lengkap</td>
          <td> : <input type='text' name='alamat' size='35' required></td>
        </tr>

        <tr>
          <td>Telpon/HP</td>
          <td> : <input type='text' name='telpon' required></td>
        </tr>

        <tr>
          <td>Email</td>
          <td> : <input type='email' name='email' required></td>
        </tr>

        <tr>
          <td colspan=2><input type=submit value=Proses></td>
        </tr>
      </table>";
  }
}


// Modul simpan transaksi
else if ($_GET['module'] == 'simpantransaksi') {

  $nama  = $_POST['nama'];
  $almt  = $_POST['alamat'];
  $tlpn  = $_POST['telpon'];
  $email = $_POST['email'];

  $tgl_skrg = date("Ymd");
  $jam_skrg = date("H:i:s");

  if (empty($nama) || empty($almt) || empty($tlpn) || empty($email)) {

    echo "Data yang Anda isikan belum lengkap ! <br>
          <a href='selesai-belanja.html'>
            <b>Ulangi Lagi</b>
          </a>
          ";

  } else {

    $sid = session_id();

    $sql   = "SELECT * FROM orders_temp WHERE id_session = '$sid' ";
    $query = mysqli_query($koneksi, $sql);

    while ($r = mysqli_fetch_array($query, MYSQLI_ASSOCC)) {
      $isikeranjang[] = $r;
    }


    // simpan data pemesanan
    mysqli_query($koneksi, "INSERT INTO orders (nama_kustomer, alamat, telpon, email, tgl_order, jam_order)
                            VALUES ('$nama', '$almt', '$tlpn', '$email', '$tgl_skrg', '$jam_skrg')");

    // mendapatkan nomor orders
    $id_orders = mysqli_insert_id($koneksi);

    // untuk menyimpan data ke dalam tabel orders_detail berdasarkan $sid
    foreach ($query as $value) {

      $id_produk = $value['id_produk'];
      $jumlah    = $value['jumlah'];

      $sql_tmp = "INSERT INTO orders_detail (id_orders, id_produk, jumlah) VALUES ('$id_orders', '$id_produk', '$jumlah')";
      mysqli_query($koneksi, $sql_tmp);

    }

    // setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
    for ($i = 0; $i < $jml; $i++) {
      mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
    }

    echo "<span class=judul_head>&#187; <b>Proses Transaksi Selesai</b></span><br /><br />
          Data pemesan beserta ordernya adalah sebagai berikut: <br />
          <table>
          <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
          <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
          <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
          <tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><hr /><br />

          Nomor Order: <b>$id_orders</b><br /><br />";

          $daftarproduk = mysqli_query($koneksi, "SELECT * FROM orders_detail, produk WHERE orders_detail.id_produk = produk.id_produk AND id_orders='$id_orders'");

    echo "<table cellpadding=5>
          <tr bgcolor=#D3DCE3>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub Total</th>
          </tr>";

    $pesan="Terimakasih telah melakukan pemesanan di Toko online kami <br /><br />
            Nama: $_POST[nama] <br />
            Alamat: $_POST[alamat] <br/>
            Telpon: $_POST[telpon] <br /><hr />

            Nomor Order: $id_orders <br />
            Data order Anda adalah sebagai berikut: <br /><br />";

    $no=1;
    while ($d = mysqli_fetch_array($daftarproduk)){

       $subtotalberat = $d['berat'] * $d['jumlah']; // total berat per item produk
       $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

       $subtotal    = $d['harga'] * $d['jumlah'];
       $total       = $total + $subtotal;
       $subtotal_rp = format_rupiah($subtotal);
       $total_rp    = format_rupiah($total);
       $harga       = format_rupiah($d['harga']);

       echo "<tr bgcolor=#cccccc>
              <td>$no</td>
              <td>$d[nama_produk]</td>
              <td align=center>$d[jumlah]</td>
              <td>Rp. $harga</td>
              <td>Rp. $subtotal_rp</td>
            </tr>";

       $pesan.= "$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
       $no++;
    }

    // untuk bagian ongkos kirim
    $ongkos       = mysqli_fetch_array(mysqli_query($koneksi, "SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
    $ongkoskirim1 = $ongkos['ongkos_kirim'];
    $ongkoskirim  = $ongkoskirim1 * $totalberat;

    $grandtotal    = $total + $ongkoskirim;

    $ongkoskirim_rp  = format_rupiah($ongkoskirim);
    $ongkoskirim1_rp = format_rupiah($ongkoskirim1);
    $grandtotal_rp   = format_rupiah($grandtotal);

    // $pesan.="<br /><br />Total : Rp. $total_rp
    //          <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp
    //          <br />Total Berat : $totalberat Kg
    //          <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp
    //          <br />Grand Total : Rp. $grandtotal_rp
    //          <br /><br />Silahkan lakukan pembayaran ke BCA sebanyak Grand Total yang tercantum,
    //          nomor rekeningnya <b>0123456789</b> a.n. Sigit Dwi Prasetya";
    //
    // $subjek="Pemesanan Online delivery makanan pada restoran kami";
    //
    // // Kirim email dalam format HTML
    // $dari = "From: sigit.prasetya@axis.blackberry.com \n";
    // $dari .= "Content-type: text/html \r\n";
    //
    // // Kirim email ke kustomer
    // mail($_POST['email'], $subjek, $pesan, $dari);
    //
    // // Kirim email ke pengelola toko online
    // mail("sigit.prasetya@axis.blackberry.com", $subjek, $pesan, $dari);


    echo "<tr>
            <td colspan=5 align=right>Total : Rp. </td>
            <td align=right><b>$total_rp</b></td>
          </tr>
          <tr>
            <td colspan=5 align=right>Grand Total : Rp. </td>
            <td align=right><b>$grandtotal_rp</b></td>
          </tr>
          </table>";

    echo "<hr /><p>Data order anda akan segera kami antar. <br />
                   Terima Kasih atas pemesanan anda</p><br />";

  }

}
?>
