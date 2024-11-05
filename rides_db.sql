-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 05-11-2024 a las 05:27:19
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rides_db`
--
CREATE DATABASE IF NOT EXISTS `rides_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `rides_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `categoria` enum('VIAJE','GASTO') NOT NULL,
  `subcategoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`, `subcategoria`) VALUES
(1, 'GASTO', 'GAS'),
(2, 'GASTO', 'RECARGAS CLARO'),
(3, 'GASTO', 'RECARGAS INDRIVE'),
(4, 'GASTO', 'LAVADO CARRO'),
(5, 'GASTO', 'CAR HOLDER'),
(6, 'VIAJE', 'VIAJE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id` int NOT NULL,
  `fecha` datetime NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `meta` decimal(10,2) NOT NULL,
  `cerrado` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id`, `fecha`, `descripcion`, `meta`, `cerrado`) VALUES
(1, '2024-11-05 00:57:56', '', 1200.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id` int NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `tasa_servicio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id`, `descripcion`, `tasa_servicio`) VALUES
(1, 'UBER', 44),
(2, 'INDRIVE', 14),
(3, 'POR FUERA', 0),
(4, 'DIDI', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes_gastos`
--

CREATE TABLE `viajes_gastos` (
  `id` int NOT NULL,
  `tipo_transaccion` tinyint(1) NOT NULL COMMENT '1- Viaje, 2- Gasto',
  `categoria_id` tinyint NOT NULL,
  `kms_recogida` decimal(8,1) DEFAULT NULL,
  `mins_recogida` time DEFAULT NULL,
  `kms_destino` decimal(8,1) DEFAULT NULL,
  `mins_destino` time DEFAULT NULL,
  `efectivo` decimal(8,2) DEFAULT '0.00',
  `tarjeta` decimal(8,2) DEFAULT '0.00',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `propina` decimal(8,2) DEFAULT '0.00',
  `plataforma_id` tinyint DEFAULT NULL,
  `dia_id` int NOT NULL,
  `hora_creacion` time DEFAULT NULL,
  `kms_recorridos` decimal(10,1) DEFAULT NULL,
  `precio_galon` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `viajes_gastos`
--

INSERT INTO `viajes_gastos` (`id`, `tipo_transaccion`, `categoria_id`, `kms_recogida`, `mins_recogida`, `kms_destino`, `mins_destino`, `efectivo`, `tarjeta`, `total`, `propina`, `plataforma_id`, `dia_id`, `hora_creacion`, `kms_recorridos`, `precio_galon`) VALUES
(1, 1, 6, 1.0, '00:02:00', 2.0, '00:10:00', 120.00, 0.00, 120.00, 20.00, 1, 1, '20:00:00', NULL, NULL),
(2, 2, 1, 1.0, '00:00:00', 0.0, '00:00:00', 0.00, 0.00, 50.00, 0.00, NULL, 1, '20:00:00', NULL, 132.60);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes_gastos`
--
ALTER TABLE `viajes_gastos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `viajes_gastos`
--
ALTER TABLE `viajes_gastos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
