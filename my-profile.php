<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        session_start();
        include_once './includes/file_const.php';
        include_once './includes/connection.php';
        include_once './includes/sql.php';
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
        $connection=  openConnection();
        
        $getUsuario = $connection->prepare(sql_select_usuario_byId());
        $getUsuario->bindParam(':idusuario', $_SESSION['idusuario'],PDO::PARAM_INT);
        $getUsuario->execute();
        
        $usuarioArray = $getUsuario->fetch();
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
        <?= css_gritter() ?>
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
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos de perfil</h3>
                            </div>
                            <div class="content">
                                <form id="frm-update-profile" class="form-horizontal" style="border-radius: 0px;" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-6">
                                            <input name="input-nombre" class="form-control" type="text" value="<?= $usuarioArray['nombre'] ?>" required>
                                            <input name="opt" value="1" type="hidden" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-6">
                                            <input name="input-apellido" class="form-control" type="text" value="<?= $usuarioArray['apellido'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo Principal</label>
                                        <div class="col-sm-6">
                                            <input name="input-email-1" class="form-control" type="email" value="<?= $usuarioArray['email_1'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo Secundario</label>
                                        <div class="col-sm-6">
                                            <input name="input-email-2" class="form-control" type="email" value="<?= $usuarioArray['email_2'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono Principal</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-1" class="form-control" type="text" value="<?= $usuarioArray['telefono_1'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono Secundario</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-2" class="form-control" type="text" value="<?= $usuarioArray['telefono_2'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                            </div>
                                        </div>
                                    </div>
<!--                                    <div class="form-group">
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
                                    </div>-->
                                </form>
                                <form id="frm-update-password" class="form-horizontal" style="border-radius: 0px;" data-parsley-validate>
                                    <div class="form-group spacer2">
                                        <div class="col-sm-3"></div>
                                        <label class="col-sm-9" for="input-old-password">Cambiar contraseña</label>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contraseña antigua</label>
                                        <div class="col-sm-6">
                                            <input name="input-old-password" id="input-old-password" class="form-control" type="password" required>
                                            <input name="opt" value="2" type="hidden" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nueva contraseña</label>
                                        <div class="col-sm-6">
                                            <input name="input-new-password" id="input-new-password" class="form-control" type="password" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Repita su nueva contraseña</label>
                                        <div class="col-sm-6">
                                            <input name="input-new-password-r" data-parsley-equalto="#input-new-password" id="input-new-password-r" data-parsley-equalto="#input-new-password" class="form-control" type="password" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Actualizar</button>
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
  <?= js_gritter() ?>
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        window.ParsleyValidator.setLocale('es');
        $("#frm-update-profile").submit(function(event){
            event.preventDefault();
            if($("#frm-update-profile").parsley().isValid()){
                $.ajax({
                    url:'ajax/perfil.php',
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize()
                }).done(function(response) {
                    if(response.status==0){
                        $.gritter.removeAll({
                            after_close: function(){
                                $.gritter.add({
                                    position: 'bottom-right',
                                    text: response.msg,
                                    class_name: 'clean'
                                });
                            }
                        });
                    }
                    else{
                        $.gritter.removeAll({
                            after_close: function(){
                              $.gritter.add({
                                position: 'bottom-right',
                                text: response.msg,
                                class_name: 'danger'
                              });
                            }
                        });
                    }
                })
                .fail(function() {
                    $.gritter.removeAll({
                        after_close: function(){
                          $.gritter.add({
                            position: 'bottom-right',
                            text: 'Ocurrio un error desconocido, por favor intentelo más tarde',
                            class_name: 'danger'
                          });
                        }
                    });
                });
           }
        });
        
        $("#frm-update-password").submit(function(event){
            event.preventDefault();
            if($("#frm-update-password").parsley().isValid()){
                $.ajax({
                    url:'ajax/perfil.php',
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize()
                }).done(function(response) {
                    if(response.status==0){
                        $.gritter.removeAll({
                            after_close: function(){
                                $.gritter.add({
                                    position: 'bottom-right',
                                    text: response.msg,
                                    class_name: 'clean'
                                });
                            }
                        });
                    }
                    else{
                        $.gritter.removeAll({
                            after_close: function(){
                              $.gritter.add({
                                position: 'bottom-right',
                                text: response.msg,
                                class_name: 'danger'
                              });
                            }
                        });
                    }
                })
                .fail(function() {
                    $.gritter.removeAll({
                        after_close: function(){
                          $.gritter.add({
                            position: 'bottom-right',
                            text: 'Ocurrio un error desconocido, por favor intentelo más tarde',
                            class_name: 'danger'
                          });
                        }
                    });
                });
           }
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>