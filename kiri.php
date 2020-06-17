<?php
// untuk koneksi
include_once 'config/koneksi.php';

// Menu Pilihan
$kategori=mysqli_query($koneksi, "select nama_kategori, kategori.id_kategori, kategori_seo,
                       count(produk.id_produk) as jml
                       from kategori left join produk
                       on produk.id_kategori=kategori.id_kategori
                       group by nama_kategori");
while($k=mysqli_fetch_array($kategori)){
  echo "<span class=kategori> <a href=kategori-$k[id_kategori].html> $k[nama_kategori] ($k[jml])</a></span><hr />";
}
echo "<br />";

// Random Produk
/* echo "<img src=images/bar3.jpg /><br /><br />";
$promo=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 1");

while($a=mysql_fetch_array($promo)){
		echo "<p align=center><img src='foto_produk/small_$a[gambar]' border=0><br /><br /><a href=#><b>$a[nama_produk]</b></a></p>";
}
echo "<br /><hr />";
*/

// Produk Best Seller
echo "<img src=images/bar3.jpg /><br /><br />";
$best=mysqli_query($koneksi, "SELECT * FROM produk ORDER BY dibeli DESC LIMIT 2");

while($a=mysqli_fetch_array($best)){
		echo "<p align=center><img src='foto_produk/small_$a[gambar]' border=0><br /><br /><a href=produk-$a[id_produk].html><b>$a[nama_produk]</b></a></p><br />";
}
echo "<hr />";

?>
