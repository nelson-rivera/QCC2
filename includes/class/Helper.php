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
   
}


?>
