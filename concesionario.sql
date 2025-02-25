-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-02-2025 a las 08:45:49
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `concesionario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id_alquiler` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(10) UNSIGNED DEFAULT NULL,
  `id_coche` int(10) UNSIGNED DEFAULT NULL,
  `prestado` datetime DEFAULT NULL,
  `devuelto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id_alquiler`, `id_usuario`, `id_coche`, `prestado`, `devuelto`) VALUES
(1, 14, 5, '2025-02-25 09:02:14', '2025-02-25 00:00:00'),
(2, 14, 5, '2025-02-25 09:02:25', '2025-02-25 00:00:00'),
(3, 14, 5, '2025-02-25 09:07:07', '2025-02-25 00:00:00'),
(4, 14, 5, '2025-02-25 09:07:51', '2025-02-25 00:00:00'),
(5, 14, 5, '2025-02-25 09:13:43', '2025-02-25 00:00:00'),
(6, 14, 5, '2025-02-25 09:16:50', '2025-02-25 00:00:00'),
(7, 18, 5, '2025-02-25 09:24:53', '2025-02-25 00:00:00'),
(8, 17, 6, '2025-02-25 09:30:34', NULL),
(9, 19, 7, '2025-02-25 09:31:46', '2025-02-25 00:00:00'),
(10, 19, 5, '2025-02-25 09:35:23', '2025-02-25 00:00:00'),
(11, 19, 4, '2025-02-25 09:38:11', '2025-02-25 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coches`
--

CREATE TABLE `coches` (
  `id_coche` int(10) UNSIGNED NOT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `alquilado` tinyint(1) DEFAULT NULL,
  `foto` varchar(300) DEFAULT NULL,
  `id_usuario_vendedor` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `coches`
--

INSERT INTO `coches` (`id_coche`, `modelo`, `marca`, `color`, `precio`, `alquilado`, `foto`, `id_usuario_vendedor`) VALUES
(4, 'roma', 'ferrari', 'rojo', 2222, 0, 'fotos/ferrariRoma.jpg', 14),
(5, 'stelvio', 'alfa romeo', 'grey', 233, 0, 'fotos/alfaRomeo.jpg', 14),
(6, 'levante', 'maseratti', 'black', 2222, 1, 'fotos/maseratti.jpg', 17),
(7, 'roma', 'ferrari', 'grey', 300, 0, 'fotos/ferrariRoma.jpg', 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `dni` varchar(9) DEFAULT NULL,
  `saldo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `password`, `nombre`, `apellidos`, `dni`, `saldo`) VALUES
(14, 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 'alvaroAdm', 'administrador', '00000000Z', 2000),
(17, 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 'vendedor', 'Vendedor', '22222222Z', 0),
(18, 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 'comprador', 'Comprador', '2222222Z', 1767),
(19, 'ab165cb90d19598f610a669dfe4798f4cd049a6a', 'comprador2', 'Comprador', '44444444Z', 17245);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id_alquiler`);

--
-- Indices de la tabla `coches`
--
ALTER TABLE `coches`
  ADD PRIMARY KEY (`id_coche`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id_alquiler` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `coches`
--
ALTER TABLE `coches`
  MODIFY `id_coche` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
