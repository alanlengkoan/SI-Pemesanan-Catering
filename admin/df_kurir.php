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
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/jquery.dataTables.css">
    		<link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">

        <script type="text/javascript" src="bootstrap/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/jquery.dataTables.min.js"></script>

    </head>

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
	                                        <a href='bagian.php?halamane=home'>Dashboard</a> <span class='divider'>/ Daftar Kurir</span>
	                                    </li>


	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                      <div class="container">
                          <div class="row">
                              <h2>&nbsp;&nbsp;&nbsp; Daftar Kurir</h2>
                              <hr class="primary">
                            </div>
                          </div>

                          <table id="Data-Table" class="table table-bordered table table-striped" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>ID User</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>No Hp / Telepon</th>
                                <th>Aksi</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                                include "../config/koneksi.php";

                                $query = mysqli_query($koneksi, "SELECT * FROM admins WHERE level = 'kurir' ORDER BY uid");
                                $no = 1;

                                while ($baris = mysqli_fetch_object($query)){
                               ?>
                              <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $baris->uid ?></td>
                                <td><?= $baris->nama_lengkap ?></td>
                                <td><?= $baris->username ?></td>
                                <td><?= substr($baris->password, 0, 10) ?></td>
                                <td><?= $baris->email ?></td>
                                <td><?= $baris->no_telp ?></td>
                                <td>
                                  <a class="btn btn-danger" href="#?id_img=<?= $baris->uid ?>"><i class="icon_trash_alt"></i>&nbsp;Hapus</a>
                                </td>
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
      	<script>
          $(document).ready(function() {
            $('#Data-Table').DataTable();
          } );
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
