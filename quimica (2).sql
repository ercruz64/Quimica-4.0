-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3325
-- Tiempo de generación: 03-09-2021 a las 18:22:55
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
-- Base de datos: `quimica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `idActividades` int(11) NOT NULL,
  `tituloActividad` varchar(300) NOT NULL,
  `nivelMinimo` int(3) NOT NULL,
  `actividadPuntaje` int(3) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`idActividades`, `tituloActividad`, `nivelMinimo`, `actividadPuntaje`, `idUsuario`) VALUES
(1, 'Que es la quimica', 30, 0, 1),
(21, 'Actividad 1', 5, 100, 1),
(22, 'Actividad 2', 40, 100, 1),
(24, 'Actividad 3', 70, 100, 1),
(25, 'Actividad 4', 70, 100, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `idGrado` int(11) NOT NULL,
  `nombreGrado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`idGrado`, `nombreGrado`) VALUES
(1, '801'),
(2, '802');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idNotas` int(11) NOT NULL,
  `idPersonas` int(11) NOT NULL,
  `idActividad` int(11) NOT NULL,
  `nota` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idNotas`, `idPersonas`, `idActividad`, `nota`) VALUES
(1, 1, 1, '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `idPersonas` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `documentoIdentidad` varchar(10) NOT NULL,
  `numeroDocumento` varchar(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(10) NOT NULL,
  `fechaNacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`idPersonas`, `nombre`, `apellido`, `documentoIdentidad`, `numeroDocumento`, `email`, `password`, `fechaNacimiento`) VALUES
(1, 'Jogan Felipe', 'Rengifo Solarte', 'T.I', '1070586140', 'felipe@correo.com', 'Pas12345', '2021-08-09'),
(2, 'Jogan Felipe', 'Rengifo Solarte', 'T.I', '1070586140', 'felipe123', '4321', '2021-08-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personasgrado`
--

CREATE TABLE `personasgrado` (
  `idPersonasGrado` int(11) NOT NULL,
  `idPersonas` int(11) NOT NULL,
  `idGrado` int(11) NOT NULL,
  `fechaInscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personasgrado`
--

INSERT INTO `personasgrado` (`idPersonasGrado`, `idPersonas`, `idGrado`, `fechaInscripcion`) VALUES
(1, 1, 1, '2021-08-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personasrol`
--

CREATE TABLE `personasrol` (
  `idPersonasRol` int(11) NOT NULL,
  `idPersonas` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personasrol`
--

INSERT INTO `personasrol` (`idPersonasRol`, `idPersonas`, `idRol`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPreguntas` int(11) NOT NULL,
  `idActividades` int(11) NOT NULL,
  `descripcionPregunta` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPreguntas`, `idActividades`, `descripcionPregunta`) VALUES
(8, 21, 'Pregunta 1'),
(9, 21, 'Pregunta 2'),
(10, 21, 'Pregunta 3'),
(11, 21, 'Pregunta 4'),
(12, 22, 'Pregunta Actividad 2.1'),
(13, 22, 'Pregunta Actividad 2.2'),
(14, 22, 'Pregunta Actividad 2.3'),
(15, 22, 'Pregunta Actividad 2.4'),
(16, 24, 'Pregunta Actividad 3.1'),
(17, 24, 'Pregunta Actividad 3.2'),
(18, 24, 'Pregunta Actividad 3.3'),
(19, 24, 'Respuesta Pregunta Actividad 3.4'),
(20, 25, 'Pregunta Actividad 4.1'),
(21, 25, 'Pregunta Actividad 4.2'),
(22, 25, 'Pregunta Actividad 4.3'),
(23, 25, 'Pregunta Actividad 4.4'),
(24, 25, 'Pregunta Actividad 4.5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuestas` int(11) NOT NULL,
  `idPreguntas` int(11) NOT NULL,
  `descripcionRespuesta` varchar(100) NOT NULL,
  `resultado` enum('verdadero','falso') NOT NULL,
  `resultadoMultiple` enum('Correcto','Incorrecto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuestas`, `idPreguntas`, `descripcionRespuesta`, `resultado`, `resultadoMultiple`) VALUES
(9, 8, 'Respuesta 1.1 Correcta', '', 'Correcto'),
(10, 8, 'Respuesta 1.2', '', 'Incorrecto'),
(11, 8, 'Respuesta 1.3', '', 'Incorrecto'),
(12, 8, 'Respuesta 1.4', '', 'Incorrecto'),
(13, 9, 'Falso', 'falso', 'Correcto'),
(14, 10, 'respuesta 3.1 Correcta', '', 'Correcto'),
(15, 10, 'respuesta 3.2', '', 'Incorrecto'),
(16, 10, 'respuesta 3.3', '', 'Incorrecto'),
(17, 10, 'respuesta 3.4', '', 'Incorrecto'),
(18, 11, 'Verdadero', 'verdadero', 'Correcto'),
(19, 12, 'Respuesta Pregunta Actividad 2.1.1', '', 'Correcto'),
(20, 12, 'Respuesta Pregunta Actividad 2.1.2', '', 'Incorrecto'),
(21, 12, 'Respuesta Pregunta Actividad 2.1.3', '', 'Incorrecto'),
(22, 12, 'Respuesta Pregunta Actividad 2.1.4', '', 'Incorrecto'),
(23, 13, 'Verdadero', 'verdadero', 'Correcto'),
(24, 14, 'Respuesta Pregunta Actividad 2.2.1', '', 'Correcto'),
(25, 14, 'Respuesta Pregunta Actividad 2.2.2', '', 'Incorrecto'),
(26, 14, 'Respuesta Pregunta Actividad 2.2.3', '', 'Incorrecto'),
(27, 14, 'Respuesta Pregunta Actividad 2.2.4', '', 'Incorrecto'),
(28, 15, 'Falso', 'falso', 'Correcto'),
(29, 16, 'Respuesta Pregunta Actividad 3.1.1', '', 'Correcto'),
(30, 16, 'Respuesta Pregunta Actividad 3.1.2', '', 'Incorrecto'),
(31, 16, 'Respuesta Pregunta Actividad 3.1.3', '', 'Incorrecto'),
(32, 16, 'Respuesta Pregunta Actividad 3.1.4', '', 'Incorrecto'),
(33, 17, 'Falso', 'falso', 'Correcto'),
(34, 18, 'Respuesta Pregunta Actividad 3.3.1', '', 'Correcto'),
(35, 18, 'Respuesta Pregunta Actividad 3.3.2', '', 'Incorrecto'),
(36, 18, 'Respuesta Pregunta Actividad 3.3.3', '', 'Incorrecto'),
(37, 18, 'Respuesta Pregunta Actividad 3.3.4', '', 'Incorrecto'),
(38, 19, 'Verdadero', 'verdadero', 'Correcto'),
(39, 20, 'Respuesta Pregunta Actividad 4.1.1', '', 'Correcto'),
(40, 20, 'Respuesta Pregunta Actividad 4.1.2', '', 'Incorrecto'),
(41, 20, 'Respuesta Pregunta Actividad 4.1.3', '', 'Incorrecto'),
(42, 20, 'Respuesta Pregunta Actividad 4.1.4', '', 'Incorrecto'),
(43, 21, 'Respuesta Pregunta Actividad 4.2.1', '', 'Correcto'),
(44, 21, 'Respuesta Pregunta Actividad 4.2.2', '', 'Incorrecto'),
(45, 21, 'Respuesta Pregunta Actividad 4.2.3', '', 'Incorrecto'),
(46, 21, 'Respuesta Pregunta Actividad 4.2.4', '', 'Incorrecto'),
(47, 22, 'Respuesta Pregunta Actividad 4.3.1', '', 'Correcto'),
(48, 22, 'Respuesta Pregunta Actividad 4.3.2', '', 'Incorrecto'),
(49, 22, 'Respuesta Pregunta Actividad 4.3.3', '', 'Incorrecto'),
(50, 22, 'Respuesta Pregunta Actividad 4.3.4', '', 'Incorrecto'),
(51, 23, 'Respuesta Pregunta Actividad 4.4.1', '', 'Correcto'),
(52, 23, 'Respuesta Pregunta Actividad 4.4.2', '', 'Incorrecto'),
(53, 23, 'Respuesta Pregunta Actividad 4.4.3', '', 'Incorrecto'),
(54, 23, 'Respuesta Pregunta Actividad 4.4.4', '', 'Incorrecto'),
(55, 24, 'Verdadero', 'verdadero', 'Correcto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultadosactividades`
--

CREATE TABLE `resultadosactividades` (
  `idResultadoActividad` int(11) NOT NULL,
  `fechaPresentacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idRespuesta` int(11) NOT NULL,
  `idPersona` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `resultadosactividades`
--

INSERT INTO `resultadosactividades` (`idResultadoActividad`, `fechaPresentacion`, `idRespuesta`, `idPersona`) VALUES
(1, '2021-08-31 16:19:44', 12, 1),
(2, '2021-08-31 16:19:44', 13, 1),
(3, '2021-08-31 16:19:44', 14, 1),
(4, '2021-08-31 16:19:44', 15, 1),
(5, '2021-08-31 19:48:55', 16, 1),
(6, '2021-08-31 19:48:55', 17, 1),
(7, '2021-08-31 19:48:55', 18, 1),
(8, '2021-08-31 19:48:55', 19, 1),
(9, '2021-09-03 16:21:02', 20, 1),
(10, '2021-09-03 16:21:02', 21, 1),
(11, '2021-09-03 16:21:02', 22, 1),
(12, '2021-09-03 16:21:02', 23, 1),
(13, '2021-09-03 16:21:02', 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `Roles` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `Roles`) VALUES
(1, 'Administrador'),
(2, 'Estudiante'),
(3, 'Docente');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `view_resultado_actividad`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `view_resultado_actividad` (
`idResultadoActividad` int(11)
,`fechaPresentacion` timestamp
,`idRespuesta` int(11)
,`idPersona` int(11)
,`nombre` varchar(100)
,`apellido` varchar(100)
,`numeroDocumento` varchar(10)
,`idPreguntas` int(11)
,`resultado` enum('verdadero','falso')
,`resultadoMultiple` enum('Correcto','Incorrecto')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `view_resultado_actividad`
--
DROP TABLE IF EXISTS `view_resultado_actividad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_resultado_actividad`  AS  select `a`.`idResultadoActividad` AS `idResultadoActividad`,`a`.`fechaPresentacion` AS `fechaPresentacion`,`a`.`idRespuesta` AS `idRespuesta`,`a`.`idPersona` AS `idPersona`,`b`.`nombre` AS `nombre`,`b`.`apellido` AS `apellido`,`b`.`numeroDocumento` AS `numeroDocumento`,`c`.`idPreguntas` AS `idPreguntas`,`c`.`resultado` AS `resultado`,`c`.`resultadoMultiple` AS `resultadoMultiple` from ((`resultadosactividades` `a` join `personas` `b`) join `respuestas` `c`) where `a`.`idPersona` = `b`.`idPersonas` and `a`.`idRespuesta` = `c`.`idRespuestas` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idActividades`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`idGrado`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idNotas`),
  ADD KEY `idPersonas` (`idPersonas`),
  ADD KEY `idActividad` (`idActividad`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`idPersonas`);

--
-- Indices de la tabla `personasgrado`
--
ALTER TABLE `personasgrado`
  ADD PRIMARY KEY (`idPersonasGrado`),
  ADD KEY `idPersonas` (`idPersonas`),
  ADD KEY `idGrado` (`idGrado`);

--
-- Indices de la tabla `personasrol`
--
ALTER TABLE `personasrol`
  ADD PRIMARY KEY (`idPersonasRol`),
  ADD KEY `idPersonas` (`idPersonas`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPreguntas`),
  ADD KEY `idActividades` (`idActividades`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuestas`),
  ADD KEY `idPreguntas` (`idPreguntas`);

--
-- Indices de la tabla `resultadosactividades`
--
ALTER TABLE `resultadosactividades`
  ADD PRIMARY KEY (`idResultadoActividad`),
  ADD KEY `idRespuestaFK_idx` (`idRespuesta`),
  ADD KEY `idPersonaFK_idx` (`idPersona`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `idActividades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `idGrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idNotas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `idPersonas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `personasgrado`
--
ALTER TABLE `personasgrado`
  MODIFY `idPersonasGrado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `personasrol`
--
ALTER TABLE `personasrol`
  MODIFY `idPersonasRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPreguntas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuestas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `resultadosactividades`
--
ALTER TABLE `resultadosactividades`
  MODIFY `idResultadoActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `idUsuario_FK(Usuario)` FOREIGN KEY (`idUsuario`) REFERENCES `personas` (`idPersonas`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`idPersonas`) REFERENCES `personas` (`idPersonas`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`idActividad`) REFERENCES `actividades` (`idActividades`);

--
-- Filtros para la tabla `personasgrado`
--
ALTER TABLE `personasgrado`
  ADD CONSTRAINT `personasgrado_ibfk_1` FOREIGN KEY (`idGrado`) REFERENCES `grado` (`idGrado`),
  ADD CONSTRAINT `personasgrado_ibfk_2` FOREIGN KEY (`idPersonas`) REFERENCES `personas` (`idPersonas`);

--
-- Filtros para la tabla `personasrol`
--
ALTER TABLE `personasrol`
  ADD CONSTRAINT `personasrol_ibfk_1` FOREIGN KEY (`idPersonas`) REFERENCES `personas` (`idPersonas`),
  ADD CONSTRAINT `personasrol_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`idActividades`) REFERENCES `actividades` (`idActividades`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idPreguntas`) REFERENCES `preguntas` (`idPreguntas`);

--
-- Filtros para la tabla `resultadosactividades`
--
ALTER TABLE `resultadosactividades`
  ADD CONSTRAINT `idPersonaFK` FOREIGN KEY (`idPersona`) REFERENCES `personas` (`idPersonas`),
  ADD CONSTRAINT `idRespuestaFK` FOREIGN KEY (`idRespuesta`) REFERENCES `respuestas` (`idRespuestas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
