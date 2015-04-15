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

        $connection=  openConnection();
        if(empty($_GET['id'])){
            header('location: list-quotes.php');
            exit();
        }
        $idCotizacion=  decryptString($_GET['id']);
        $getCotizacion=$connection->prepare(sql_select_cotizacion_by_idcotizacion());
        $getCotizacion->execute(array($idCotizacion));
        $cotizacionArray=$getCotizacion->fetch();

        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Cotización</title>
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
                    
                    <?= lytSideMenu(7) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Cotizaciones <i class="fa fa-angle-double-right"></i> Editar Cotización <?= $cotizacionArray['codigo_cotizacion'] ?></h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos generales</h3>
                            </div>
                            <div class="content">
                                <form id="frm-quote-info" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"># Cotización</label>
                                        <div class="col-sm-6">
                                            <input name="input-codigo" class="form-control" type="text" required value="<?= $cotizacionArray['codigo_cotizacion'] ?>" readonly="readonly">
                                            <input type="hidden" value="<?= $idCotizacion ?>" name="input-cotizacion" />
                                            <input type="hidden" value="2" name="opt" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" required value="<?= $cotizacionArray['nombre_vendedor'] ?>" readonly="readonly">
                                            <input name="input-vendedor" type="hidden" value="<?= $cotizacionArray['idvendedor'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cliente</label>
                                        <div class="col-sm-6">
                                            <?= selectClientes('input-cliente','input-cliente','form-control','required','updateClienteInfo()',$cotizacionArray['idcliente']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Departamento</label>
                                        <div class="col-sm-6">
                                            <?= selectDepartamento('input-departamento','input-departamento','form-control','required','loadMunicipios()',$cotizacionArray['iddepartamento']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Municipio</label>
                                        <div class="col-sm-6">
                                           <?= selectMunicipio($cotizacionArray['iddepartamento'],'input-municipio','input-municipio','form-control','required','',$cotizacionArray['idmunicipio']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre contacto</label>
                                        <div class="col-sm-6">
                                            <?= selectContactos($cotizacionArray['idcliente'],'input-contacto','input-contacto','form-control','required','updateContactoInfo()',$cotizacionArray['idcontacto']) ?>
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
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Fase</label>
                                        <div class="col-sm-6">
                                            <?= selectFaseCotizacion('input-estado-cotizacion','input-estado-cotizacion','form-control','required','',$cotizacionArray['idestado_cotizacion']) ?>
                                        </div>
                                    </div>
                                <div class="header">
                                    <h3>Items</h3>
                                </div>
                                
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?= selectIva('input-iva','input-iva','form-control','required','',$cotizacionArray['iva']) ?>
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
                                            <?php
                                            $getItemsCotizacion=$connection->prepare(sql_select_cotizacion_items());
                                            $getItemsCotizacion->execute(array($idCotizacion));
                                            $contadorItem=1;
                                            foreach ($getItemsCotizacion->fetchAll() as $itemCotizacion) {
                                            ?>
                                                <tr class="item">
                                                    <td class="text-center">
                                                        <button class="btn btn-danger btn-xs btn-delete-item" type="button"><i class="fa fa-times"></i></button>
                                                    </td>
                                                    
                                                    <td>
                                                        <input name="input-cantidad[]" class="input-cantidad form-control" value="<?= $itemCotizacion['cantidad'] ?>" type="text" required=""/>
                                                    </td>
                                                    <td>
                                                        <?= selectRubro('', 'input-rubro[]', 'form-control input-rubro', 'required', '', $itemCotizacion['idrubro']) ?>
                                                    </td>
                                                    <td>
                                                        <textarea name="input-descripcion[]" class="input-description form-control"required><?= $itemCotizacion['descripcion'] ?></textarea>
                                                        <input class="file" id="file<?= $contadorItem ?>" name="input-image[]" type='file'/>
                                                        <div id="prev_file<?= $contadorItem ?>"></div><br/>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span><input name="input-precio-unitario[]" class="input-precio-unitario form-control" value="<?= $itemCotizacion['precio_unitario'] ?>" type="text" required/>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <span class="input-group-addon">$</span><input name="input-total[]" class="input-total form-control" type="text" required readonly="readonly"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php
                                            $contadorItem++;
                                            }
                                            $contadorItem--;
                                            ?>
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
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Valides de la oferta</label>
                                        <div class="col-sm-3">
                                            <?= selectValidez('input-validez','input-validez','form-control','required','',$cotizacionArray['idvalidez_cotizacion']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Forma de pago</label>
                                        <div class="col-sm-3">
                                            <?= selectFormasPago('input-forma-pago','input-forma-pago','form-control','required','',$cotizacionArray['idforma_pago']) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Garantía</label>
                                        <div class="col-sm-3">
                                            <?= selectGarantias('input-garantia','input-garantia','form-control','required','',$cotizacionArray['idgarantia']) ?>
                                        </div>
                                    </div>
                                    <?php
                                    $queryCondicionesCustom=$connection->prepare(sql_select_condiciones_by_idcotizacion());
                                    $queryCondicionesCustom->execute(array($idCotizacion));
                                    
                                    foreach ($queryCondicionesCustom->fetchAll() as $condicion) {
                                    ?>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <input name="input-condicion-custom[]" class="input-condicion form-control" value="<?= $condicion['condicion'] ?>" type="text" required="" placeholder="condición" name="input-condicion-custom[]">
                                            </div>
                                            <div class="col-sm-3">
                                                <input name="input-condicion-custom-valor[]" class="form-control" type="text" value="<?= $condicion['valor_condicion'] ?>" required="" placeholder="valor de condición" name="input-condicion-custom-valor[]">
                                            </div>
                                            <div class="col-sm-1 container-btn-delete-condicion">
                                                <button class="btn btn-danger btn-xs btn-delete-condicion" type="button">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <div class="form-group" id="container-btn-add">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <button id="btn-add-condicion" type="button" class="btn btn-info btn-block">Agregar Condición</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <button type="button" id="btn-editar-cotizacion" class="btn btn-lg btn-block btn-primary">Guardar cotización</button>
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
            <h3>Cotización editada exitosamente</h3>
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
  <?= js_preimage() ?>
  <?= js_i18n_es() ?>
  <?= js_gritter() ?>
  <?= js_niftymodals() ?>
  <?= js_general() ?>
  <?= js_ckeditor() ?>
  <?= js_ckeditor_adapter() ?>
	

    <script type="text/javascript">
        $(function(){
            //initialize the javascript
            App.init();
            window.ParsleyValidator.setLocale('es');
            $('.input-description').ckeditor();
            <?php 
             for($i=1; $i<=$contadorItem; $i++){
            ?>
                    $('#file<?= $i ?>').preimage();
            <?php
             }
            ?>
            $("#input-contacto").change();
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
            var itemCounter = <?= $contadorItem ?>;
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
                        +'<input class="file" id="file'+itemCounter+'" name="input-image[]" type="file"/>'
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
            $(".input-cantidad").each(function(){
               $(this).trigger('change'); 
            });
            $("#btn-editar-cotizacion").click(function(event){
                event.preventDefault();
                if($( '#frm-quote-info' ).parsley().validate()){
                    CKupdate();
                    var cotizacionData = $('form').serialize()+'&opt=2';
                    $.ajax({
                        url:'ajax/cotizacion.php',
                        type: 'post',
                        dataType: 'json',
                        data: new FormData( $("#frm-quote-info").get(0) ),
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
                        $.gritter.add({
                            title: "Error",
                            text: 'Error de red, intentelo más tarde',
                            class_name: 'danger'
                          });
                    });
                }
            });
            $("#btn-redirect").click(function(){
                window.location.href='list-quotes.php';
            });
            totalize();
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

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>