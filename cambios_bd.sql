
ALTER TABLE `cotizacion_items` CHANGE `imagen` `imagen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;
ALTER TABLE `cotizaciones` ADD `deleted` TINYINT NOT NULL DEFAULT '0' ;