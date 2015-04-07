<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="add"){
    $subrubro=$_POST['subrubroAgregar'];
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_subrubro());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':sub_rubro', $subrubro);
        $query->bindParam(':fecha_creacion', $now);
        $query->execute();
        $response['id']= $connection->lastInsertId();
        $connection->commit();

        $response['status']=1;
        $response['msg']= txt_sc_registrado();

    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_sc_msg_registro_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="update"){
    $idsub_rubro= decryptString($_POST['subcat']);
    $sub_rubro=$_POST['subrubroEditar'];
   
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_subrubro());
        $query->bindParam(':id_subrubro', $idsub_rubro);
        $query->bindParam(':sub_rubro', $sub_rubro);

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
    $subcat=decryptString($_POST['subcat']);
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_subrubro());
        $query->bindParam(':idsub_rubro', $subcat);
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
