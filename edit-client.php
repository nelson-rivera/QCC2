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
        $idClient=  decryptString($_GET['id']);
        $getClient=$connection->prepare(sql_select_cliente_extended_by_idcliente());
        $getClient->execute(array($idClient));
        if($getClient->rowCount()<1){
            header('location: list-clients.php');
            exit(); 
        }
        $clientArray=$getClient->fetch();
        $recibirCorreosIsChecked=(empty($clientArray['recibir_correos']))?'':'checked';
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Cliente</title>
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
                    
                    <?= lytSideMenu(2) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Clientes <i class="fa fa-angle-double-right"></i> Editar Cliente</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos de cliente</h3>
                            </div>
                            <div class="content">
                                <form id="frm-edit" class="form-horizontal" style="border-radius: 0px;" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre Empresa</label>
                                        <div class="col-sm-6">
                                            <input name="input-name-company" class="form-control" type="text" value="<?= $clientArray['nombre_cliente'] ?>" required>
                                            <input name="opt" type="hidden" value="2" />
                                            <input name="id1" type="hidden" value="<?= $clientArray['idcliente']?>" />
                                            <input name="id2" type="hidden" value="<?= $clientArray['idcontacto']?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <?= selectVendedor('input-vendedor','input-vendedor','input-select','required','',$clientArray['idusuario'], false) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Rubro</label>
                                        <div class="col-sm-6" data-select="rubro">
                                            <?= selectRubro('input-rubro','input-rubro','input-select','required','',$clientArray['idrubro']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Departamento <?= $clientArray['iddepartamento'] ?></label>
                                        <div class="col-sm-6">
                                            <?= selectDepartamento('input-departamento','input-departamento','input-select','required','loadMunicipios()',$clientArray['iddepartamento']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Municipio </label>
                                        <div class="col-sm-6">
                                            <?= selectMunicipio($clientArray['iddepartamento'],'input-municipio','input-municipio','input-select','required','',$clientArray['idmunicipio']) ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input name="input-contacto" class="form-control" type="text" value="<?= $clientArray['nombre_contacto'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6" data-select="cargo">
                                            <!--<input name="input-cargo" class="form-control" type="text" value="<?= $clientArray['idcargo'] ?>" required>-->
                                            <select class="input-select" name="input-cargo" id="input-cargo" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_contactos_cargo_all());
                                                $query->execute();
                                                $cargoArray=$query->fetchAll();
                                                foreach ($cargoArray as $value) {
                                                    $selected = ($clientArray['idcargo'] == $value['idcontacto_cargo'])?'selected="selected"':'';
                                                ?>
                                                <option <?= $selected ?> value="<?= $value['idcontacto_cargo'] ?>" ><?= $value['cargo'] ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-1" class="form-control" type="text" value="<?= $clientArray['telefono_1'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-2" class="form-control" value="<?= $clientArray['telefono_2'] ?>" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-3" class="form-control" value="<?= $clientArray['telefono_2'] ?>" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-correo-1" class="form-control" type="email" value="<?= $clientArray['email_1'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-correo-2" class="form-control" value="<?= $clientArray['email_2'] ?>" type="email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Imagen</label>
                                        <div class="col-sm-6 ">
                                            <input name="input-logo" id="img-client" type="file" title="Subir una imagen" >
                                            <?php if (!empty($clientArray['logo'])){ ?>
                                                <img src="<?= $clientArray['logo'] ?>" class="img-responsive"  />
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="input-newsletter" type="checkbox" <?= $recibirCorreosIsChecked ?>>
                                                    Enviar correos de mercadeo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" id="btn-submit" type="button">Guardar</button>
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
            <h3>Cliente editado exitosamente</h3>
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
  <?= js_jquery_parsley() ?>  
  <?= js_i18n_es() ?>  
  <?= js_general() ?>
  <?= js_bootstrap_file_input() ?>
  <?= js_select2() ?>
  <?= js_gritter() ?>
  <?= js_niftymodals() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        window.ParsleyValidator.setLocale('es');
        
        $("#btn-submit").click(function(event){
            if($( '#frm-edit' ).parsley().isValid()){
               
                $.ajax({
                    url:'ajax/client.php',
                    type: 'post',
                    dataType: 'json',
                    data: new FormData( $("#frm-edit").get(0) ),
                    processData: false,
                    contentType: false
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
        
        $("#btn-redirect").click(function(){
            location.href='list-clients.php';
        });
        $('#img-client').bootstrapFileInput();
        $("#input-vendedor").select2();
        $("#input-rubro").select2();
        $("#input-cargo").select2();
        $("#input-departamento").select2();
        $("#input-municipio").select2();
        
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
      function loadMunicipios(){
        if($("#input-departamento").val()!=''){
            var departamento=$("#input-departamento").val();
            var opt=1;
            $.ajax({
                url: "ajax/ajax-calls.php",
                data: ({'departamento':departamento,'opt':opt}),
                type: "POST",
                dataType: "json"

            })
            .done(function(response){
                if (response.status == "0") {
                    $("#input-municipio").html(response.select);
                }
                else {

                }
            });
        }
      }
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>