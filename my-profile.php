<!DOCTYPE html>
<html lang="en">

<head>
        <?php
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

	<title>QCC</title>
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
                    <?= lytSideMenu(1) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos de perfil</h3>
                            </div>
                            <div class="content">
                                <form id="frm-update-profile" class="form-horizontal" style="border-radius: 0px;" action="#">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" value="José" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" value="Perez" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="email" value="jperez@qcc.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Perfil</label>
                                        <div class="col-sm-6">
                                            <select class="form-control"  required>
                                                <option value="1" selected="selected">
                                                    Vendedor
                                                </option>
                                                <option value="2">
                                                    Adinistrador
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group spacer2">
                                        <div class="col-sm-3"></div>
                                        <label class="col-sm-9" for="input-old-password">Cambiar contraseña</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contraseña antigua</label>
                                        <div class="col-sm-6">
                                            <input id="input-old-password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nueva contraseña</label>
                                        <div class="col-sm-6">
                                            <input id="input-new-password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Repita su nueva contraseña</label>
                                        <div class="col-sm-6">
                                            <input id="input-new-password-r" data-parsley-equalto="#input-new-password" class="form-control" type="password">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Actualizar</button>
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
  <?= js_jquery_parsley() ?>
  <?= js_i18n_es() ?>
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        window.ParsleyValidator.setLocale('es');
        $("#frm-update-profile").parsley().subscribe('parsley:form:validate', function (formInstance) {
            formInstance.submitEvent.preventDefault();
            if(formInstance.isValid('', true)){
                alert('Perfil Editado con éxito');
            }
            return;
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>