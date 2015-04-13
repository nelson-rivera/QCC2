<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="add"){
    $perfil=$_POST['cargoAgregar'];
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_perfil());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':perfil', $perfil);
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
    $idperfil= decryptString($_POST['perf']);
    $perfil=$_POST['cargoEditar'];
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_perfil());
        $query->bindParam(':idperfil', $idperfil);
        $query->bindParam(':perfil', $perfil);

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
    $idperfil=decryptString($_POST['perf']);
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_perfil());
        $query->bindParam(':idperfil', $idperfil);
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
