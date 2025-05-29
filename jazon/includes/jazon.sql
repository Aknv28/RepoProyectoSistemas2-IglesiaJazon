-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 06:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jazon`
--

-- --------------------------------------------------------

--
-- Table structure for table `asociados`
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
-- Dumping data for table `asociados`
--

INSERT INTO `asociados` (`Id_Asociado`, `Nombre`, `Apellido_Pat`, `Apellido_Mat`, `Fecha_Nacimiento`, `habilitado`, `Id_Contacto`, `Id_Zona`, `Id_Usuario`) VALUES
(1, 'Ahmed', 'Najar', 'Vargas', '2005-12-31', 1, 1, 2, 1),
(2, 'Willy', 'Condori', 'Esteban', '2005-12-04', 1, 2, 1, 2),
(3, 'Julian', 'Delgado', 'Quino', '2004-12-31', 1, 3, 5, 3),
(4, 'Flavia', 'Trigoso', 'Torres', '2005-03-23', 1, 4, 6, 4),
(5, 'Freddy', 'Nuñez', 'Gomez', '1978-02-20', 1, 5, 4, 5),
(6, 'Mayda', 'Vargas', 'Terrazas', '1985-01-31', 1, 6, 2, 6),
(7, 'Marcos', 'Pereira', 'Carrasco', '1989-04-15', 1, 7, 3, 7),
(8, 'Gabriel', 'Ariñez', 'Velasco', '1997-07-05', 1, 8, 5, 8),
(9, 'Alejandro', 'Siles', 'Francis', '1999-05-19', 1, 9, 3, 9),
(10, 'Pedro', 'Sol', 'Basel', '2002-11-18', 1, 10, 3, 32),
(11, 'Luciana', 'Prado', 'Salas', '1995-11-26', 1, 11, 6, 33);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE `categoria` (
  `Id_Categoria` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categoria`
--

INSERT INTO `categoria` (`Id_Categoria`, `Nombre`, `habilitado`) VALUES
(1, 'Kermes', 1),
(2, 'Platica', 1),
(3, 'Comida', 1),
(4, 'Carrera', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contactos`
--

CREATE TABLE `contactos` (
  `Id_Contacto` int(11) NOT NULL,
  `NumeroTelefono` int(11) NOT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactos`
--

INSERT INTO `contactos` (`Id_Contacto`, `NumeroTelefono`, `Correo`, `habilitado`) VALUES
(1, 73265777, 'Aknv@gmail.com', 1),
(2, 73265777, 'wcondoriesteban@gmail.com', 1),
(3, 71230984, 'jdq3112@gmail.com', 1),
(4, 69981236, NULL, 1),
(5, 71285214, NULL, 1),
(6, 61209834, 'mvter@hotmail.com', 1),
(7, 70083542, 'marper@gmail.com', 1),
(8, 79924834, NULL, 1),
(9, 67834501, 'alesale@gmail.com', 1),
(10, 413241412, 'pesoba@hotmail.com', 1),
(11, 67894560, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `eventos`
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
-- Dumping data for table `eventos`
--

INSERT INTO `eventos` (`Id_Eventos`, `Nombre`, `Fecha`, `habilitado`, `Id_Resultado`, `Id_Categoria`, `Id_Ubicacion`, `Id_Horario`) VALUES
(1, 'Comida comunitaria', '2025-06-28', 1, 1, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `formulario`
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
-- Dumping data for table `formulario`
--

INSERT INTO `formulario` (`Id_Formulario`, `Actividad`, `Pregunta1`, `Pregunta2`, `Pregunta3`, `Pregunta4`, `Fecha`, `Fecha_fin`, `habilitado`, `id_evento`, `Id_Ubicacion`) VALUES
(1, 'Comida comunitaria', 'Sugerencia para comidas', 'Sugerencia de cantidad de platos', 'Sugerencia de cantidad de personas', 'Sugerencia de hermanos a cargo', '2025-04-10', '2025-04-11', 1, 1, 1),
(2, 'Kermes por juanita', 'Sugerencia de comida ', 'Sugerencia de comida ', 'Sugerencia de comida ', 'Sugerencia de actividades a realizar', '2025-05-29', '2025-05-31', 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE `horarios` (
  `Id_Horario` int(11) NOT NULL,
  `Hora_Inicio` int(11) NOT NULL,
  `Hora_Final` int(11) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`Id_Horario`, `Hora_Inicio`, `Hora_Final`, `habilitado`) VALUES
(1, 12, 16, 1),
(2, 15, 20, 1),
(3, 9, 12, 1),
(4, 10, 18, 1),
(5, 8, 12, 1),
(6, 12, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `respuestas`
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
-- Dumping data for table `respuestas`
--

INSERT INTO `respuestas` (`Id_Respuesta`, `Respuesta1`, `Respuesta2`, `Respuesta3`, `Respuesta4`, `Horario`, `Fecha`, `Ubicacion`, `Id_Formulario`, `Id_Asociado`) VALUES
(1, 'Fricase', '110', '100', '15', '1', '2025-04-18', '1', 1, 1),
(2, 'Pizza', '20', '80', '10', '1', '2025-04-18', '1', 1, 3),
(3, 'Fricase', '100', '80', '10', '1', '2025-04-20', '1', 1, 2),
(4, 'Chicharron', '100', '70', '12', '1', '2025-04-19', '2', 1, 5),
(5, 'Hamburgues', '80', '60', '10', '1', '2025-04-18', '2', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `resultados`
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
-- Dumping data for table `resultados`
--

INSERT INTO `resultados` (`Id_Respuesta`, `Resultado1`, `Resultado2`, `Resultado3`, `Resultado4`, `Ubicacion`, `Fecha`, `Horario`, `Id_Formulario`) VALUES
(1, 'Fricase', '100', '80', '10', '1', '2025-04-18', '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `Id_Rol` int(11) NOT NULL,
  `Tipo` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`Id_Rol`, `Tipo`, `habilitado`) VALUES
(1, 'asociado', 1),
(2, 'pastor', 1),
(3, 'administrador', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ubicacion`
--

CREATE TABLE `ubicacion` (
  `Id_Ubicacion` int(11) NOT NULL,
  `Zona` varchar(30) NOT NULL,
  `Calle` text NOT NULL,
  `NroLugar` varchar(30) DEFAULT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ubicacion`
--

INSERT INTO `ubicacion` (`Id_Ubicacion`, `Zona`, `Calle`, `NroLugar`, `habilitado`) VALUES
(1, 'Miraflores', 'Villalobos', '1087', 1),
(2, 'Bolonia', 'Calle 7', '571', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `Id_Usuario` int(11) NOT NULL,
  `Usuario` varchar(30) NOT NULL,
  `Contrasena` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL,
  `Id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id_Usuario`, `Usuario`, `Contrasena`, `habilitado`, `Id_Rol`) VALUES
(1, 'ANV288', 'ANV288', 1, 1),
(2, 'WCE174', 'WCE174', 1, 3),
(3, 'JDQ548', 'JDQ871', 1, 1),
(4, 'FTT233', 'FTT147', 1, 1),
(5, 'FNG202', 'FNG257', 1, 2),
(6, 'MVT362', 'MVT836', 1, 1),
(7, 'MPC037', 'MPC127', 1, 1),
(8, 'GAV239', 'GAV375', 1, 1),
(9, 'ASF785', 'ASF570', 1, 1),
(32, 'PSB749', 'PSB919', 1, 1),
(33, 'LPP862', 'LPP748', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zona`
--

CREATE TABLE `zona` (
  `Id_Zona` int(11) NOT NULL,
  `NombreZona` varchar(30) NOT NULL,
  `habilitado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zona`
--

INSERT INTO `zona` (`Id_Zona`, `NombreZona`, `habilitado`) VALUES
(1, 'Miraflores', 1),
(2, 'Irpavi', 1),
(3, 'Achumani', 1),
(4, 'Bolonia', 1),
(5, 'Obrajes', 1),
(6, 'Calacoto', 1),
(7, 'Florida', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asociados`
--
ALTER TABLE `asociados`
  ADD PRIMARY KEY (`Id_Asociado`),
  ADD KEY `Id_Contacto_Asociados` (`Id_Contacto`),
  ADD KEY `Id_Zona_Asociados` (`Id_Zona`),
  ADD KEY `Id_Usuario_Asociados` (`Id_Usuario`);

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id_Categoria`);

--
-- Indexes for table `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`Id_Contacto`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`Id_Eventos`),
  ADD KEY `Id_Resultado_Evento` (`Id_Resultado`),
  ADD KEY `Id_Categoria_Evento` (`Id_Categoria`),
  ADD KEY `Id_Ubicacion_Evento` (`Id_Ubicacion`),
  ADD KEY `Id_Horario_Evento` (`Id_Horario`);

--
-- Indexes for table `formulario`
--
ALTER TABLE `formulario`
  ADD PRIMARY KEY (`Id_Formulario`);

--
-- Indexes for table `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`Id_Horario`);

--
-- Indexes for table `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`Id_Respuesta`),
  ADD KEY `Id_Formulario_Respuestas` (`Id_Formulario`),
  ADD KEY `Id_Asociado_Respuestas` (`Id_Asociado`);

--
-- Indexes for table `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`Id_Respuesta`),
  ADD KEY `Id_Formulario_Resultados` (`Id_Formulario`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indexes for table `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`Id_Ubicacion`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Rol_Usuarios` (`Id_Rol`);

--
-- Indexes for table `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`Id_Zona`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asociados`
--
ALTER TABLE `asociados`
  MODIFY `Id_Asociado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contactos`
--
ALTER TABLE `contactos`
  MODIFY `Id_Contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `Id_Eventos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formulario`
--
ALTER TABLE `formulario`
  MODIFY `Id_Formulario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `horarios`
--
ALTER TABLE `horarios`
  MODIFY `Id_Horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `resultados`
--
ALTER TABLE `resultados`
  MODIFY `Id_Respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `Id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ubicacion`
--
ALTER TABLE `ubicacion`
  MODIFY `Id_Ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `zona`
--
ALTER TABLE `zona`
  MODIFY `Id_Zona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asociados`
--
ALTER TABLE `asociados`
  ADD CONSTRAINT `Id_Contacto_Asociados` FOREIGN KEY (`Id_Contacto`) REFERENCES `contactos` (`Id_Contacto`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Usuario_Asociados` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuarios` (`Id_Usuario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Zona_Asociados` FOREIGN KEY (`Id_Zona`) REFERENCES `zona` (`Id_Zona`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `Id_Categoria_Evento` FOREIGN KEY (`Id_Categoria`) REFERENCES `categoria` (`Id_Categoria`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Horario_Evento` FOREIGN KEY (`Id_Horario`) REFERENCES `horarios` (`Id_Horario`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Resultado_Evento` FOREIGN KEY (`Id_Resultado`) REFERENCES `resultados` (`Id_Respuesta`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Ubicacion_Evento` FOREIGN KEY (`Id_Ubicacion`) REFERENCES `ubicacion` (`Id_Ubicacion`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `Id_Asociado_Respuestas` FOREIGN KEY (`Id_Asociado`) REFERENCES `asociados` (`Id_Asociado`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `Id_Formulario_Respuestas` FOREIGN KEY (`Id_Formulario`) REFERENCES `formulario` (`Id_Formulario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `Id_Formulario_Resultados` FOREIGN KEY (`Id_Formulario`) REFERENCES `formulario` (`Id_Formulario`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `Id_Rol_Usuarios` FOREIGN KEY (`Id_Rol`) REFERENCES `roles` (`Id_Rol`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
