<?php
session_start();
include_once '../includes/functions.php';
include_once '../includes/connection.php';
include_once '../includes/sql.php';
include_once '../includes/password.php';
include_once '../includes/lang/text.es.php';

try{
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $email=$_POST['username'];
        $password=$_POST['password'];
        $connection=  openConnection();
        $query=$connection->prepare(sql_get_user_password_by_user());
        $query->execute(array($email));
        $passwordArray=$query->fetch();
        $passHash=$passwordArray['password'];
        $active=$passwordArray['activo'];
        if($active==1){
            if(password_verify($password, $passHash)){
                
                $_SESSION['usuario']=$passwordArray['email_1'];
                $_SESSION['idusuario']=$passwordArray['idusuario'];
                $_SESSION['nombre']=$passwordArray['nombre']." ".$passwordArray['apellido'];
                $_SESSION['idperfil']=$passwordArray['idperfil'];
                $_SESSION['idnivel']=$passwordArray['idnivel'];
                

                $query=$connection->prepare(sql_select_permisos_byIdusuario() );
                $query->bindParam(':idusuario', $passwordArray['idusuario'],PDO::PARAM_INT);
                $query->execute();
                $permisos=$query->fetchAll(PDO::FETCH_ASSOC);
                $apermisos = array();
                foreach ($permisos as $value) {
                    $apermisos[] =  $value['idpermiso'];
                }
                $_SESSION['permisos'] = $apermisos;    
                $response['status']=0;
                $response['msg']='valid';
                echo json_encode($response);
            }
            else{
                $response['status']=1;
                $response['msg']=txt_login_fallido();
                echo json_encode($response);
            }
        }
        else{
            $response['status']=2;
            $response['msg']=txt_usuario_no_activo();
            echo json_encode($response);
        }

    }
    else{
        $response['status']=3;
        $response['msg']=txt_login_fallido();
        echo json_encode($response);
    }
}
catch (Exception $error){
    $response['status']=4;
    $response['msg']=txt_login_fallido();
    echo json_encode($response);
}


?>
