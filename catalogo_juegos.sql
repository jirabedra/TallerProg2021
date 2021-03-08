-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-03-2021 a las 15:21:39
-- Versión del servidor: 5.5.43
-- Versión de PHP: 5.4.4-14+deb7u5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `catalogo_juegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_juego` int(11) NOT NULL,
  `texto` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `puntuacion` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_juego` (`id_juego`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=896 ;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_usuario`, `id_juego`, `texto`, `fecha`, `puntuacion`) VALUES
(890, 2, 2, 'Buenisimo', '2021-03-07', 5),
(891, 1, 2, 'Buenisimo!', '2021-03-08', 3),
(892, 1, 2, 'Buenisimo', '2021-03-08', 5),
(893, 1, 2, 'Clásico', '2021-03-08', 5),
(894, 1, 2, 'Un juegaso', '2021-03-08', 5),
(895, 1, 2, 'No tan bueno', '2021-03-08', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consolas`
--

CREATE TABLE IF NOT EXISTS `consolas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `consolas`
--

INSERT INTO `consolas` (`id`, `nombre`) VALUES
(2, 'PC'),
(3, 'XBOX'),
(4, 'PS2'),
(5, 'PS3'),
(6, 'PS4'),
(7, 'Nintendo switch'),
(8, 'Nintendo DS'),
(9, 'Gameboy advance');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE IF NOT EXISTS `generos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'MMORPG'),
(2, 'Terror'),
(3, 'RPG'),
(4, 'FPS'),
(5, 'MOBA'),
(6, 'Sandbox'),
(7, 'Indie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE IF NOT EXISTS `juegos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `poster` varchar(255) NOT NULL,
  `puntuacion` decimal(10,0) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `empresa` varchar(255) NOT NULL,
  `visualizaciones` int(11) NOT NULL,
  `url_video` varchar(255) NOT NULL,
  `resumen` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `id_genero`, `poster`, `puntuacion`, `fecha_lanzamiento`, `empresa`, `visualizaciones`, `url_video`, `resumen`) VALUES
(1, 'Tetris', 7, '1.jpeg', 0, '1984-06-06', 'RSFS', 821, 'https://www.youtube.com/watch?v=L_UPHsGR6fM', 'Clasico juego de scroll'),
(2, 'World of Warcraft', 1, '2.jpeg', 3, '2004-06-05', 'Blizzard', 63, 'https://www.youtube.com/watch?v=s4gBChg6AII', 'Icono de su genero'),
(3, 'League of Legends', 5, '3.jpeg', 0, '2010-10-10', 'RIOT Games', 1, 'https://www.youtube.com/watch?v=IzMnCv_lPxI', 'Icono de su género'),
(4, 'Untitled goose game', 6, '4.jpeg', 0, '2019-09-20', 'House House', 0, 'https://www.youtube.com/watch?v=9LL2AtHo1gk', 'Un ganso terrible siembra terror en un vecindario. '),
(5, 'GTA V', 4, '5.jpeg', 0, '2013-09-17', 'Rockstar', 0, 'https://www.youtube.com/watch?v=FoaScpGT1GU', 'Revolucionario ejemplo de la saga de GTA.'),
(6, 'Crash Bandicoot 4', 7, '6.jpeg', 0, '2020-10-10', 'Activision', 23, 'https://www.youtube.com/watch?v=LhNAsc5Cq7w', 'Un inesperado regreso del marsupial más querido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos_consolas`
--

CREATE TABLE IF NOT EXISTS `juegos_consolas` (
  `id_juego` int(11) NOT NULL,
  `id_consola` int(11) NOT NULL,
  PRIMARY KEY (`id_juego`,`id_consola`),
  KEY `id_consola` (`id_consola`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `juegos_consolas`
--

INSERT INTO `juegos_consolas` (`id_juego`, `id_consola`) VALUES
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(1, 3),
(5, 3),
(6, 3),
(1, 4),
(4, 5),
(5, 5),
(6, 5),
(2, 6),
(4, 6),
(5, 6),
(6, 6),
(4, 7),
(5, 7),
(6, 7),
(5, 8),
(6, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `es_admin` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `alias`, `password`, `es_admin`) VALUES
(1, 'irabedra@ort', 'Juancho', '12345', 1),
(2, 'barrios@ort', 'JP', '54321', 0),
(3, 'admin', 'admin', 'admin', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `juegos_ibfk_1` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`);

--
-- Filtros para la tabla `juegos_consolas`
--
ALTER TABLE `juegos_consolas`
  ADD CONSTRAINT `juegos_consolas_ibfk_1` FOREIGN KEY (`id_juego`) REFERENCES `juegos` (`id`),
  ADD CONSTRAINT `juegos_consolas_ibfk_2` FOREIGN KEY (`id_consola`) REFERENCES `consolas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
