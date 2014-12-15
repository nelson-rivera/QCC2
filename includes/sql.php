<?php
//queries

function sql_save_user(){
    return 'INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `idperfil`, `password`, `telefono_1`, `telefono_2`, `email_1`, `email_2`, `fecha_creacion`) '
            .' VALUES (:idusuario, :nombre, :apellido, :idperfil, :password, :telefono_1, :telefono_2, :email_1, :email_2, :fecha_creacion);';
}

function sql_update_user(){
    return 'UPDATE `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `idperfil`=:idperfil,  `telefono_1`=:telefono_1, `telefono_2`=:telefono_2, `email_1`=:email_1, `email_2`=:email_2 '
           . ' WHERE  `idusuario`=:idusuario;';
}

function sql_update_user_password(){
    return 'UPDATE `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `password`=:idpassword, `idperfil`=:idperfil,  `telefono_1`=:telefono_1, `telefono_2`=:telefono_2, `email_1`=email_1, `email_2`=email_2 '
           . ' WHERE  `idusuario`=:idusuario;';
}

function sql_disable_user(){
    return 'UPDATE `usuarios` SET activo=0, fecha_inactivo=:fecha_inactivo WHERE  `idusuario`=:idusuario;';
}

function sql_save_permiso_x_usuario(){
    return 'INSERT INTO `permisos_x_usuarios` (`idpermiso`, `idusuario`, `fecha_creacion`) '
            .' VALUES (:idpermiso, :idusuario, :fecha_creacion);';
}

function sql_delete_permiso_x_usuario_byId(){
    return 'DELETE FROM `permisos_x_usuarios` WHERE `permisos_x_usuarios`.idusuario=:idusuario;';
}

function sql_select_permisos_all(){
    return 'SELECT * FROM permisos';
}

function sql_select_permisos_byIdusuario(){
    return 'SELECT `permisos_x_usuarios`.`idpermiso` FROM `permisos_x_usuarios` WHERE `permisos_x_usuarios`.`idusuario` = :idusuario';
}

function sql_select_usuarios_all(){
    return ' SELECT usuarios.*, perfiles.`perfil` FROM usuarios '
           . 'INNER JOIN perfiles ON perfiles.`idperfil` = usuarios.`idperfil` WHERE usuarios.`activo`=1';
}

function sql_select_usuario_byId(){
    return 'SELECT * FROM usuarios WHERE idusuario=:idusuario';
}

function sql_select_perfiles_all(){
    return 'SELECT * FROM perfiles';
}

?>