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
        $connection=  openConnection();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Agregar cotización</title>
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
                <h2>Cotizaciones</h2>
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="col-sm-3 pull-right" >
<!--                                <form  action="#" class="form-horizontal">
                                    <div class="form-group">
                                      <label class="col-sm-5 control-label">Vendedor</label>
                                      <div class="col-sm-7 no-padding">
                                        <select class="form-control">
                                          <option>Raymundo</option>
                                          <option>Yolanda</option>
                                          <option>Pepe</option>
                                        </select>									
                                      </div>
                                    </div>
                                </form>-->
                            </div>
                            <table class="table table-bordered" id="datatable-icons" >
                                <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Cliente</th>
                                            <th>Vendedor</th>
                                            <th>Fase</th>
                                            <th>Municipio</th>
                                            <th>Acciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $queryGetCotizaciones=$connection->prepare(sql_select_cotizaciones());
                                    $queryGetCotizaciones->execute();
                                    foreach ($queryGetCotizaciones->fetchAll() as $cotizacion) {
                                    ?>
                                        <tr class="odd gradeA">
                                            <td><a href="edit-quote.php?id=<?= $cotizacion['idcotizacion'] ?>"><?= $cotizacion['codigo_cotizacion'] ?></a></td>
                                            <td><a href="edit-client.php?id=<?= $cotizacion['idcliente'] ?>"><?= $cotizacion['nombre_cliente'] ?></a></td>
                                            <td><?= $cotizacion['nombre_vendedor'] ?></td>
                                            <td class="center"><?= $cotizacion['estado'] ?></td>
                                            <td class="center"><?= $cotizacion['municipio'] ?></td>
                                            <td class="center">
                                                <a class="btn btn-success btn-xs" data-toggle="tooltip" data-original-title="Descargar PDF" href="generate-pdf.php?id=<?=$cotizacion['idcotizacion'] ?>">
                                                    <i class="fa fa-file-pdf-o"></i>
                                                </a>
                                                <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Edit" href="edit-quote.php?id=<?= $cotizacion['idcotizacion'] ?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                               
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
                                                    <input type="hidden" class="input-cotizacion" value="<?= $cotizacion['idcotizacion'] ?>"/>
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
            <h4 class="modal-title" id="myModalLabel">Eliminar Cotización</h4>
          </div>
          <div class="modal-body">
              Está seguro que desea eliminar la cotizacion<span id="codigo-cotizacion"></span>, esta acción es definitiva y 
              todos los datos relacionados con ella se perderán.
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
        var oTable = $('#datatable-icons').dataTable();
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
        
        var selectedRow;
        var idC;
        $('#datatable-icons tbody').on( 'click', '.btn-danger', function () {
            $('#modal-delete').modal('show');
            selectedRow = $(this).closest("tr").get(0);
            idC = $(this).children(".input-cotizacion").val();
        } );
        
        $("#btn-eliminar").click(function(){
            $.ajax({
                url:'ajax/cotizacion.php',
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
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>