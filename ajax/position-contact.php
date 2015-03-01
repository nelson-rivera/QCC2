<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="add"){
    $cargo=$_POST['cargoAgregar'];
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_cargo_proveedores());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':cargo', $cargo);
        $query->execute();
        $connection->commit();

        $response['status']=1;
        $response['msg']= txt_pc_registrado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_pc_msg_registro_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="update"){
    $idpcon= decryptString($_POST['pcon']);
    $cargo=$_POST['cargoEditar'];
   
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_cargo());
        $query->bindParam(':idcontactos_proveedores_cargos', $idpcon);
        $query->bindParam(':cargo', $cargo);

        $query->execute();
        $connection->commit();
        $response['status']=1;
        $response['msg']=txt_pc_actualizado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_pc_msg_actualizado_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="delete"){
    $pcon=decryptString($_POST['pcon']);
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_cargo());
        $query->bindParam(':idcontactos_proveedores_cargos', $pcon);
        $query->execute();
        $connection->commit();
        $response['status']=1;
        $response['msg']= txt_pc_eliminado();
    } catch (Exception $exc) {
        $response['status']=0;
        $response['msg']= txt_error_pc_eliminado();
        $response['error']=$exc->getMessage();
    }
    exit(json_encode($response));
}
?>
