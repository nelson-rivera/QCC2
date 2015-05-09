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
        //Helper::helpIsAllowed(5); // 5 - Listado de proveedores
        $connection=  openConnection();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Listado de Tipo de Proveedores[Mantenimiento]</title>
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
                    
                    <?= lytSideMenu(5) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Mantenimiento <i class="fa fa-angle-double-right"></i> Tipo de Proveedores</h2>
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="clearfix">
                            <a class="btn btn-info md-trigger btn-agregar-tsup pull-right" data-toggle="tooltip" data-original-title="Agregar registro" data-modal="mod-add123" ><i class="fa fa-book"></i> Agrega registro</a><span>&nbsp;</span>
                        </div>
                        <div class="block-flat">
                            <table class="table table-bordered" id="datatable-icons" >
                                <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $query=$connection->prepare(sql_select_tipo_proveedores());
                                $query->execute();
                                $usuarios=$query->fetchAll();
                                $num=1;
                                foreach ($usuarios as $value) {
                                ?>
                                    <tr class="odd gradeA">
                                        <td id="tsup_<?= $num ?>" ><?= $value['tipo'] ?></td>
                                        <td class="center">
                                            <a class="btn btn-primary md-trigger btn-xs btn-edit-tsup" data-toggle="tooltip" data-original-title="Eliminar registro" data-modal="mod-edit" data-tsup="<?= encryptString($value['idtipos_empresas']) ?>"  data-num="<?= $num ?>" >
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-danger md-trigger btn-xs btn-eliminar-tsup" data-toggle="tooltip" data-original-title="Eliminar registro" data-modal="mod-delete" data-tsup="<?= encryptString($value['idtipos_empresas']) ?>"  data-num="<?= $num ?>" >
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php $num++; } ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- <eliminar> -->
                        <div class="md-modal colored-header danger md-effect-10" id="mod-delete">
                            <div class="md-content ">
                              <div class="modal-header">
                                <h3>Eliminar</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <div id="modal-body-center" class="text-center">
                                  <div class="i-circle danger"><i class="fa fa-trash-o"></i></div>
                                  <h4>¡Cuidado!</h4>
                                  <p>¿Seguro que desea eliminar el registro: <span id="del_name" ></span>?</p>
                                </div>
                              </div>
                                <div class="modal-footer" id="modal-footer-response" >
                                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" id="btn-deleteS" >Eliminar</button>
                                </div>
                            </div>
                        </div>
                        <!-- </eliminar> -->
                        
                        <!-- <editar> -->
                        <div class="md-modal colored-header primary md-effect-10" id="mod-edit">
                            <div class="md-content ">
                              <div class="modal-header">
                                <h3>Editar</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <div id="modal-body-center-edit" class="text-center">
                                  <form name="frm-edit-sup" id="frm-edit-sup" class="form-horizontal" style="border-radius: 0px;" onkeypress="return anular(event)">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="tipoEditar" id="tipoEditar" required >
                                        </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                                <div class="modal-footer" id="modal-footer-response-edit" >
                                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary btn-flat" data-dismiss="modal" id="btn-editS" >Editar</button>
                                </div>
                            </div>
                        </div>
                        <!-- </editar> -->
                        
                        <!-- <agregar> -->
                        <div class="md-modal colored-header info md-effect-10" id="mod-add123">
                            <div class="md-content ">
                              <div class="modal-header">
                                <h3>Agregar</h3>
                                <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              </div>
                              <div class="modal-body">
                                <div id="modal-body-center-add" class="text-center">
                                  <form name="frm-add-sup" id="frm-add-sup" class="form-horizontal" style="border-radius: 0px;" onkeypress="return anular(event)">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="tipoAgregar" id="tipoAgregar" required >
                                        </div>
                                    </div>
                                  </form>
                                </div>
                              </div>
                                <div class="modal-footer" id="modal-footer-response-add" >
                                    <button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-primary btn-flat" data-dismiss="modal" id="btn-addS" >Agregar</button>
                                </div>
                            </div>
                        </div>
                        <!-- </agregar> -->
                        
                        <div class="md-overlay"></div>
                        
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
  <?= js_jquery_datatable() ?>
  <?= js_jquery_datatable_adapter() ?>
  <?= js_general() ?>
  <?= js_niftymodals() ?>   
	

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        $('#datatable-icons').dataTable();
        $("#datatable").dataTable();
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
      
        $('.btn-eliminar-tsup').click(function(e){
           var num = $(this).attr("data-num");
           $("#del_name").html( $("#tsup_"+num).html());
           $("#btn-deleteS").attr("data-tsup", $(this).attr("data-tsup") )
        });
        
        $('.btn-edit-tsup').click(function(e){
           var num = $(this).attr("data-num");
           $("#tipoEditar").val( $("#tsup_"+num).html());
           $("#btn-editS").attr("data-tsup", $(this).attr("data-tsup"));
        });
        
        $('.btn-add-tsup').click(function(e){
           $("#btn-editS").attr("data-tsup", $(this).attr("data-tsup"));
        });
        
        
        
        $('#btn-deleteS').click(function(e){
           var tsup = $("#btn-deleteS").attr("data-tsup");
           $.ajax({
                url:"ajax/supplier-types.php",
                type:'POST',
                dataType:"json",
                data:"option=delete&idte="+tsup,
                beforeSend: function(){ $("#modal-footer-response").html(''); },
                success:function(data){
                    if(data.status=="1"){ 
                        $("#modal-body-center").html('<div class="i-circle danger"><i class="fa fa-check"></i></div><h4>¡Registro eliminado con éxito!</h4>');
                        $("#modal-footer-response").html('<button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }else{
                        $("#modal-body-center").html('<div class="i-circle danger"><i class="fa  fa-frown-o"></i></div><h4>Ocurrio un error al eliminar el registro</h4>');
                        $("#modal-footer-response").html('<button type="button" class="btn btn-default btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }
                    $(document).on('click','#btn-actualizarDT', function () { location.reload();});
                }
            }); 
        });
        
        $('#btn-editS').click(function(e){
        $(this).attr("disabled","disabled"); 
           var tsup = $("#btn-editS").attr("data-tsup");
           $.ajax({
                url:"ajax/supplier-types.php",
                type:'POST',
                dataType:"json",
                data:"option=update&idte="+tsup+"&"+$("#frm-edit-sup").serialize(),
                beforeSend: function(){ $("#modal-footer-response").html(''); },
                success:function(data){
                    if(data.status=="1"){ 
                        $("#modal-body-center-edit").html('<div class="i-circle primary"><i class="fa fa-check"></i></div><h4>¡Registro editado con éxito!</h4>');
                        $("#modal-footer-response-edit").html('<button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }else{
                        $("#modal-body-center-edit").html('<div class="i-circle primary"><i class="fa  fa-frown-o"></i></div><h4>Ocurrio un error al editar el registro</h4>');
                        $("#modal-footer-response-edit").html('<button type="button" class="btn btn-primary btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }
                    $(document).on('click','#btn-actualizarDT', function () { location.reload();});
                }
            }); 
        });
        
        $('#btn-addS').click(function(e){
        $(this).attr("disabled","disabled"); 
           var tsup = $("#btn-editS").attr("data-tsup");
           $.ajax({
                url:"ajax/supplier-types.php",
                type:'POST',
                dataType:"json",
                data:"option=add&"+$("#frm-add-sup").serialize(),
                beforeSend: function(){ $("#modal-footer-response").html(''); },
                success:function(data){
                    if(data.status=="1"){ 
                        $("#modal-body-center-add").html('<div class="i-circle info"><i class="fa fa-check"></i></div><h4>¡Registro agregado con éxito!</h4>');
                        $("#modal-footer-response-add").html('<button type="button" class="btn btn-info btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }else{
                        $("#modal-body-center-add").html('<div class="i-circle info"><i class="fa  fa-frown-o"></i></div><h4>Ocurrio un error al agregar el registro</h4>');
                        $("#modal-footer-response-add").html('<button type="button" class="btn btn-info btn-flat md-close" data-dismiss="modal" id="btn-actualizarDT" >Aceptar</button>');
                    }
                    $(document).on('click','#btn-actualizarDT', function () { location.reload();});
                }
            }); 
        });
        
        $('#tipoEditar').keydown(function(event) {
            if (event.keyCode == 13) {
                document.getElementById("btn-editS").click();
                return false;
             }
        });
        
        $('#tipoAgregar').keydown(function(event) {
            if (event.keyCode == 13) {
                document.getElementById("btn-addS").click();
                return false;
             }
        });
        
      });
    function anular(e) { evento = (document.all) ? e.keyCode : e.which; return (evento != 13); }
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>