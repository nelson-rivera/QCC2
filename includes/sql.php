<?php
//queries

function sql_save_user(){
    return 'INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `cargo`, `password`, `telefono_1`, `telefono_2`, `email_1`, `email_2`, `fecha_creacion`) '
            .' VALUES (:idusuario, :nombre, :apellido, :cargo, :password, :telefono_1, :telefono_2, :email_1, :email_2, :fecha_creacion);';
}

function sql_save_permiso_x_usuario(){
    return 'INSERT INTO `permisos_x_usuarios` (`idpermiso`, `idusuario`, `fecha_creacion`) '
            .' VALUES (:idpermiso, :idusuario, :fecha_creacion);';
}

function sql_select_permisos_all(){
    return 'SELECT * FROM permisos';
}

function sql_select_permisos_byIdusuario(){
    return 'SELECT `permisos_x_usuarios`.`idpermiso` FROM `permisos_x_usuarios` WHERE `permisos_x_usuarios`.`idusuario` = :idusuario';
}

function sql_select_usuarios_all(){
    return 'SELECT * FROM usuarios usuarios';
}

function sql_select_usuario_byId(){
    return 'SELECT * FROM usuarios WHERE idusuario=:idusuario';
}

function sql_select_perfiles_all(){
    return 'SELECT * FROM perfiles';
}

?>