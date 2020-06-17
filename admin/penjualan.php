<?php
session_start();
include "../config/koneksi.php";
include "../config/fungsi_seo.php";
?>
<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>Admin Home Page</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">
		 <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
    </head>
    <script type="text/javascript" src="bootstrap/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.dataTables.min.js"></script>
        <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Sixghakreasi CPanel</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">

                              <?php include "profile.php"; ?>

                                                  </ul>
                                              </div>
                            </li>
                        </ul>

                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include "menu.php"; ?>

                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">

                        	<div class='navbar'>
                            	<div class='navbar-inner'>
	                                <ul class='breadcrumb'>
	                                    <i class='icon-chevron-left hide-sidebar'><a href='#' title='Hide Sidebar' rel='tooltip'>&nbsp;</a></i>
	                                    <i class='icon-chevron-right show-sidebar' style='display:none;'><a href='#' title='Show Sidebar' rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href='bagian.php?halamane=home'>Dashboard</a> <span class='divider'>/ Hubungi Kami</span>
	                                    </li>


	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                      <div class="container">
                          <div class="row">
                              <h2>&nbsp;&nbsp;&nbsp;Laporan Penjualan</h2>
                              <hr class="primary">
                            </div>
                      </div>

                      <!-- button untuk print laporan penjualan -->
                      <a href="laporan/laporan_penjualan.php" target="_blank" class="btn btn-success btn-sm">Print</a>

                      <div class="block"></div>

                      <table class="table table-bordered table table-striped">
                        <thead>
                           <tr>
                             <th>No</th>
                             <th>Total Penjualan</th>
                             <th>Jumlah Penjualan</th>
                           </tr>
                        </thead>
                        <tbody>
                          <?php

                          // $sql   = "SELECT a.id_orders, b.nama_produk FROM orders AS a INNER JOIN produk AS b ON a.id_orders = b.id_orders ";
                          $sql1   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk";
                          $query1 = mysqli_query($koneksi, $sql1);
                          $no =1;

                          $total_pnjln = 0;
                          $total_jual  = 0;

                          while ($data = mysqli_fetch_array($query1, MYSQLI_ASSOC)) {

                            $total_pnjln = $total_pnjln + $data['total'];
                            $total_jual  = $total_jual + $data['jumlah'];
                            
                          }

                           ?>
                         <tr>
                           <td><?php echo $no++; ?></td>
                           <td>Rp. <?php echo number_format($total_pnjln, 0, ",", "."); ?></td>
                           <td><?php echo number_format($total_jual, 0, ",", "."); ?></td>
                         </tr>
                        </tbody>
                      </table>

                        <div class="block"></div>

                        <table id="Data-Table" class="table table-bordered table table-striped" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>ID Produk</th>
                              <th>Nama Produk</th>
                              <th>Harga</th>
                              <th>Jumlah</th>
                              <th>Total Penjualan</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                              // $sql   = "SELECT a.id_orders, b.nama_produk FROM orders AS a INNER JOIN produk AS b ON a.id_orders = b.id_orders ";
                              $sql   = "SELECT a.*, b.* FROM produk AS a INNER JOIN orders_detail AS b ON a.id_produk=b.id_produk";
                              $query = mysqli_query($koneksi, $sql);
                              $no =1;
                              while ($data = mysqli_fetch_array($query, MYSQLI_ASSOC)){

                                // untuk total
                                $total = $data['total'];

                             ?>
                            <tr>
                              <td><?php echo $no++; ?></td>
                              <td><?php echo $data['id_produk'] ?></td>
                              <td><?php echo $data['nama_produk'] ?></td>
                              <td>Rp. <?php echo number_format($data['harga_p'], 0, ",", ".") ?></td>
                              <td><?php echo $data['jumlah'] ?></td>
                              <td>Rp. <?php echo number_format($total, 0, ",", ".") ?></td>
                            </tr>
                                <?php } ?>
                       </tbody>
                    </table>
                </div>

            </div>

        </div>

        <hr>
        <footer>
            <p>&copy; Sixghakreasi 2015</p>
        </footer>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
    		<script>
          $(document).ready(function() {
           $('#Data-Table').DataTable();
          });
        </script>

        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>


        <link href="vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="vendors/jquery.uniform.min.js"></script>
        <script src="vendors/chosen.jquery.min.js"></script>
        <script src="vendors/bootstrap-datepicker.js"></script>

        <script src="vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="vendors/wizard/jquery.bootstrap.wizard.min.js"></script>




        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/DT_bootstrap.js"></script>

		<script type="text/javascript" src="vendors/tinymce/js/tinymce/tinymce.min.js"></script>


    </body>

</html>
