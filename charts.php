<!DOCTYPE html>
<html lang="en">
<head>
        <?php
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Listar Clientes</title>
	<?= css_fonts() ?>

	<!-- Bootstrap core CSS -->
	<?= css_bootstrap() ?>
        <?= css_font_awesome() ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
	<?= css_nanoscroller() ?>
	<?= css_datatable() ?>
	<?= css_style() ?>

</head>

<body>

    <!-- Fixed navbar -->
    <div id="head-nav" class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="fa fa-gear"></span>
          </button>
          <a class="navbar-brand" href="#"><span>QCC</span></a>
        </div>
        <div class="navbar-collapse collapse">
            <?= lytTopBarMenu() ?>		

        </div><!--/.nav-collapse -->
      </div>
    </div>
	
    <div id="cl-wrapper">
        <div class="cl-sidebar">
            <div class="cl-toggle"><i class="fa fa-bars"></i></div>
            <div class="cl-navblock">
                <div class="menu-space">
                  <div class="content">
                    <div class="side-user">
                      <div class="avatar"><img src="images/avatar1_50.jpg" alt="Avatar" /></div>
                      <div class="info">
                        <a href="#">Usuario 1</a>
                        <img src="images/state_online.png" alt="Status" /> <span>Online</span>
                      </div>
                    </div>
                    <?= lytSideMenu(1) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Clientes</h2>
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <table class="table table-bordered" id="datatable-icons" >
                                <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Rubro</th>
                                            <th>Municipio</th>
                                            <th>Departamento</th>
                                            <th>Acciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                        <tr class="odd gradeA">
                                            <td>ACAVISA</td>
                                            <td>FINAL</td>
                                            <td>San Salvador</td>
                                            <td class="center">San Salvador</td>
                                            <td class="center">
                                                <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Edit" href="edit-client.php">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeA">
                                            <td>Claro</td>
                                            <td>FINAL</td>
                                            <td>San Salvador</td>
                                            <td class="center">San Salvador</td>
                                            <td class="center">
                                                <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Edit" href="edit-client.php">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr class="odd gradeA">
                                            <td>UCA</td>
                                            <td>FINAL</td>
                                            <td>San Salvador</td>
                                            <td class="center">San Salvador</td>
                                            <td class="center">
                                                <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Edit" href="edit-client.php">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
	</div> 
    </div>
   <?= js_jquery() ?>
  <?= js_jquery_ui() ?>
  <?= js_bootstrap_datetimepicker() ?>
  <?= js_jquery_nanoscroller() ?>
  <?= js_jquery_nestable() ?>
  <?= js_bootstrap_switch() ?>
  <?= js_select2() ?>
  <?= js_bootstrap_slider() ?>
  <?= js_jquery_datatable() ?>
  <?= js_jquery_datatable_adapter() ?>
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        $('#datatable-icons').dataTable();
        $("#datatable").dataTable();
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>