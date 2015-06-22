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
        Helper::helpIsAllowed(9); // 9 - Agregar  proveedores
        
        $connection = openConnection();
        $query=$connection->prepare(sql_select_proveedor_byId());
        $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount() < 0){}
        $proveedor = $query->fetch();

        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Agregar Contacto Proveedor</title>
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
    <?= css_select2() ?>
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
                <h2>Proveedores <i class="fa fa-angle-double-right"></i> <a href="list-suppliers.php">Listado de Proveedores</a> <i class="fa fa-angle-double-right"></i> <a href="contacts-supplier.php?sup=<?= encryptString($proveedor['idproveedor']) ?>">Contactos de  <?= $proveedor['proveedor'] ?></a> <i class="fa fa-angle-double-right"></i> Agregar Contacto</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="content">
                                <form id="frm-add-contacto-proveedor" name="frm-add-contacto-proveedor" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="contacto" id="contacto" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6" data-select="cargo" >
                                            <select name="cargo" id="cargo" style="width: 100%" required >
                                               <?php 
                                                $query=$connection->prepare(sql_select_contactos_proveedores_cargo_all());
                                                $query->execute();
                                                $cargoArray=$query->fetchAll();
                                                foreach ($cargoArray as $value) {
                                                ?>
                                                <option value="<?= $value['idcontactos_proveedores_cargos'] ?>" ><?= $value['cargo'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_1" id="telefono_1" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_2" id="telefono_2" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono_3" id="telefono_3" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="email" name="email_1" id="email_1" required email >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="email" name="email_2" id="email_2" email >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto Privado</label>
                                        <div class="col-sm-6">
                                            <?= selectPrivateContact('input-Private','input-Private','form-control','required',null,false) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button id="btnSave" class="btn btn-primary" type="button">Agregar</button>
                                            <button id="btnCancel" type="button" onclick="javascript: location.href='contacts-supplier.php?sup=<?= encryptString(decryptString($_GET['sup'])) ?>';" class="btn btn-default">Cancelar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla de contactos del proveedor X-->
                <?php 
                    $query=$connection->prepare(sql_select_proveedor_byId());
                    $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);
                    $query->execute();
                    $proveedor = $query->fetch();
                    
                    if($_SESSION['idnivel']=="1"){

                      $query=$connection->prepare(sql_select_contactos_proveedores_bydIdproveedor());
                      $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);

                    } else if($_SESSION['idnivel']=="2"){

                        $query=$connection->prepare(sql_select_contactos_proveedores_bydIdproveedor_nivel());
                        $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);
                        //$query->bindParam(':idnivel', $_SESSION['idnivel']); //Debería ser nivel  2
                        $query->bindParam(':idusuario', $_SESSION['idusuario']);
                        //$query->bindParam(':idnivel2', 3); //Nivel 3 en los permisos de los perfiles

                    } else if($_SESSION['idnivel']=="3"){

                          $query=$connection->prepare(sql_select_contactos_proveedores_bydIdproveedor_usuario());
                          $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);
                          $query->bindParam(':idusuario', $_SESSION['idusuario']);
                          //$query->bindParam(':idnivel', $_SESSION['idnivel']);
                    }

                    $query->execute();

                ?>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table" >
                            <thead>
                                    <tr>
                                        <th>Cotacto</th>
                                        <th>Cargo</th>
                                        <th>Teléfono 1</th>
                                        <th>Correo 1</th>
                                    </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        
                                        $contactos_proveedores=$query->fetchAll();
                                        $num=1;
                                        foreach ($contactos_proveedores as $value) {
                                        ?>
                                            <tr class="odd gradeA">
                                                <td id="cp_<?= $num ?>" ><a href="mailto:<?= $value['email_1'] ?>" title="Click para enviar correo" ><?= $value['nombre_contacto'] ?></a></td>
                                                <td><?= $value['cargo'] ?></td>
                                                <td class="center"><?= $value['telefono_1'] ?></td>
                                                <td class="center"><a href="mailto:<?= $value['email_1'] ?>" title="Click para enviar correo" ><?= $value['email_1'] ?></a></td>
                                            </tr>
                                        <?php $num++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
	   </div> 
    </div>



    <!-- Notificaciones-->
    <div class="md-modal colored-header info md-effect-10" id="mod-alert">
        <div class="md-content ">
          <div class="modal-header">
            <h3><?= txt_contacto_proveedor_title_registrado() ?></h3>
            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div id="modal-body-center-edit" class="text-center">
                <div class="i-circle primary">
                    <i class="fa fa-check"></i>
                </div>
                <h4 id="hmodal" ></h4>
            </div>
          </div>
            <div class="modal-footer" id="modal-footer-response-add" >
                <button type="button" class="btn btn-primary btn-flat" data-dismiss="modal" id="btn-redirect" >Aceptar</button>
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
  <?= js_general() ?>
  <?= js_jquery_parsley() ?>
  <?= js_i18n_es() ?>
  <?= js_gritter() ?>
  <?= js_select2() ?>
  <?= js_niftymodals() ?>
    
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        $("#btnSave").click(function(event){
            if($( '#frm-add-contacto-proveedor' ).parsley().validate()){
                $.ajax({
                    url:"ajax/contact-supplier.php",
                    type:'POST',
                    dataType:"json",
                    data:$("#frm-add-contacto-proveedor").serialize()+"&sup=<?= encryptString(decryptString($_GET['sup'])) ?>&option=save",
                    beforeSend: function() {
                        $("#btnSave").prop("disabled",true);
                        $("#btnReset").prop("disabled",true);
                    }
                }).done(function(response){
                    if (response.status == "1") {
                        $("#mod-alert").addClass("md-show");
                        $("#hmodal").html(response.msg);
                    }
                    else {
                        $.gritter.add({
                            title: "<?= txt_contacto_proveedor_title_registrado_fail() ?>",
                            text: response.msg,
                            class_name: 'danger'
                          });
                    }
                });
            }
            return;
        });
        $("#cargo").select2();
        $('.select2-search > input.select2-input').on('keyup', function(e) {
           if(e.keyCode === 13) nuevoRegistro($( '.select2-dropdown-open' ).parents().attr('data-select'),$(this).val())
        });
        
      });
            $("#btn-redirect").click(function(){ location.href='contacts-supplier.php?sup=<?= encryptString(decryptString($_GET['sup'])) ?>';  });
    

        function nuevoRegistro(mant,valor){
            var pserv={"cargo":{ "url": "ajax/position-contact.php","option":"add","reg":"cargoAgregar"}}; 
                
            $.ajax({
                url:pserv[mant].url,
                type:'POST',
                dataType:"json",
                data:"option="+pserv[mant].option+"&"+pserv[mant].reg+"="+valor,
                beforeSend: function(){ },
                success:function(data){
                    if(data.status=="1"){ 
                        $("#"+mant).append('<option value="'+data.id+'">'+valor+'</option>');
                        $("#"+mant).select2("val", data.id).select2("close");
                    }else{

                    }
                    
                }
            });
        }
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>