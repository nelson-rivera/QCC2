<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        session_start();
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
        Helper::helpIsAllowed(2); // 2 - Agregar,editar,eliminar clientes
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Agregar Cliente</title>
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
                <h2>Agregar Cliente</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos de cliente</h3>
                            </div>
                            <div class="content">
                                <form id="frm-add-client" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre Empresa</label>
                                        <div class="col-sm-6">
                                            <input name="input-name-company" class="form-control" type="text" required>
                                            <input type="hidden" value="1" name="opt" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <?= selectVendedor('input-vendedor','input-vendedor','form-control','required','','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Rubro</label>
                                        <div class="col-sm-6">
                                            <?= selectRubro('input-rubro','input-rubro','form-control','required','','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Departamento</label>
                                        <div class="col-sm-6">
                                            <?= selectDepartamento('input-departamento','input-departamento','form-control','required','loadMunicipios()','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Municipio</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="input-municipio" id="input-municipio" required>
                                                <option value="">Selecciones un municipio...</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contacto</label>
                                        <div class="col-sm-6">
                                            <input name="input-contacto" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6">
                                            <input name="input-cargo" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-1" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-2" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 3</label>
                                        <div class="col-sm-6">
                                            <input name="input-telefono-3" class="form-control" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input name="input-correo-1" class="form-control" type="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input name="input-correo-2" class="form-control" type="email">
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-sm-3 control-label">Imagen</label>
                                        <div class="col-sm-6 ">
                                            <input name="input-logo" id="img-client" type="file" title="Subir una imagen" required><i></i>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label  >
                                                    <input name="input-newsletter" type="checkbox" value="1">
                                                    Enviar correos de mercadeo
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
  <?= js_jquery_parsley() ?>
  <?= js_i18n_es() ?>
  <?= js_general() ?>
  <?= js_bootstrap_file_input() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        window.ParsleyValidator.setLocale('es');
        
        $("#frm-add-client").submit(function(event){
            event.preventDefault();
            if($( '#frm-add-client' ).parsley().isValid()){
                var clientData = $('#frm-add-client').serializeArray();
                clientData.push({name: 'opt', value: 1});
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

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>