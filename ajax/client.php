<?php
include_once '../includes/connection.php';
include_once '../includes/sql.php';

if(empty($_POST['opt']) || !is_numeric($_POST['opt'])){
    $response['status']=1;
    $response['msg']= 'A su petición le falta un argumento';
    $response['error']= '101';
    exit(json_encode($response));
}
$opt=$_POST['opt'];
$connection= openConnection();
switch ($opt) {
    //save client
    case 1:
        if(!empty($_POST['input-name-company']) && !empty($_POST['input-vendedor']) && is_numeric($_POST['input-vendedor']) && !empty($_POST['input-rubro']) && 
           is_numeric($_POST['input-rubro']) && !empty($_POST['input-municipio']) && is_numeric($_POST['input-municipio']) && !empty($_POST['input-contacto']) && 
           !empty($_POST['input-cargo']) && !empty($_POST['input-telefono-1']) && !empty($_POST['input-correo-1'])){
            
            $companyName=$_POST['input-name-company'];
            $idUsuario=$_POST['input-vendedor'];
            $idRubro=$_POST['input-rubro'];
            $idMunicipio=$_POST['input-municipio'];
            $nombreContacto=$_POST['input-contacto'];
            $cargo=$_POST['input-cargo'];
            $telefono1=$_POST['input-telefono-1'];
            $correo1=$_POST['input-correo-1'];
            $logo=(empty($_POST['input-logo']))?null:$_POST['input-logo'];
            $recibirCorreos=(empty($_POST['input-newsletter']))?0:1;
            
            $telefono2=(empty($_POST['input-telefono-2']))?null:$_POST['input-telefono-2'];
            $telefono3=(empty($_POST['input-telefono-3']))?null:$_POST['input-telefono-3'];
            $correo2=(empty($_POST['input-correo-2']))?null:$_POST['input-correo-2'];
            $connection->beginTransaction();
            try {
                $insertClient=$connection->prepare(sql_insert_client());
                $insertClient->execute(array($companyName,$idMunicipio,$logo,$idRubro,$idUsuario,$recibirCorreos));
                $idCliente=$connection->lastInsertId();
                $insertContact=$connection->prepare(sql_save_contacto());
                $insertContact->execute(array($nombreContacto, $cargo, $idCliente, $correo1, $correo2, $telefono1,$telefono2,$telefono3));
                
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Cliente agregado con éxito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 102: Error al insertar cliente';
                $response['error']= '102';
            }
    
            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '103';
        }
        

        break;
    //update cliente
    case 2:
        if(!empty($_POST['input-name-company']) && !empty($_POST['input-vendedor']) && is_numeric($_POST['input-vendedor']) && !empty($_POST['input-rubro']) && 
           is_numeric($_POST['input-rubro']) && !empty($_POST['input-municipio']) && is_numeric($_POST['input-municipio']) && !empty($_POST['input-contacto']) && 
           !empty($_POST['input-cargo']) && !empty($_POST['input-telefono-1']) && !empty($_POST['input-correo-1']) && is_numeric($_POST['id1']) && is_numeric($_POST['id2'])){
            
            $idCliente=$_POST['id1'];
            $idContacto=$_POST['id2'];
            $companyName=$_POST['input-name-company'];
            $idUsuario=$_POST['input-vendedor'];
            $idRubro=$_POST['input-rubro'];
            $idMunicipio=$_POST['input-municipio'];
            $nombreContacto=$_POST['input-contacto'];
            $cargo=$_POST['input-cargo'];
            $telefono1=$_POST['input-telefono-1'];
            $correo1=$_POST['input-correo-1'];
            $logo=(empty($_POST['input-logo']))?null:$_POST['input-logo'];
            $recibirCorreos=(empty($_POST['input-newsletter']))?0:1;
            
            $telefono2=(empty($_POST['input-telefono-2']))?null:$_POST['input-telefono-2'];
            $telefono3=(empty($_POST['input-telefono-3']))?null:$_POST['input-telefono-3'];
            $correo2=(empty($_POST['input-correo-2']))?null:$_POST['input-correo-2'];
            $connection->beginTransaction();
            try {
                $insertClient=$connection->prepare(sql_update_client());
                $insertClient->execute(array($companyName,$idMunicipio,$logo,$idRubro,$idUsuario,$recibirCorreos,$idCliente));
                $insertContact=$connection->prepare(sql_update_contacto());
                $insertContact->execute(array($nombreContacto, $cargo, $correo1, $correo2, $telefono1,$telefono2,$telefono3,$idContacto));
                
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Cliente editado con éxito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 104: Error al actualizar cliente';
                $response['error']= '104';
            }
    
            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '105';
        }
        

        break;
    //delete cliente
    case 3:
        if(is_numeric($_POST['id'])){
            $idCliente=$_POST['id'];
            $connection->beginTransaction();
            try {
                $deleteCliente=$connection->prepare(sql_delete_cliente());
                $deleteCliente->execute(array($idCliente));
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Cliente eliminado con éxito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 107: Error al eliminar cliente';
                $response['error']= '107';
            }            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '108';
        }
        break;
    default:
        $response['status']=1;
        $response['msg']= 'A su petición le falta un argumento';
        $response['error']= '106';
        break;
}
exit(json_encode($response));
