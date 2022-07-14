-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2022 a las 20:08:05
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
  `imagen` varchar(50) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contenedores`
--

INSERT INTO `contenedores` (`id`, `nombre`, `imagen`, `descripcion`) VALUES
(1, 'Contenedor Amarillo (plásticos)', './img/contenedor amarillo.png', 'Todo tipo de envases y productos fabricados con plásticos como botellas, envases de alimentación o bolsas. Las botellas y envases de alimentos deben ser enjuagados y entregados secos.'),
(2, 'Contenedor Azul (papel y cartón)', './img/contenedor azul.png', 'Se deposita todo tipo de papeles y cartones, como cajas o envases de alimentos. Periódicos, revistas, papeles de envolver o folletos publicitarios entre otros. Es recomendable plegar correctamente las cajas y envases para almacenar la más residuos.'),
(3, 'Contenedor Cafe oscuro (Desechos orgánicos)', './img/contenedor cafe.png', 'Se depositan restos de alimentos como pieles de frutas, espinas de pescado, plantas, cáscaras de huevo o posos; o servilletas y papel de cocina usados. No depositar objetos de cerámica, pañales, colillas, chicles, toallitas húmedas, arena para mascotas, pelo, etc.'),
(4, 'Contenedor Beige (Cartón para bebidas)', './img/contenedor cafe claro.png', 'Se depositan todos los envases de cartón (treta pack) que contienen refrescos, leches, bebidas alcohólicas y alimentos.'),
(5, 'Contenedor gris claro (Metales)', './img/contenedor gris claro.png', 'Se depositan latas de conservas y de refrescos. Deben ser enjuagados y secados para su depósito.'),
(6, 'Contenedor gris oscuro (Restos de residuos', './img/contenedor gris oscuro.png', 'Se depositan los residuos que no pueden ser reciclados o que el mercado aún no está establecido.'),
(7, 'Contenedor Burdeo (Aparatos eléctricos', './img/contenedor purpura.png', 'Se depositan electrodomésticos voluminosos, audio y video, computación y electrodomésticos pequeños.'),
(8, 'Contenedor Rojo (Desechos peligrosos)', './img/contenedor rojo.png', 'Son considerados para almacenar residuos peligrosos como baterías, pilas, aceites o medicamentos.'),
(9, 'Contenedor Verde (vidrio)', './img/contenedor verde.png', 'Se depositan envases de vidrio, como botellas de bebidas alcohólicas, refresco y agua. No usar para cerámica o cristal.');

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
(16, 18, 0);

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
(801, 18, 1, 0, 0),
(802, 18, 2, 0, 0),
(803, 18, 3, 0, 0),
(804, 18, 4, 0, 0),
(805, 18, 5, 0, 0),
(806, 18, 6, 0, 0),
(807, 18, 7, 0, 0),
(808, 18, 8, 0, 0),
(809, 18, 9, 0, 0),
(810, 18, 10, 0, 0),
(811, 18, 11, 0, 0),
(812, 18, 12, 0, 0),
(813, 18, 13, 0, 0),
(814, 18, 14, 0, 0),
(815, 18, 15, 0, 0),
(816, 18, 16, 0, 0),
(817, 18, 17, 0, 0),
(818, 18, 18, 0, 0),
(819, 18, 19, 0, 0),
(820, 18, 20, 0, 0),
(821, 18, 21, 0, 0),
(822, 18, 22, 0, 0),
(823, 18, 23, 0, 0),
(824, 18, 24, 0, 0),
(825, 18, 25, 0, 0),
(826, 18, 26, 0, 0),
(827, 18, 27, 0, 0),
(828, 18, 28, 0, 0),
(829, 18, 29, 0, 0),
(830, 18, 30, 0, 0),
(831, 18, 31, 0, 0),
(832, 18, 32, 0, 0),
(833, 18, 33, 0, 0),
(834, 18, 34, 0, 0),
(835, 18, 35, 0, 0),
(836, 18, 36, 0, 0),
(837, 18, 37, 0, 0),
(838, 18, 38, 0, 0),
(839, 18, 39, 0, 0),
(840, 18, 40, 0, 0),
(841, 18, 41, 0, 0),
(842, 18, 42, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contrasena`) VALUES
(18, 'ejemplo', 'ejemplo', 'ejemplo@ejemplo', '$2y$10$eAo5T7mtMDMmqq1zYaInnOHSG2KBeQEsAuHc26oM7ETi7HEMMKsie');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rendimiento`
--
ALTER TABLE `rendimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=843;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
