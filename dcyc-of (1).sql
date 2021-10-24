-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-08-2021 a las 15:54:24
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dcyc-of`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones`
--

CREATE TABLE IF NOT EXISTS `condiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuit` varchar(11) NOT NULL,
  `iibb` varchar(11) NOT NULL,
  `razon_social` varchar(128) NOT NULL DEFAULT '',
  `ultimo_padron_arba` date DEFAULT NULL,
  `ret_filesize_padron_arba` mediumtext,
  `ret_curpos_padron_arba` mediumtext,
  `last_activity_padron_arba` mediumtext,
  `per_curpos_padron_arba` mediumtext,
  `per_filesize_padron_arba` mediumtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cuit` varchar(11) NOT NULL,
  `iibb` varchar(11) NOT NULL,
  `condicion_id` int(11) NOT NULL,
  `razon_social` varchar(64) NOT NULL,
  `nombre_fantasia` varchar(64) DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `domicilio` varchar(64) DEFAULT NULL,
  `telefono` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `fecha_alta` datetime NOT NULL,
  `usuario_alta_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_alta_id` (`usuario_alta_id`),
  KEY `pais_id` (`pais_id`,`provincia_id`),
  KEY `condicion_id` (`condicion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compras`
--

CREATE TABLE IF NOT EXISTS `facturas_compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letra_comprobante` varchar(1) NOT NULL,
  `numero_comprobante` varchar(32) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha_comprobante` date NOT NULL,
  `descripcion` varchar(256) NOT NULL DEFAULT '',
  `importe_neto` decimal(10,2) NOT NULL,
  `importe_pagado` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `proveedor_id` (`proveedor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4835 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_ventas`
--

CREATE TABLE IF NOT EXISTS `facturas_ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `letra_comprobante` varchar(1) NOT NULL,
  `numero_comprobante` varchar(32) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha_comprobante` date NOT NULL,
  `importe_neto` decimal(10,2) NOT NULL,
  `importe_iva10` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_iva21` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_iva27` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_nograv` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_percepcion1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_percepcion2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_percepcion3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `importe_percepcion4` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado_id` int(11) NOT NULL DEFAULT '1',
  `descripcion` varchar(256) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `cliente_id` (`cliente_id`),
  KEY `estado_id` (`estado_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_ventas_estados`
--

CREATE TABLE IF NOT EXISTS `facturas_ventas_estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_pagos`
--

CREATE TABLE IF NOT EXISTS `ordenes_pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `importe_neto` decimal(10,2) NOT NULL,
  `importe_retencion1` decimal(10,2) DEFAULT NULL,
  `importe_retencion2` decimal(10,2) DEFAULT NULL,
  `importe_retencion3` decimal(10,2) DEFAULT NULL,
  `importe_retencion4` decimal(10,2) DEFAULT NULL,
  `alicuota1` decimal(10,2) DEFAULT NULL,
  `alicuota2` decimal(10,2) DEFAULT NULL,
  `alicuota3` decimal(10,2) DEFAULT NULL,
  `alicuota4` decimal(10,2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `certificado_retencion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4514 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes_pagos_facturas`
--

CREATE TABLE IF NOT EXISTS `ordenes_pagos_facturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pago_id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pago_id` (`pago_id`),
  KEY `factura_id` (`factura_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4549 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `padron_arba`
--

CREATE TABLE IF NOT EXISTS `padron_arba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `cuit` varchar(11) NOT NULL,
  `alicuota_percepcion` decimal(10,2) NOT NULL DEFAULT '0.00',
  `alicuota_retencion` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `fecha` (`fecha`,`cuit`),
  KEY `cuit` (`cuit`,`fecha`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54029335 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais_id` int(11) NOT NULL,
  `descripcion` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pais_id` (`pais_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) DEFAULT NULL,
  `nombre` varchar(64) DEFAULT NULL,
  `perfil` int(11) NOT NULL,
  `fecha_alta` datetime NOT NULL,
  `fecha_baja` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `empresas_ibfk_1` FOREIGN KEY (`usuario_alta_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `empresas_ibfk_2` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`),
  ADD CONSTRAINT `empresas_ibfk_3` FOREIGN KEY (`pais_id`, `provincia_id`) REFERENCES `provincias` (`pais_id`, `id`),
  ADD CONSTRAINT `empresas_ibfk_4` FOREIGN KEY (`condicion_id`) REFERENCES `condiciones` (`id`);

--
-- Filtros para la tabla `facturas_compras`
--
ALTER TABLE `facturas_compras`
  ADD CONSTRAINT `facturas_compras_ibfk_1` FOREIGN KEY (`proveedor_id`) REFERENCES `empresas` (`id`);

--
-- Filtros para la tabla `facturas_ventas`
--
ALTER TABLE `facturas_ventas`
  ADD CONSTRAINT `facturas_ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `empresas` (`id`),
  ADD CONSTRAINT `facturas_ventas_ibfk_2` FOREIGN KEY (`estado_id`) REFERENCES `facturas_ventas_estados` (`id`);

--
-- Filtros para la tabla `ordenes_pagos_facturas`
--
ALTER TABLE `ordenes_pagos_facturas`
  ADD CONSTRAINT `ordenes_pagos_facturas_ibfk_1` FOREIGN KEY (`pago_id`) REFERENCES `ordenes_pagos` (`id`),
  ADD CONSTRAINT `ordenes_pagos_facturas_ibfk_2` FOREIGN KEY (`factura_id`) REFERENCES `facturas_compras` (`id`);

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
