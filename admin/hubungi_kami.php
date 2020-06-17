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
                              <h2>&nbsp;&nbsp;&nbsp;Hubungi Kami</h2>
                              <hr class="primary">
                            </div>
                          </div>
                        <table id="Data-Table" class="table table-bordered table table-striped" cellspacing="0" width="100%">
                                                <thead>
                                                   <th>No</th>
                                                   <th>Nama</th>
                                                   <th>Email</th>
                                                   <th>Subjek</th>
                                                   <th>Komentar</th>
                                                   <th>Tanggal</th>
                                                   <th>Aksi</th>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                    $sql   = "SELECT * FROM hubungi";
                                                    $query = mysqli_query($koneksi, $sql);
                                                    while ($data= mysqli_fetch_array($query)){
                                                   ?>
                                                <tr>
                                                   <td><?php echo $data['id_hubungi']; ?></td>
                                                   <td><?php echo $data['nama']; ?></td>
                                                   <td><?php echo $data['email']; ?></td>
                                                   <td><?php echo $data['subjek']; ?></td>
                                                   <td><?php echo $data['pesan']; ?></td>
                                                   <td><?php echo $data['tanggal']; ?></td>
                                                   <td><a class="btn btn-danger" href="hubungi_kami_hapus.php?id_hubungi=<?php echo $data['id_hubungi']; ?>"><i class="icon_trash_alt"></i>&nbsp;Hapus</a></td>
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
