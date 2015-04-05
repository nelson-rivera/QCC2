<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="add"){
    $rubro=$_POST['rubroAgregar'];
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_rubro_cliente());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':rubro', $rubro);
        $query->bindParam(':fecha_creacion', $now);
        $query->execute();
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
    $idrubro= decryptString($_POST['cat']);
    $rubro=$_POST['rubroEditar'];
   
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_rubro_cliente());
        $query->bindParam(':idrubro', $idrubro);
        $query->bindParam(':rubro', $rubro);

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
    $cat=decryptString($_POST['cat']);
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_rubro_cliente());
        $query->bindParam(':idrubro', $cat);
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