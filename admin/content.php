<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";

// Bagian Home
if ($_GET['halamane']=='home'){

  ?>
  <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
                            <h4>Selamat Datang</h4>
                        	Silahkan Mengelola Website anda dengan menu yang tersedia</div>

  <?php
}



// Bagian Kategori
elseif ($_GET['halamane']=='kategori'){
    include "halaman/hal_kategori/kategori.php";
}

// Bagian Produk
elseif ($_GET['halamane']=='produk'){
    include "halaman/hal_produk/produk.php";
}


// Bagian Order
elseif ($_GET['halamane']=='order'){
    include "halaman/hal_order/order.php";
}

// Bagian Kota/Ongkos Kirim


elseif ($_GET['halamane']=='laporanH'){
    include "halaman/hal_laporan_harian/laporanH.php";
}

elseif ($_GET['halamane']=='laporanB'){
    include "halaman/hal_laporan_bulanan/laporanB.php";
}

elseif ($_GET['halamane']=='laporanM'){
    include "halaman/hal_laporan_mingguan/laporanM.php";
}


// Bagian Password
elseif ($_GET['halamane']=='password'){
    include "halaman/hal_password/password.php";
}

// Apabila halaman tidak ditemukan
else{
  echo "<p><b>Maaf, Halaman Belum Tersedia</b></p>";
}
?>
