<?php
class Helper{
  
   static function helpSession() {
       if(empty($_SESSION['idusuario']) ) {
           header('Location: login.php');
       }
   }
   
   static function helpSessionAjax() {
       if( !empty($_SESSION['iduser']) ) {
           $response = array();
           $response['code']="2.1";
           $response['msj']="Sesión expirada";
           exit(json_encode($response));
       } 
   }
   
   static function helpIsAllowed($permiso) {
        if (!in_array($permiso, $_SESSION['permisos']) ){
           header('Location: index.php'); 
        } 
   }
   
}


?>
