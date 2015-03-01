<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';

$option = $_POST['option'];

if($option=="save"){
    
    $nombre=$_POST['nombre'];
    $tipo=$_POST['tipo'];
    $rubro=$_POST['rubro'];
    $sub_rubro=$_POST['sub_rubro'];
    
    $contacto=$_POST['contacto'];
    $cargo=$_POST['cargo'];
    $telefono1=$_POST['telefono_1'];
    $telefono2=$_POST['telefono_2'];
    $telefono3=$_POST['telefono_3'];
    $correo1=$_POST['email_1'];
    $correo2=$_POST['email_2'];
    $correo3=$_POST['email_3'];
    
    $idproveedor=null;
    $now=date("Y-m-d H:i:s");
    $connection=  openConnection();
    $query=$connection->prepare(sql_save_proveedor());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':proveedor', $nombre);
        $query->bindParam(':idtipos_empresas', $tipo);
        $query->bindParam(':idrubro', $rubro);
        $query->bindParam(':idsub_rubro', $sub_rubro);
        $query->bindParam(':fecha_creacion', $now);
        $query->execute();
        $idproveedor = $connection->lastInsertId();
        
        $query=$connection->prepare(sql_save_contacto_proveedor());
        $query->bindParam(':nombre_contacto', $contacto);
        $query->bindParam(':idcontactos_proveedores_cargos', $cargo);
        $query->bindParam(':idproveedor', $idproveedor);
        $query->bindParam(':email_1', $correo1);
        $query->bindParam(':email_2', $correo2);
        $query->bindParam(':email_3', $correo3);
        $query->bindParam(':telefono_1', $telefono1);
        $query->bindParam(':telefono_2', $telefono2);
        $query->bindParam(':telefono_3', $telefono3);
        $query->bindParam(':fecha_creacion', $now);
        $query->execute();

        $connection->commit();

        $response['status']=1;
        $response['msg']=  txt_proveedor_registrado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_proveedor_msg_registro_fail();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}

if($option=="update"){
    $idproveedor= decryptString($_POST['sup']);
    $nombre=$_POST['nombre'];
    $tipo=$_POST['tipo'];
    $rubro=$_POST['rubro'];
    $sub_rubro=$_POST['sub_rubro'];
   
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_update_proveedor());
        $query->bindParam(':idproveedor', $idproveedor);
        $query->bindParam(':proveedor', $nombre);
        $query->bindParam(':idtipos_empresas', $tipo);
        $query->bindParam(':idrubro', $rubro);
        $query->bindParam(':idsub_rubro', $sub_rubro);

        $query->execute();
        $connection->commit();
        $response['status']=1;
        $response['msg']=txt_proveedor_actualizado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_proveedor_msg_actualizado_fail();
        $response['error']=$exc->getTraceAsString();
    }
    
    exit(json_encode($response));
}

if($option=="delete"){
    $idproveedor= decryptString($_POST['sup']);
    
    $connection=openConnection();
    try {
        $connection->beginTransaction();
        $query=$connection->prepare(sql_delete_proveedor());
        $query->bindParam(':idproveedor', $idproveedor);
        $query->execute();
        $connection->commit();

        $response['status']=1;
        $response['msg']= txt_vendedor_eliminado();
    
    } catch (Exception $exc) {
        $response['status']=0;
        $response['msg']= txt_error_vendedor_eliminado();
        $response['error']=$exc->getMessage();
        
    }
    exit(json_encode($response));
}
?>
