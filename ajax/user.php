<?php
session_start();
include_once '../includes/file_const.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';
include_once '../includes/lang/text.es.php';
include_once '../includes/password.php';

$option = $_POST['option'];

if($option=="save"){
    
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $cargo=$_POST['cargo'];
    $password=$_POST['password'];
    $telefono1=$_POST['telefono1'];
    $telefono2=$_POST['telefono2'];
    $correo1=$_POST['correo1'];
    $correo2=$_POST['correo2'];
    $idusuario=null;
    $now=date("Y-m-d H:i:s");
    $PassHash=password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));

    $connection=  openConnection();
    $query=$connection->prepare(sql_save_user());
    
    try {
        $connection->beginTransaction();
        $query->bindParam(':idusuario', $idusuario);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido', $apellido);
        $query->bindParam(':idperfil', $cargo);
        $query->bindParam(':password', $PassHash);
        $query->bindParam(':telefono_1', $telefono1);
        $query->bindParam(':telefono_2', $telefono2);
        $query->bindParam(':email_1', $correo1);
        $query->bindParam(':email_2', $correo2);
        $query->bindParam(':fecha_creacion', $now);
        $query->execute();

        $getIdusuario = $connection->lastInsertId();
        $query=$connection->prepare(sql_select_permisos_all());
        $query->execute();
        $permisosArray=$query->fetchAll();
        foreach ($permisosArray as $value) {
            if(!empty($_POST['op_'.$value['idpermiso']])) {
                $query=$connection->prepare(sql_save_permiso_x_usuario());
                $query->bindParam(':idpermiso',$value['idpermiso'] );
                $query->bindParam(':idusuario', $getIdusuario);
                $query->bindParam(':fecha_creacion', $now);
                $query->execute();
            }
        }

        $connection->commit();

        $response['status']=1;
        $response['msg']=txt_vendedor_registrado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_vendedor_msg_registro_fail();
        $response['error']=$exc->getTraceAsString();
    }
    
    echo json_encode($response);
}

if($option=="update"){
    
    $idusuario= decryptString($_POST['us']);
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $cargo=$_POST['cargo'];
    $password=$_POST['password'];
    $telefono1=$_POST['telefono1'];
    $telefono2=$_POST['telefono2'];
    $correo1=$_POST['correo1'];
    $correo2=$_POST['correo2'];
    $now=date("Y-m-d H:i:s");
    if(!empty($password)) $PassHash=password_hash($password, PASSWORD_BCRYPT, array("cost" => 10));
    $sql = ( empty($password) ) ? sql_update_user_no_password() : sql_update_user();
    
    $connection=openConnection();
    
    try {
        $connection->beginTransaction();
        $query=$connection->prepare($sql);
        $query->bindParam(':idusuario', $idusuario);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido', $apellido);
        $query->bindParam(':idperfil', $cargo);
        if(!empty($password)) $query->bindParam(':password', $PassHash);
        $query->bindParam(':telefono_1', $telefono1);
        $query->bindParam(':telefono_2', $telefono2);
        $query->bindParam(':email_1', $correo1);
        $query->bindParam(':email_2', $correo2);
        $query->execute();

        //eliminamos los permisos

        $query=$connection->prepare(sql_delete_permiso_x_usuario_byId());
        $query->bindParam(':idusuario', $idusuario);
        $query->execute();

        $query=$connection->prepare(sql_select_permisos_all());
        $query->execute();
        $permisosArray=$query->fetchAll();
        foreach ($permisosArray as $value) {
            if(!empty($_POST['op_'.$value['idpermiso']])) {
                $query=$connection->prepare(sql_save_permiso_x_usuario());
                $query->bindParam(':idpermiso',$value['idpermiso'] );
                $query->bindParam(':idusuario', $idusuario);
                $query->bindParam(':fecha_creacion', $now);
                $query->execute();
            }
        }

        $connection->commit();

        $response['status']=1;
        $response['msg']=  txt_vendedor_actualizado();
    }  catch ( Exception $exc ){
        $response['status']=0;
        $response['msg']= txt_vendedor_actualizado_fail();
        $response['error']=$exc->getTraceAsString();
    }
    echo json_encode($response);
}

if($option=="delete"){
    $idusuario= decryptString($_POST['us']);
    $now=date("Y-m-d H:i:s");
    
    $connection=openConnection();
    try {
    $connection->beginTransaction();
    $query=$connection->prepare(sql_disable_user());
        $query->bindParam(':idusuario', $idusuario);
        $query->bindParam(':fecha_inactivo', $now);
    $query->execute();
    $connection->commit();
        
    $response['status']=1;
    $response['msg']= txt_vendedor_eliminado();
    
    } catch (Exception $exc) {
        $response['status']=0;
        $response['msg']= txt_error_vendedor_eliminado();
        $response['error']=$exc->getTraceAsString();
    }
    exit(json_encode($response));
}
?>
