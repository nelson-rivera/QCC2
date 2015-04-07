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
        Helper::helpIsAllowed(1); // 1 - Listado de clientes
        $connection=openConnection();
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
                <h2 class="" >Clientes <i class="fa fa-angle-double-right"></i> Listado de clientes</h2>
                
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="row">
                                <div class="col-sm-3 pull-left" >
                                    <a href="generar-excel-clientes.php" class="btn btn-success">Generar Excel</a> 

                                </div>
                                <div class="col-sm-3 pull-right" >
                                    <form  action="#" class="form-horizontal">
                                        <div>
                                            <label class="col-sm-5 control-label">Vendedor</label>
                                            <div class="col-sm-7 no-padding">
                                                <?= selectVendedor('input-vendedor','input-vendedor','form-control','','','',true) ?>
                                            </div>
                                        </div>
                                      </form>
                                </div>
                            </div>
                                
                            
                                <table class="table table-bordered" id="datatable-icons" >
                                    <thead>
                                            <tr>
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
                                        $selectClientes=$connection->prepare(sql_select_clientes_extended());
                                        $selectClientes->execute();
                                        foreach ($selectClientes->fetchAll() as $cliente) {
                                        ?>
                                            <tr class="odd gradeA">
                                                <td><?= utf8_encode($cliente['nombre_cliente']) ?></td>
                                                <td><?= $cliente['rubro'] ?></td>
                                                <td><?= $cliente['nombre_vendedor'] ?></td>
                                                <td><?= utf8_encode($cliente['departamento']) ?></td>
                                                <td class="center"><?= utf8_encode($cliente['municipio']) ?></td>
                                                <td class="center">
                                                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Gestionar contactos de clientes" href="contacts-client.php?id=<?= $cliente['idcliente'] ?>">
                                                        <i class="fa fa-users"></i>
                                                    </a>
                                                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Editar cliente" href="edit-client.php?id=<?= $cliente['idcliente'] ?>">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
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
                           
                        </div>
                    </div>
                </div>
                
            </div>
	</div> 
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
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
    </div>
    
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
  <?= js_general() ?>
     
	

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        var oTable=$('#datatable-icons').dataTable();
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
        
        
        var selectedRow;
        var idC;
        $('#datatable-icons tbody').on( 'click', '.btn-danger', function () {
            $('#modal-delete').modal('show');
            selectedRow = $(this).closest("tr").get(0);
            idC = $(this).children(".input-cliente").val();
            
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
            $.ajax({
                url:"ajax/client.php",
                type:'POST',
                dataType:"json",
                data: {'opt':6, 'id':id},
            }).done(function(response){
                if (response.status == "0") {
                    oTable.fnClearTable();
                    if(response.data){
                        oTable.fnAddData(response.data);
                        oTable.fnAdjustColumnSizing();
                    }
                }
                else{
                    oTable.fnClearTable();
                }
            }); 
            
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>