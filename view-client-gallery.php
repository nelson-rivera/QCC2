<!DOCTYPE html>
<html lang="en">
<head>
        <?php
        session_start();
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/class/Helper.php';
        include_once './includes/connection.php';
        include_once './includes/sql.php';
        Helper::helpSession();
        Helper::helpIsAllowed(1); // 1 - Listado de clientes
        $connection = openConnection();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Listado de Clientes</title>
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
                <h2>Clientes <i class="fa fa-angle-double-right"></i> Galeria de clientes</h2>
                
            </div>
           
            <div class="content">
<!--                <div class="row">
                    <div class="spacer" ></div>
                        <div class="col-md-6 pull-right">
                            <input type="text" placeholder="Buscar cliente..." class="form-control">
                        </div>
                </div>-->
                 <div class="spacer" ></div>
                <div class="gallery-cont">
                    <?php
                        $queryClientes = $connection->prepare(sql_select_clientes_extended_order_alph());
                        $queryClientes->execute();
                        foreach ($queryClientes->fetchAll() as $cliente) {
                    ?>
                        <div class="item">
                        <div class="photo">
                          <div class="head">
                            <span class="pull-right"> <i class="fa fa-map-marker"></i> </span><h4><?= utf8_encode($cliente['nombre_cliente']) ?></h4>
                            <span class="desc"><?= utf8_encode($cliente['municipio']) ?></span>
                          </div>
                          <div class="img" style="background-position: center; background-repeat: no-repeat; background-image: url('<?= $cliente['logo'] ?>'); background-size: contain; height: 200px">
                            <img src="<?= $cliente['logo'] ?>" />
                            <div class="over">
                              <div class="func">
                                  <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                            </div>            
                          </div>
                        </div>
                      </div>
                    <?php
                        }
                    ?>
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
  <?= js_general() ?>
  <?= js_masonry() ?>

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
         //Initialize Mansory
      var $container = $('.gallery-cont');
      // initialize
      $container.masonry({
        columnWidth: 0,
        itemSelector: '.item'
      });
      
      //Resizes gallery items on sidebar collapse
      $("#sidebar-collapse").click(function(){
          $container.masonry();      
      });
     
        
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>