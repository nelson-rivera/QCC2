<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        session_start();
        include_once './includes/file_const.php';
        include_once './includes/connection.php';
        include_once './includes/sql.php';
        include_once './includes/lang/text.es.php';
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/functions.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
        Helper::helpIsAllowed(1); // 1 - Listado de clientes
        $connection=  openConnection();
        if(empty($_GET['id'])){
            header('location: contact-client.php');
            exit();
        }
        $idContacto=  decryptString($_GET['id']);
        $getContacto=$connection->prepare(sql_select_contacto_by_idcontacto());
        $getContacto->execute(array($idContacto));
        $contactoArray=$getContacto->fetch();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Contacto de cliente</title>
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
	<?= css_niftymodals() ?>
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
                <h2>Clientes <i class="fa fa-angle-double-right"></i> Editar Contacto <?= $contactoArray['nombre_contacto'] ?></h2>
            </div>
            <div class="cl-mcont">
                
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos del contacto</h3>
                            </div>
                            <div class="content">
                                <form id="frm-edit" class="form-horizontal" style="border-radius: 0px;" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input name="input-nombre-contacto" class="form-control" type="text" value="<?= $contactoArray['nombre_contacto'] ?>" required>
                                            <input type="hidden" name="id" value="<?= $idContacto ?>" />
                                            <input type="hidden" name="opt" value="4" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6">
                                            <!--<input name="input-cargo" class="form-control" type="text" value="<?= $contactoArray['cargo'] ?>" required>-->
                                            <select class="form-control" name="input-cargo" id="input-cargo" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_contactos_proveedores_cargo_all());
                                                $query->execute();
                                                $cargoArray=$query->fetchAll();
                                                foreach ($cargoArray as $value) {
                                                    $selected = ($contactoArray['idcargo'] == $value['idcontactos_proveedores_cargos'])?'selected="selected"':'';
                                                ?>
                                                <option <?= $selected ?> value="<?= $value['idcontactos_proveedores_cargos'] ?>" ><?= $value['cargo'] ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-1" class="form-control" type="text" value="<?= $contactoArray['telefono_1'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-2" class="form-control" type="text" value="<?= $contactoArray['telefono_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-3" class="form-control" type="text" value="<?= $contactoArray['telefono_3'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-email-1" class="form-control" type="email" value="<?= $contactoArray['email_1'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-email-2" class="form-control" type="text" value="<?= $contactoArray['email_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Guardar</button>
                                            <button type="button" class="btn btn-danger btn-redirect">Cancelar</button>
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
    
    <div class="md-modal colored-header info md-effect-10" id="mod-alert">
        <div class="md-content ">
          <div class="modal-header">
            <h3>Contacto editado exitosamente</h3>
            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div id="modal-body-center-edit" class="text-center">
                <div class="i-circle primary">
                    <i class="fa fa-check"></i>
                </div>
                <h4>¡Registro editado con éxito!</h4>
            </div>
          </div>
            <div class="modal-footer" id="modal-footer-response-add" >
                <button type="button" class="btn btn-primary btn-flat btn-redirect" data-dismiss="modal" id="btn-redirect" >Aceptar</button>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>
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
  <?= js_niftymodals() ?>  
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        window.ParsleyValidator.setLocale('es');
        
        $("#frm-edit").submit(function(event){
            event.preventDefault();
            if($( '#frm-edit' ).parsley().isValid()){
               
                $.ajax({
                    url:'ajax/client.php',
                    type: 'post',
                    dataType: 'json',
                    data: $(this).serialize()
                }).done(function(response) {
                    if(response.status==0){
                        $("#mod-alert").addClass("md-show");
                    }
                    else{
                        $.gritter.add({
                            title: "Error",
                            text: response.msg,
                            class_name: 'danger'
                          });
                    }
                })
                .fail(function() {
                    
                });
           }
        });
        $(".btn-redirect").click(function(){
            location.href='list-clients.php';
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>