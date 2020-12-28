-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2020 a las 13:23:58
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `piggy_cash`
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

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`id`, `id_producto`, `usuario`, `texto`, `fecha`) VALUES
(13, 5, 'ana', 'Me esperaba una mejor batería. Se parece mucho al modelo anterior.', '2020-05-21 10:52:03'),
(14, 6, 'ana', 'No se cómo permiten subir estas cosas. Sois unos vendidos.', '2020-05-21 10:53:21'),
(16, 7, 'ana', 'El color de la taza resalta el color marrón del café', '2020-05-21 11:03:35'),
(17, 15, 'ana', 'Casi me ahogo, no la recomiendo.', '2020-05-21 11:03:56'),
(18, 12, 'ivan', 'Alcanza una velocidad punta brutal, aunque soy más fan de BMW, para el que le guste, es una excelente oferta.', '2020-05-21 11:05:32'),
(19, 13, 'ivan', 'Efectivamente, es tan barato por que se escucha... MALAMENTE. Mu mal mu mal.', '2020-05-21 11:06:49'),
(20, 8, 'ivan', 'Me cabe absolutamente de todo, una gran compra. Que pena no haberla comprado algo más tarde ahora que está de oferta.', '2020-05-21 11:07:44'),
(21, 14, 'patri', 'La calidad de materiales es excelente, me paso el día tocando.', '2020-05-21 11:08:42'),
(22, 12, 'patri', 'Prefiero el serie 3 la verdad.', '2020-05-21 11:09:05'),
(23, 15, 'patri', 'Es bastante amplia y se monta fácilmente, perfecto para chalés con poco patio.  ', '2020-05-21 11:10:19'),
(24, 5, 'adrian', 'La fluidez es increíble, pero 16GB de memoria no dan para mucho :(', '2020-05-21 11:12:45'),
(25, 6, 'adrian', 'Ilumina poco, cosa que por la descripción ya se sabe. Si te sobra el dinero y eres poco espabilado, esta es tu lámpara.', '2020-05-21 11:13:42'),
(26, 12, 'adrian', 'Mientras no haya cargadores rápidos en las gasolineras, es una mala inversión.', '2020-05-21 11:14:16'),
(27, 14, 'adrian', 'El kit es muy completo', '2020-05-21 11:14:41'),
(28, 8, 'adrian', 'El nombre parece sacado de... Animal Crossing¿?', '2020-05-21 11:16:50');

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
(5, 'https://www.apple.com/es/', 660, 'iPhone 8', '2020-04-22 11:32:46', '2021-02-18', 550, 'El iphone 7, ahora un numero más', 'iphone.jpg', 'ana', 'Informatica', NULL),
(6, 'https://www.ikea.com', 20, 'Lampara YONKI', '2020-04-22 11:35:57', '2021-07-23', 10, 'Una lámpara con pocas luces', 'lampara.jpg', 'ivan', 'Hogar', NULL),
(7, 'https://www.carrefour.es/', 4, 'Taza azul', '2020-04-22 11:37:18', '2021-12-31', 2, 'Es una taza y es azul.', 'taza.jpg', 'patri', 'Hogar', 'Carrefour'),
(8, 'https://www.carrefour.es/', 30, 'Mochila de colegial', '2020-04-22 11:39:14', '2021-05-28', 15, 'Mochila marron, muy marron', 'mochila.jpg', 'patri', 'Deportes', 'Carrefour'),
(12, 'www.nada.com', 3000000, 'Coche elestrico', '2020-05-15 11:23:30', '2020-07-24', 110000, 'Erase una vez un tablet pegado a cuatro ruedas', '774ab013-dbf2-4d1a-ba67-65b1f766c4a3.png', 'ana', 'Deportes', NULL),
(13, 'https://www.spotify.com/es/', 30, 'La Rosalia Trá Trá', '2020-05-21 10:06:29', '2020-06-30', 20, 'Disco que se escucha Malamente', '7a82b26d-9c33-4f5d-9abf-dd44325f9e65.png', 'patri', 'Música', 'Patria'),
(14, 'https://www.gear4music.es/es/Guitarra-y-bajo/Set-de-Guitarra-Electrica-New-Jersey-Classic-and-Ampli-de-15-W-Vintage-Sunburst/D5K', 200, 'Pack eléctrico', '2020-05-21 10:25:35', '2020-06-09', 171.5, 'Tan eléctrico que se te cambiará el pelo', 'bc005380-f44d-4548-9f65-5bf9a87e9c01.png', 'ana', 'Música', 'Ana-lytics'),
(15, 'https://www.intex.es/piscinas/desmontables/58983-28270-piscina-small-frame-familiar-220x150x60cm-1662l', 100, 'Piscina profunda', '2020-05-21 10:31:44', '2020-08-13', 78.95, 'Piscina desmontable tubular y procedural', 'bd71fe2e-49b9-419c-a9eb-9126756081e6.png', 'ivan', 'Hogar', NULL);

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

--
-- Volcado de datos para la tabla `puntua`
--

INSERT INTO `puntua` (`id`, `id_producto`, `nombre_usuario`, `puntuacion`) VALUES
(3, 5, 'ivan', 4),
(4, 5, 'ana', 1),
(10, 13, 'patri', 4),
(12, 5, 'patri', 5),
(13, 15, 'ivan', 5),
(15, 14, 'patri', 5),
(16, 12, 'patri', 3),
(17, 6, 'adrian', 3),
(18, 5, 'adrian', 5),
(19, 13, 'adrian', 2),
(20, 15, 'adrian', 3),
(21, 8, 'adrian', 3);

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
('adrian', 'adrian@gmail.com', 'adrian', 'adrian.png', 'estandar'),
('ana', '', 'ana', 'ana.png', 'admin'),
('ivan', 'ivan@gmail.com', 'ivan', 'ivan.png', 'estandar'),
('patri', 'patris@gmail.com', 'patri', 'patri.png', 'estandar'),
('usuariotest', 'test@test.com', '123', NULL, 'estandar');

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
