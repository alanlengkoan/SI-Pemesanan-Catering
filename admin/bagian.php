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
                    <a class="brand" href="#">Admin Katering Restoran Sahabat</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">

                                <?php include "profile.php"; ?>

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
	                                        <a href='bagian.php?halamane=home'>Dashboard</a> <span class='divider'>/</span>
	                                    </li>

	                                    <?php include "breadcrumb.php"; ?>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                       <?php include "content.php"; ?>
                    </div>

                </div>
            </div>
            <hr>
            <footer>
                <p>&copy; Kasmawati 2018</p>
            </footer>
        </div>

        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
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

        <script>

        $(document).ready(function() {
          $('#Data-Table').DataTable();
        });

        $(function() {

            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });

        // Tiny MCE
            tinymce.init({
    		    selector: "#tinymce_full",
    		    plugins: [
    		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    		        "searchreplace wordcount visualblocks visualchars code fullscreen",
    		        "insertdatetime media nonbreaking save table contextmenu directionality",
    		        "emoticons template paste textcolor"
    		    ],
    		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    		    toolbar2: "print preview media | forecolor backcolor emoticons",
    		    image_advtab: true,
    		    templates: [
    		        {title: 'Test template 1', content: 'Test 1'},
    		        {title: 'Test template 2', content: 'Test 2'}
    		    ]
    		});

        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });

        </script>

    </body>

</html>
