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
        Helper::helpIsAllowed(6); // 5 - Agregar, editar y eliminar proveedores
        
        $connection = openConnection();
        $query=$connection->prepare(sql_select_contactos_proveedores_bydIcontacto_proveedor());
        $query->bindParam(':idcontacto_proveedor', decryptString($_GET['cp']),PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount()>0){}
        $contacto_proveedor=$query->fetch();
        
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Contacto de Proveedor</title>
        <?= css_fonts() ?>

	<!-- Bootstrap core CSS -->
	<?= css_fonts() ?>

	<!-- Bootstrap core CSS -->
	<?= css_bootstrap() ?>
        <?= css_gritter() ?>
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
                    
                    <?= lytSideMenu(5) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Proveedores <i class="fa fa-angle-double-right"></i> <?= $contacto_proveedor['nombre_contacto'] ?></h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos del contacto</h3>
                            </div>
                            <div class="content">
                                <form id="frm-edit-cp" name="frm-edit-cp" class="form-horizontal" style="border-radius: 0px;" action="#">
                                   <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="contacto" id="contacto" required value="<?= $contacto_proveedor['nombre_contacto'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="cargo" id="cargo" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_contactos_proveedores_cargo_all());
                                                $query->execute();
                                                $cargoArray=$query->fetchAll();
                                                foreach ($cargoArray as $value) {
                                                    $cpc= ($value['idcontactos_proveedores_cargos'] == $contacto_proveedor['idcontactos_proveedores_cargos'] ) ? "selected" : "" ;    
                                                ?>
                                                <option value="<?= $value['idcontactos_proveedores_cargos'] ?>" <?= $cpc ?> ><?= $value['cargo'] ?></option>
                                                <?php } ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_1" id="telefono_1" required value="<?= $contacto_proveedor['telefono_1'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_2" id="telefono_2" value="<?= $contacto_proveedor['telefono_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_3" id="telefono_3" value="<?= $contacto_proveedor['telefono_3'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="email_1" id="email_1" required email value="<?= $contacto_proveedor['email_1'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="email_2" id="email_2" email value="<?= $contacto_proveedor['email_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 3</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="email_3" id="email_3" email value="<?= $contacto_proveedor['email_3'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button id="btnSave" class="btn btn-primary" type="submit">Guardar</button>
                                            <button id="btnCancel" type="button" onclick="javascript: location.href='contacts-supplier.php?sup=<?= encryptString($contacto_proveedor['idproveedor']) ?>'" class="btn btn-default">Cancelar</button>
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
  <?= js_jquery_parsley() ?>
  <?= js_i18n_es() ?>
  <?= js_gritter() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        $("#frm-edit-cp").parsley().subscribe('parsley:form:validate', function (formInstance) {
            formInstance.submitEvent.preventDefault();
                if(formInstance.isValid('', true)){
                    $.ajax({
                    url:"ajax/contact-supplier.php",
                    type:'POST',
                    dataType:"json",
                    data:$("#frm-edit-cp").serialize()+"&cp=<?= encryptString(decryptString($_GET['cp'])) ?>&option=update",
                    beforeSend: function() {
                        $("#btnSave").prop("disabled",true);
                        $("#btnReset").prop("disabled",true);
                    }
                }).done(function(response){
                    if (response.status == "1") {
                        $.gritter.removeAll({
                            after_close: function(){
                              $.gritter.add({
                                position: 'bottom-right',
                                title: "<?= txt_contacto_proveedor_title_actualizado()?>",
                                text: response.msg,
                                class_name: 'clean'
                              });
                            }
                          });
                          location.href='contacts-supplier.php?sup=<?= encryptString($contacto_proveedor['idproveedor']) ?>';
                    }
                    else {
                        $.gritter.add({
                            title: "<?= txt_contacto_proveedor_title_actualizado_fail() ?>",
                            text: response.msg,
                            class_name: 'danger'
                          });
                    }
                });
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

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>