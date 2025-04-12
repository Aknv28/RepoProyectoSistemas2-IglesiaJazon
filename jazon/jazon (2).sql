-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2025 a las 04:02:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jazon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asociados`
--

CREATE TABLE `asociados` (
  `Id_Asociado` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Apellido_Pat` varchar(30) NOT NULL,
  `Apellido_Mat` varchar(30) NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `habilitado` int(11) NOT NULL,
  `Id_Contacto` int(11) DEFAULT NULL,
  `Id_Zona` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asociados`
--

INSERT INTO `asociados` (`Id_Asociado`, `Nombre`, `Apellido_Pat`, `Apellido_Mat`, `Fecha_Nacimiento`, `habilitado`, `Id_Contacto`, `Id_Zona`, `Id_Usuario`) VALUES
(1, 'Ahmed', 'Najar', 'Vargas', '2005-12-31', 1, 1, 2, 1),
(2, 'Willy', 'Condori', 'Esteban', '2005-12-04', 1, 2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id_Categoria` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Id_Categoria`, `Nombre`, `habilitado`) VALUES
(1, 'kermezz', 1),
(2, 'fdsfds', 1),
(3, 'Comedor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `Id_Contacto` int(11) NOT NULL,
  `NumeroTelefono` int(11) NOT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`Id_Contacto`, `NumeroTelefono`, `Correo`, `habilitado`) VALUES
(1, 73265777, 'Aknv@gmail.com', 1),
(2, 73265777, 'wcondoriesteban@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `Id_Eventos` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `habilitado` int(11) NOT NULL,
  `Id_Resultado` int(11) DEFAULT NULL,
  `Id_Categoria` int(11) DEFAULT NULL,
  `Id_Ubicacion` int(11) DEFAULT NULL,
  `Id_Horario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`Id_Eventos`, `Nombre`, `Fecha`, `habilitado`, `Id_Resultado`, `Id_Categoria`, `Id_Ubicacion`, `Id_Horario`) VALUES
(2, 'compartir', '2025-04-18', 1, 1, 3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario`
--

CREATE TABLE `formulario` (
  `Id_Formulario` int(11) NOT NULL,
  `Actividad` varchar(30) NOT NULL,
  `Pregunta1` varchar(50) NOT NULL,
  `Pregunta2` varchar(50) NOT NULL,
  `Pregunta3` varchar(50) NOT NULL,
  `Pregunta4` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Fecha_fin` date NOT NULL,
  `habilitado` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `Id_Ubicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`Id_Formulario`, `Actividad`, `Pregunta1`, `Pregunta2`, `Pregunta3`, `Pregunta4`, `Fecha`, `Fecha_fin`, `habilitado`, `id_evento`, `Id_Ubicacion`) VALUES
(1, 'Comida', 'sugerencia para comidas', 'sugerencia de cantidad de platos', 'sugerencia de cantidad de personas', 'sugenrencia de hermanos a cargo', '2025-04-10', '2025-04-11', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `Id_Horario` int(11) NOT NULL,
  `Hora_Inicio` int(11) NOT NULL,
  `Hora_Final` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`Id_Horario`, `Hora_Inicio`, `Hora_Final`, `habilitado`) VALUES
(1, 11, 12, 1),
(2, 15, 20, 1),
(3, 10, 12, 0),
(4, 10, 12, 0),
(5, 1, 12, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `Id_Respuesta` int(11) NOT NULL,
  `Respuesta1` longtext NOT NULL,
  `Respuesta2` longtext NOT NULL,
  `Respuesta3` longtext NOT NULL,
  `Respuesta4` longtext NOT NULL,
  `Horario` varchar(10) NOT NULL,
  `Fecha` varchar(20) NOT NULL,
  `Ubicacion` varchar(50) NOT NULL,
  `Id_Formulario` int(11) DEFAULT NULL,
  `Id_Asociado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`Id_Respuesta`, `Respuesta1`, `Respuesta2`, `Respuesta3`, `Respuesta4`, `Horario`, `Fecha`, `Ubicacion`, `Id_Formulario`, `Id_Asociado`) VALUES
(1, 'dsaa', 'aaaaaaaaaaa', 'aaaaaaaaa', 'aaaaaaaaaaaaaaaa', '1', '2025-04-10', '1', 1, NULL),
(2, 'dsaa', 'aaaaaaaaaaa', 'aaaaaaaaa', 'aaaaaaaaaaaaaaaa', '1', '2025-04-10', '1', 1, NULL),
(3, 'fsaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', '1', '2025-04-10', '1', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `Id_Respuesta` int(11) NOT NULL,
  `Resultado1` longtext NOT NULL,
  `Resultado2` longtext NOT NULL,
  `Resultado3` longtext NOT NULL,
  `Resultado4` longtext NOT NULL,
  `Ubicacion` varchar(50) NOT NULL,
  `Fecha` date NOT NULL,
  `Horario` varchar(10) NOT NULL,
  `Id_Formulario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`Id_Respuesta`, `Resultado1`, `Resultado2`, `Resultado3`, `Resultado4`, `Ubicacion`, `Fecha`, `Horario`, `Id_Formulario`) VALUES
(1, 'fricase', '', '', '', '', '2025-04-02', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `Id_Rol` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`Id_Rol`, `Tipo`, `habilitado`) VALUES
(1, 'asociado', 1),
(2, 'pastor', 1),
(3, 'administrador', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `Id_Ubicacion` int(11) NOT NULL,
  `Zona` varchar(30) NOT NULL,
  `Calle` text NOT NULL,
  `NroLugar` varchar(30) DEFAULT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`Id_Ubicacion`, `Zona`, `Calle`, `NroLugar`, `habilitado`) VALUES
(1, 'miraflores', 'santa rosa', '10', 1),
(2, 'villa fatima', 'n', '15', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Contrasena` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL,
  `Id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Usuario`, `Contrasena`, `habilitado`, `Id_Rol`) VALUES
(1, 'ANV721', 'ANV909', 1, 1),
(2, 'WCE828', 'WCE851', 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `Id_Zona` int(11) NOT NULL,
  `NombreZona` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`Id_Zona`, `NombreZona`, `habilitado`) VALUES
(1, 'Miraflores', 1),
(2, 'Irpavi', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asociados`
--
ALTER TABLE `asociados`
  ADD PRIMARY KEY (`Id_Asociado`),
  ADD KEY `Id_Contacto_Asociados` (`Id_Contacto`),
  ADD KEY `Id_Zona_Asociados` (`Id_Zona`),
  ADD KEY `Id_Usuario_Asociados` (`Id_Usuario`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id_Categoria`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`Id_Contacto`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id_Eventos`),
  ADD KEY `Id_Resultado_Evento` (`Id_Resultado`),
  ADD KEY `Id_Categoria_Evento` (`Id_Categoria`),
  ADD KEY `Id_Ubicacion_Evento` (`Id_Ubicacion`),
  ADD KEY `Id_Horario_Evento` (`Id_Horario`);

--
-- Indices de la tabla `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`Id_Formulario`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`Id_Horario`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`Id_Respuesta`),
  ADD KEY `Id_Formulario_Respuestas` (`Id_Formulario`),
  ADD KEY `Id_Asociado_Respuestas` (`Id_Asociado`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`Id_Respuesta`),
  ADD KEY `Id_Formulario_Resultados` (`Id_Formulario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`Id_Ubicacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Rol_Usuarios` (`Id_Rol`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`Id_Zona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asociados`
--
ALTER TABLE `asociados`
  MODIFY `Id_Asociado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `Id_Contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id_Eventos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `formulario`
--
ALTER TABLE `formulario`
  MODIFY `Id_Formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `Id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `Id_Ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `Id_Zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asociados`
--
ALTER TABLE `asociados`
  ADD CONSTRAINT `Id_Contacto_Asociados` FOREIGN KEY (`Id_Contacto`) REFERENCES `contactos` (`Id_Contacto`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Usuario_Asociados` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Zona_Asociados` FOREIGN KEY (`Id_Zona`) REFERENCES `zona` (`Id_Zona`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `Id_Categoria_Evento` FOREIGN KEY (`Id_Categoria`) REFERENCES `categoria` (`Id_Categoria`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Horario_Evento` FOREIGN KEY (`Id_Horario`) REFERENCES `horarios` (`Id_Horario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Resultado_Evento` FOREIGN KEY (`Id_Resultado`) REFERENCES `resultados` (`Id_Respuesta`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Ubicacion_Evento` FOREIGN KEY (`Id_Ubicacion`) REFERENCES `ubicacion` (`Id_Ubicacion`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `Id_Asociado_Respuestas` FOREIGN KEY (`Id_Asociado`) REFERENCES `asociados` (`Id_Asociado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Formulario_Respuestas` FOREIGN KEY (`Id_Formulario`) REFERENCES `formulario` (`Id_Formulario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `Id_Formulario_Resultados` FOREIGN KEY (`Id_Formulario`) REFERENCES `formulario` (`Id_Formulario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Id_Rol_Usuarios` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
