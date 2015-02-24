<?php
session_start();
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/password.php';

if(empty($_POST['opt']) || !is_numeric($_POST['opt'])){
    $response['status']=1;
    $response['msg']= 'A su petición le falta un argumento';
    $response['error']= '101';
    exit(json_encode($response));
}
$opt=$_POST['opt'];
$connection= openConnection();
switch ($opt) {
    //update usuario perfil
    case 1:
        try{
            $updateUsuario = $connection->prepare(sql_update_user_basic_info());
            $updateUsuario->execute(array($_POST['input-nombre'], $_POST['input-apellido'], $_POST['input-telefono-1'], $_POST['input-telefono-2'], $_POST['input-email-1'], $_POST['input-email-2'], $_SESSION['idusuario']));
            $response['status']=0;
            $response['msg']= 'Perfil actualizado con exito';
        
        } 
        catch (Exception $exc) {
            echo $exc->getMessage();
            $response['status']=1;
            $response['msg']= 'Error 209: Error al actualizar perfil';
            $response['error']= '209';
        }  
        break;
    //update password
    case 2:
        try{
            $getUsuario = $connection->prepare(sql_select_usuario_byId());
            $getUsuario->bindParam(':idusuario', $_SESSION['idusuario'],PDO::PARAM_INT);
            $getUsuario->execute();

            $usuarioArray = $getUsuario->fetch();
            $passHash = $usuarioArray['password'];
            $password = $_POST['input-old-password'];

            if(password_verify($password, $passHash)){
                $newPass = $_POST['input-new-password'];
                $newPassHash=password_hash($newPass, PASSWORD_BCRYPT, array("cost" => 10));
                $updateUsuario = $connection->prepare(sql_update_user_only_password());
                $updateUsuario->execute(array($newPassHash, $_SESSION['idusuario']));
                $response['status']=0;
                $response['msg']= 'Password actualizado con exito';
            }
            else{
                $response['status']=1;
                $response['msg']= 'La contraseña antigua no coincide';
                $response['error']= '211';
            }
        
        }
        catch (Exception $exc) {
            $response['status']=1;
            $response['msg']= 'Error 210: Error al actualizar perfil';
            $response['error']= '210';
        }
        
        
        

        break;
    //update empres
    case 3:
        
        break;
    default:
        $response['status']=1;
        $response['msg']= 'A su petición le falta un argumento';
        $response['error']= '106';
        break;
}
exit(json_encode($response));
