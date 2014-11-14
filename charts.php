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

	<title>QCC - Listar Clientes</title>
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
                    <div class="side-user">
                      <div class="avatar"><img src="images/avatar1_50.jpg" alt="Avatar" /></div>
                      <div class="info">
                        <a href="#">Usuario 1</a>
                        <img src="images/state_online.png" alt="Status" /> <span>Online</span>
                      </div>
                    </div>
                    <?= lytSideMenu(9) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Reportes</h2>
            </div>
            <div class="cl-mcont">
                <div class="row col-md-4">
                    <form class="form-horizontal group-border-dashed" action="#" style="border-radius: 0px;">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Funnel</label>
                          <div class="col-sm-6">
                            <select class="form-control">
                              <option>General</option>
                              <option>Vendedor</option>
                              <option>Cliente</option>
                              <option>Rubro</option>
                            </select>									
                          </div>
                        </div>
                      </form>
                </div>
                <div class="row col-md-8">
                    <div id="charts_funnel" >
                        
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
  <?= js_general() ?>
  <?= js_highcharts() ?>
  <?= js_highcharts_exporting() ?>

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
         $('#charts_funnel').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Gráfica Funnel General/Vendedor/Cliente'
            },
            subtitle: {
                text: 'Fuente: QCC'
            },
            xAxis: {
                categories: [
                    'F1',
                    'F2',
                    'F3',
                    'F4',
                    'F5',
                    'FX'
                ],
                title: {
                    text: 'Fases'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Monto'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'F1',
                data: [150000]
            }, {
                name: 'F2',
                data: [160000]
            }, {
                name: 'F3',
                data: [20000]
            }, {
                name: 'F4',
                data: [10000]
            }, {
                name: 'F5',
                data: [9000]
            }, {
                name: 'FX',
                data: [1000]
            }]
        });
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>