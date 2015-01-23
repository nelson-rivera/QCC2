<!DOCTYPE html>
<html lang="en">
<head>
        <?php
        session_start();
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
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
           
            <div class="content">
                <div class="row">
                    <div class="spacer" ></div>
                        <div class="col-md-6 pull-right">
                            <input type="text" placeholder="Buscar cliente..." class="form-control">
                        </div>
                </div>
                 <div class="spacer" ></div>
                <div class="gallery-cont">
                    <div class="item">
                      <div class="photo">
                        <div class="head">
                          <span class="pull-right"> <i class="fa fa-map-marker"></i> </span><h4>ACAVISA</h4>
                          <span class="desc">San Salvador</span>
                        </div>
                        <div class="img">
                          <img src="clients/unilever.jpg" />
                          <div class="over">
                            <div class="func">
                                <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                          </div>            
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="photo">
                        <div class="head">
                          <span class="pull-right active"> <i class="fa fa-map-marker"></i> </span><h4>Molsa</h4>
                          <span class="desc">San Salvador</span>
                        </div>
                        <div class="img">
                            <img src="clients/molsa.jpg" />
                          <div class="over">
                            <div class="func">
                                <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                          </div>            
                        </div>          
                      </div>
                    </div>
                    <div class="item">
                      <div class="photo">
                        <div class="head">
                          <span class="pull-right active"> <i class="fa fa-map-marker"></i> </span><h4>Credicomer</h4>
                          <span class="desc">San Salvador</span>
                        </div>
                        <div class="img">
                            <img src="clients/credicomer.png" />
                          <div class="over">
                            <div class="func">
                                <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                          </div>            
                        </div>          
                      </div>
                    </div>
                    <div class="item">
                      <div class="photo">
                        <div class="head">
                          <span class="pull-right active"> <i class="fa fa-map-marker"></i> </span><h4>Claro</h4>
                          <span class="desc">San Salvador</span>
                        </div>
                        <div class="img">
                            <img src="clients/claro.jpg" />
                          <div class="over">
                            <div class="func">
                                <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                          </div>            
                        </div>          
                      </div>
                    </div>
                    <div class="item">
                      <div class="photo">
                        <div class="head">
                          <span class="pull-right active"> <i class="fa fa-map-marker"></i> </span><h4>Claro</h4>
                          <span class="desc">San Salvador</span>
                        </div>
                        <div class="img">
                            <img src="clients/uca.jpg" />
                          <div class="over">
                            <div class="func">
                                <a class="image-zoom" href="edit-client.php"><i class="fa fa-search"></i></a></div>
                          </div>            
                        </div>          
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