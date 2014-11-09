<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        include_once './includes/libraries.php';
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>Clean Zone</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<?= css_bootstrap() ?>
        <?= css_font_awesome() ?>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->
	<?= css_nanoscroller() ?>
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
    <ul class="nav navbar-nav navbar-right user-nav">
      <li class="dropdown profile_menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="images/avatar2.jpg" />Usuario 1<b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">My Account</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="#">Messages</a></li>
          <li class="divider"></li>
          <li><a href="#">Sign Out</a></li>
        </ul>
      </li>
    </ul>			

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
            <ul class="cl-vnavigation">
              <li>
                <a href="#"><i class="fa fa-users"></i><span>Clientes</span></a>
                <ul class="sub-menu">
                  <li><a href="list-clients.php">Listar clientes</a></li>
                  <li><a href="add-client.php">Agregar cliente</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-smile-o"></i><span>Vendedores</span></a>
                <ul class="sub-menu">
                  <li><a href="ui-elements.html">Listar vendedores</a></li>
                  <li><a href="ui-buttons.html">Agregar vendedor</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-list-alt"></i><span>Proveedores</span></a>
                <ul class="sub-menu">
                  <li><a href="form-elements.html">Listar Proveedores</a></li>
                  <li><a href="form-validation.html">Agregar proveedor</a></li>
                </ul>
              </li>
              <li><a href="#"><i class="fa fa-table"></i><span>Cotizaciones</span></a>
                <ul class="sub-menu">
                  <li><a href="tables-general.html">Listar cotizaciones</a></li>
                  <li><a href="tables-datatables.html">Crear Cotización</a></li>
                </ul>
              </li>                         
              <li><a href="#"><i class="fa fa-signal nav-icon"></i><span>Reporteria</span></a>
              </li>
              
            </ul>
          </div>
        </div>
        <div class="text-right collapse-button" style="padding:7px 9px;">
          <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
        </div>
			</div>
		</div>
	
	<div class="container-fluid" id="pcont">

	<div class="cl-mcont">
		<h3 class="text-center">Content goes here!</h3>
	</div>
	
	</div> 
	
</div>
  <?= js_jquery() ?>
  <?= js_jquery_nanoscroller() ?>
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>