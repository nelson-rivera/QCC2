ALTER TABLE `contactos` CHANGE `cargo` `idcargo` INT(11) NOT NULL;

ALTER TABLE contactos
ADD CONSTRAINT fk_cargo
FOREIGN KEY (idcargo)
REFERENCES contactos_proveedores_cargos(idcontactos_proveedores_cargos);

CREATE TABLE IF NOT EXISTS `rubros_clientes`
 ( `idrubro` int(11) NOT NULL, `rubro` varchar(45) NOT NULL, 
`fecha_creacion` date DEFAULT NULL ) ENGINE=InnoDB AUTO_INCREMENT=6 
DEFAULT CHARSET=utf8;


ALTER TABLE `rubros_clientes`
 ADD PRIMARY KEY (`idrubro`);

ALTER TABLE `rubros_clientes`
MODIFY `idrubro` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;

INSERT INTO `rubros_clientes` (`rubro`, `fecha_creacion`) 
VALUES (1, 'Final', '2014-12-14'), (2, 'UPS', '2014-12-15'), ( 3,'Rubro', '2015-02-22'), ( 4,'Eliminar', '2015-02-23');

ALTER TABLE `clientes` DROP FOREIGN KEY `fk_clientes_1`; ALTER TABLE `clientes` 
ADD CONSTRAINT `fk_clientes_1` FOREIGN KEY (`idrubro`)
 REFERENCES `bd_qcc`.`rubros_clientes`(`idrubro`) ON DELETE CASCADE ON UPDATE CASCADE;



---Lunes 6 de Abril
ALTER TABLE `contactos` ADD `activo` INT NOT NULL DEFAULT '1' ;


---Domingo 12 de Abril

CREATE TABLE IF NOT EXISTS `contactos_cargos` (
`idcontacto_cargo` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `contactos_cargos`
 ADD PRIMARY KEY (`idcontacto_cargo`);

ALTER TABLE `contactos_cargos`
MODIFY `idcontacto_cargo` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `contactos_cargos` (`idcontacto_cargo`, `cargo`) VALUES
(1, 'Gerente de ventas'),
(2, 'Vendedor');


ALTER TABLE `contactos` DROP FOREIGN KEY `fk_cargo`; 
ALTER TABLE `contactos` ADD CONSTRAINT `fk_cargo` 
FOREIGN KEY (`idcargo`) REFERENCES `bd_qcc`.`contactos_cargos`(`idcontacto_cargo`) 
ON DELETE CASCADE ON UPDATE CASCADE;

