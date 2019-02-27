-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-02-2019 a las 18:41:57
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclo`
--

DROP TABLE IF EXISTS `ciclo`;
CREATE TABLE IF NOT EXISTS `ciclo` (
  `idciclo` int(11) NOT NULL,
  `cicloformativo` varchar(45) DEFAULT NULL,
  `familia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idciclo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
CREATE TABLE IF NOT EXISTS `mensajes` (
  `idMensajes` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) NOT NULL,
  `contenido` varchar(45) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `fechacreacion` datetime NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`idMensajes`,`usuarios_id`),
  KEY `fk_Mensajes_usuarios1_idx` (`usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos_has_usuarios`
--

DROP TABLE IF EXISTS `modulos_has_usuarios`;
CREATE TABLE IF NOT EXISTS `modulos_has_usuarios` (
  `modulos_idmodulos` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  PRIMARY KEY (`modulos_idmodulos`,`usuarios_id`),
  KEY `fk_modulos_has_usuarios_usuarios1_idx` (`usuarios_id`),
  KEY `fk_modulos_has_usuarios_modulos_idx` (`modulos_idmodulos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `apellido1` varchar(45) NOT NULL,
  `apellido2` varchar(45) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `nick` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `movil` int(11) NOT NULL,
  `fijo` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `github` varchar(45) DEFAULT NULL,
  `blog` varchar(45) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL,
  `fechasolic` datetime NOT NULL,
  `formacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `fk_Mensajes_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `modulos_has_usuarios`
--
ALTER TABLE `modulos_has_usuarios`
  ADD CONSTRAINT `fk_modulos_has_usuarios_modulos` FOREIGN KEY (`modulos_idmodulos`) REFERENCES `ciclo` (`idciclo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_modulos_has_usuarios_usuarios1` FOREIGN KEY (`usuarios_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
