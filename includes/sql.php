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
           . 'INNER JOIN perfiles ON perfiles.`idperfil` = usuarios.`idperfil`';
}

function sql_select_usuario_byId(){
    return 'SELECT * FROM usuarios WHERE idusuario=:idusuario';
}

function sql_select_perfiles_all(){
    return 'SELECT * FROM perfiles';
}
function sql_insert_client(){
    return 'INSERT INTO clientes (nombre_cliente, idmunicipio, logo, idrubro, idvendedor, recibir_correos) values(?,?,?,?,?,?)';
}
function sql_update_client(){
    return 'UPDATE clientes SET nombre_cliente=?, idmunicipio=?, logo=?, idrubro=?, idvendedor=?, recibir_correos=? WHERE idcliente=?';
}
function sql_delete_cliente(){
    return 'DELETE FROM clientes WHERE idcliente=?';
}
function sql_get_departamentos(){
    return 'SELECT * from departamentos';
}
function sql_get_municipios_by_iddepartamento(){
    return 'SELECT * from municipios WHERE iddepartamento=?';
}
function sql_get_municipio_by_iddepartamento(){
    return "SELECT * from municipios where iddepartamento=?";
}
function sql_save_contacto(){
    return 'INSERT INTO contactos (nombre_contacto, cargo, idcliente, email_1, email_2, telefono_1,telefono_2,telefono_3) values(?,?,?,?,?,?,?,?)';
}
function sql_update_contacto(){
    return 'UPDATE contactos SET nombre_contacto=?, cargo=?, email_1=?, email_2=?, telefono_1=?,telefono_2=?,telefono_3=? WHERE idcontacto=?';
}
function sql_select_clientes_extended(){
    return 'SELECT clientes.idcliente, clientes.nombre_cliente, municipios.municipio, departamentos.departamento, rubros.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros ON clientes.idrubro=rubros.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario';
}
function sql_select_cliente_extended_by_idcliente(){
    return 'SELECT clientes.idcliente, clientes.nombre_cliente, clientes.recibir_correos, municipios.idmunicipio, departamentos.iddepartamento, rubros.idrubro, usuarios.idusuario, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor, '
         .' contactos.nombre_contacto, contactos.idcontacto, contactos.cargo, contactos.email_1, contactos.email_2, contactos.telefono_1, contactos.telefono_2, contactos.telefono_3'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros ON clientes.idrubro=rubros.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario'
         .' INNER JOIN contactos ON clientes.idcliente=contactos.idcliente'
         .' WHERE clientes.idcliente=? LIMIT 1';
}
function sql_select_rubros(){
    return 'SELECT * FROM rubros';
}
function sql_select_clientes(){
    return 'SELECT * FROM clientes';
}
function sql_get_cliente_departamento_contacto(){
    return 'SELECT clientes.idmunicipio, departamentos.iddepartamento, contactos.idcontacto FROM clientes'
            .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
            .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
            .' INNER JOIN contactos ON clientes.idcliente=contactos.idcliente'
            .' WHERE clientes.idcliente=? LIMIT 1';
}
function sql_select_contactos(){
    return 'SELECT * FROM contactos';
}
function sql_select_contacto_by_idcontacto(){
    return 'SELECT * FROM contactos WHERE idcontacto=?';
}
