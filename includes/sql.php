<?php
//queries

function sql_save_user(){
    return 'INSERT INTO `usuarios` (`idusuario`, `nombre`, `apellido`, `idperfil`, `password`, `telefono_1`, `telefono_2`, `email_1`, `email_2`, `fecha_creacion`) '
            .' VALUES (:idusuario, :nombre, :apellido, :idperfil, :password, :telefono_1, :telefono_2, :email_1, :email_2, :fecha_creacion);';
}

function sql_update_user_no_password(){
    return 'UPDATE `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `idperfil`=:idperfil,  `telefono_1`=:telefono_1, `telefono_2`=:telefono_2, `email_1`=:email_1, `email_2`=:email_2 '
           . ' WHERE  `idusuario`=:idusuario;';
}
function sql_update_user_basic_info(){
    return 'UPDATE `usuarios` SET `nombre`=?, `apellido`=?,  `telefono_1`=?, `telefono_2`=?, `email_1`=?, `email_2`=?'
           . ' WHERE  `idusuario`=?';
}

function sql_update_user(){
    return 'UPDATE `usuarios` SET `nombre`=:nombre, `password`=:password, `apellido`=:apellido, `idperfil`=:idperfil,  `telefono_1`=:telefono_1, `telefono_2`=:telefono_2, `email_1`=:email_1, `email_2`=:email_2 '
           . ' WHERE  `idusuario`=:idusuario;';
}

function sql_update_user_password(){
    return 'UPDATE `usuarios` SET `nombre`=:nombre, `apellido`=:apellido, `password`=:idpassword, `idperfil`=:idperfil,  `telefono_1`=:telefono_1, `telefono_2`=:telefono_2, `email_1`=email_1, `email_2`=email_2 '
           . ' WHERE  `idusuario`=:idusuario;';
}
function sql_update_user_only_password(){
    return 'UPDATE `usuarios` SET `password`=?'
           . ' WHERE  `idusuario`=?;';
}

function sql_disable_user(){
    return 'UPDATE `usuarios` SET activo=0, fecha_inactivo=:fecha_inactivo WHERE  `idusuario`=:idusuario;';
}

function sql_get_user_password_by_user(){
    return 'SELECT usuarios.*, perfiles.`perfil` FROM usuarios '
           . 'INNER JOIN perfiles ON perfiles.`idperfil` = usuarios.`idperfil` '
           . 'WHERE usuarios.`activo`=1 and usuarios.`email_1`=?';
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
    return 'SELECT `permisos_x_usuarios`.* FROM `permisos_x_usuarios` WHERE `permisos_x_usuarios`.`idusuario` = :idusuario';
}

function sql_select_proveedores_all(){
    return ' SELECT proveedores.*, rubros.rubro,tipos_empresas.tipo FROM proveedores '
           . 'INNER JOIN rubros ON rubros.`idrubro` = proveedores.`idrubro`'
           . 'INNER JOIN tipos_empresas ON tipos_empresas.`idtipos_empresas` = proveedores.`idtipos_empresas`';
}

function sql_select_usuario_byId(){
    return 'SELECT * FROM usuarios WHERE idusuario=:idusuario';
}

function sql_select_usuarios_all(){
    return ' SELECT usuarios.*, perfiles.`perfil` FROM usuarios '
           . 'INNER JOIN perfiles ON perfiles.`idperfil` = usuarios.`idperfil` WHERE usuarios.`activo`=1';
}

function sql_select_perfiles_all(){
    return 'SELECT * FROM perfiles';
}
function sql_insert_client(){
    return 'INSERT INTO clientes (nombre_cliente, idmunicipio, logo, idrubro, idvendedor) values(?,?,?,?,?)';
}
function sql_update_client(){
    return 'UPDATE clientes SET nombre_cliente=?, idmunicipio=?, logo=?, idrubro=?, idvendedor=? WHERE idcliente=?';
}
function sql_update_client_no_logo(){
    return 'UPDATE clientes SET nombre_cliente=?, idmunicipio=?, idrubro=?, idvendedor=? WHERE idcliente=?';
}
function sql_delete_cliente(){
    return 'UPDATE clientes SET active = 0 WHERE idcliente=?';
}
function sql_delete_contacto(){
    return 'UPDATE contactos SET activo = 0 WHERE idcontacto=?';
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
    return 'INSERT INTO contactos (nombre_contacto, idcargo, idcliente, email_1, email_2, telefono_1,telefono_2,telefono_3, recibir_correos) values(?,?,?,?,?,?,?,?,?)';
}
function sql_update_contacto(){
    return 'UPDATE contactos SET nombre_contacto=?, idcargo=?, email_1=?, email_2=?, telefono_1=?,telefono_2=?,telefono_3=?, recibir_correos=? WHERE idcontacto=?';
}
function sql_select_clientes_extended(){
    return 'SELECT clientes.*, municipios.municipio, departamentos.departamento, rubros_clientes.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario WHERE clientes.active = 1';
}
function sql_select_total_clientes(){
    return 'SELECT count(idcliente) AS total_clientes from clientes WHERE active=1';
}
function sql_select_clientes_extended_order_alph(){
    return 'SELECT clientes.*, municipios.municipio, departamentos.departamento, rubros_clientes.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario WHERE clientes.active = 1 ORDER BY clientes.nombre_cliente ASC';
}
function sql_select_clientes_extended_by_idvendedor(){
    return 'SELECT clientes.*, municipios.municipio, departamentos.departamento, rubros_clientes.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario WHERE clientes.active = 1 AND clientes.idvendedor=?';
}
function sql_select_contactos_clientes_extended(){
    return 'SELECT contactos.*, clientes.*, contactos_cargos.cargo, municipios.municipio, departamentos.departamento, rubros_clientes.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM contactos' 
        . ' INNER JOIN contactos_cargos ON contactos.idcargo = contactos_cargos.idcontacto_cargo'
        . ' INNER JOIN clientes ON contactos.idcliente = clientes.idcliente'
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario WHERE clientes.active = 1';
}
function sql_select_contactos_clientes_extended_by_idvendedor(){
    return 'SELECT contactos.*, clientes.*, contactos_cargos.cargo, municipios.municipio, departamentos.departamento, rubros_clientes.rubro, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor'
         .' FROM contactos' 
        . ' INNER JOIN contactos_cargos ON contactos.idcargo = contactos_cargos.idcontacto_cargo'
        . ' INNER JOIN clientes ON contactos.idcliente = clientes.idcliente'
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario WHERE clientes.active = 1 AND clientes.idvendedor = ?';
}
function sql_select_cliente_extended_by_idcliente(){
    return 'SELECT clientes.*, municipios.idmunicipio, departamentos.iddepartamento, rubros_clientes.idrubro, usuarios.idusuario, CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor, '
         .' contactos.*'
         .' FROM clientes' 
         .' INNER JOIN municipios ON clientes.idmunicipio=municipios.idmunicipio'
         .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
         .' INNER JOIN rubros_clientes ON clientes.idrubro=rubros_clientes.idrubro'
         .' INNER JOIN usuarios ON clientes.idvendedor=usuarios.idusuario'
         .' INNER JOIN contactos ON clientes.idcliente=contactos.idcliente'
         .' WHERE clientes.idcliente=? LIMIT 1';
}
function sql_select_rubros(){
    return 'SELECT * FROM rubros';
}
function sql_select_rubros_clientes(){
    return 'SELECT * FROM rubros_clientes';
}
function sql_select_validez(){
    return 'SELECT * FROM validez_cotizaciones';
}
function sql_select_formas_pago(){
    return 'SELECT * FROM formas_pago';
}
function sql_select_garantias(){
    return 'SELECT * FROM garantias';
}
function sql_select_validez_by_id(){
    return 'SELECT * FROM validez_cotizaciones WHERE idvalidez_cotizacion=? LIMIT 1';
}
function sql_select_forma_pago_by_id(){
    return 'SELECT * FROM formas_pago WHERE idforma_pago=? LIMIT 1';
}
function sql_select_garantias_by_id(){
    return 'SELECT * FROM garantias WHERE idgarantia = ? LIMIT 1';
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
function sql_select_contactos_by_idcliente(){
    return 'SELECT contactos.*, contactos_cargos.cargo FROM contactos'
        .' INNER JOIN contactos_cargos ON contactos.idcargo = contactos_cargos.idcontacto_cargo'
        .' WHERE idcliente=? and activo=1'; 
}
function sql_select_contacto_by_idcontacto(){
    return 'SELECT * FROM contactos WHERE idcontacto=?';
}

function sql_select_tipos_empresas_all(){
    return 'SELECT tipos_empresas.* from tipos_empresas ';
}

function sql_select_rubros_all(){
    return 'SELECT rubros.* from rubros ';
}
function sql_select_rubros_clientes_all(){
    return 'SELECT * from rubros_clientes ';
}

function sql_select_sub_rubros_all(){
    return 'SELECT sub_rubros.* from sub_rubros ';
}

function sql_save_proveedor(){
    return 'INSERT INTO `proveedores`(`proveedor`, `idtipos_empresas`, `idrubro`, `idsub_rubro`, `fecha_creacion`,`website`) '
            . ' VALUES (:proveedor,:idtipos_empresas,:idrubro,:idsub_rubro,:fecha_creacion,:website)';
}

function sql_save_contacto_proveedor(){
    return 'INSERT INTO `contactos_proveedores`(`nombre_contacto`, `idcontactos_proveedores_cargos`, `idproveedor`, `email_1`, `email_2`, `telefono_1`, `telefono_2`, `telefono_3`, `fecha_creacion`) '
            .' VALUES (:nombre_contacto, :idcontactos_proveedores_cargos, :idproveedor, :email_1, :email_2, :telefono_1, :telefono_2, :telefono_3, :fecha_creacion)';
}
function sql_select_last_idcotizacion(){
    return 'SELECT idcotizacion FROM cotizaciones ORDER by idcotizacion DESC LIMIT 1';
}
function sql_save_cotizacion(){
    return 'INSERT INTO cotizaciones(codigo_cotizacion,idvendedor,idcliente,idmunicipio,idcontacto,idestado_cotizacion,idvalidez_cotizacion,'
    .'idforma_pago, idgarantia, iva,fecha_creacion) values(?,?,?,?,?,?,?,?,?,?,?)';
}
function sql_save_item_cotizacion(){
    return 'INSERT INTO cotizacion_items(idcotizacion,cantidad,idrubro,descripcion,imagen,precio_unitario) VALUES(?,?,?,?,?,?)';
}
function sql_save_condicion_custom(){
    return 'INSERT INTO condiciones_cotizacion(condicion, valor_condicion,idcotizacion) VALUES(?,?,?)';
}
function sql_select_cotizaciones(){
    return 'SELECT cotizaciones.*, clientes.idcliente, clientes.nombre_cliente,CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor, municipios.municipio,'
    .' departamentos.iddepartamento, contactos.idcontacto, estados_cotizacion.estado'
    .' FROM cotizaciones INNER JOIN clientes ON cotizaciones.idcliente=clientes.idcliente'
    .' INNER JOIN usuarios ON cotizaciones.idvendedor=usuarios.idusuario'
    .' INNER JOIN municipios ON cotizaciones.idmunicipio=municipios.idmunicipio'
    .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
    .' INNER JOIN contactos ON cotizaciones.idcontacto=contactos.idcontacto'
    .' INNER JOIN estados_cotizacion ON cotizaciones.idestado_cotizacion=estados_cotizacion.idestado_cotizacion WHERE cotizaciones.deleted != 1';
}
function sql_select_cotizacion_by_idcotizacion(){
    return 'SELECT cotizaciones.*, clientes.idcliente, clientes.nombre_cliente,CONCAT(usuarios.nombre,\' \', usuarios.apellido) AS nombre_vendedor, municipios.municipio,'
    .' departamentos.iddepartamento, contactos.idcontacto, contactos.nombre_contacto, contactos.email_1, contactos.telefono_1,contactos.telefono_2,contactos.telefono_3, estados_cotizacion.estado'
    .' FROM cotizaciones INNER JOIN clientes ON cotizaciones.idcliente=clientes.idcliente'
    .' INNER JOIN usuarios ON cotizaciones.idvendedor=usuarios.idusuario'
    .' INNER JOIN municipios ON cotizaciones.idmunicipio=municipios.idmunicipio'
    .' INNER JOIN departamentos ON municipios.iddepartamento=departamentos.iddepartamento'
    .' INNER JOIN contactos ON cotizaciones.idcontacto=contactos.idcontacto'
    .' INNER JOIN estados_cotizacion ON cotizaciones.idestado_cotizacion=estados_cotizacion.idestado_cotizacion WHERE idcotizacion=?';
}
function sql_select_cotizacion_items(){
    return 'SELECT * FROM cotizacion_items WHERE idcotizacion=?';
}
function sql_select_condiciones_by_idcotizacion(){
    return 'SELECT * FROM condiciones_cotizacion WHERE idcotizacion=?';
}
function sql_select_estados_cotizacion(){
    return 'SELECT * FROM estados_cotizacion';
}
function sql_delete_cotizacion_by_idcotizacion(){
    return 'DELETE FROM cotizaciones WHERE idcotizacion=?';
}
function sql_update_cotizacion_deleted_by_idcotizacion(){
    return 'UPDATE cotizaciones SET deleted = 1 WHERE idcotizacion=?';
}

function sql_select_proveedor_byId(){
    return 'SELECT * FROM proveedores WHERE idproveedor=:idproveedor';
}

function sql_update_proveedor(){
    return 'UPDATE `proveedores` SET `proveedor`=:proveedor,`idtipos_empresas`=:idtipos_empresas,'
            .' `idrubro`=:idrubro,`idsub_rubro`=:idsub_rubro, `website`=:website'
            . ' WHERE `idproveedor`=:idproveedor'; 
    
}   

function sql_delete_proveedor(){
    return 'DELETE FROM `proveedores` WHERE  `idproveedor`=:idproveedor;';
}

function sql_select_contactos_proveedores_bydIdproveedor(){
    return 'SELECT `idcontacto_proveedor`, `nombre_contacto`, `contactos_proveedores_cargos`.*,'
           .' `email_1`, `email_2`, `telefono_1`, `telefono_2`, `telefono_3`, `fecha_creacion`'
           .' FROM `contactos_proveedores`'
           .' INNER JOIN `contactos_proveedores_cargos` ON `contactos_proveedores_cargos`.`idcontactos_proveedores_cargos` = `contactos_proveedores`.`idcontactos_proveedores_cargos`'
           .' WHERE idproveedor=:idproveedor ';
}

function sql_select_contactos_proveedores_bydIcontacto_proveedor(){
    return 'SELECT `idcontacto_proveedor`,`idproveedor`, `nombre_contacto`, `idcontactos_proveedores_cargos`, '
           .'`email_1`, `email_2`,  `telefono_1`, `telefono_2`, `telefono_3`, '
           .'`fecha_creacion` FROM `contactos_proveedores` WHERE idcontacto_proveedor=:idcontacto_proveedor';
}

function  sql_update_contacto_proveedor(){
    return 'UPDATE `contactos_proveedores` SET `nombre_contacto`=:nombre_contacto,`idcontactos_proveedores_cargos`=:idcontactos_proveedores_cargos,'
            .'`email_1`=:email_1,`email_2`=:email_2,`telefono_1`=:telefono_1,'
            .'`telefono_2`=:telefono_2,`telefono_3`=:telefono_3 WHERE idcontacto_proveedor=:idcontacto_proveedor';
}

function sql_delete_contacto_proveedor(){
    return 'DELETE FROM `contactos_proveedores` WHERE  `idcontacto_proveedor`=:idcontacto_proveedor';
}



function sql_chart_resumen_cotizaciones(){
    return "SELECT * from resumen_cotizaciones where between fecha_creacion between :fecha_creacionIni and :fecha_creacionFin ";
}

function sql_chart_resumen_cotizaciones_vendedor(){
    return "SELECT * from resumen_cotizaciones where idvendedor = :idvendedor and between fecha_creacion between :fecha_creacionIni and :fecha_creacionFin";
}

function sql_chart_resumen_cotizaciones_cliente(){
    return "SELECT * from resumen_cotizaciones where idcliente= :idcliente and between fecha_creacion between :fecha_creacionIni and :fecha_creacionFin";
}

function sql_chart(){
    return "SELECT 
    `cotizaciones`.codigo_cotizacion, `clientes`.`nombre_cliente`, 
    CONCAT( `usuarios`.`nombre` ,' ', `usuarios`.`apellido`) AS vendedor, 
    `estados_cotizacion`.`estado`,
    SUM(( `cotizacion_items`.`cantidad` * `cotizacion_items`.`precio_unitario` )) AS total 
    FROM `cotizaciones`
    INNER JOIN clientes ON clientes.`idcliente` = `cotizaciones`.`idcliente`
    INNER JOIN `cotizacion_items` ON `cotizacion_items`.`idcotizacion` = `cotizaciones`.`idcotizacion`
    INNER JOIN `usuarios` ON `usuarios`.`idusuario` = `cotizaciones`.`idvendedor`
    INNER JOIN `estados_cotizacion` ON `estados_cotizacion`.`idestado_cotizacion` = `cotizaciones`.`idestado_cotizacion`
    GROUP BY `cotizaciones`.`idcotizacion`, `cotizaciones`.`idestado_cotizacion`;";
}

function sql_select_proveedores_contact(){
    return 'SELECT proveedores.*, rubros.rubro,tipos_empresas.tipo,sub_rubros.sub_rubro, '.
           ' (SELECT `contactos_proveedores`.nombre_contacto '.
           ' FROM `contactos_proveedores` '. 
           ' WHERE `contactos_proveedores`.`idproveedor` = `proveedores`.`idproveedor` '.
           ' ORDER BY contactos_proveedores.`idcontacto_proveedor` DESC LIMIT 1) as contacto '.
           ' FROM proveedores '.
           ' INNER JOIN rubros ON rubros.`idrubro` = proveedores.`idrubro` '.
           ' INNER JOIN sub_rubros ON sub_rubros.`idsub_rubro` = proveedores.`idsub_rubro` '.
           ' INNER JOIN tipos_empresas ON tipos_empresas.`idtipos_empresas` = proveedores.`idtipos_empresas`';
}

function sql_select_contactos_proveedores_cargo_all(){
    return 'SELECT * FROM contactos_proveedores_cargos';
}
function sql_select_contactos_cargo_all(){
    return 'SELECT * FROM contactos_cargos';
}

function sql_select_tipo_proveedores(){
    return 'SELECT tipos_empresas.* FROM `tipos_empresas`';
}

function sql_save_tipo_empresa(){
    return 'INSERT INTO `tipos_empresas`(`tipo`) VALUES (:tipo);';
}

function sql_update_tipo_empresa(){
    return 'UPDATE `tipos_empresas` SET `tipo` = :tipo WHERE `idtipos_empresas` = :idtipos_empresas';
}
function sql_delete_tipo_empresa(){
    return 'DELETE FROM `tipos_empresas` WHERE `idtipos_empresas` = :idtipos_empresas';
}

function sql_save_rubro(){
    return 'INSERT INTO `rubros`(`rubro`,`fecha_creacion`) VALUES (:rubro,:fecha_creacion)';
}
function sql_save_rubro_cliente(){
    return 'INSERT INTO `rubros_clientes`(`rubro`,`fecha_creacion`) VALUES (:rubro,:fecha_creacion)';
}

function sql_update_rubro(){
    return 'UPDATE `rubros` SET `rubro` = :rubro  WHERE `idrubro` = :idrubro';
}
function sql_update_rubro_cliente(){
    return 'UPDATE `rubros_clientes` SET `rubro` = :rubro  WHERE `idrubro` = :idrubro';
}

function sql_delete_rubro(){
    return 'DELETE FROM `rubros` WHERE `idrubro` = :idrubro';
}
function sql_delete_rubro_cliente(){
    return 'DELETE FROM `rubros_clientes` WHERE `idrubro` = :idrubro';
}

function sql_save_subrubro(){
    return 'INSERT INTO `sub_rubros` (`sub_rubro`,`fecha_creacion`) VALUES (:sub_rubro,:fecha_creacion);';
}

function sql_update_subrubro(){
    return 'UPDATE `sub_rubros` SET `sub_rubro` = :sub_rubro  WHERE `idsub_rubro` = :id_subrubro';
}

function sql_delete_subrubro(){
    return 'DELETE FROM `sub_rubros` WHERE `idsub_rubro` = :idsub_rubro';
}

function sql_save_cargo_proveedores(){
    return 'INSERT INTO `contactos_proveedores_cargos`(`cargo`) VALUES (:cargo)';
}
function sql_save_cargo_contacto(){
    return 'INSERT INTO `contactos_cargos`(`cargo`) VALUES (:cargo)';
}

function sql_update_cargo(){
    return 'UPDATE `contactos_proveedores_cargos` SET `cargo` = :cargo  WHERE `idcontactos_proveedores_cargos` = :idcontactos_proveedores_cargos';
}
function sql_update_contacto_cargo(){
    return 'UPDATE `contactos_cargos` SET `cargo` = :cargo  WHERE `idcontacto_cargo` = :idcontacto_cargo';
}

function sql_delete_cargo(){
    return 'DELETE FROM `contactos_proveedores_cargos` WHERE `idcontactos_proveedores_cargos` = :idcontactos_proveedores_cargos';
}
function sql_delete_contacto_cargo(){
    return 'DELETE FROM `contactos_cargos` WHERE `idcontacto_cargo` = :idcontacto_cargo';
}

function sql_select_usuarios_byPerfil(){
    return 'SELECT `usuarios`.`idusuario` , CONCAT(`usuarios`.`nombre`," ",`usuarios`.`apellido`) as nombre,`usuarios`.`telefono_1`,`usuarios`.`email_1`,' 
           .' `perfiles`.`perfil` FROM usuarios' 
           .' INNER JOIN perfiles ON perfiles.`idperfil` = usuarios.`idperfil`  WHERE usuarios.`activo`=1 AND usuarios.`idperfil`=1';
}

function sql_funnel_byVendedor(){
    return 'SELECT `resumen_cotizaciones`.`idestado_cotizacion`,`resumen_cotizaciones`.`estado`, SUM(`resumen_cotizaciones`.`total`) AS total '
            .' FROM `resumen_cotizaciones`'
            .' WHERE `resumen_cotizaciones`.`idvendedor`=:idvendedor' 
            .' AND (DATE_FORMAT(`resumen_cotizaciones`.`fecha_creacion`,\'%Y-%m-%d\') BETWEEN :inicio AND :fin )'
            .' GROUP BY `resumen_cotizaciones`.`idestado_cotizacion`'
            .' ORDER BY `resumen_cotizaciones`.`idestado_cotizacion` ASC;';
}

function sql_select_contactos_proveedores_extended(){ 
    return 'SELECT `proveedores`.`idproveedor`, `proveedores`.`proveedor`,`tipos_empresas`.`tipo`, `rubros`.`rubro`,`sub_rubros`.`sub_rubro`, `contactos_proveedores`.`nombre_contacto`, `contactos_proveedores_cargos`.`cargo`, `contactos_proveedores`.`telefono_1`,`contactos_proveedores`.`telefono_2`, `contactos_proveedores`.`telefono_3`, `contactos_proveedores`.`email_1`, `contactos_proveedores`.`email_2` '
            .' FROM `proveedores` '
            .' INNER JOIN `tipos_empresas` ON `tipos_empresas`.`idtipos_empresas` = `proveedores`.`idtipos_empresas` '
            .' INNER JOIN `rubros` ON `rubros`.`idrubro` = `proveedores`.`idrubro` '
            .' INNER JOIN `sub_rubros` ON `sub_rubros`.`idsub_rubro` = `proveedores`.`idsub_rubro` '
            .' INNER JOIN `contactos_proveedores` ON `contactos_proveedores`.`idproveedor` = `proveedores`.`idproveedor` '
            .' INNER JOIN `contactos_proveedores_cargos` ON `contactos_proveedores_cargos`.`idcontactos_proveedores_cargos` = `contactos_proveedores`.`idcontactos_proveedores_cargos`
';
}

function sql_save_perfil(){
    return 'INSERT INTO `perfiles`(`perfil`) VALUES (:perfil)';
}

function sql_update_perfil(){
    return 'UPDATE `perfiles` SET `perfil` = :perfil WHERE `idperfil` = :idperfil';
}

function sql_delete_perfil(){
    return 'DELETE FROM `perfiles` WHERE `idperfil` = :idperfil';
}


