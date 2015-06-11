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
        Helper::helpIsAllowed(10); // 10 - Editar proveedores
        
        $connection = openConnection();
        $query=$connection->prepare(sql_select_proveedor_byId());
        $query->bindParam(':idproveedor', decryptString($_GET['sup']),PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount()>0){}
        $proveedor=$query->fetch();
        
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Proveedor</title>
         <?= css_fonts() ?>

	<!-- Bootstrap core CSS -->
	<?= css_bootstrap() ?>
        <?= css_gritter() ?>
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
                <h2>Proveedores <i class="fa fa-angle-double-right"></i> Editar Proveedor - <?= $proveedor['proveedor'] ?></h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                            <div class="header">
                                <h3>Datos del proveedor</h3>
                            </div>
                            <div class="content">
                                <form id="frm-edit-supplier" name="frm-edit-supplier" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre Empresa</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" id="nombre" name="nombre" value="<?= $proveedor['proveedor'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-6" data-select="tipo"  >
                                            <select  name="tipo" id="tipo" style="width: 100%" required >
                                            <?php 
                                                $query=$connection->prepare(sql_select_tipos_empresas_all());
                                                $query->execute();
                                                $tipoEmpresasArray=$query->fetchAll();
                                                if($query->rowCount()>0){}
                                                foreach ($tipoEmpresasArray as $value) {
                                                    $te= ($value['idtipos_empresas'] == $proveedor['idtipos_empresas'] ) ? "selected" : "" ;    
                                                ?>
                                                <option value="<?= $value['idtipos_empresas'] ?>" <?= $te ?> ><?= $value['tipo'] ?></option>
                                                <?php } ?>    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Rubro</label>
                                        <div class="col-sm-6" data-select="rubro" >
                                             <select  name="rubro" id="rubro" style="width: 100%" required >
                                               <?php 
                                                $query=$connection->prepare(sql_select_rubros_all());
                                                $query->execute();
                                                $rubrosArray=$query->fetchAll();
                                                if($query->rowCount()>0){}
                                                foreach ($rubrosArray as $value) {
                                                    $urubro= ($value['idrubro'] == $proveedor['idrubro'] ) ? "selected" : "" ;
                                                ?>
                                                <option value="<?= $value['idrubro'] ?>" <?= $urubro ?> ><?= $value['rubro'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Sub-Rubro</label>
                                        <div class="col-sm-6" data-select="sub_rubro" >
                                            <select  name="sub_rubro" id="sub_rubro" style="width: 100%" required >
                                                <?php 
                                                $query=$connection->prepare(sql_select_sub_rubros_all());
                                                $query->execute();
                                                $subRubrosArray=$query->fetchAll();
                                                if($query->rowCount()>0){}
                                                foreach ($subRubrosArray as $value) {
                                                     $usubrubro= ($value['idsub_rubro'] == $proveedor['idsub_rubro'] ) ? "selected" : "" ;
                                                ?>
                                                <option value="<?= $value['idsub_rubro'] ?>" <?= $usubrubro ?> ><?= $value['sub_rubro'] ?></option>
                                                <?php } ?>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Sitio web</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="url" name="website" id="website"  parsley-type="url" value="<?= $proveedor['website'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button id="btnSave" class="btn btn-primary" type="button">Guardar</button>
                                            <button id="btnCancel" type="button" onclick="javascript: location.href='contacts-suppliers.php?sup'+<?= encryptString(decryptString( $_GET['sup'])) ?>;" class="btn btn-default">Cancelar</button>
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
    <!-- Notificaciones-->
    <div class="md-modal colored-header info md-effect-10" id="mod-alert">
        <div class="md-content ">
          <div class="modal-header">
            <h3><?= txt_proveedor_title_actualizado() ?></h3>
            <button type="button" class="close md-close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div id="modal-body-center-edit" class="text-center">
                <div class="i-circle primary">
                    <i class="fa fa-check"></i>
                </div>
                <h4 id="hmodal" ></h4>
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
  <?= js_general() ?>
  <?= js_jquery_parsley() ?>
  <?= js_i18n_es() ?>
  <?= js_gritter() ?>
  <?= js_select2() ?>
  <?= js_niftymodals() ?>
     
    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
         $("#tipo").select2();$("#rubro").select2();$("#sub_rubro").select2();
        window.ParsleyValidator.setLocale('es');

        $("#btnSave").click(function(event){
            if($( '#frm-edit-supplier' ).parsley().validate()){ 
                    $.ajax({
                    url:"ajax/supplier.php",
                    type:'POST',
                    dataType:"json",
                    data:$("#frm-edit-supplier").serialize()+"&option=update&sup=<?= encryptString(decryptString( $_GET['sup'])) ?>",
                    beforeSend: function() {
                        $("#btnSave").prop("disabled",true);
                        $("#btnReset").prop("disabled",true);
                    }
                }).done(function(response){
                    if (response.status == "1") {
                        $("#mod-alert").addClass("md-show");
                        $("#hmodal").html(response.msg);
                    }
                    else {
                        $.gritter.add({
                            title: "<?= txt_proveedor_title_actualizado_fail() ?>",
                            text: response.msg,
                            class_name: 'danger'
                          });
                    }
                });
            }
            return;
        });
         $('.select2-search > input.select2-input').on('keyup', function(e) {
           if(e.keyCode === 13) nuevoRegistro($( '.select2-dropdown-open' ).parents().attr('data-select'),$(this).val())
        });
      });

      $("#btn-redirect").click(function(){ location.href='list-suppliers.php'; });

        function nuevoRegistro(mant,valor){
            var pserv={
                "tipo":{ "url": "ajax/supplier-types.php","option":"add","reg":"tipoAgregar"},
                "rubro":{ "url": "ajax/supplier-category.php","option":"add","reg":"rubroAgregar"},
                "sub_rubro":{ "url": "ajax/supplier-subcategory.php","option":"add","reg":"subrubroAgregar"}               
                }; 
                
            $.ajax({
                url:pserv[mant].url,
                type:'POST',
                dataType:"json",
                data:"option="+pserv[mant].option+"&"+pserv[mant].reg+"="+valor,
                beforeSend: function(){ },
                success:function(data){
                    if(data.status=="1"){ 
                        $("#"+mant).append('<option value="'+data.id+'">'+valor+'</option>');
                        $("#"+mant).select2("val", data.id).select2("close");
                    }else{

                    }
                    
                }
            });
        }

    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

<!-- Mirrored from foxypixel.net/cleanzone/pages-blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 06 Nov 2014 04:57:43 GMT -->
</html>