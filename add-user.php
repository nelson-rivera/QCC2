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

	<title>QCC - Agregar usuario</title>
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
                        <a href="#">José Perez</a>
                        <img src="images/state_online.png" alt="Status" /> <span>Online</span>
                      </div>
                    </div>
                    <?= lytSideMenu(4) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Agregar vendedor</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos del usuario</h3>
                            </div>
                            <div class="content">
                                <form class="form-horizontal" style="border-radius: 0px;" action="#">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6">
                                            <select class="form-control">
                                                <option>Gerente de ventas</option>
                                                <option>Vendedor</option>
                                                <option>Asistente de ventas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contraseña</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Confirmar Contraseña</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Departamento</label>
                                        <div class="col-sm-6">
                                            <select class="form-control">
                                                <option>San Salvador</option>
                                                <option>Morazán</option>
                                                <option>Ahuachapan</option>
                                                <option>Santa Ana</option>
                                                <option>Sonsonate</option>
                                                <option>Chalatenango</option>
                                                <option>Cuscatlan</option>
                                                <option>La Libertad</option>
                                                <option>La Paz</option>
                                                <option>San Vicente</option>
                                                <option>Usulutan</option>
                                                <option>San Miguel</option>
                                                <option>Cabañas</option>
                                                <option>La Union</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Municipio</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text">
                                        </div>
                                    </div>
                                    
                                 
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Agregar, Editar Clientes
                                                </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Listar, ver Clientes
                                                </label>
                                            </div>
                                            <div class="clear" ></div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Agregar, Editar Usuarios
                                                </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Listar, Ver Usuarios
                                                </label>
                                            </div>
                                             <div class="clear" ></div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Agregar, Editar Proveedores
                                                </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Listar, Ver Proveedores
                                                </label>
                                            </div>
                                              <div class="clear" ></div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Agregar, Editar Cotizaciones
                                                </label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox">
                                                    Listar, Ver Cotizaciones
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Agregar</button>
                                            <button type="reset" class="btn btn-default">Limpiar</button>
                                        </div>
                                    </div>
                                </form>
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