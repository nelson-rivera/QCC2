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
        include_once './includes/functions.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
        Helper::helpIsAllowed(1); // 1 - Listado de clientes
        $connection=openConnection();
        
        if(!empty($_GET['us'])){
            $idVendedor = decryptString($_GET['us']);
            if(!is_numeric($idVendedor)){
                $idVendedor = 0;
            }
        }
        else{
            $idVendedor = 0;
        }
        $queryTotalCLientes = $connection->prepare(sql_select_total_clientes());
        $queryTotalCLientes->execute();
        $totalArray = $queryTotalCLientes->fetch();
        $totalClientes = $totalArray['total_clientes'];
        
        $selectClientes=$connection->prepare(sql_select_clientes_extended_by_idvendedor());
        $selectClientes->execute(array($_SESSION['idusuario']));
        $clientesVendedor = $selectClientes->rowCount();
        $porc = ($clientesVendedor/$totalClientes)*100;
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Listado de Clientes</title>
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
	<?= css_datatable() ?>
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
                <h2 class="" >Clientes <i class="fa fa-angle-double-right"></i> Listado de Clientes</h2>
                
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="row">
                                <div class="col-sm-9 pull-left" >
                                    <button id="btn-excel" type="button" class="btn btn-success">Generar Excel</button> 
                                    <a href="view-client-gallery.php" class="btn btn-primary">Ver logos</a>                                
                                    <div class="lbl_sistecorp_clients">
                                        <strong><span id="cantidad-clientes"><?= $clientesVendedor ?></span> de <span id="cantidad-clientes-tot"><?= $totalClientes ?></span> Clientes (<span id="cantidad-clientes-porc"><?= $porc ?></span>%) </strong>
                                     </div>
                                </div>
                                <div class="col-sm-3 pull-right" >
                                    <form  action="#" class="form-horizontal">
                                        <div>
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-9 no-padding">
                                                <?= selectVendedor('input-vendedor','input-vendedor','form-control','','',$_SESSION['idusuario'],true) ?>
                                            </div>
                                        </div>
                                      </form>
                                </div>
                            </div>
                                
                            
                                <table class="table table-bordered" id="datatable-icons" >
                                    <thead>
                                            <tr>
                                                <th><input type="checkbox" id="master-checkbox"/></th>
                                                <th>Nombre</th>
                                                <th>Rubro</th>
                                                <th>Vendedor</th>
                                                <th>Departamento</th>
                                                <th>Municipio</th>
                                                <th>Acciones</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($selectClientes->fetchAll() as $cliente) {
                                        ?>
                                            <tr class="odd gradeA">
                                                <td class="text-center send-email-container"><input type="checkbox" class="send_email_cb" data-id="<?= $cliente['idcliente'] ?>" id="send_email_<?= encryptString($cliente['idcliente'])?>" name="send_email_<?= encryptString($cliente['idcliente'])?>"/></td>
                                                <td><?= utf8_decode($cliente['nombre_cliente']) ?></td>
                                                <td><?= utf8_encode($cliente['rubro']) ?></td>
                                                <td><?= utf8_encode($cliente['nombre_vendedor']) ?></td>
                                                <td><?= utf8_encode($cliente['departamento']) ?></td>
                                                <td class="center"><?= utf8_encode($cliente['municipio']) ?></td>
                                                <td class="center">
                                                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Contacto" href="contacts-client.php?id=<?= encryptString($cliente['idcliente']) ?>">
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Editar" href="edit-client.php?id=<?= encryptString($cliente['idcliente']) ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Eliminar" href="#">
                                                        <input class="input-cliente" type="hidden" value="<?= $cliente['idcliente']?>" />
                                                        <i class="fa fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <button type="button" class="btn btn-primary" id="btn-send-emails"><i class="fa fa-envelope"></i> Enviar correo de mercadeo</button>
                           
                        </div>
                    </div>
                </div>
                
            </div>
	</div> 
    </div>
    
    <!-- Modal -->
    <div class="md-modal md-effect-10" id="modal-delete">
        <div class="md-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Eliminar Cliente</h4>
          </div>
          <div class="modal-body">
              Está seguro que desea eliminar el cliente <span id="client-name"></span>, esta acción es definitiva y 
              todos los datos relacionados a este cliente se perderán.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button id="btn-eliminar" type="button" class="btn btn-danger">Sí, eliminar</button>
          </div>
        </div>
    </div>
    <div class="md-overlay"></div>
    
    <div class="md-modal colored-header info md-effect-10" id="mod-alert">
        <div class="md-content">
          <div class="modal-header">
            <h3>Enviar Correo de Mercadeo</h3>
            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div id="modal-body-center-edit" class="text-center">
                Por favor seleccione a los destinatarios:
                <table id="table-destinatarios">
                    <thead>
                        <th></th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Empresa</th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
          </div>
            <div class="modal-footer" id="modal-footer-response-add" >
                <a class="btn btn-primary btn-flat" data-dismiss="modal" id="btn-confirm-send" >Enviar</a>
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
  <?= js_jquery_datatable() ?>
  <?= js_jquery_datatable_adapter() ?>
  <?= js_niftymodals() ?>
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        
        var idVendedor = parseInt(<?= $idVendedor ?>);
        App.init();
        var oTable=$('#datatable-icons').dataTable({  
             aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "Todos"]
                ],
                aoColumnDefs: [
                    { 'bSortable': false, 'aTargets': [ 0 ] }
                 ],
                iDisplayLength: -1
        });
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
        
        
        var selectedRow;
        var idC;
        $('#datatable-icons tbody').on( 'click', '.btn-danger', function () {
            $('#modal-delete').addClass("md-show");;
            selectedRow = $(this).closest("tr").get(0);
            idC = $(this).children(".input-cliente").val();
            
        });
        $("#btn-excel").click(function(){
           var idVendedor = $("#input-vendedor").val();
            window.location.href = 'generar-excel-clientes.php?id='+idVendedor;
        });
        $("#btn-eliminar").click(function(){
            $.ajax({
                url:'ajax/client.php',
                type: 'post',
                dataType: 'json',
                data: {opt:3, id: idC}
            }).done(function(response) {
                if(response.status==0){
                    oTable.fnDeleteRow(oTable.fnGetPosition(selectedRow));
                    $('#modal-delete').modal('hide');
                }
                else{
                    alert('error');
                }
            })
            .fail(function() {

            });  
        });
        
        $("#input-vendedor").change(function(){
            var id = $(this).val();
            var porc = 0.00;
            $("#nombre-vendedor").html($("#input-vendedor option:selected").text());
            $.ajax({
                url:"ajax/client.php",
                type:'POST',
                dataType:"json",
                data: {'opt':6, 'id':id},
            }).done(function(response){
                if (response.status == "0") {
                    oTable.fnClearTable();
                    if(response.data){
                        $("#btn-excel").attr('disabled',false);
                        oTable.fnAddData(response.data);
                        oTable.fnAdjustColumnSizing();

                        $("#cantidad-clientes").html(oTable.fnSettings().fnRecordsTotal());
                        porc = parseFloat( (oTable.fnSettings().fnRecordsTotal() /$("#cantidad-clientes-tot").html()) * 100).toFixed(2);

                        $("#cantidad-clientes-porc").html( porc );
                    }
                    else{
                        $("#cantidad-clientes").html('0');
                        $("#cantidad-clientes-porc").html( porc );
                        $("#btn-excel").attr('disabled',true);
                    }
                }
                else{
                    $("#cantidad-clientes").html('0');
                    oTable.fnClearTable();
                }
            }); 
            
        });
        if(idVendedor > 0){
            $("#input-vendedor").val(idVendedor).change();
        }
        $("#master-checkbox").change(function(){
           if($(this).is(':checked')){
               $(".send-email-container").each(function(){
                   $(this).children('input[type=checkbox]').prop('checked',true);
               });
           } 
           else{
               $(".send-email-container").each(function(){
                   $(this).children('input[type=checkbox]').prop('checked', false);
               });
           }
        });
        $("#btn-send-emails").click(function(){
            var idArray = [];
            $(".send_email_cb").each(function(){
                if($(this).is(':checked')){
                    idArray.push($(this).data('id'));
                }
            });
            if(idArray.length<1){
                alert('Por favor seleccione al menos un cliente');
            }
            else{
                var ids = idArray.join();
                $.ajax({
                    url:"ajax/client.php",
                    type:'POST',
                    dataType:"json",
                    data: {'opt':8, 'ids':ids},
                }).done(function(response){
                    $("#table-destinatarios tbody").html('');
                    if (response.status == "0") {
                        var jsonObj = $.parseJSON(response.data)
                        $.each(jsonObj,function(index,contacto){
                            $("#table-destinatarios tbody").append('<tr><td><input type="checkbox" checked="true" /></td><td>'+contacto.nombre_contacto+'</td><td class="contacto-email">'+contacto.email_1+'</td><td>'+contacto.nombre_cliente+'</td></tr>');
                            var existingMails = $("#btn-confirm-send").prop('href');
                            var newMails = existingMails + 'bcc:'+contacto.email_1+';';
                            $("#btn-confirm-send").prop('href',newMails);
                        });
                        $("#mod-alert").addClass("md-show");
                    }
                    else{
                        alert('ocurrio un error, por favor intentelo mas tarde');
                    }
                }); 
            }
            
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>