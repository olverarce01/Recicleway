-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-07-2022 a las 14:10:12
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
  `contenedor` varchar(50) NOT NULL,
  `imagenContenedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenedores`
--

INSERT INTO `contenedores` (`contenedor`, `imagenContenedor`) VALUES
('amarillo', './img/contenedor amarillo.png'),
('azul', './img/contenedor azul.png'),
('cafe', './img/contenedor cafe.png'),
('cafe claro', './img/contenedor cafe claro.png'),
('gris claro', './img/contenedor gris claro.png'),
('gris oscuro', './img/contenedor gris oscuro.png'),
('purpura', './img/contenedor purpura.png'),
('rojo', './img/contenedor rojo.png'),
('verde', './img/contenedor verde.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `nombreMaterial` varchar(50) NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `contenedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`nombreMaterial`, `imagen`, `contenedor`) VALUES
('aceite', './img/aceite.png', 'rojo'),
('arena de mascota', './img/arena de mascota.png', 'gris oscuro'),
('bateria', './img/bateria.png', 'rojo'),
('bolsa plastico', './img/bolsa plastico.png', 'amarillo'),
('botella de vidrio', './img/botella de vidrio.png', 'verde'),
('botella de vidrio bebida', './img/botella de vidrio bebida.png', 'verde'),
('botella vino', './img/botella vino.png', 'verde'),
('caja', './img/caja.png', 'azul'),
('cascara huevo', './img/cascara huevo.png', 'cafe'),
('celular', './img/celular.png', 'purpura'),
('ceramica', './img/ceramica.png', 'gris oscuro'),
('colilla cigarro', './img/colilla cigarro.png', 'gris oscuro'),
('envase carton', './img/envase carton.png', 'azul'),
('envase de plastico agua', './img/envase de plastico agua.png', 'amarillo'),
('envase plastico comida', './img/envase plastico comida.png', 'amarillo'),
('envases de vidrio', './img/envases de vidrio.png', 'verde'),
('envoltorios', './img/envoltorios.png', 'gris oscuro'),
('espina pescado', './img/espina pescado.png', 'cafe'),
('folleto', './img/folleto.png', 'azul'),
('laptop', './img/laptop.png', 'purpura'),
('lata conserva', './img/lata conserva.png', 'gris claro'),
('lata de atun', './img/lata de atun.png', 'gris claro'),
('lata de bebida', './img/lata de bebida.png', 'gris claro'),
('lata de cerveza', './img/lata de cerveza.png', 'gris claro'),
('manzana', './img/manzana.png', 'cafe'),
('mascarilla', './img/mascarilla.png', 'gris oscuro'),
('medicamentos', './img/medicamentos.png', 'rojo'),
('medicamentos 2', './img/medicamentos 2.png', 'rojo'),
('pañal', './img/pañal.png', 'gris oscuro'),
('papel', './img/papel.png', 'azul'),
('papel de colores', './img/papel de colores.png', 'azul'),
('parlante bluetooth', './img/parlante bluetooth.png', 'purpura'),
('pasta dental', './img/pasta dental.png', 'gris oscuro'),
('periodico', './img/periodico.png', 'azul'),
('pilas', './img/pilas.png', 'rojo'),
('servilleta', './img/servilleta.png', 'cafe'),
('teclado', './img/teclado.png', 'purpura'),
('tetrapack desconocido', './img/tetrapack desconocido.png', 'cafe claro'),
('tetrapack jugo', './img/tetrapack jugo.png', 'cafe claro'),
('tetrapack leche', './img/tetrapack leche.png', 'cafe claro'),
('tetrapack leche 2', './img/tetrapack leche 2.png', 'cafe claro'),
('vasos plasticos', './img/vasos plasticos.png', 'amarillo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntajes`
--

CREATE TABLE `puntajes` (
  `correo` varchar(50) NOT NULL,
  `puntajeMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puntajes`
--

INSERT INTO `puntajes` (`correo`, `puntajeMax`) VALUES
('jose@limache', 25),
('olver@arce', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendimiento`
--

CREATE TABLE `rendimiento` (
  `idRegistro` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `nombreMaterial` varchar(50) NOT NULL,
  `frecuenciaJuego` int(11) NOT NULL,
  `frecuenciaIncorrecta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rendimiento`
--

INSERT INTO `rendimiento` (`idRegistro`, `correo`, `nombreMaterial`, `frecuenciaJuego`, `frecuenciaIncorrecta`) VALUES
(3, 'olver@arce', 'aceite', 2, 1),
(4, 'olver@arce', 'arena de mascota', 2, 0),
(5, 'olver@arce', 'bateria', 3, 0),
(6, 'olver@arce', 'bolsa plastico', 5, 0),
(7, 'olver@arce', 'botella de vidrio', 1, 0),
(8, 'olver@arce', 'botella de vidrio bebida', 4, 0),
(9, 'olver@arce', 'botella vino', 8, 1),
(10, 'olver@arce', 'caja', 8, 1),
(11, 'olver@arce', 'cascara huevo', 2, 0),
(12, 'olver@arce', 'celular', 3, 0),
(13, 'olver@arce', 'ceramica', 1, 0),
(14, 'olver@arce', 'colilla cigarro', 2, 0),
(15, 'olver@arce', 'envase carton', 2, 0),
(16, 'olver@arce', 'envase de plastico agua', 6, 2),
(17, 'olver@arce', 'envase plastico comida', 0, 0),
(18, 'olver@arce', 'envases de vidrio', 2, 0),
(19, 'olver@arce', 'envoltorios', 4, 0),
(20, 'olver@arce', 'espina pescado', 5, 0),
(21, 'olver@arce', 'folleto', 0, 0),
(22, 'olver@arce', 'laptop', 3, 2),
(23, 'olver@arce', 'lata conserva', 3, 0),
(24, 'olver@arce', 'lata de atun', 2, 1),
(25, 'olver@arce', 'lata de bebida', 0, 0),
(26, 'olver@arce', 'lata de cerveza', 1, 0),
(27, 'olver@arce', 'manzana', 6, 2),
(28, 'olver@arce', 'mascarilla', 3, 0),
(29, 'olver@arce', 'medicamentos', 2, 0),
(30, 'olver@arce', 'medicamentos 2', 1, 1),
(31, 'olver@arce', 'pañal', 0, 0),
(32, 'olver@arce', 'papel', 4, 3),
(33, 'olver@arce', 'papel de colores', 1, 0),
(34, 'olver@arce', 'parlante bluetooth', 0, 1),
(35, 'olver@arce', 'pasta dental', 4, 0),
(36, 'olver@arce', 'periodico', 6, 0),
(37, 'olver@arce', 'pilas', 3, 1),
(38, 'olver@arce', 'servilleta', 4, 0),
(39, 'olver@arce', 'teclado', 6, 0),
(40, 'olver@arce', 'tetrapack desconocido', 5, 1),
(41, 'olver@arce', 'tetrapack jugo', 2, 1),
(42, 'olver@arce', 'tetrapack leche', 2, 0),
(43, 'olver@arce', 'tetrapack leche 2', 1, 0),
(44, 'olver@arce', 'vasos plasticos', 1, 0),
(45, 'jose@limache', 'aceite', 4, 1),
(46, 'jose@limache', 'arena de mascota', 2, 0),
(47, 'jose@limache', 'bateria', 3, 0),
(48, 'jose@limache', 'bolsa plastico', 2, 0),
(49, 'jose@limache', 'botella de vidrio', 1, 0),
(50, 'jose@limache', 'botella de vidrio bebida', 2, 0),
(51, 'jose@limache', 'botella vino', 2, 0),
(52, 'jose@limache', 'caja', 2, 0),
(53, 'jose@limache', 'cascara huevo', 3, 1),
(54, 'jose@limache', 'celular', 1, 0),
(55, 'jose@limache', 'ceramica', 2, 0),
(56, 'jose@limache', 'colilla cigarro', 1, 0),
(57, 'jose@limache', 'envase carton', 1, 0),
(58, 'jose@limache', 'envase de plastico agua', 3, 0),
(59, 'jose@limache', 'envase plastico comida', 1, 0),
(60, 'jose@limache', 'envases de vidrio', 4, 0),
(61, 'jose@limache', 'envoltorios', 2, 0),
(62, 'jose@limache', 'espina pescado', 4, 0),
(63, 'jose@limache', 'folleto', 2, 0),
(64, 'jose@limache', 'laptop', 3, 0),
(65, 'jose@limache', 'lata conserva', 1, 0),
(66, 'jose@limache', 'lata de atun', 2, 0),
(67, 'jose@limache', 'lata de bebida', 1, 0),
(68, 'jose@limache', 'lata de cerveza', 2, 0),
(69, 'jose@limache', 'manzana', 2, 0),
(70, 'jose@limache', 'mascarilla', 2, 0),
(71, 'jose@limache', 'medicamentos', 3, 0),
(72, 'jose@limache', 'medicamentos 2', 3, 0),
(73, 'jose@limache', 'pañal', 5, 0),
(74, 'jose@limache', 'papel', 4, 1),
(75, 'jose@limache', 'papel de colores', 0, 0),
(76, 'jose@limache', 'parlante bluetooth', 0, 0),
(77, 'jose@limache', 'pasta dental', 2, 0),
(78, 'jose@limache', 'periodico', 2, 0),
(79, 'jose@limache', 'pilas', 7, 0),
(80, 'jose@limache', 'servilleta', 2, 0),
(81, 'jose@limache', 'teclado', 0, 0),
(82, 'jose@limache', 'tetrapack desconocido', 1, 0),
(83, 'jose@limache', 'tetrapack jugo', 2, 0),
(84, 'jose@limache', 'tetrapack leche', 2, 0),
(85, 'jose@limache', 'tetrapack leche 2', 1, 0),
(86, 'jose@limache', 'vasos plasticos', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellido`, `correo`, `contrasena`) VALUES
('jose', 'limache', 'jose@limache', '123123'),
('olver', 'arce', 'olver@arce', '123123');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contenedores`
--
ALTER TABLE `contenedores`
  ADD PRIMARY KEY (`contenedor`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`nombreMaterial`),
  ADD KEY `contenedor` (`contenedor`);

--
-- Indices de la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD PRIMARY KEY (`correo`),
  ADD KEY `correo` (`correo`);

--
-- Indices de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  ADD PRIMARY KEY (`idRegistro`),
  ADD KEY `nombreMaterial` (`nombreMaterial`),
  ADD KEY `correo` (`correo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  MODIFY `idRegistro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`contenedor`) REFERENCES `contenedores` (`contenedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `puntajes`
--
ALTER TABLE `puntajes`
  ADD CONSTRAINT `puntajes_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `usuarios` (`correo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  ADD CONSTRAINT `rendimiento_ibfk_1` FOREIGN KEY (`correo`) REFERENCES `usuarios` (`correo`) ON DELETE CASCADE,
  ADD CONSTRAINT `rendimiento_ibfk_2` FOREIGN KEY (`nombreMaterial`) REFERENCES `material` (`nombreMaterial`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
