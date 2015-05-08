<!DOCTYPE html>
<html lang="en">
<head>
        <?php
        session_start();
        include_once './includes/layout.php';
        include_once './includes/libraries.php';
        include_once './includes/class/Helper.php';
        Helper::helpSession();
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
        
        <?= css_datetimepicker() ?>
        <?= css_daterangepicker_bs3() ?>
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
	
    <div id="cl-wrapper" class="sb-collapsed">
        <div class="cl-sidebar">
            <div class="cl-toggle"><i class="fa fa-bars"></i></div>
            <div class="cl-navblock">
                <div class="menu-space">
                  <div class="content">
                    
                    <?= lytSideMenu(9) ?>
                  </div>
                </div>
                
                <div class="text-right collapse-button" style="padding:7px 9px;">
                  <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-right"></i></button>
                </div>
            </div>
	</div>
	
	<div class="container-fluid" id="pcont">
            <div class="page-head">
                <h2>Reportes</h2>
            </div>
            <div class="cl-mcont">
                <div class="row col-md-4">
                    <form  class="form-horizontal group-border-dashed" name="form-reportes" id="form-reportes" action="#" style="border-radius: 0px;">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Funnel</label>
                          <div class="col-sm-9">
                              <select id="cbfunnel" name="cbfunnel" class="form-control" onchange="getcbFunnel();" >
                              <option value="general">General</option>
                              <option value="vendedor">Vendedor</option>
                              <option value="cliente">Cliente</option>
                              <option value="rubro">Rubro</option>
                            </select>									
                          </div>
                        </div>
                        <div class="form-group" id="cmbSelected">
                            <label class="col-sm-3 control-label" id="lblSelected" >Vendedor</label>
                          <div class="col-sm-9">
                              <select id="selSelected" name="selSelected" class="form-control">
                              
                            </select>									
                          </div>
                        </div>
                       <div class="form-group">
                        <label class="col-sm-3 control-label">Periodo</label>
                        <div class="col-sm-6">
                         <fieldset>
                          <div class="control-group">
                            <div class="controls">
                             <div class="input-prepend input-group">
                               <span class="add-on input-group-addon primary"><span class="glyphicon glyphicon-th"></span></span><input type="text" style="width: 200px" name="periodo" id="periodo" class="form-control"  /> 
                             </div>
                            </div>
                          </div>
                         </fieldset>
                        </div>
                      </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button id="btnSave" class="btn btn-primary" type="button" onclick="graficar();" >Enviar</button>
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
  <?= js_daterangepicker() ?>
  <?= js_moment() ?>

    <script type="text/javascript">
      $(document).ready(function(){
        App.init();
        
        $('#periodo').daterangepicker({
          format: 'DD/MM/YYYY',
          startDate: moment().subtract('months', 3),
          endDate: moment()
        });
        $('#periodo').html(moment().subtract('months', 3).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));  

        
      });
    function getcbFunnel(){
        var cmb = $("#cbfunnel").val();   
        $.ajax({
             url:"ajax/charts.php",
             type:'POST',
             dataType:"json",
             data:"type=getCmb&cbfunnel="+cmb,
             beforeSend: function(){ $('#selSelected').html(); },
             success:function(data){
                  $.each(data, function(index, element) {
                        $('#selSelected').append( '<option value="'+element.id+'">'+element.lbl+'</option>'  );
                    });
             }
         });
    }
    
    function graficar(){
           
        $.ajax({
             url:"ajax/charts.php",
             type:'POST',
             dataType:"json",
             data:"type=getChart&"+$("#form-reportes").serialize(),
             beforeSend: function(){ $('#selSelected').html(); },
             success:function(data){
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
                                headerFormat: '<span style="font-size:10px">{point.key}</span>',
                                pointFormat: '',
                                footerFormat: '',
                                shared: true,
                                useHTML: true
                            },
                            plotOptions: {
                                column: {
                                    pointPadding: 0.2,
                                    borderWidth: 0
                                }
                            },
                            series: data
                    });
             }
         });
    }
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <?= js_bootstrap() ?>
</body>

</html>