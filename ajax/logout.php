<?php
session_start();
unset($_SESSION['usuario']);
unset($_SESSION['idusuario']);
unset($_SESSION['nombre']);
unset($_SESSION['idperfil']);
header('Location: login.php');
?>
