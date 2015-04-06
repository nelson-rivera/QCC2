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
        $connection=  openConnection();
        if(empty($_GET['id']) && !is_numeric($_GET['id'])){
            header('location: list-clients.php');
            exit();
        }
        $idCliente=$_GET['id'];
        $getCliente=$connection->prepare(sql_select_cliente_extended_by_idcliente());
        $getCliente->execute(array($idCliente));
        if($getCliente->rowCount()<1){
            header('location: list-clients.php');
            exit(); 
        }
        $clientArray=$getCliente->fetch();
        ?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>QCC - Listar de Contactos de los Clientes</title>
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
                <h2>Clientes <i class="fa fa-angle-double-right"></i> Contactos de <a href="edit-client.php?id=<?=$idCliente ?>"><?= $clientArray['nombre_cliente'] ?></a></h2>
            </div>
            <div class="cl-mcont">
                <div class="row">
                    <div class="col-md-12">
                        <div class="block-flat">
                                    
                            <table class="table table-bordered" id="datatable-icons" >
                                <thead>
                                        <tr>
                                            <th>Cotacto</th>
                                            <th>Cargo</th>
                                            <th>Teléfono 1</th>
                                            <th>Teléfono 2</th>
                                            <th>Teléfono 3</th>
                                            <th>Correo 1</th>
                                            <th>Correo 2</th>
                                            <th>Acciones</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getContactos = $connection->prepare(sql_select_contactos_by_idcliente());
                                    $getContactos->execute(array($idCliente));
                                    foreach ($getContactos->fetchAll() as $contacto){
                                    ?>
                                        <tr class="odd">
                                            <td><?= $contacto['nombre_contacto'] ?></td>
                                            <td><?= $contacto['cargo'] ?></td>
                                            <td><?= $contacto['telefono_1'] ?></td>
                                            <td><?= $contacto['telefono_2'] ?></td>
                                            <td><?= $contacto['telefono_3'] ?></td>
                                            <td><?= $contacto['email_1'] ?></td>
                                            <td><?= $contacto['email_2'] ?></td>
                                            <td class="center">
                                    <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Edit" href="edit-contact-client.php?id=<?= $contacto['idcontacto']?>">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Remove" href="#">
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
        $('#datatable-icons').dataTable();
    
        //Search input style
        $('.dataTables_filter input').addClass('form-control').attr('placeholder','Search');
        $('.dataTables_length select').addClass('form-control');
        $('<a href="add-contact-client.php?id=<?=$idCliente ?>" class="btn btn-info" type="button" ><i class="fa fa-user"></i> Agrega contacto</a><span>&nbsp;</span>').appendTo('div.dataTables_filter');
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>