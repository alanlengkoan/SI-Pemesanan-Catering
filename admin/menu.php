<?php
include "../config/koneksi.php";
$jmlorder=mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM orders"));
echo"<div class='span3' id='sidebar'>
                    <ul class='nav nav-list bs-docs-sidenav nav-collapse collapse'>
                        <li class='active'>
                            <a href='bagian.php?halamane=home'>Dashboard</a>
                        </li>
                        <li>
                            <a href='bagian.php?halamane=kategori'>Kategori Menu</a>
                        </li>
                        <li>
                            <a href='bagian.php?halamane=produk'>Daftar Menu</a>
                        </li>
                        <li>
                            <a href='df_user.php'>Daftar User</a>
                        </li>
                        <li>
                            <a href='df_kurir.php'>Daftar Kurir</a>
                        </li>
                        <li>
                            <a href='bagian.php?halamane=order'><span class='badge badge-success pull-right'>$jmlorder</span> Orders</a>
                        </li>
						            <li>
                            <a href='pembayaran.php'>Konfirmasi Pembayaran</a>
                        </li>
                        <li>
                            <a href='hubungi_kami.php'>Hubungi Kami</a>
                        </li>
                        <li>
                            <a href='penjualan.php'>Laporan Penjualan</a>
                        </li>
						            <li>
                            <a href='bagian.php?halamane=laporanH'>Laporan Harian</a>
                        </li>
                        <li>
                            <a href='bagian.php?halamane=laporanM'>Laporan Mingguan</a>
                        </li>
                        <li>
                            <a href='bagian.php?halamane=laporanB'>Laporan Bulanan</a>
                        </li>



                    </ul>
                </div>";
?>
