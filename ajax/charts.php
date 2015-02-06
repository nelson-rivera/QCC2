<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$gChart = $_POST['chart'];
$gOption = $_POST['cbfunnel'];

if($gOption=="save"){
    $connection=  openConnection();
    
    
    
    $query=$connection->prepare(sql_chart_resumen_cotizaciones());
   
    
}


?>