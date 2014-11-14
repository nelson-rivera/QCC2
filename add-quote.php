<!DOCTYPE html>
<html lang="en">

<head>
        <?php
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
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
                        <a href="#">Usuario 1</a>
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
                <h2>Agregar Cotizacón</h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos generales</h3>
                            </div>
                            <div class="content">
                                <form id="frm-quote-info" class="form-horizontal" style="border-radius: 0px;" action="#">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Vendedor</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" required value="Nelson Rivera" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cliente</label>
                                        <div class="col-sm-6">
                                            <select class="form-control" required>
                                                <option>ACAVISA</option>
                                                <option>Claro</option>
                                                <option>UCA</option>
                                                <option>Tigo</option>
                                                <option>Digicel</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre contacto</label>
                                        <div class="col-sm-6">
                                            <select id="input-contact" class="form-control" required>
                                                <option value="1">José Perez</option>
                                                <option value="2">Ernesto Monterrosa</option>
                                                <option value="3">Ivana Chavarria</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono Contacto</label>
                                        <div class="col-sm-6">
                                            <input id="input-phone" class="form-control" type="text" value="2249-2034" required readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo Contacto</label>
                                        <div class="col-sm-6">
                                            <input id="input-email" class="form-control" type="email" value="jperez@email.com" required readonly="readonly">
                                        </div>
                                    </div>
                                </form>
                                <div class="header">
                                    <h3>ITEMS</h3>
                                </div>
                                <form id="frm-add-item" class="form-horizontal" style="border-radius: 0px;" action="#">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cantidad</label>
                                        <div class="col-sm-6">
                                            <input id="input-amount" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Descripción</label>
                                        <div class="col-sm-6">
                                            <input id="input-description" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Imagen</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="file">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Precio Unitario</label>
                                        <div class="col-sm-6">
                                            <input id="input-unit-price" class="form-control" type="text" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button class="btn btn-primary" type="submit">Agregar</button>
                                            <button class="btn btn-info" type="reset">Limpiar</button>
                                        </div>
                                    </div>
                                </form>
                                <form id="frm-quote-items">
                                    <table id="table-items" data-nitems="0">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Item
                                                </th>
                                                <th>
                                                    Cantidad
                                                </th>
                                                <th>
                                                    Descripción
                                                </th>
                                                <th>
                                                    Precio Unitario
                                                </th>
                                                <th>
                                                    Precio Total
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>Sumas</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>13% IVA</td>
                                                <td>$0.00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td>TOTAL</td>
                                                <td>$0.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
        
        $("#frm-add-item").parsley().subscribe('parsley:form:validate', function (formInstance) {
            formInstance.submitEvent.preventDefault();
            if(formInstance.isValid('', true)){
                var amount=$("#input-amount").val();
                var description=$("#input-description").val();
                var unitPrice=$("#input-unit-price").val();
                var totalPrice=amount*unitPrice;
                var nItems=$("#table-items").attr('data-nitems');
                nItems++;
                var tr='<tr>';
                tr+='<td>'+nItems+'</td><td>'+amount+'</td><td>'+description+'<td>$'+unitPrice+'</td><td>$'+totalPrice+'</td></tr>';
                $("#table-items tbody").append(tr);
            }
            return;
        });
        $("#input-contact").change(function(){
           if($(this).val()==1){
               $("#input-phone").val('2249-2034');
               $("#input-email").val('jperez@email.com');
           }
           else if($(this).val()==2){
                $("#input-phone").val('2249-2023');
                $("#input-email").val('emonterrosa@email.com');
           }
           else if($(this).val()==3){
               $("#input-phone").val('2249-2010');
               $("#input-email").val('ichavarria@email.com');
           }
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