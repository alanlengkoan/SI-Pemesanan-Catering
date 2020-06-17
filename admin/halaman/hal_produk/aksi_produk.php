<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_seo.php";

$halamane=$_GET[halamane];
$act=$_GET[act];

// Hapus produk
if ($halamane=='produk' AND $act=='hapus'){
  mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$_GET[id]'");
  header('location:../../bagian.php?halamane='.$halamane);
}

// Input produk
elseif ($halamane=='produk' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    UploadImage($nama_file_unik);

    mysqli_query($koneksi, "INSERT INTO produk(id_produk,
                                    nama_produk,
                                    produk_seo,
                                    id_kategori,
                                    harga_p,
                                    stok,
                                    deskripsi,
                                    tgl_masuk,
                                    gambar)
                            VALUES('$_POST[id_produk]',
                                   '$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
                                   '$_POST[harga]',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang',
                                   '$nama_file_unik')");
  }
  else{
    mysqli_query($koneksi, "INSERT INTO produk(nama_produk,
                                    produk_seo,
                                    id_kategori,
                                    harga_p,
                                    stok,
                                    deskripsi,
                                    tgl_masuk)
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$_POST[kategori]',
                                   '$_POST[harga]',
                                   '$_POST[stok]',
                                   '$_POST[deskripsi]',
                                   '$tgl_sekarang')");
  }
  header('location:../../bagian.php?halamane='.$halamane);
}

// Update produk
elseif ($halamane=='produk' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;

  $produk_seo      = seo_title($_POST['nama_produk']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo',
                                   id_kategori = '$_POST[kategori]',
                                   harga_p     = '$_POST[harga]',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_produk   = '$_POST[id]'");
  }
  else{
    UploadImage($nama_file_unik);
    mysqli_query($koneksi, "UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo',
                                   id_kategori = '$_POST[kategori]',
                                   harga_p     = '$_POST[harga]',
                                   stok        = '$_POST[stok]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'
                             WHERE id_produk   = '$_POST[id]'");
  }
  header('location:../../bagian.php?halamane='.$halamane);
}
?>
