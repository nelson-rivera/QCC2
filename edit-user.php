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
        Helper::helpIsAllowed(2); // 2 - Editar vendedores
        
        $connection = openConnection();
        $query=$connection->prepare(sql_select_usuario_byId());
        $query->bindParam(':idusuario', decryptString($_GET['us']),PDO::PARAM_INT);
        $query->execute();
        if($query->rowCount()>0){}
        $usuario=$query->fetch();
        
    ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Editar Contacto</title>
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
                    
                    <?= lytSideMenu(4) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>SISTECORP <i class="fa fa-angle-double-right"></i> <a href="list-users.php">Listado de Contactos SISTECORP</a> <i class="fa fa-angle-double-right"></i> Editar Contacto: <?= $usuario['nombre'] ?></h2>
            </div>
            <div class="cl-mcont">
                
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                           <div id="client" class="panel-group accordion accordion-semi">
                            <div class="panel panel-default">
                            <div class="panel-heading success">
                              <h4 class="panel-title">
                              <a href="#ac4-1" data-parent="#accordion4" data-toggle="collapse" class="collapsed">
                                <i class="fa fa-angle-right"></i> Ver estadísticas del vendedor
                              </a>
                              </h4>
                            </div>
                                
                            <div class="panel-collapse collapse" id="ac4-1" style="height: 0px;">
                              <div class="panel-body">
                                    <div class="butpro butstyle" >
					<div class="sub"><h2>Clientes</h2><span id="total_clientes">170</span></div>
					<div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle">
                                            <div class="sub"><h2>F1</h2><span id="total_clientes">$2,500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle">
                                            <div class="sub"><h2>F2</h2><span id="total_clientes">$1,500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle">
                                            <div class="sub"><h2>F3</h2><span id="total_clientes">$500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle" >
                                            <div class="sub"><h2>F4</h2><span id="total_clientes">$500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle">
                                            <div class="sub"><h2>F5</h2><span id="total_clientes">$500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                                    <div class="butpro butstyle">
                                            <div class="sub"><h2>FX</h2><span id="total_clientes">$500</span></div>
                                            <div class="stat"><span class="spk1"></span></div>
                                    </div>
                              </div>
                            </div>
                            </div>
                          </div>
			
                            <div class="content">
                                <form name="frm-edit-user" id="frm-edit-user" class="form-horizontal" style="border-radius: 0px;" action="#" data-parsley-validate >
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="nombre" id="nombre" value="<?= $usuario['nombre'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="apellido" id="apellido" value="<?= $usuario['apellido'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Cargo</label>
                                        <div class="col-sm-6" id="div_cargo" data-select="cargo"  >
                                            <select id="cargo" name="cargo" style="width: 100%" required >
                                                <?php 
                                                $query=$connection->prepare(sql_select_perfiles_all());
                                                $query->execute();
                                                $perfilesArray=$query->fetchAll();
                                                if($query->rowCount()>0){}
                                                foreach ($perfilesArray as $value) { 
                                                     $uperfil= ($value['idperfil'] == $usuario['idperfil'] ) ? "selected" : "" ;
                                                    ?>
                                                <option value="<?= $value['idperfil']; ?>" <?= $uperfil ?> ><?= $value['perfil']; ?>  </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Contraseña</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password" name="password" id="password"  >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Confirmar Contraseña</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="password" name="cpassword" id="cpassword"  >
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono1" id="telefono1" value="<?= $usuario['telefono_1'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfono 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="text" name="telefono2" id="telefono2" value="<?= $usuario['telefono_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 1</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="email" name="correo1" id="correo1" value="<?= $usuario['email_1'] ?>" required >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Correo 2</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" type="email" name="correo2" id="correo2" value="<?= $usuario['email_2'] ?>" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nivel de Contactos</label>
                                        <div class="col-sm-6">
                                            <select id="nivel" name="nivel" style="width: 100%" required >
                                                <?php 
                                                $query=$connection->prepare(sql_select_niveles_all());
                                                $query->execute();
                                                $nivelesArray=$query->fetchAll();
                                                if($query->rowCount()>0){}
                                                foreach ($nivelesArray as $value) { 
                                                     $univel= ($value['idnivel'] == $usuario['idnivel'] ) ? "selected" : "" ;
                                                    ?>
                                                <option value="<?= $value['idnivel']; ?>" <?= $univel ?> ><?= $value['nivel']; ?>  </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6">
                                            
                                            <?php 
                                            
                                            $query=$connection->prepare(sql_select_permisos_byIdusuario() );
                                            $query->bindParam(':idusuario', decryptString($_GET['us']),PDO::PARAM_INT);
                                            $query->execute();
                                            if($query->rowCount()>0){}
                                            $permisos=$query->fetchAll(PDO::FETCH_ASSOC);
                                            $apermisos = array();
                                            foreach ($permisos as $value) {
                                                $apermisos[] =  $value['idpermiso'];
                                            }
                                            
                                            $query=$connection->prepare(sql_select_permisos_all());
                                            $query->execute();
                                            $permisosArray=$query->fetchAll();

                                            if($query->rowCount()>0){}
                                            foreach ($permisosArray as $value) {
                                                $upermiso= (in_array($value['idpermiso'], $apermisos) ) ? "checked" : "" ;

                                            }


                                            ?>
                                            <table class="blue">
                                                <thead>
                                                    <tr>
                                                        <th>&nbsp;</th>
                                                        <th class="right">Ver</th>
                                                        <th class="right">Agregar</th>
                                                        <th class="right">Editar</th>
                                                        <th class="right">Eliminar</th>
                                                        <th class="right">Exportar</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="no-border-x">
                                                    <tr>
                                                        <td style="width:40%;">Vendedores</td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_13" <?php if(in_array("13", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_1" <?php if(in_array("1", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_2" <?php if(in_array("2", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_3" <?php if(in_array("3", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_4" <?php if(in_array("4", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:40%;">Clientes</td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_14" <?php if(in_array("14", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_5" <?php if(in_array("5", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_6" <?php if(in_array("6", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_7" <?php if(in_array("7", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_8" <?php if(in_array("8", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width:40%;">Proveedores</td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_15" <?php if(in_array("15", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_9" <?php if(in_array("9", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_10" <?php if(in_array("10", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_11" <?php if(in_array("11", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right">
                                                            <div class="checkbox-inline">
                                                                <label>
                                                                    <input type="checkbox" name="op_12" <?php if(in_array("12", $apermisos) ) echo "checked" ; ?> >
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button id="btnSave" class="btn btn-primary" type="button">Actualizar</button>
                                            <button id="btnCancel" type="button" class="btn btn-default" onclick="location.href='list-users.php';" >Cancelar</button>
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
    
    <div class="md-modal colored-header info md-effect-10" id="mod-alert">
        <div class="md-content ">
          <div class="modal-header">
            <h3>Usuario editado exitosamente</h3>
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
        window.ParsleyValidator.setLocale('es');

        $("#btnSave").click(function(event){
            if($( '#frm-edit-user' ).parsley().validate()){
                    $.ajax({
                    url:"ajax/user.php",
                    type:'POST',
                    dataType:"json",
                    data:$("#frm-edit-user").serialize()+"&option=update&us=<?= encryptString(decryptString( $_GET['us'])) ?>",
                    beforeSend: function() {
                        $("#btnSave").prop("disabled",true);
                        $("#btnReset").prop("disabled",true);
                    }
                    }).done(function(response){
                        if (response.status == "1") {
                            $("#mod-alert").addClass("md-show");
                        }
                        else {
                            $.gritter.add({
                            title: "Error",
                                text: response.msg,
                                class_name: 'danger'
                              });
                        }
                    });
            }
            return;
        });
        $("#btn-redirect").click(function(){
            location.href='list-users.php';
        });
        $("#cargo").select2(); $("#nivel").select2();
        $('.select2-search > input.select2-input').on('keyup', function(e) {
           if(e.keyCode === 13) nuevoRegistro($( '.select2-dropdown-open' ).parents().attr('data-select'),$(this).val())
        });
      });

    function nuevoRegistro(mant,valor){
            var pserv={"cargo":{ "url": "ajax/position-user.php","option":"add","reg":"cargoAgregar"}};
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