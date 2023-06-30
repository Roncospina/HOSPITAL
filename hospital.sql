-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-06-2023 a las 03:49:26
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `documento_emp` int(11) NOT NULL,
  `nombre_emp` varchar(255) DEFAULT NULL,
  `direccion_emp` varchar(255) DEFAULT NULL,
  `telefono_emp` varchar(20) DEFAULT NULL,
  `ciudad_emp` varchar(100) DEFAULT NULL,
  `departamento_emp` varchar(100) DEFAULT NULL,
  `codigoPostal_emp` varchar(10) DEFAULT NULL,
  `seguridadSocial_emp` varchar(20) DEFAULT NULL,
  `tipo_emp` varchar(100) DEFAULT NULL,
  `estadoVacaciones_emp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`documento_emp`, `nombre_emp`, `direccion_emp`, `telefono_emp`, `ciudad_emp`, `departamento_emp`, `codigoPostal_emp`, `seguridadSocial_emp`, `tipo_emp`, `estadoVacaciones_emp`) VALUES
(123456789, 'John Doe', '123 Main St', '555-1234', 'City', 'Department', '12345', '1234567890', 'Aministrativo', 'Ya disfrutadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `id_medico` int(11) DEFAULT NULL,
  `dia_semana` enum('lunes','martes','miércoles','jueves','viernes') DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `id_medico`, `dia_semana`, `hora_inicio`, `hora_fin`) VALUES
(1, 1, 'lunes', '09:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `departamento` varchar(100) DEFAULT NULL,
  `codigo_postal` varchar(10) DEFAULT NULL,
  `cedula` varchar(20) DEFAULT NULL,
  `num_seguridad_social` varchar(20) DEFAULT NULL,
  `matricula_profesional` varchar(50) DEFAULT NULL,
  `tipo_medico` enum('titular','interino','sustituto') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `nombre`, `direccion`, `telefono`, `ciudad`, `departamento`, `codigo_postal`, `cedula`, `num_seguridad_social`, `matricula_profesional`, `tipo_medico`) VALUES
(1, 'Dr. Juan Perez', 'Calle Principal 123', '1234567890', 'Supia', 'Caldas', '12345', '123456789', '987654321', 'MP-1234', 'titular'),
(4, 'Manuel', 'Calle 21', '3147439878', 'Manizales', 'cucuta', '170002', '2514896', '154879456', '2148651456', 'sustituto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id_pac` int(11) NOT NULL,
  `documento_pac` varchar(20) NOT NULL,
  `nombre_pac` varchar(100) NOT NULL,
  `direccion_pac` varchar(200) NOT NULL,
  `telefono_pac` varchar(20) NOT NULL,
  `ciudad_pac` varchar(100) NOT NULL,
  `departamento_pac` varchar(100) NOT NULL,
  `codigo_postal_pac` varchar(20) NOT NULL,
  `seguridad_social_pac` varchar(20) NOT NULL,
  `id_medico` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id_pac`, `documento_pac`, `nombre_pac`, `direccion_pac`, `telefono_pac`, `ciudad_pac`, `departamento_pac`, `codigo_postal_pac`, `seguridad_social_pac`, `id_medico`) VALUES
(5, '1234567890', 'carlos', 'Calle 123', '1234567890', 'Bogotá', 'Cundinamarca', '110111', '9876543210', 4),
(7, '5555555555', 'Pedro Rodríguez', 'Calle 789', '5555555555', 'Cali', 'Valle del Cauca', '760001', '1111111111', 1),
(8, '9999999999', 'Ana López', 'Avenida 999', '9999999999', 'Barranquilla', 'Atlántico', '080123', '2222222222', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sustituciones`
--

CREATE TABLE `sustituciones` (
  `id_sustitucion` int(11) NOT NULL,
  `id_medico_sustituto` int(11) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sustituciones`
--

INSERT INTO `sustituciones` (`id_sustitucion`, `id_medico_sustituto`, `fecha_alta`, `fecha_baja`) VALUES
(2, 1, '2023-06-01', '2023-06-30');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`documento_emp`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_pac`),
  ADD KEY `id_medico` (`id_medico`);

--
-- Indices de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD PRIMARY KEY (`id_sustitucion`),
  ADD KEY `id_medico_sustituto` (`id_medico_sustituto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_pac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  MODIFY `id_sustitucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD CONSTRAINT `horarios_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_medico`);

--
-- Filtros para la tabla `sustituciones`
--
ALTER TABLE `sustituciones`
  ADD CONSTRAINT `sustituciones_ibfk_1` FOREIGN KEY (`id_medico_sustituto`) REFERENCES `medicos` (`id_medico`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
