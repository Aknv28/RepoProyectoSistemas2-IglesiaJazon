-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-04-2025 a las 08:03:08
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
(1, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 6, 1, NULL),
(2, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 7, 1, NULL),
(3, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 8, 1, NULL),
(4, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 9, 1, NULL),
(5, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 1, 1, 1),
(6, 'Ahmed', 'Najar', 'Vargas', '2004-02-05', 1, 2, 1, 2),
(7, 'Ahmed', 'Najar', 'Vargas', '2005-12-02', 1, 3, 1, 3),
(8, 'Ahmed', 'Najar', 'Vargas', '2005-12-11', 1, 4, 1, 4),
(9, 'Ahmed', 'Najar', 'Vargas', '2005-12-11', 1, 5, 1, 5),
(10, 'Ahmed', 'Najar', 'Vargas', '2005-12-04', 1, 6, 1, 6),
(11, 'Ahmed', 'Najar', 'Vargas', '2005-12-18', 1, 7, 1, 7),
(12, 'Ahmed', 'Najar', 'Vargas', '2005-12-01', 1, 8, 1, 8),
(13, 'Ahmed', 'Najar', 'Vargas', '2005-12-04', 1, 9, 1, 9);

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
(1, 73265777, 'Aknv@gmail.com', 0),
(2, 73265777, 'Aknv@gmail.com', 0),
(3, 73265777, 'Aknv@gmail.com', 0),
(4, 73265777, 'Aknv@gmail.com', 0),
(5, 73265777, 'Aknv@gmail.com', 0),
(6, 73265777, 'Aknv@gmail.com', 0),
(7, 73265777, 'Aknv@gmail.com', 0),
(8, 73265777, 'Aknv@gmail.com', 0),
(9, 73265777, 'Aknv@gmail.com', 0),
(10, 73265777, 'Aknv@gmail.com', 0),
(11, 73265777, 'Aknv@gmail.com', 0),
(12, 78965422, 'Aknv@gmail.com', 0),
(13, 78954622, 'Aknv@gmail.com', 0),
(14, 78954622, 'Aknv@gmail.com', 0),
(15, 78954622, 'Aknv@gmail.com', 0),
(16, 2134214421, 'Aknv@gmail.com', 0),
(17, 2134214421, 'Aknv@gmail.com', 0),
(18, 2134214421, 'Aknv@gmail.com', 0),
(19, 2134214421, 'Aknv@gmail.com', 0),
(20, 214421241, 'Aknv@gmail.com', 0),
(21, 2147483647, 'Aknv@gmail.com', 0),
(22, 2147483647, 'Aknv@gmail.com', 0),
(23, 564465465, 'Aknv@gmail.com', 0),
(24, 73265777, 'Aknv@gmail.com', 1),
(25, 73265777, 'Aknv@gmail.com', 1),
(26, 73265777, 'Aknv@gmail.com', 1);

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
(2, 'dsa', '2025-04-02', 1, 1, 3, 1, 2);

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
  `Horario` varchar(10) NOT NULL,
  `Fecha` date NOT NULL,
  `Fecha_fin` date NOT NULL,
  `habilitado` int(11) NOT NULL,
  `Id_Ubicacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formulario`
--

INSERT INTO `formulario` (`Id_Formulario`, `Actividad`, `Pregunta1`, `Pregunta2`, `Pregunta3`, `Pregunta4`, `Horario`, `Fecha`, `Fecha_fin`, `habilitado`, `Id_Ubicacion`) VALUES
(1, 'Comida', 'sugerencia para comidas', 'sugerencia de cantidad de platos', 'sugerencia de cantidad de personas', 'sugenrencia de hermanos a cargo', '2', '2025-04-10', '2025-04-11', 1, 1);

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
(1, 10, 12, 1),
(2, 15, 20, 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `Id_Respuesta` int(11) NOT NULL,
  `Resultado` longtext NOT NULL,
  `Fecha` date NOT NULL,
  `Id_Formulario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`Id_Respuesta`, `Resultado`, `Fecha`, `Id_Formulario`) VALUES
(1, 'das', '2025-04-02', 1);

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
(1, 'miraflores', 'santa ', '10', 1);

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
(1, 'ANV894', '$2y$10$v1erx8YCJnegH5gMWH1r8eQ', 0, 1),
(2, 'ANV548', '$2y$10$1CJ.eCtraphkac7pVDBZA.C', 0, 1),
(3, 'ANV361', '$2y$10$5FRqnx7HG/uOKcghi6602uV', 0, 1),
(4, '', '$2y$10$UFpzVUbmSvc0zVQS7OFYCel', 0, 1),
(5, '', '$2y$10$TKFCcpLrtLuW55JTL4ICiei', 0, 1),
(6, '', '', 0, 1),
(7, 'ANV441100', 'ANV230100', 0, 1),
(8, 'ANV837100', 'ANV264100', 1, 1),
(9, 'ANV209100', 'ANV730100', 1, 3);

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
  MODIFY `Id_Asociado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `Id_Contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `Id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `Id_Ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
