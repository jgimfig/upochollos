-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-12-2020 a las 14:08:37
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `upochollo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

CREATE TABLE `anuncio` (
  `id` int(11) NOT NULL,
  `titulo` varchar(32) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `cif_patrocinador` varchar(9) NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `descripcion` varchar(124) NOT NULL,
  `contenido_multimedia` varchar(64) DEFAULT NULL,
  `cuantia` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`id`, `titulo`, `fecha_inicio`, `cif_patrocinador`, `fecha_fin`, `descripcion`, `contenido_multimedia`, `cuantia`) VALUES
(5, 'Nueva apple store', '2020-05-05', '6545353', NULL, 'Los iPas más tochos que hayamos hecho nunca', '51a33136-994e-4e58-a55d-8140c66945eb.png', 180),
(6, 'iKea', '2020-05-21', '12345S', '2021-12-05', 'Unos muebles muy mueblosos', '9f47cc13-11a9-4a9b-afac-4a65a2cf9d0d.png', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `nombre` varchar(32) NOT NULL,
  `color_borde` varchar(32) DEFAULT NULL,
  `color_fondo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`nombre`, `color_borde`, `color_fondo`) VALUES
('Alimentacion', '376C01', 'DBFAD9'),
('Deportes', '966900', 'FFF4D9'),
('Hogar', '8f5300', 'edddc7'),
('Informatica', '01216c', 'd9f8fa'),
('Música', '8a0019', 'ffb5c3'),
('Viajes', '00a6a6', 'adffff'),
('Videojuegos', '00a648', 'adffd1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `texto` varchar(124) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon`
--

CREATE TABLE `cupon` (
  `id` int(11) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `codigo` varchar(124) NOT NULL,
  `fecha_publicado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_vencimiento` date DEFAULT NULL,
  `descripcion` varchar(124) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupon`
--

INSERT INTO `cupon` (`id`, `nombre`, `codigo`, `fecha_publicado`, `fecha_vencimiento`, `descripcion`) VALUES
(2, '  Oferta primavera APPLE ', '  XXX-YYY-ZZZ ', '2020-04-22 22:00:00', '2023-07-21', '  Apple ofrece un descuento del 10% a los que usen este cupón '),
(3, '    NIKE SUPER DEAL  ', '    NNN-YYY-III-XXX  ', '2020-04-22 22:00:00', '2023-01-21', '    NIKE ofrece un descuento para aquellos que se levanten con el pie izquierdo.  '),
(6, 'Test', 'codigo-cupon', '2020-06-21 22:00:00', '2020-11-11', 'ER CUPONASO DE LA ONSE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinador`
--

CREATE TABLE `patrocinador` (
  `cif` varchar(9) NOT NULL,
  `nombre` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `patrocinador`
--

INSERT INTO `patrocinador` (`cif`, `nombre`) VALUES
('12345S', 'Eustakio'),
('6545353', 'Apple');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `enlace` varchar(255) NOT NULL,
  `precio_original` float NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `fecha_publicado` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_vencimiento` date DEFAULT NULL,
  `precio_descuento` float NOT NULL,
  `descripcion` varchar(140) NOT NULL,
  `imagen` varchar(64) NOT NULL,
  `usuario` varchar(32) NOT NULL,
  `nombre_categoria` varchar(32) DEFAULT NULL,
  `nombre_tienda` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `enlace`, `precio_original`, `nombre`, `fecha_publicado`, `fecha_vencimiento`, `precio_descuento`, `descripcion`, `imagen`, `usuario`, `nombre_categoria`, `nombre_tienda`) VALUES
(7, 'https://www.carrefour.es/', 4, 'Taza azul', '2020-04-22 11:37:18', '2021-12-31', 2, 'Es una taza y es azul.', 'taza.jpg', 'patri', 'Hogar', 'Carrefour'),
(8, 'https://www.carrefour.es/', 30, 'Mochila de colegial', '2020-04-22 11:39:14', '2021-05-28', 15, 'Mochila marron, muy marron', 'mochila.jpg', 'patri', 'Deportes', 'Carrefour'),
(13, 'https://www.spotify.com/es/', 30, 'La Rosalia Trá Trá', '2020-05-21 10:06:29', '2020-06-30', 20, 'Disco que se escucha Malamente', '7a82b26d-9c33-4f5d-9abf-dd44325f9e65.png', 'patri', 'Música', 'Patria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntua`
--

CREATE TABLE `puntua` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre_usuario` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `nombre` varchar(32) NOT NULL,
  `logo` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`nombre`, `logo`) VALUES
('Adrictos', 'adrictos.png'),
('Ana-lytics', 'ana-lytics.png'),
('Apple', 'apple.png'),
('Carrefour', 'carrefour.png'),
('Ivan y venian', 'ivan_y_venian.png'),
('Patria', 'patria.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `hash` varchar(160) NOT NULL,
  `foto` varchar(64) DEFAULT NULL,
  `tipo` varchar(32) NOT NULL DEFAULT 'estandar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario`, `email`, `hash`, `foto`, `tipo`) VALUES
('javi', 'javi@gmail.com', 'javi', NULL, 'estandar'),
('juancarlos', 'juancarlos@gmail.com', 'juancarlos', NULL, 'estandar'),
('patri', 'patri@gmail.com', 'patri', NULL, 'estandar'),
('pepe', '', 'pepe', NULL, 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cif_patrocinador` (`cif_patrocinador`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `patrocinador`
--
ALTER TABLE `patrocinador`
  ADD PRIMARY KEY (`cif`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nombre_tienda` (`nombre_tienda`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `nombre_categoria` (`nombre_categoria`);

--
-- Indices de la tabla `puntua`
--
ALTER TABLE `puntua`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `nombre_usuario` (`nombre_usuario`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncio`
--
ALTER TABLE `anuncio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `puntua`
--
ALTER TABLE `puntua`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `cif_patrocinador` FOREIGN KEY (`cif_patrocinador`) REFERENCES `patrocinador` (`cif`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`nombre_tienda`) REFERENCES `tienda` (`nombre`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`usuario`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`nombre_categoria`) REFERENCES `categoria` (`nombre`);

--
-- Filtros para la tabla `puntua`
--
ALTER TABLE `puntua`
  ADD CONSTRAINT `puntua_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `puntua_ibfk_2` FOREIGN KEY (`nombre_usuario`) REFERENCES `usuario` (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
