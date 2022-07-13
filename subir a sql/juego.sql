-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2022 a las 17:11:44
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juego`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenedores`
--

CREATE TABLE `contenedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenedores`
--

INSERT INTO `contenedores` (`id`, `nombre`, `imagen`) VALUES
(1, 'amarillo', './img/contenedor amarillo.png'),
(2, 'azul', './img/contenedor azul.png'),
(3, 'cafe', './img/contenedor cafe.png'),
(4, 'cafe claro', './img/contenedor cafe claro.png'),
(5, 'gris claro', './img/contenedor gris claro.png'),
(6, 'gris oscuro', './img/contenedor gris oscuro.png'),
(7, 'purpura', './img/contenedor purpura.png'),
(8, 'rojo', './img/contenedor rojo.png'),
(9, 'verde', './img/contenedor verde.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `idContenedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`id`, `nombre`, `imagen`, `idContenedor`) VALUES
(1, 'aceite', './img/aceite.png', 8),
(2, 'arena de mascota', './img/arena de mascota.png', 6),
(3, 'bateria', './img/bateria.png', 8),
(4, 'bolsa plastico', './img/bolsa plastico.png', 1),
(5, 'botella de vidrio', './img/botella de vidrio.png', 9),
(6, 'botella de vidrio bebida', './img/botella de vidrio bebida.png', 9),
(7, 'botella vino', './img/botella vino.png', 9),
(8, 'caja', './img/caja.png', 2),
(9, 'cascara huevo', './img/cascara huevo.png', 3),
(10, 'celular', './img/celular.png', 7),
(11, 'ceramica', './img/ceramica.png', 6),
(12, 'colilla cigarro', './img/colilla cigarro.png', 6),
(13, 'envase carton', './img/envase carton.png', 2),
(14, 'envase de plastico agua', './img/envase de plastico agua.png', 1),
(15, 'envase plastico comida', './img/envase plastico comida.png', 1),
(16, 'envases de vidrio', './img/envases de vidrio.png', 9),
(17, 'envoltorios', './img/envoltorios.png', 6),
(18, 'espina pescado', './img/espina pescado.png', 3),
(19, 'folleto', './img/folleto.png', 2),
(20, 'laptop', './img/laptop.png', 7),
(21, 'lata conserva', './img/lata conserva.png', 5),
(22, 'lata de atun', './img/lata de atun.png', 5),
(23, 'lata de bebida', './img/lata de bebida.png', 5),
(24, 'lata de cerveza', './img/lata de cerveza.png', 5),
(25, 'manzana', './img/manzana.png', 3),
(26, 'mascarilla', './img/mascarilla.png', 6),
(27, 'medicamentos', './img/medicamentos.png', 8),
(28, 'medicamentos 2', './img/medicamentos 2.png', 8),
(29, 'pañal', './img/pañal.png', 6),
(30, 'papel', './img/papel.png', 2),
(31, 'papel de colores', './img/papel de colores.png', 2),
(32, 'parlante bluetooth', './img/parlante bluetooth.png', 7),
(33, 'pasta dental', './img/pasta dental.png', 6),
(34, 'periodico', './img/periodico.png', 2),
(35, 'pilas', './img/pilas.png', 8),
(36, 'servilleta', './img/servilleta.png', 3),
(37, 'teclado', './img/teclado.png', 7),
(38, 'tetrapack desconocido', './img/tetrapack desconocido.png', 4),
(39, 'tetrapack jugo', './img/tetrapack jugo.png', 4),
(40, 'tetrapack leche', './img/tetrapack leche.png', 4),
(41, 'tetrapack leche 2', './img/tetrapack leche 2.png', 4),
(42, 'vasos plasticos', './img/vasos plasticos.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `puntajeMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntajes`
--

INSERT INTO `puntajes` (`id`, `idUsuario`, `puntajeMax`) VALUES
(1, 1, 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendimiento`
--

CREATE TABLE `rendimiento` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idMaterial` int(11) NOT NULL,
  `frecuenciaJuego` int(11) NOT NULL,
  `frecuenciaIncorrecta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rendimiento`
--

INSERT INTO `rendimiento` (`id`, `idUsuario`, `idMaterial`, `frecuenciaJuego`, `frecuenciaIncorrecta`) VALUES
(171, 1, 1, 0, 0),
(172, 1, 2, 0, 0),
(173, 1, 3, 1, 0),
(174, 1, 4, 0, 0),
(175, 1, 5, 1, 0),
(176, 1, 6, 1, 0),
(177, 1, 7, 1, 0),
(178, 1, 8, 1, 0),
(179, 1, 9, 4, 0),
(180, 1, 10, 1, 0),
(181, 1, 11, 0, 0),
(182, 1, 12, 2, 0),
(183, 1, 13, 1, 0),
(184, 1, 14, 2, 0),
(185, 1, 15, 1, 0),
(186, 1, 16, 2, 0),
(187, 1, 17, 1, 0),
(188, 1, 18, 1, 0),
(189, 1, 19, 1, 0),
(190, 1, 20, 0, 0),
(191, 1, 21, 0, 0),
(192, 1, 22, 3, 0),
(193, 1, 23, 1, 0),
(194, 1, 24, 1, 0),
(195, 1, 25, 2, 0),
(196, 1, 26, 0, 0),
(197, 1, 27, 0, 0),
(198, 1, 28, 3, 0),
(199, 1, 29, 0, 0),
(200, 1, 30, 1, 1),
(201, 1, 31, 2, 0),
(202, 1, 32, 2, 0),
(203, 1, 33, 1, 0),
(204, 1, 34, 3, 0),
(205, 1, 35, 0, 0),
(206, 1, 36, 2, 0),
(207, 1, 37, 1, 0),
(208, 1, 38, 1, 0),
(209, 1, 39, 0, 0),
(210, 1, 40, 3, 0),
(211, 1, 41, 1, 0),
(212, 1, 42, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contrasena`) VALUES
(1, 'olver', 'arce', 'olver@arce', '123456');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenedores`
--
ALTER TABLE `contenedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idMaterial` (`idMaterial`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contenedores`
--
ALTER TABLE `contenedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntajes_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  ADD CONSTRAINT `rendimiento_ibfk_1` FOREIGN KEY (`idMaterial`) REFERENCES `material` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rendimiento_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
