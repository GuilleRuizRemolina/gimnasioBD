/********************************
Autor: Guillermo Ruiz Remolina
Fecha creación: 30/11/2020
Última modificación: 16/12/2020
Versión: 1.00

#baseDatos.sql
Fichero con el código sql para crear la base de datos del gimnasio
**********************************/

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-12-2020 a las 19:17:18
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gimnasio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `aforo` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `nombre`, `descripcion`, `aforo`) VALUES
(1, 'Crossfit', 'A levantar cosas', 10),
(2, 'Zumba', 'A bailar', 20),
(3, 'Boxeo', 'A golpear cosas', 4),
(4, 'Aerobic', 'A sudar', 20),
(5, 'Pesas', 'A levantar cosas', 24),
(6, 'Correr', 'A correr muy rapido', 50),
(7, 'Fitness', 'A hacer cosas de fitness', 5),
(9, 'Comba', 'A saltar un monton', 4),
(10, 'BodyCombat', 'A bailar pero como si estuvieras peleando', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(5) NOT NULL,
  `tramo_id` int(5) NOT NULL,
  `usuario_id` int(5) NOT NULL,
  `fecha_reserva` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `tramo_id`, `usuario_id`, `fecha_reserva`) VALUES
(1, 32, 2, '16/12/2020'),
(2, 11, 2, '16/12/2020'),
(3, 20, 2, '16/12/2020'),
(4, 14, 2, '16/12/2020'),
(5, 32, 3, '16/12/2020'),
(6, 11, 3, '16/12/2020'),
(7, 27, 3, '16/12/2020'),
(8, 10, 4, '16/12/2020'),
(9, 32, 4, '16/12/2020'),
(10, 28, 4, '16/12/2020'),
(11, 8, 6, '16/12/2020'),
(12, 32, 6, '16/12/2020'),
(13, 17, 6, '16/12/2020'),
(14, 20, 6, '16/12/2020'),
(15, 18, 8, '16/12/2020'),
(16, 32, 8, '16/12/2020'),
(17, 28, 8, '16/12/2020'),
(18, 20, 8, '16/12/2020'),
(19, 20, 9, '16/12/2020'),
(20, 32, 9, '16/12/2020'),
(21, 35, 9, '16/12/2020'),
(22, 32, 10, '16/12/2020'),
(23, 11, 10, '16/12/2020'),
(24, 31, 10, '16/12/2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tramos`
--

CREATE TABLE `tramos` (
  `id` int(5) NOT NULL,
  `dia` varchar(10) NOT NULL,
  `hora_inicio` int(2) NOT NULL,
  `actividad_id` int(5) NOT NULL,
  `fecha_alta` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tramos`
--

INSERT INTO `tramos` (`id`, `dia`, `hora_inicio`, `actividad_id`, `fecha_alta`) VALUES
(3, 'Jueves', 18, 3, '4/12/2020'),
(4, 'Jueves', 15, 1, '4/12/2020'),
(5, 'Jueves', 18, 3, '4/12/2020'),
(8, 'Viernes', 7, 4, '04/12/2020'),
(9, 'Sábado', 11, 5, '12/12/2020'),
(10, 'Sábado', 12, 1, '12/12/2020'),
(11, 'Miércoles', 7, 2, '04/12/2020'),
(12, 'Martes', 12, 7, '12/12/2020'),
(14, 'Lunes', 18, 3, '13/12/2020'),
(16, 'Miércoles', 21, 3, '13/12/2020'),
(17, 'Jueves', 22, 2, '13/12/2020'),
(18, 'Jueves', 10, 6, '13/12/2020'),
(19, 'Lunes', 10, 9, '14/12/2020'),
(20, 'Miércoles', 14, 7, '14/12/2020'),
(27, 'Viernes', 21, 7, '16/12/2020'),
(28, 'Sábado', 19, 9, '16/12/2020'),
(29, 'Lunes', 12, 4, '16/12/2020'),
(30, 'Lunes', 22, 10, '16/12/2020'),
(31, 'Martes', 16, 6, '16/12/2020'),
(32, 'Lunes', 7, 10, '16/12/2020'),
(33, 'Martes', 9, 4, '16/12/2020'),
(34, 'Martes', 19, 10, '16/12/2020'),
(35, 'Viernes', 15, 10, '16/12/2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(8) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido1` varchar(20) NOT NULL,
  `apellido2` varchar(20) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `usuarioLogin` varchar(20) NOT NULL,
  `contrasena` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefono` int(12) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `rol` varchar(1) NOT NULL,
  `logado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `imagen`, `usuarioLogin`, `contrasena`, `email`, `telefono`, `direccion`, `rol`, `logado`) VALUES
(1, '49119440L', 'Guillermo', 'Ruiz', 'Remolina', '1608139183-admin.png', 'gui888', 'contraseña', 'grrem99@gmail.com', 665300705, 'c/Reyes Católicos 36 B', 'A', 1),
(2, '76593587E', 'Daniel', 'Pedraza', 'Gómez', '1608140220-chrome_m05PS6vRit.png', 'daniel99', 'daniel99', 'danielPie@gamil.com', 664876123, 'c/Amadia Mantrus 12D', 'S', 0),
(3, '43875639G', 'Ana', 'Romero', 'Rodríguez', '1608140311-chrome_BZtTDsrabf.png', 'ana56', 'anaana', 'anasuperfeliz@gmail.com', 876231908, 'c/San junipero 5 B', 'S', 0),
(4, '87644598D', 'Matt', 'Smith', 'Douglas', '1608140413-chrome_oQZ3xYfMtQ.png', 'mattyeah', 'matt', 'matentrenaduro@gmail.com', 989654376, 'c/Esperanza 23 A', 'S', 0),
(5, '76539723U', 'Ursula', 'Fariksen', 'Ouths', '1608140534-chrome_FTNJ0bMjon.png', 'ursu8899', 'ursulaursula', 'ursulaRosas@hotmail.com', 764876419, 'c/Prado del Orgullo 12 B', 'S', 0),
(6, '88765432J', 'Marta', 'Prieto', 'Álvarez', '1608140623-chrome_tExjbaIHcl.png', 'martalamaschula', 'marta8888', 'martalamaschula@gmail.com', 789453119, 'c/Villa Conchita 12 E', 'S', 0),
(7, '98746532G', 'Miguel', 'Gimeno', 'Roble', '1608140826-chrome_AhNVw4dB1Z.png', 'miguelvidaalegre', 'mikimiki88', 'miguelfeliz@gmail.com', 989756175, 'c/Plaza del toro 45A', 'S', 0),
(8, '67543289K', 'Hernesto', 'Surtidor', 'Sueños', '1608140914-chrome_vxgUok29Ds.png', 'hernestopoesia', 'poesia88', 'hernestopoesisa@gmail.com', 986476123, 'c/Ruta de la plata 34 E', 'S', 0),
(9, '76544328U', 'Susan', 'Etterworth', 'Doren', '1608141019-chrome_RNVSWCyHhE.png', 'susanfurret', 'furretlover', 'susanfurret@gmail.com', 876432765, 'c/ Isla Palmera 23 E', 'S', 0),
(10, '43217865H', 'Manuel', 'Molla', 'Alvaz', '1608141113-chrome_XcYOCVDGhY.png', 'manu1999', 'manumanu_8', 'manuelcorreo@gmail.com', 965432768, 'c/MiraPlaya 32 E', 'S', 0),
(11, '56783345K', 'Aura', 'Lusey', 'Karen', '1608141210-chrome_9MwMdop2uO.png', 'aura33', '123456789', 'aurasimplevida@gmail.com', 432876498, 'c/Normal 1 A', 'S', 0),
(12, '45645645E', 'Emett', 'Koren', 'Andalez', '1608141295-chrome_wN0ebK9IK5.png', 'emet777', '777', 'emettEnderman@gmail.com', 898671123, 'c/ Azorin 12 E', 'U', 0),
(13, '45645689E', 'Lucia', 'Magdalena', 'Outhouse', '1608141377-chrome_sF996xbvQh.png', 'lucia456', '456654', 'lucia456@gmail.com', 765398675, 'c/ Honestidad 21 B', 'U', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tramos`
--
ALTER TABLE `tramos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`usuarioLogin`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
