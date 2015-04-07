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
        Helper::helpIsAllowed(2); // 2 - Agregar,editar,eliminar clientes
        
        $connection=  openConnection();
        if(empty($_GET['id']) && !is_numeric($_GET['id'])){
            header('location: list-clients.php');
            exit();
        }
        $idClient=$_GET['id'];
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
                                            <?= selectVendedor('input-vendedor','input-vendedor','form-control','required','',$clientArray['idusuario'],false) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Rubro</label>
                                        <div class="col-sm-6">
                                            <?= selectRubro('input-rubro','input-rubro','form-control','required','',$clientArray['idrubro']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Departamento <?= $clientArray['iddepartamento'] ?></label>
                                        <div class="col-sm-6">
                                            <?= selectDepartamento('input-departamento','input-departamento','form-control','required','loadMunicipios()',$clientArray['iddepartamento']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Municipio </label>
                                        <div class="col-sm-6">
                                            <?= selectMunicipio($clientArray['iddepartamento'],'input-municipio','input-municipio','form-control','required','',$clientArray['idmunicipio']) ?>
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
                                        <div class="col-sm-6">
                                            <!--<input name="input-cargo" class="form-control" type="text" value="<?= $clientArray['idcargo'] ?>" required>-->
                                            <select class="form-control" name="input-cargo" id="input-cargo" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_contactos_proveedores_cargo_all());
                                                $query->execute();
                                                $cargoArray=$query->fetchAll();
                                                foreach ($cargoArray as $value) {
                                                    $selected = ($clientArray['idcargo'] == $value['idcontactos_proveedores_cargos'])?'selected="selected"':'';
                                                ?>
                                                <option <?= $selected ?> value="<?= $value['idcontactos_proveedores_cargos'] ?>" ><?= $value['cargo'] ?></option>
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
                                            <button class="btn btn-primary" type="submit">Editar</button>
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
  <?= js_bootstrap_file_input() ?>
     
	

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
                    data: new FormData( this ),
                    processData: false,
                    contentType: false
                }).done(function(response) {
                    if(response.status==0){
                        alert(response.msg);
                    }
                    else{
                        alert('error');
                    }
                })
                .fail(function() {
                    
                });
           }
        });
        $('#img-client').bootstrapFileInput();
      });
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