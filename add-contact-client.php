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
        Helper::helpIsAllowed(2); // 2 - Agregar,editar,eliminar clientes
        $connection=  openConnection();
        if(empty($_GET['id'])){
            header('location: list-clients.php');
            exit();
        }
        $idCliente=  decryptString($_GET['id']);
        $getCliente=$connection->prepare(sql_select_cliente_extended_by_idcliente());
        $getCliente->execute(array($idCliente));
        if($getCliente->rowCount()<1){
            header('location: list-clients.php');
            exit(); 
        }
        $clienteArray=$getCliente->fetch();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Agregar Contacto de Cliente</title>
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
        <?= css_select2() ?>
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
                <h2>Clientes <i class="fa fa-angle-double-right"></i> Agregar contacto de <a href="edit-client.php?id=<?= $_GET['id'] ?>"><?= $clienteArray['nombre_cliente'] ?></a></h2>
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="content">
                                <form id="frm-add-contact" class="form-horizontal" style="border-radius: 0px;" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <input disabled="true" id="input-name-vendedor" name="input-name-vendedor" class="form-control" value="<?= $_SESSION['nombre'] ?>" />
                                            <input type="hidden" name="input-id" value="<?= $idCliente ?>" />
                                            <input type="hidden" name="opt" value="5" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input id="input-nombre-contacto" name="input-nombre-contacto" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6" data-select="cargo">
                                            <!--<input id="input-cargo" name="input-cargo" class="form-control" type="text" required>-->
                                            <select class="input-select" name="input-cargo" id="input-cargo" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_contactos_cargo_all());
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
                                            <input id="input-telefono-1" name="input-telefono-1" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input id="input-telefono-2" name="input-telefono-2" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input id="input-telefono-3" name="input-telefono-3" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input id="input-email-1" name="input-email-1" class="form-control" type="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input id="input-email-2" name="input-email-2" class="form-control" type="email">
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Agregar</button>
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
            <h3>Contacto agregado exitosamente</h3>
            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div id="modal-body-center-edit" class="text-center">
                <div class="i-circle primary">
                    <i class="fa fa-check"></i>
                </div>
                <h4>¡Registro agregado con éxito!</h4>
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
  <?= js_gritter() ?>
  <?= js_niftymodals() ?>
  <?= js_general() ?>
  <?= js_select2() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        $("#input-cargo").select2();
        $("#frm-add-contact").submit(function(event){
            event.preventDefault();
            if($( '#frm-add-contact' ).parsley().isValid()){
               
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
        $('.select2-search > input.select2-input').on('keyup', function(e) {
           if(e.keyCode === 13) nuevoRegistro($( '.select2-dropdown-open' ).parents().attr('data-select'),$(this).val())
        });
      });
      
      function nuevoRegistro(mant,valor){
        var pserv={
            "rubro":{ "url": "ajax/clients-category.php","option":"add","reg":"rubroAgregar"},
            "cargo":{ "url": "ajax/position-contact-client.php","option":"add","reg":"cargoAgregar"}, 
            }; 

        $.ajax({
            url:pserv[mant].url,
            type:'POST',
            dataType:"json",
            data:"option="+pserv[mant].option+"&"+pserv[mant].reg+"="+valor,
            beforeSend: function(){ },
            success:function(data){
                if(data.status=="1"){ 
                    $("#input-"+mant).append('<option value="'+data.id+'">'+valor+'</option>');
                    $("#input-"+mant).select2("val", data.id).select2("close");
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