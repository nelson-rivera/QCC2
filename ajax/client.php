<?php
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/functions.php';

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
            $recibirCorreos=(empty($_POST['input-newsletter']))?0:1;
            
            $telefono2=(empty($_POST['input-telefono-2']))?null:$_POST['input-telefono-2'];
            $telefono3=(empty($_POST['input-telefono-3']))?null:$_POST['input-telefono-3'];
            $correo2=(empty($_POST['input-correo-2']))?null:$_POST['input-correo-2'];
            $connection->beginTransaction();
            try {
                $logo = null;
                if(!empty($_FILES["input-logo"]["name"])){
                    $uploadDir = "../uploads/clientes/";
                    if(!is_dir($uploadDir)) {
                        mkdir($uploadDir,0566,true);
                    }
                    $imageUrl = $uploadDir. $_FILES["input-logo"]["name"];
                    $logo = "uploads/clientes/".$_FILES["input-logo"]["name"];
                    move_uploaded_file($_FILES["input-logo"]["tmp_name"], $imageUrl);
                }
                
                
                $insertClient=$connection->prepare(sql_insert_client());
                $insertClient->execute(array($companyName,$idMunicipio,$logo,$idRubro,$idUsuario));
                $idCliente=$connection->lastInsertId();
                $insertContact=$connection->prepare(sql_save_contacto());
                $insertContact->execute(array($nombreContacto, $cargo, $idCliente, $correo1, $correo2, $telefono1,$telefono2,$telefono3, $recibirCorreos));
                
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
           is_numeric($_POST['input-rubro']) && !empty($_POST['input-municipio']) && is_numeric($_POST['input-municipio']) && is_numeric($_POST['id1']) && is_numeric($_POST['id2'])){
            
            $idCliente=$_POST['id1'];
            $idContacto=$_POST['id2'];
            $companyName=$_POST['input-name-company'];
            $idUsuario=$_POST['input-vendedor'];
            $idRubro=$_POST['input-rubro'];
            $idMunicipio=$_POST['input-municipio'];
            
            $connection->beginTransaction();
            try {
                
                if(!empty($_FILES["input-logo"]["name"])){
                    $uploadDir = "../uploads/clientes/";
                    if(!is_dir($uploadDir)) {
                        mkdir($uploadDir,0566,true);
                    }
                    $imageUrl = $uploadDir. $_FILES["input-logo"]["name"];
                    $logo = "uploads/clientes/".$_FILES["input-logo"]["name"];
                    move_uploaded_file($_FILES["input-logo"]["tmp_name"], $imageUrl);
                    
                    $insertClient=$connection->prepare(sql_update_client());
                    $insertClient->execute(array($companyName,$idMunicipio,$logo,$idRubro,$idUsuario,$idCliente));
                }
                else{
                    $insertClient=$connection->prepare(sql_update_client_no_logo());
                    $insertClient->execute(array($companyName,$idMunicipio,$idRubro,$idUsuario,$idCliente));
                }
                
                
                
                
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
        
    //Update client's contact
    case 4:
        if(is_numeric($_POST['id']) && !empty($_POST['input-nombre-contacto']) && !empty($_POST['input-cargo']) && !empty($_POST['input-telefono-1']) && !empty($_POST['input-email-1'])){
            $idContacto=$_POST['id'];
            $recibirCorreos=(empty($_POST['input-newsletter']))?0:1;
            $connection->beginTransaction();
            try {
                $updateContacto = $connection->prepare(sql_update_contacto());
                $updateContacto->execute(array($_POST['input-nombre-contacto'], $_POST['input-cargo'], $_POST['input-email-1'], $_POST['input-email-2'], $_POST['input-telefono-1'], $_POST['input-telefono-2'], $_POST['input-telefono-3'],$recibirCorreos, $idContacto));
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Contacto editado con exito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 109: Error al eliminar cliente';
                $response['error']= '109';
            }            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '110';
        }
        break;
    //Agregar contacto
    case 5:
        if(is_numeric($_POST['input-id']) && !empty($_POST['input-nombre-contacto']) && !empty($_POST['input-cargo']) && !empty($_POST['input-telefono-1']) && !empty($_POST['input-email-1'])){
            $idCliente=$_POST['input-id'];
            $email2 = empty($_POST['input-email-2'])?null:$_POST['input-email-2'];
            $telefono2 = empty($_POST['input-telefono-2'])?null:$_POST['input-telefono-2'];
            $telefono3 = empty($_POST['input-telefono-3'])?null:$_POST['input-telefono-3'];
            $recibirCorreos=(empty($_POST['input-newsletter']))?0:1;
            $connection->beginTransaction();
            try {
                $insertContacto = $connection->prepare(sql_save_contacto());
                $insertContacto->execute(array($_POST['input-nombre-contacto'], $_POST['input-cargo'],$idCliente, $_POST['input-email-1'], $email2, $_POST['input-telefono-1'], $telefono2, $telefono3,$recibirCorreos));
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Contacto agregado con exito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 109: Error al agregar cliente';
                $response['error']= '109';
            }            
        }
        else{
            $response['status']=1;
            $response['msg']= 'A su petición le falta un argumento';
            $response['error']= '110';
        }
        break;
    //Lista de clientes filtrada por vendedor
    case 6:
        $idCliente = $_POST['id'];
        try {
            if($idCliente==0){
                $getCliente = $connection->prepare(sql_select_clientes_extended());
                $getCliente->execute();
            }
            else{
                $getCliente = $connection->prepare(sql_select_clientes_extended_by_idvendedor());
                $getCliente->execute(array($idCliente));
            }
            
            $counter = 0;
            $data = null;
            foreach ( $getCliente->fetchAll() as $cliente){
                $buttons = '<a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Contacto" href="contacts-client.php?id='. encryptString($cliente['idcliente']).'">
                            <i class="fa fa-user"></i>
                        </a>
                        <a class="btn btn-primary btn-xs" data-toggle="tooltip" data-original-title="Editar" href="edit-client.php?id='. encryptString($cliente['idcliente']) .'">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a class="btn btn-danger btn-xs" data-toggle="tooltip" data-original-title="Eliminar" href="#">
                            <input class="input-cliente" type="hidden" value="'. $cliente['idcliente'].'" />
                            <i class="fa fa-times"></i>
                        </a>';
                $clienteArray = [$cliente['nombre_cliente'], $cliente['rubro'], utf8_encode($cliente['nombre_vendedor']), utf8_encode($cliente['departamento']), utf8_encode($cliente['municipio']), $buttons];
                $data[$counter] = $clienteArray;
                $counter++;
            }
            $response['data'] = $data;
            $response['status']=0;
            $response['msg']= 'Lista de clientes';
        } catch (Exception $exc) {
            $response['status']=1;
            $response['msg']= 'Error 109: Error al obtener cliente';
            $response['error']= '111';
        }
        break;
    
    case 7:
        if(is_numeric($_POST['id'])){
            $idContacto=$_POST['id'];
            $connection->beginTransaction();
            try {
                $deleteContacto=$connection->prepare(sql_delete_contacto());
                $deleteContacto->execute(array($idContacto));
                $connection->commit();
                $response['status']=0;
                $response['msg']= 'Contacto eliminado con éxito';
            } catch (Exception $exc) {
                $connection->rollBack();
                $response['status']=1;
                $response['msg']= 'Error 107: Error al eliminar contacto';
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
