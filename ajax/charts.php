<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$gOption = $_POST['cbfunnel'];
$type = $_POST['type'];

if($gOption=="vendedor" and $type=="getCmb" ){
    //obtener todos los vendedores
    $connection=  openConnection();
    $query=$connection->prepare(sql_select_usuarios_byPerfil());
    $query->execute();
    $usuarios=$query->fetchAll();
    $datos = array();
    foreach ($usuarios as $value) {
        $datos[] = array("id"=>$value['idusuario'],"lbl"=>$value['nombre']  );
    }
    exit(json_encode($datos));
}

if($gOption=="vendedor" and $type=="getChart" ){
    //obtener todos los vendedores
    $connection=  openConnection();
    $vendedor = $_POST['selSelected'];
    $periodo = $_POST['periodo'];
    list($inicio,$fin) = explode("-", $periodo);
    
    list($idia,$imes,$ianio) = explode("/",trim($inicio));
    list($fdia,$fmes,$fanio) = explode("/",trim($fin));
    
    $inicio = $ianio."-".$imes."-".$idia;
    $fin = $fanio."-".$fmes."-".$fdia;

    $query=$connection->prepare(sql_funnel_byVendedor());
    $query->bindParam(':idvendedor', $vendedor);
    $query->bindParam(':inicio', $inicio);
    $query->bindParam(':fin', $fin);
    $query->execute();
    $usuarios=$query->fetchAll();
    $datos = array();
    foreach ($usuarios as $value) {
        //$datos[] = array("id"=>$value['idestado_cotizacion'],"estado"=>$value['estado'],"total"=>$value['total']);
        $datos[] = array("name"=>$value['estado'],"data"=>$value['total']);
    }
    exit(json_encode($datos));
   
}


?>