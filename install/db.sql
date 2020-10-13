DROP DATABASE IF EXISTS `db`;

CREATE DATABASE IF NOT EXISTS `db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db`;

--
-- Estructura de tabla para la tabla `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nif` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido1` varchar(255) DEFAULT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `perfil` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `movil` varchar(9) DEFAULT NULL,
  `paginaweb` varchar(255) DEFAULT NULL,
  `blog` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,
  `cursos` varchar(255) DEFAULT NULL,
  `asignaturas` varchar(255) DEFAULT NULL,
  `fecha` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--
INSERT INTO `usuario` 
(`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `username`, `perfil`, `password`, `email`, `fotografia`, `telefono`, `movil`, `paginaweb`, `blog`, `twitter`, `departamento`, `cursos`, `asignaturas`, `fecha`, `activo`) 
VALUES
(0, NULL, '', '', NULL, 'root', 'administrador', '$2y$04$bzD2G5HF0WtH.04a1y2BZ.LB.XMDdX2aucrKM/xgCWF5RtCF89Wd6', 'root@root.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);
