<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        session_start();
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

	<title>QCC - Agregar Cotización</title>
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
                    <?= lytSideMenu(8) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Agregar Cotización</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <form id="frm-quote" name="frm-quote" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate>
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos generales</h3>
                                <input type="hidden" name="opt" value="1" />
                            </div>
                            <div class="content">
                                
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <input type="hidden" name="input-vendedor" id="input-vendedor" class="form-control" required value="<?= $_SESSION['idusuario'] ?>" />
                                            <input type="text" name="input-nombre-vendedor" id="input-nombre-vendedor" disabled="true" class="form-control" required value="<?= $_SESSION['nombre'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cliente</label>
                                        <div class="col-sm-6">
                                            <?= selectClientes('input-cliente','input-cliente','form-control','required','updateClienteInfo()','') ?>
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
                                        <label class="col-sm-3 control-label">Nombre contacto</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" name="input-contacto" id="input-contacto" onchange="updateContactoInfo()" required>
                                                <option value="">Selecciones un contacto...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono Contacto</label>
                                        <div class="col-sm-6">
                                            <input id="input-phone" class="form-control" type="text" required readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo Contacto</label>
                                        <div class="col-sm-6">
                                            <input id="input-email" class="form-control" type="email" required readonly="readonly">
                                        </div>
                                    </div>
                                <div class="header">
                                    <h3>Items</h3>
                                </div>
                                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?= selectIva('input-iva','input-iva','form-control','required','','') ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <table id="table-items" class="no-strip" data-nitems="1">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10%">
                                                    Eliminar
                                                </th>
                                                <th class="text-center" style="width: 10%">
                                                    Cantidad
                                                </th>
                                                <th class="text-center" style="width: 10%">
                                                    Rubro
                                                </th>
                                                <th class="text-center" style="width: 30%">
                                                    Descripción
                                                </th>
                                                <th class="text-center" style="width: 15%">
                                                    Precio Unitario
                                                </th>
                                                <th class="text-center" style="width: 15%">
                                                    Precio Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="item">
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-xs btn-delete-item" type="button"><i class="fa fa-times"></i></button>
                                                </td>
                                                <td>
                                                    <input name="input-cantidad[]" class="input-cantidad form-control" type="text" required=""/>
                                                </td>
                                                <td>
                                                    <?= selectRubro('','input-rubro[]','form-control input-rubro','required','','') ?>
                                                </td>
                                                <td>
                                                    <textarea id="input-descripcion-1" name="input-descripcion[]" class="input-descripcion form-control"required></textarea>
                                                    <input class="file" id="file1" name="input-image[]" type='file' required/>
                                                    <div id="prev_file1"></div><br/>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input name="input-precio-unitario[]" class="input-precio-unitario form-control" type="text" required/>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">$</span><input name="input-total[]" class="input-total form-control" type="text" required readonly="readonly"/>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr id="row-add-item">
                                                <td colspan="6">
                                                    <button type="button" id="btn-add-item" class="btn btn-primary btn-block">Agregar item</button>
                                                </td>
                                            </tr>
                                            <tr class="text-center">
                                                <td colspan="4"></td>
                                                <td class="primary-emphasis-dark">Sumas</td>
                                                <td id="td-sub-total">$0.00</td>
                                            </tr>
                                            <tr id="tr-iva" class="text-center">
                                                <td colspan="4"></td>
                                                <td class="primary-emphasis-dark">13% IVA</td>
                                                <td id="td-iva">$0.00</td>
                                            </tr>
                                            <tr class="text-center">
                                                <td colspan="4"></td>
                                                <td class="primary-emphasis-dark">TOTAL</td>
                                                <td id="td-total">$0.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                
                                <div class="header">
                                    <h3>Condiciones</h3>
                                </div>
                                    <div class="form-group" id="div_condicion1" style="display: none;" >
                                        Precios no incluyen Iva
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Valides de la oferta</label>
                                        <div class="col-sm-3">
                                            <?= selectValidez('input-validez','input-validez','form-control','required','','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Forma de pago</label>
                                        <div class="col-sm-3">
                                            <?= selectFormasPago('input-forma-pago','input-forma-pago','form-control','required','','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Garantía</label>
                                        <div class="col-sm-3">
                                            <?= selectGarantias('input-garantia','input-garantia','form-control','required','','') ?>
                                        </div>
                                    </div>
                                    <div class="form-group" id="container-btn-add">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button id="btn-add-condicion" type="button" class="btn btn-info btn-block">Agregar Condición</button>
                                            </div>
                                        </div>
                                    </div>
                                
                                <hr />
                                <button type="submit" id="btn-crear-cotizacion" class="btn btn-lg btn-block btn-primary">Crear cotización</button>
                            </div>
                        </div>
                    </div>
                    </form>
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
  <?= js_preimage() ?>
  <?= js_i18n_es() ?>
  <?= js_general() ?>
  <?= js_ckeditor() ?>
  <?= js_ckeditor_adapter() ?>
     
	

    <script type="text/javascript">
        $(document).ready(function(){
            //initialize the javascript
            App.init();
            window.ParsleyValidator.setLocale('es');
            $("#input-descripcion-1").ckeditor();
            $('#file1').preimage();
            $("#input-iva").change(function(){
                var ivaflag=parseInt($(this).val(),10);
                if(ivaflag===1){
                    $("#tr-iva").show();
                    $("#div_condicion1").hide();
                }
                else{
                    $("#tr-iva").hide();
                    $("#div_condicion1").show();
                }
                totalize();
            });
            $("#table-items").on('click', '.btn-delete-item',function(){
                $(this).closest('tr.item').remove();
                totalize();
            });
            $("#table-items").on('change','.input-cantidad', function(){
                var cantidad=$(this).val();
                var unitPrice=$(this).closest('tr.item').find('.input-precio-unitario').val();
                var totalPrice=cantidad*unitPrice;
                $(this).closest('tr.item').find('.input-total').val(totalPrice.formatMoney(2));
                totalize();
            });
            $("#table-items").on('change','.input-precio-unitario',function(){
                var unitPrice=$(this).val();
                var cantidad=$(this).closest('tr.item').find('.input-cantidad').val();
                var totalPrice=cantidad*unitPrice;
                $(this).closest('tr.item').find('.input-total').val(totalPrice.formatMoney(2));
                totalize();
            });
            var itemCounter = 1;
            $("#btn-add-item").click(function(){
                itemCounter++;
                var nItems=$("#table-items").attr('data-nitems');
                nItems++;
                $("#table-items").attr('data-nitems',nItems);
                var selectRubro='<?= selectRubro('','input-rubro[]','form-control input-rubro','required','','') ?>';
                $("#row-add-item").before('<tr class="item">'
                            +'<td class="text-center">'
                                +'<button class="btn btn-danger btn-xs btn-delete-item" type="button"><i class="fa fa-times"></i></button>'
                            +'</td>'
                            +'<td>'
                                +'<input name="input-cantidad[]" class="input-cantidad form-control" type="text" required=""/>'
                            +'</td>'
                            +'<td>'
                                +selectRubro
                            +'</td>'
                            +'<td>'
                                +'<textarea id="input-descripcion-'+itemCounter+'" name="input-descripcion[]" class="input-descripcion form-control" required></textarea>'
                                +'<input class="file" id="file'+itemCounter+'" name="input-image[]" type="file" required/>'
                                +'<div id="prev_file'+itemCounter+'"></div><br/>'
                            +'</td>'
                            +'<td>'
                                +'<div class="input-group">'
                                    +'<span class="input-group-addon">$</span><input name="input-precio-unitario[]" class="input-precio-unitario form-control" type="text" required/>'
                                +'</div>'
                            +'</td>'
                            +'<td>'
                                +'<div class="input-group">'
                                    +'<span class="input-group-addon">$</span><input name="input-total[]" class="input-total form-control" type="text" required readonly="readonly"/>'
                                +'</div>'
                            +'</td>'
                        +'</tr>');
                $("#input-descripcion-"+itemCounter).ckeditor();
                $('#file'+itemCounter).preimage();
            });
            $("#btn-add-condicion").click(function(){
                $("#container-btn-add").before('<div class="form-group">'
                    +'<div class="col-sm-2">'
                        +'<input name="input-condicion-custom[]" type="text" class="input-condicion form-control" placeholder="condición" required/>'
                    +'</div>'
                    +'<div class="col-sm-3">'
                        +'<input name="input-condicion-custom-valor[]" type="text" class="form-control" placeholder="valor de condición" required/>'
                    +'</div>'
                    +'<div class="col-sm-1 container-btn-delete-condicion">'
                        +'<button class="btn btn-danger btn-xs btn-delete-condicion" type="button"><i class="fa fa-times"></i></button> '
                    +'</div>');
            });
            $("#frm-condiciones").on('click','.btn-delete-condicion',function(){
               $(this).parents('.form-group').remove(); 
            });
            
            $("#frm-quote").submit(function(e){
                e.preventDefault();
                
                if($( '#frm-quote' ).parsley().validate()){
                    CKupdate();
//                    var cotizacionData = $('form').serialize()+'&opt=1';
                    $.ajax({
                        url:'ajax/cotizacion.php',
                        type: 'post',
                        dataType: 'json',
                        data: new FormData( this ),
                        processData: false,
                        contentType: false
                    }).done(function(response) {
                        if(response.status==0){
                            alert(response.msg);
                            window.location.href='list-quotes.php';
                        }
                        else{
                            alert('error');
                        }
                    })
                    .fail(function() {

                    });
                }
            });
        });
        function totalize(){
            var subTotal=0;
            var iva=0;
            var total=0;
            var ivaFlag=parseInt($("#input-iva").val(),10);
            $(".input-total").each(function(){
               subTotal+=parseFloat($(this).val().replace(/,/g,''),10); 
            });
            $("#td-sub-total").html('$'+subTotal.formatMoney(2));
            
            if(ivaFlag===1){
                iva=subTotal*0.13;
            }
            $("#td-iva").html('$'+iva.formatMoney(2));
            total=parseFloat(subTotal+iva,10);
            $("#td-total").html('$'+total.formatMoney(2));
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
        function updateClienteInfo(){
            if($("#input-cliente").val()!=''){
                var cliente=$("#input-cliente").val();
                var opt=2;
                $.ajax({
                    url: "ajax/ajax-calls.php",
                    data: ({'cliente':cliente,'opt':opt}),
                    type: "POST",
                    dataType: "json"

                })
                .done(function(response){
                    if (response.status == "0") {
                        $("#input-departamento").val(response.iddepartamento);
                        $("#input-municipio").html(response.selectMunicipio);
                        $("#input-contacto").html(response.selectContacto);
                    }
                    else {

                    }
                });
            }
        }
        function updateContactoInfo(){
            if($("#input-contacto").val()!=''){
                var contacto=$("#input-contacto").val();
                var opt=3;
                $.ajax({
                    url: "ajax/ajax-calls.php",
                    data: ({'contacto':contacto,'opt':opt}),
                    type: "POST",
                    dataType: "json"

                })
                .done(function(response){
                    if (response.status == "0") {
                        $("#input-phone").val(response.telefono);
                        $("#input-email").val(response.email);
                    }
                    else {

                    }
                });
            }
        }
        Number.prototype.formatMoney = function(c, d, t){
            var n = this, 
            c = isNaN(c = Math.abs(c)) ? 2 : c, 
            d = d == undefined ? "." : d, 
            t = t == undefined ? "," : t, 
            s = n < 0 ? "-" : "", 
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
            j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        };
        function CKupdate(){
            for ( instance in CKEDITOR.instances )
                CKEDITOR.instances[instance].updateElement();
        }
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>