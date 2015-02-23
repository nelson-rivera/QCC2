<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="add"){
    $tipo=$_POST['tipoAgregar'];
    $idtipo_proveedor=null;
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_tipo_empresa());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':tipo', $tipo);
        $query->execute();
        $connection->commit();

        $response['status']=1;
        $response['msg']= txt_te_registrado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_te_msg_registro_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="update"){
    $idte= decryptString($_POST['idte']);
    $tipo=$_POST['tipoEditar'];
   
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_tipo_empresa());
        $query->bindParam(':idtipos_empresas', $idte);
        $query->bindParam(':tipo', $tipo);

        $query->execute();
        $connection->commit();
        $response['status']=1;
        $response['msg']=txt_te_actualizado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_te_msg_actualizado_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="delete"){
    $idte=decryptString($_POST['idte']);
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_tipo_empresa());
        $query->bindParam(':idtipos_empresas', $idte);
        $query->execute();
        $connection->commit();
        $response['status']=1;
        $response['msg']= txt_te_eliminado();
    
    } catch (Exception $exc) {
        $response['status']=0;
        $response['msg']= txt_error_te_eliminado();
        $response['error']=$exc->getMessage();
    }
    exit(json_encode($response));
}
?>
