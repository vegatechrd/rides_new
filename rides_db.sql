-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2024 a las 18:12:35
-- Versión del servidor: 8.0.39-0ubuntu0.24.04.2
-- Versión de PHP: 8.2.23

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
(1, '2024-10-03 06:58:00', '', 2200.00, 1),
(2, '2024-10-04 00:52:00', 'Viernes 04 octubre', 3500.00, 1),
(3, '2024-10-05 11:18:00', 'Sabado 5', 2800.00, 1),
(4, '2024-10-07 07:17:00', '', 1800.00, 1),
(5, '2024-10-08 06:52:00', '', 1000.00, 1),
(6, '2024-10-09 16:26:00', '', 2000.00, 1),
(7, '2024-10-10 07:24:00', '', 700.00, 1),
(8, '2024-10-11 07:03:00', '', 2800.00, 1),
(9, '2024-10-12 10:01:00', 'Sabado 12 octubre', 3800.00, 1),
(10, '2024-10-14 07:19:00', '', 2800.00, 1),
(11, '2024-10-15 07:17:00', '', 3800.00, 1),
(12, '2024-10-16 07:32:00', '', 3800.00, 1),
(13, '2024-10-17 07:28:00', '', 3800.00, 1),
(14, '2024-10-18 07:56:00', '', 3800.00, 1),
(15, '2024-10-19 13:07:00', '', 3085.00, 1),
(16, '2024-10-21 07:26:00', '', 3085.00, 1),
(17, '2024-10-22 07:27:00', '', 1500.00, 1),
(18, '2024-10-28 15:54:00', '', 2800.00, 1),
(19, '2024-10-29 07:38:00', '', 2800.00, 1),
(20, '2024-10-30 07:22:00', '', 2800.00, 1),
(21, '2024-10-31 07:39:00', '', 3200.00, 1),
(22, '2024-11-01 07:23:00', '', 3500.00, 1),
(23, '2024-11-02 15:17:00', '', 3600.00, 1),
(24, '2024-11-03 11:40:00', '', 1000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int NOT NULL,
  `id_categoria_gasto` int NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `cantidad_km` decimal(5,2) DEFAULT NULL,
  `precio_galon` decimal(5,2) DEFAULT NULL,
  `comentario` varchar(255) DEFAULT NULL,
  `dia_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `id_categoria_gasto`, `total`, `cantidad_km`, `precio_galon`, `comentario`, `dia_id`) VALUES
(1, 1, 663.00, 124.90, 132.60, 'Gas Mañana Propagas casa. Propina $37', 1),
(2, 3, 200.00, 0.00, 0.00, 'Recarga jueves noche ', 1),
(3, 1, 530.00, 82.00, 132.60, 'Gas tarde Tropigas Av. España', 2),
(4, 1, 530.00, 149.60, 132.60, 'Gas 6 tarde tropigas av españa', 3),
(6, 1, 1705.00, 0.00, 132.60, 'Lunes mañana ', 4),
(7, 3, 200.00, 0.00, 0.00, '', 5),
(8, 1, 530.00, 0.00, 132.60, '', 10),
(9, 3, 200.00, 0.00, 0.00, '', 10),
(10, 3, 400.00, 0.00, 0.00, '', 15),
(11, 1, 530.00, 0.00, 132.60, '', 15),
(12, 1, 800.00, 0.00, 132.60, '', 16),
(13, 3, 400.00, 0.00, 0.00, '', 16),
(14, 1, 800.00, 149.50, 132.60, 'propagas casa mañana ', 19),
(15, 1, 530.00, 89.30, 132.60, 'Tarde Tropigas 27', 20),
(16, 1, 400.00, 0.00, 132.60, '', 21),
(17, 3, 483.35, 0.00, 0.00, 'Recarga mañana', 22),
(18, 4, 500.00, 0.00, 0.00, 'Sammy 200 propina', 23),
(19, 3, 200.00, 0.00, 0.00, 'Recarga noche', 23),
(20, 6, 400.00, 0.00, 0.00, 'Romo', 23),
(21, 1, 400.00, 0.00, 132.60, 'Gas Domingo mañana', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_categorias`
--

CREATE TABLE `gastos_categorias` (
  `id` int NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `gastos_categorias`
--

INSERT INTO `gastos_categorias` (`id`, `descripcion`) VALUES
(1, 'GAS'),
(2, 'RECARGAS CLARO'),
(3, 'RECARGAS INDRIVE'),
(4, 'LAVADO CARRO'),
(5, 'CAR HOLDER'),
(6, 'COMIDA CALLE');

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
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `id` int NOT NULL,
  `kms_recogida` decimal(5,1) NOT NULL,
  `mins_recogida` time NOT NULL,
  `kms_destino` decimal(5,1) NOT NULL,
  `mins_destino` time NOT NULL,
  `efectivo` decimal(8,2) NOT NULL DEFAULT '0.00',
  `tarjeta` decimal(8,2) NOT NULL DEFAULT '0.00',
  `total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `propina` decimal(8,2) NOT NULL DEFAULT '0.00',
  `plataforma_id` tinyint NOT NULL,
  `dia_id` int NOT NULL,
  `fecha_hora` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`id`, `kms_recogida`, `mins_recogida`, `kms_destino`, `mins_destino`, `efectivo`, `tarjeta`, `total`, `propina`, `plataforma_id`, `dia_id`, `fecha_hora`) VALUES
(81, 2.7, '00:09:00', 17.0, '00:42:00', 0.00, 416.40, 416.40, 0.00, 1, 1, NULL),
(84, 1.3, '00:05:00', 8.1, '00:23:00', 260.00, 0.00, 260.00, 0.00, 2, 1, NULL),
(85, 1.9, '00:07:00', 7.8, '00:33:00', 300.00, 0.00, 400.00, 100.00, 2, 1, NULL),
(86, 0.4, '00:03:00', 6.4, '00:26:00', 250.00, 0.00, 1150.00, 900.00, 2, 1, NULL),
(87, 1.2, '00:06:00', 15.0, '00:46:00', 370.00, 0.00, 370.00, 0.00, 2, 1, NULL),
(88, 2.0, '00:09:00', 17.0, '00:53:00', 480.00, 0.00, 480.00, 0.00, 2, 2, NULL),
(89, 0.2, '00:02:00', 10.9, '00:32:00', 250.00, 0.00, 250.00, 0.00, 3, 2, NULL),
(90, 0.8, '00:04:00', 5.5, '00:25:00', 250.00, 0.00, 250.00, 0.00, 2, 2, NULL),
(91, 2.8, '00:08:00', 1.3, '00:07:00', 200.00, 0.00, 200.00, 0.00, 2, 2, NULL),
(92, 0.2, '00:02:00', 2.2, '00:11:00', 200.00, 0.00, 200.00, 0.00, 2, 2, NULL),
(93, 1.1, '00:05:00', 3.8, '00:15:00', 200.00, 0.00, 200.00, 0.00, 2, 2, NULL),
(94, 0.6, '00:05:00', 3.1, '00:09:00', 200.00, 0.00, 200.00, 0.00, 2, 2, NULL),
(95, 0.5, '00:04:00', 4.4, '00:13:00', 200.00, 0.00, 200.00, 0.00, 2, 2, NULL),
(96, 0.8, '00:04:00', 16.5, '00:50:00', 480.00, 0.00, 500.00, 20.00, 2, 2, NULL),
(97, 1.7, '00:06:00', 7.5, '00:15:00', 200.00, 0.00, 250.00, 50.00, 2, 3, NULL),
(98, 1.1, '00:04:00', 5.3, '00:10:00', 150.00, 0.00, 150.00, 0.00, 2, 3, NULL),
(99, 0.5, '00:00:00', 1.1, '00:00:00', 120.00, 0.00, 120.00, 0.00, 2, 3, NULL),
(100, 0.3, '00:03:00', 15.0, '00:34:00', 350.00, 0.00, 400.00, 50.00, 2, 3, NULL),
(101, 1.7, '00:06:00', 35.0, '01:04:00', 550.00, 0.00, 600.00, 50.00, 2, 3, NULL),
(102, 1.8, '00:07:00', 26.0, '01:02:00', 0.00, 455.98, 455.98, 0.00, 1, 3, NULL),
(103, 1.0, '00:04:00', 3.9, '00:13:00', 200.00, 0.00, 200.00, 0.00, 2, 3, NULL),
(104, 2.3, '00:06:00', 7.7, '00:13:00', 260.00, 0.00, 260.00, 0.00, 2, 3, NULL),
(105, 1.7, '00:10:00', 14.0, '00:23:00', 300.00, 0.00, 300.00, 0.00, 2, 3, NULL),
(106, 0.6, '00:04:00', 12.0, '00:18:00', 250.00, 0.00, 250.00, 0.00, 2, 3, NULL),
(107, 2.6, '00:06:00', 5.0, '00:20:00', 350.00, 0.00, 350.00, 0.00, 2, 3, NULL),
(108, 0.4, '00:02:00', 0.3, '00:02:00', 200.00, 0.00, 200.00, 0.00, 2, 4, '2024-10-07 07:30:29'),
(109, 0.4, '00:03:00', 3.9, '00:15:00', 240.00, 0.00, 240.00, 0.00, 2, 4, '2024-10-07 08:19:13'),
(110, 0.6, '00:04:00', 11.0, '00:32:00', 300.00, 0.00, 300.00, 0.00, 2, 4, '2024-10-07 08:35:42'),
(111, 1.8, '00:07:00', 7.2, '00:21:00', 260.00, 0.00, 300.00, 40.00, 2, 4, '2024-10-07 09:15:57'),
(113, 1.3, '00:09:00', 9.7, '00:25:00', 0.00, 350.00, 350.00, 0.00, 2, 5, '2024-10-08 07:03:19'),
(114, 3.3, '00:05:00', 11.0, '00:24:00', 300.00, 0.00, 300.00, 0.00, 2, 5, '2024-10-08 08:03:04'),
(115, 1.1, '00:06:00', 3.7, '00:13:00', 200.00, 0.00, 250.00, 50.00, 2, 6, '2024-10-09 16:31:01'),
(116, 0.9, '00:03:00', 10.2, '00:59:00', 250.00, 0.00, 250.00, 0.00, 2, 6, '2024-10-09 18:26:43'),
(117, 0.5, '00:03:00', 4.7, '00:16:00', 140.00, 0.00, 140.00, 0.00, 2, 6, '2024-10-09 20:23:16'),
(118, 0.7, '00:05:00', 2.3, '00:10:00', 150.00, 0.00, 150.00, 0.00, 2, 6, '2024-10-09 20:52:15'),
(119, 1.0, '00:04:00', 13.0, '00:26:00', 240.00, 0.00, 250.00, 10.00, 2, 6, '2024-10-09 21:40:55'),
(120, 1.0, '00:03:00', 4.2, '00:10:00', 150.00, 0.00, 160.00, 10.00, 2, 6, '2024-10-09 22:31:10'),
(121, 1.4, '00:05:00', 3.7, '00:17:00', 200.00, 0.00, 200.00, 0.00, 2, 7, '2024-10-10 07:31:46'),
(122, 0.7, '00:04:00', 1.6, '00:08:00', 130.00, 0.00, 130.00, 0.00, 2, 7, '2024-10-10 08:08:56'),
(123, 0.6, '00:04:00', 12.0, '00:36:00', 300.00, 0.00, 300.00, 0.00, 2, 7, '2024-10-10 08:42:07'),
(124, 0.0, '00:00:00', 13.0, '00:42:00', 350.00, 0.00, 350.00, 0.00, 2, 8, '2024-10-11 07:34:57'),
(125, 1.3, '00:06:00', 33.0, '00:00:00', 600.00, 0.00, 600.00, 100.00, 2, 8, '2024-10-11 18:15:59'),
(126, 1.4, '00:05:00', 3.3, '00:12:00', 250.00, 0.00, 250.00, 0.00, 2, 8, '2024-10-11 20:24:50'),
(127, 0.6, '00:03:00', 10.0, '00:21:00', 300.00, 0.00, 300.00, 0.00, 2, 9, '2024-10-12 11:56:41'),
(128, 3.5, '00:09:00', 18.0, '00:24:00', 300.00, 0.00, 300.00, 0.00, 2, 9, '2024-10-12 12:40:08'),
(129, 0.6, '00:04:00', 9.2, '00:26:00', 250.00, 0.00, 250.00, 0.00, 2, 9, '2024-10-12 13:07:16'),
(130, 1.0, '00:04:00', 15.0, '00:29:00', 300.00, 0.00, 400.00, 100.00, 2, 9, '2024-10-12 14:57:52'),
(131, 1.1, '00:04:00', 11.0, '00:29:00', 300.00, 0.00, 300.00, 0.00, 2, 9, '2024-10-12 16:15:07'),
(133, 2.0, '00:06:00', 4.4, '00:10:00', 150.00, 0.00, 200.00, 50.00, 2, 9, '2024-10-12 18:52:12'),
(134, 1.8, '00:05:00', 16.0, '00:36:00', 0.00, 313.00, 313.00, 0.00, 1, 9, '2024-10-12 19:05:45'),
(137, 2.0, '00:04:00', 12.0, '00:26:00', 200.00, 0.00, 200.00, 0.00, 2, 9, '2024-10-13 17:40:32'),
(139, 0.7, '00:05:00', 7.6, '00:31:00', 300.00, 0.00, 500.00, 200.00, 2, 10, '2024-10-14 07:27:41'),
(140, 1.2, '00:04:00', 8.6, '00:18:00', 0.00, 260.00, 260.00, 0.00, 2, 10, '2024-10-14 17:20:46'),
(141, 0.2, '00:01:00', 31.0, '00:06:00', 350.00, 0.00, 350.00, 0.00, 2, 10, '2024-10-14 17:40:54'),
(142, 1.0, '00:03:00', 1.2, '00:06:00', 140.00, 0.00, 140.00, 0.00, 2, 10, '2024-10-14 21:34:48'),
(143, 1.2, '00:05:00', 23.0, '00:15:00', 300.00, 0.00, 300.00, 0.00, 2, 10, '2024-10-14 21:38:45'),
(144, 1.9, '00:08:00', 3.5, '00:17:00', 200.00, 0.00, 200.00, 0.00, 2, 11, '2024-10-15 07:27:05'),
(145, 1.4, '00:07:00', 12.0, '00:47:00', 480.00, 0.00, 500.00, 20.00, 2, 11, '2024-10-15 08:22:23'),
(146, 0.5, '00:03:00', 4.7, '00:23:00', 0.00, 258.73, 258.73, 0.00, 1, 11, '2024-10-15 16:29:53'),
(147, 1.0, '00:08:00', 6.7, '00:48:00', 0.00, 302.00, 302.00, 0.00, 1, 11, '2024-10-15 17:02:11'),
(148, 1.1, '00:05:00', 3.3, '00:15:00', 0.00, 145.00, 145.00, 0.00, 1, 11, '2024-10-15 17:57:15'),
(149, 1.9, '00:08:00', 4.0, '00:15:00', 150.00, 0.00, 150.00, 0.00, 2, 11, '2024-10-15 18:59:39'),
(150, 0.3, '00:02:00', 1.0, '00:04:00', 150.00, 0.00, 150.00, 0.00, 2, 11, '2024-10-15 19:39:21'),
(151, 1.3, '00:04:00', 7.6, '00:20:00', 282.00, -54.39, 245.61, 18.00, 1, 11, '2024-10-15 20:10:03'),
(152, 0.9, '00:05:00', 1.8, '00:07:00', 120.00, -30.00, 90.00, 0.00, 1, 11, '2024-10-15 21:17:35'),
(153, 0.5, '00:02:00', 2.6, '00:08:00', 0.00, 95.98, 95.98, 0.00, 1, 11, '2024-10-15 21:30:15'),
(154, 0.6, '00:03:00', 6.7, '00:17:00', 180.00, 0.00, 200.00, 20.00, 2, 11, '2024-10-15 21:50:03'),
(155, 0.8, '00:03:00', 1.0, '00:05:00', 100.00, -10.00, 90.00, 0.00, 1, 11, '2024-10-15 22:49:13'),
(156, 0.0, '00:00:00', 2.2, '00:09:00', 100.00, -10.00, 90.00, 0.00, 1, 11, '2024-10-15 23:03:15'),
(157, 0.3, '00:04:00', 2.0, '00:08:00', 500.00, -368.17, 131.83, 0.00, 1, 11, '2024-10-15 23:39:18'),
(158, 1.0, '00:05:00', 4.7, '00:13:00', 200.00, 0.00, 200.00, 0.00, 2, 12, '2024-10-16 07:32:50'),
(159, 0.8, '00:04:00', 8.6, '00:35:00', 250.00, 0.00, 250.00, 0.00, 2, 12, '2024-10-16 16:33:24'),
(160, 1.8, '00:07:00', 4.4, '00:14:00', 170.00, 0.00, 200.00, 30.00, 2, 13, '2024-10-17 07:48:59'),
(161, 1.3, '00:06:00', 9.7, '00:47:00', 300.00, 0.00, 300.00, 0.00, 2, 13, '2024-10-17 08:00:33'),
(162, 0.8, '00:04:00', 12.0, '00:40:00', 300.00, 0.00, 300.00, 0.00, 2, 13, '2024-10-17 16:28:33'),
(163, 1.9, '00:07:00', 8.3, '00:20:00', 260.00, 0.00, 260.00, 0.00, 2, 13, '2024-10-17 21:11:31'),
(164, 0.8, '00:04:00', 18.0, '01:18:00', 510.00, 0.00, 510.00, 0.00, 2, 14, '2024-10-18 08:05:23'),
(165, 0.8, '00:07:00', 11.0, '00:59:00', 400.00, 0.00, 400.00, 0.00, 2, 14, '2024-10-18 17:45:26'),
(166, 2.1, '00:06:00', 10.0, '00:40:00', 300.00, 0.00, 300.00, 0.00, 2, 14, '2024-10-18 19:25:15'),
(167, 0.6, '00:03:00', 1.6, '00:06:00', 150.00, 0.00, 150.00, 0.00, 2, 14, '2024-10-18 20:59:33'),
(168, 0.5, '00:03:00', 16.0, '00:28:00', 300.00, 0.00, 300.00, 0.00, 2, 14, '2024-10-18 21:05:05'),
(169, 0.6, '00:02:00', 6.3, '00:12:00', 200.00, 0.00, 200.00, 0.00, 2, 14, '2024-10-18 21:57:37'),
(170, 0.6, '00:02:00', 2.0, '00:05:00', 200.00, 0.00, 300.00, 100.00, 2, 14, '2024-10-18 22:47:22'),
(171, 1.4, '00:05:00', 8.2, '00:11:00', 285.00, 0.00, 300.00, 15.00, 2, 14, '2024-10-18 23:40:16'),
(172, 0.5, '00:02:00', 6.5, '00:17:00', 200.00, 0.00, 200.00, 0.00, 2, 14, '2024-10-19 00:11:32'),
(173, 1.4, '00:05:00', 9.7, '00:21:00', 240.00, 0.00, 250.00, 10.00, 2, 15, '2024-10-19 13:25:26'),
(174, 1.0, '00:06:00', 2.4, '00:08:00', 150.00, 0.00, 150.00, 0.00, 2, 15, '2024-10-19 14:11:31'),
(175, 2.0, '00:08:00', 3.2, '00:11:00', 180.00, 0.00, 200.00, 20.00, 2, 15, '2024-10-19 14:43:29'),
(176, 1.6, '00:06:00', 10.0, '00:23:00', 240.00, 0.00, 240.00, 0.00, 2, 15, '2024-10-19 15:06:49'),
(177, 0.2, '00:02:00', 2.4, '00:08:00', 150.00, 0.00, 150.00, 0.00, 2, 15, '2024-10-19 15:43:16'),
(178, 0.9, '00:04:00', 2.8, '00:07:00', 180.00, 0.00, 180.00, 20.00, 2, 15, '2024-10-19 16:52:08'),
(179, 1.2, '00:05:00', 10.0, '00:23:00', 250.00, 0.00, 300.00, 50.00, 2, 15, '2024-10-19 17:51:02'),
(180, 0.4, '00:02:00', 15.0, '00:30:00', 390.00, 0.00, 400.00, 10.00, 2, 15, '2024-10-19 18:26:44'),
(181, 2.1, '00:08:00', 12.0, '00:21:00', 330.00, 0.00, 330.00, 0.00, 2, 15, '2024-10-19 21:02:17'),
(182, 0.5, '00:02:00', 4.3, '00:08:00', 200.00, 0.00, 200.00, 0.00, 2, 15, '2024-10-19 23:21:36'),
(183, 1.0, '00:04:00', 0.5, '00:04:00', 200.00, 0.00, 200.00, 0.00, 2, 15, '2024-10-20 00:10:02'),
(184, 1.4, '00:04:00', 1.4, '00:09:00', 150.00, 0.00, 150.00, 0.00, 2, 15, '2024-10-20 00:47:55'),
(185, 2.8, '00:10:00', 12.0, '00:32:00', 400.00, 0.00, 400.00, 0.00, 2, 16, '2024-10-21 08:22:49'),
(186, 2.8, '00:07:00', 12.0, '00:50:00', 420.00, 0.00, 450.00, 30.00, 2, 16, '2024-10-21 08:23:11'),
(187, 2.0, '00:08:00', 15.0, '00:40:00', 440.00, 0.00, 450.00, 10.00, 2, 16, '2024-10-21 18:15:29'),
(188, 1.0, '00:06:00', 11.0, '00:49:00', 380.00, 0.00, 400.00, 20.00, 2, 16, '2024-10-21 18:59:07'),
(189, 2.1, '00:10:00', 11.0, '00:30:00', 780.00, 0.00, 780.00, 0.00, 2, 17, '2024-10-22 07:28:25'),
(190, 2.7, '00:13:00', 13.0, '00:55:00', 520.00, 0.00, 520.00, 0.00, 2, 17, '2024-10-22 09:28:43'),
(191, 1.6, '00:06:00', 8.0, '00:30:00', 300.00, 0.00, 300.00, 0.00, 2, 17, '2024-10-22 09:39:33'),
(192, 2.8, '00:06:00', 11.0, '00:45:00', 450.00, 0.00, 450.00, 0.00, 2, 18, '2024-10-28 08:54:52'),
(193, 0.3, '00:05:00', 10.5, '00:35:00', 250.00, 0.00, 250.00, 0.00, 3, 18, '2024-10-28 15:57:28'),
(194, 1.0, '00:06:00', 17.0, '00:51:00', 550.00, 0.00, 550.00, 0.00, 2, 18, '2024-10-28 18:13:16'),
(195, 2.0, '00:05:00', 9.8, '00:38:00', 300.00, 0.00, 300.00, 0.00, 2, 19, '2024-10-29 07:40:09'),
(196, 2.0, '00:06:00', 11.0, '00:42:00', 380.00, 0.00, 500.00, 120.00, 2, 19, '2024-10-29 08:24:59'),
(197, 0.5, '00:02:00', 12.0, '00:37:00', 200.00, 0.00, 200.00, 0.00, 3, 19, '2024-10-29 17:01:35'),
(198, 1.0, '00:06:00', 5.4, '00:23:00', 240.00, 0.00, 240.00, 0.00, 2, 19, '2024-10-29 17:52:21'),
(199, 1.0, '00:04:00', 6.0, '00:16:00', 180.00, 0.00, 200.00, 20.00, 2, 19, '2024-10-29 19:17:32'),
(200, 0.3, '00:05:00', 9.0, '00:18:00', 240.00, 0.00, 250.00, 10.00, 2, 19, '2024-10-29 20:01:44'),
(201, 0.7, '00:04:00', 1.4, '00:06:00', 0.00, 116.33, 116.33, 0.00, 1, 19, '2024-10-29 21:12:37'),
(202, 0.8, '00:05:00', 8.1, '00:14:00', 0.00, 215.32, 215.32, 0.00, 1, 19, '2024-10-29 22:07:35'),
(203, 1.0, '00:04:00', 11.0, '00:21:00', 0.00, 251.57, 251.57, 0.00, 1, 19, '2024-10-29 22:17:15'),
(205, 2.2, '00:07:00', 9.2, '00:38:00', 280.00, 0.00, 300.00, 20.00, 2, 20, '2024-10-30 07:34:29'),
(206, 1.1, '00:06:00', 3.6, '00:13:00', 240.00, 0.00, 250.00, 10.00, 2, 20, '2024-10-30 16:28:08'),
(207, 3.5, '00:10:00', 11.0, '00:44:00', 350.00, 0.00, 350.00, 0.00, 2, 20, '2024-10-30 16:53:24'),
(208, 1.1, '00:05:00', 13.0, '00:40:00', 400.00, 0.00, 400.00, 0.00, 2, 20, '2024-10-30 18:26:49'),
(209, 2.4, '00:08:00', 14.0, '01:02:00', 0.00, 403.00, 403.00, 0.00, 1, 21, '2024-10-31 07:58:25'),
(210, 0.3, '00:02:00', 6.9, '00:12:00', 122.00, 0.00, 122.00, 0.00, 1, 21, '2024-10-31 08:52:08'),
(211, 0.4, '00:05:00', 5.8, '00:22:00', 240.00, 0.00, 250.00, 10.00, 2, 21, '2024-10-31 16:33:32'),
(212, 0.8, '00:04:00', 17.0, '00:57:00', 500.00, 0.00, 500.00, 0.00, 2, 21, '2024-10-31 17:07:14'),
(213, 1.2, '00:05:00', 6.0, '00:16:00', 240.00, 0.00, 300.00, 60.00, 2, 21, '2024-10-31 18:48:45'),
(214, 1.0, '00:04:00', 6.1, '00:13:00', 180.00, 0.00, 200.00, 20.00, 2, 21, '2024-10-31 19:14:48'),
(215, 0.4, '00:03:00', 8.6, '00:13:00', 190.00, 0.00, 200.00, 10.00, 2, 21, '2024-10-31 21:17:22'),
(216, 0.4, '00:02:00', 3.0, '00:08:00', 98.01, 0.00, 98.01, 0.00, 2, 21, '2024-10-31 21:49:48'),
(217, 3.0, '00:10:00', 8.1, '00:16:00', 280.00, 0.00, 300.00, 20.00, 2, 22, '2024-11-01 07:34:24'),
(218, 1.0, '00:07:00', 5.4, '00:19:00', 240.00, 0.00, 250.00, 10.00, 2, 22, '2024-11-01 08:10:36'),
(219, 0.4, '00:02:00', 13.0, '00:40:00', 250.00, 0.00, 250.00, 0.00, 2, 22, '2024-11-01 16:24:21'),
(220, 1.9, '00:06:00', 8.5, '00:35:00', 290.00, 0.00, 290.00, 0.00, 2, 22, '2024-11-01 18:44:22'),
(221, 1.1, '00:06:00', 11.0, '00:25:00', 300.00, 0.00, 300.00, 0.00, 2, 22, '2024-11-01 19:23:35'),
(222, 0.2, '00:01:00', 8.1, '00:21:00', 260.00, 0.00, 300.00, 40.00, 2, 22, '2024-11-01 20:06:01'),
(223, 1.8, '00:06:00', 10.0, '00:20:00', 300.00, 0.00, 500.00, 200.00, 2, 22, '2024-11-01 22:04:00'),
(224, 0.2, '00:02:00', 19.0, '00:30:00', 350.00, 0.00, 400.00, 50.00, 2, 22, '2024-11-01 22:35:12'),
(225, 0.2, '00:02:00', 2.4, '00:10:00', 0.00, 90.00, 90.00, 0.00, 1, 23, '2024-11-02 15:18:09'),
(226, 1.9, '00:12:00', 12.0, '00:28:00', 300.00, 0.00, 350.00, 50.00, 2, 23, '2024-11-02 15:49:35'),
(227, 0.8, '00:06:00', 11.0, '00:20:00', 280.00, 0.00, 300.00, 20.00, 2, 23, '2024-11-02 16:41:06'),
(228, 3.0, '00:08:00', 7.6, '00:16:00', 240.00, 0.00, 250.00, 10.00, 2, 23, '2024-11-02 17:15:16'),
(229, 1.3, '00:05:00', 2.8, '00:12:00', 150.00, 0.00, 150.00, 0.00, 2, 23, '2024-11-02 17:54:17'),
(230, 0.7, '00:04:00', 2.2, '00:11:00', 150.00, 0.00, 150.00, 0.00, 2, 23, '2024-11-02 18:17:19'),
(231, 0.9, '00:06:00', 7.0, '00:32:00', 300.00, 0.00, 300.00, 0.00, 2, 23, '2024-11-02 19:09:14'),
(232, 0.9, '00:05:00', 2.6, '00:13:00', 250.00, 0.00, 250.00, 0.00, 2, 23, '2024-11-02 19:44:59'),
(233, 1.2, '00:06:00', 16.0, '00:36:00', 300.00, 0.00, 400.00, 100.00, 2, 23, '2024-11-02 20:49:25'),
(234, 3.0, '00:11:00', 11.0, '00:23:00', 280.00, 0.00, 280.00, 0.00, 2, 23, '2024-11-02 21:52:02'),
(235, 1.0, '00:03:00', 13.0, '00:20:00', 270.00, 0.00, 300.00, 30.00, 2, 23, '2024-11-03 00:15:01'),
(236, 1.0, '00:03:00', 7.7, '00:20:00', 250.00, 0.00, 300.00, 50.00, 2, 23, '2024-11-03 00:43:02'),
(237, 3.1, '00:08:00', 15.7, '00:27:00', 300.00, 0.00, 350.00, 50.00, 2, 24, '2024-11-03 12:05:01'),
(238, 1.0, '00:05:00', 12.0, '00:20:00', 280.00, 0.00, 300.00, 20.00, 2, 24, '2024-11-03 13:02:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria_gasto` (`id_categoria_gasto`);

--
-- Indices de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD CONSTRAINT `gastos_ibfk_1` FOREIGN KEY (`id_categoria_gasto`) REFERENCES `gastos_categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
