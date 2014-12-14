<?php
//Function to generate an alphanumeric+simbols string
function randomStr($length) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()-=+_~";
    $string = "";
    for ($x = 0; $x < $length; $x++){
        $string .= $characters[mt_rand(0, strlen($characters))];
    }
    return $string;
}
//Function to encrypt
function encryptString($string) {
   $key = QCC_KEY;
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return urlencode(base64_encode($result));
}
//Function to decrypt
function decryptString($string) {
   $key = QCC_KEY;
   $result = '';
   $string = urldecode(base64_decode($string));
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}


?>
