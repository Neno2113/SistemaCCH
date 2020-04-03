-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2020 a las 17:40:55
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cch`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id` int(11) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `codigo_almacen` varchar(20) DEFAULT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `usado_curva` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `corte_id`, `producto_id`, `user_id`, `codigo_almacen`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `usado_curva`, `updated_at`, `created_at`) VALUES
(42, 55, 104, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-05 15:36:11', '2020-03-05 15:34:24'),
(43, 53, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 340, NULL, '2020-03-05 16:58:20', '2020-03-05 16:57:57'),
(44, 56, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 340, NULL, '2020-03-06 14:33:38', '2020-03-06 11:11:37'),
(45, 57, 104, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-06 14:25:52', '2020-03-06 14:20:21'),
(46, 58, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-09 10:50:14', '2020-03-09 10:49:15'),
(47, 59, 104, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 490, NULL, '2020-03-09 15:03:40', '2020-03-09 14:07:24'),
(48, 60, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-09 15:35:59', '2020-03-09 15:22:51'),
(49, 63, 110, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-10 08:44:27', '2020-03-10 08:29:55'),
(50, 64, 112, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-10 08:57:41', '2020-03-10 08:56:34'),
(51, 65, 105, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 440, NULL, '2020-03-19 11:27:18', '2020-03-19 11:26:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_detalle`
--

CREATE TABLE `almacen_detalle` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `producto_id_ref_2` int(11) DEFAULT NULL,
  `codigo_entrada` varchar(10) DEFAULT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `impreso` tinyint(1) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_impreso` datetime DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen_detalle`
--

INSERT INTO `almacen_detalle` (`id`, `almacen_id`, `producto_id`, `producto_id_ref_2`, `codigo_entrada`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `impreso`, `fecha_entrada`, `fecha_impreso`, `sec`, `created_at`, `updated_at`) VALUES
(184, 42, 104, NULL, 'EA-001', 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, NULL, '2020-03-05', NULL, '0.01', '2020-03-05 15:36:11', '2020-03-05 00:00:00'),
(185, 43, 105, NULL, 'EA-002', 0, 0, 50, 60, 60, 60, 60, 50, 0, 0, 0, 0, 340, NULL, '2020-03-05', NULL, '0.02', '2020-03-05 16:58:20', '2020-03-05 00:00:00'),
(191, 44, 105, NULL, 'EA-003', 0, 0, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 30, NULL, '2020-03-06', NULL, '0.03', '2020-03-06 11:12:35', '2020-03-06 00:00:00'),
(192, 44, 105, NULL, 'EA-004', 0, 0, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 30, NULL, '2020-03-06', NULL, '0.04', '2020-03-06 11:16:55', '2020-03-06 00:00:00'),
(193, 44, 105, NULL, 'EA-005', 0, 0, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 30, NULL, '2020-03-06', NULL, '0.05', '2020-03-06 11:19:25', '2020-03-06 00:00:00'),
(194, 45, 104, NULL, 'EA-006', 5, 5, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 40, NULL, '2020-03-06', NULL, '0.06', '2020-03-06 14:24:33', '2020-03-06 00:00:00'),
(195, 45, 104, NULL, 'EA-007', 5, 5, 5, 5, 5, 5, 5, 5, 0, 0, 0, 0, 40, NULL, '2020-03-06', NULL, '0.07', '2020-03-06 14:25:01', '2020-03-06 00:00:00'),
(196, 45, 104, NULL, 'EA-008', 20, 20, 20, 20, 20, 20, 20, 20, 0, 0, 0, 0, 160, NULL, '2020-03-06', NULL, '0.08', '2020-03-06 14:25:30', '2020-03-06 00:00:00'),
(197, 45, 104, NULL, 'EA-009', 20, 30, 30, 20, 20, 30, 30, 20, 0, 0, 0, 0, 200, NULL, '2020-03-06', NULL, '0.09', '2020-03-06 14:25:52', '2020-03-06 00:00:00'),
(198, 44, 105, NULL, 'EA-010', 0, 0, 35, 35, 35, 35, 35, 35, 0, 0, 0, 0, 210, NULL, '2020-03-06', NULL, '0.10', '2020-03-06 14:33:23', '2020-03-06 00:00:00'),
(199, 44, 105, NULL, 'EA-011', 0, 0, 0, 10, 10, 10, 10, 0, 0, 0, 0, 0, 40, 1, '2020-03-06', '2020-03-06 02:33:41', '0.11', '2020-03-06 14:33:38', '2020-03-06 00:00:00'),
(200, 46, 105, NULL, 'EA-012', 0, 0, 30, 40, 40, 40, 40, 30, 0, 0, 0, 0, 220, 1, '2020-03-09', '2020-03-09 10:49:57', '0.12', '2020-03-09 10:49:55', '2020-03-09 00:00:00'),
(201, 46, 105, NULL, 'EA-013', 0, 0, 30, 40, 40, 40, 40, 30, 0, 0, 0, 0, 220, NULL, '2020-03-09', NULL, '0.13', '2020-03-09 10:50:14', '2020-03-09 00:00:00'),
(202, 47, 104, NULL, 'EA-014', 50, 30, 30, 40, 30, 30, 40, 40, 0, 0, 0, 0, 290, 1, '2020-03-09', '2020-03-09 02:09:02', '0.14', '2020-03-09 14:08:54', '2020-03-09 00:00:00'),
(203, 47, 104, NULL, 'EA-015', 0, 30, 30, 10, 20, 30, 20, 10, 0, 0, 0, 0, 150, 1, '2020-03-10', '2020-03-09 02:11:24', '0.15', '2020-03-09 14:11:22', '2020-03-09 00:00:00'),
(205, 48, 105, NULL, 'EA-016', 0, 0, 20, 20, 20, 20, 20, 20, 0, 0, 0, 0, 120, NULL, '2020-03-09', NULL, '0.16', '2020-03-09 15:24:00', '2020-03-09 00:00:00'),
(206, 48, 105, NULL, 'EA-017', 0, 0, 20, 20, 20, 20, 20, 20, 0, 0, 0, 0, 120, 1, '2020-03-09', '2020-03-09 03:33:04', '0.17', '2020-03-09 15:32:58', '2020-03-09 00:00:00'),
(207, 48, 105, NULL, 'EA-018', 0, 0, 20, 20, 20, 20, 20, 20, 0, 0, 0, 0, 120, NULL, '2020-03-09', NULL, '0.18', '2020-03-09 15:35:23', '2020-03-09 00:00:00'),
(208, 48, 105, NULL, 'EA-019', 0, 0, 0, 20, 20, 20, 20, 0, 0, 0, 0, 0, 80, NULL, '2020-03-09', NULL, '0.19', '2020-03-09 15:35:59', '2020-03-09 00:00:00'),
(209, 49, 110, NULL, 'EA-020', 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, 1, '2020-03-10', '2020-03-10 08:44:30', '0.20', '2020-03-10 08:44:27', '2020-03-10 00:00:00'),
(210, 50, 112, NULL, 'EA-021', 50, 60, 50, 50, 50, 60, 60, 50, 0, 0, 0, 0, 430, NULL, '2020-03-10', NULL, '0.21', '2020-03-10 08:57:35', '2020-03-10 00:00:00'),
(211, 50, 112, NULL, 'EA-022', 0, 0, 0, 10, 0, 0, 0, 0, 0, 0, 0, 0, 10, 1, '2020-03-10', '2020-03-10 08:57:59', '0.22', '2020-03-10 08:57:41', '2020-03-10 00:00:00'),
(212, 51, 105, NULL, 'EA-023', 0, 0, 40, 40, 40, 40, 40, 40, 0, 0, 0, 0, 240, NULL, '2020-03-19', NULL, '0.23', '2020-03-19 11:27:02', '2020-03-19 11:27:02'),
(213, 51, 105, NULL, 'EA-024', 0, 0, 20, 40, 40, 40, 40, 20, 0, 0, 0, 0, 200, NULL, '2020-03-19', NULL, '0.24', '2020-03-19 11:27:18', '2020-03-19 11:27:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogo_cuenta`
--

CREATE TABLE `catalogo_cuenta` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `tipo_cuenta` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogo_cuenta`
--

INSERT INTO `catalogo_cuenta` (`id`, `codigo`, `descripcion`, `tipo_cuenta`, `updated_at`, `created_at`) VALUES
(3, '44000-191', 'Cuenta de pantalones', 'Account Receivable', '2020-03-28 11:55:34', '2020-03-28 11:55:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `codigo_cliente` varchar(50) DEFAULT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `sitios_cercanos` varchar(255) DEFAULT NULL,
  `rnc` varchar(15) DEFAULT NULL,
  `contacto_cliente_principal` varchar(45) DEFAULT NULL,
  `telefono_1` varchar(45) DEFAULT NULL,
  `telefono_2` varchar(45) DEFAULT NULL,
  `telefono_3` varchar(45) DEFAULT NULL,
  `celular_principal` varchar(45) DEFAULT NULL,
  `email_principal` varchar(100) DEFAULT NULL,
  `condiciones_credito` varchar(45) DEFAULT NULL,
  `autorizacion_credito_req` tinyint(4) DEFAULT NULL,
  `notas` longtext DEFAULT NULL,
  `redistribucion_tallas` tinyint(4) DEFAULT NULL,
  `factura_desglosada_talla` tinyint(4) DEFAULT NULL,
  `acepta_segundas` tinyint(4) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `codigo_cliente`, `nombre_cliente`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `rnc`, `contacto_cliente_principal`, `telefono_1`, `telefono_2`, `telefono_3`, `celular_principal`, `email_principal`, `condiciones_credito`, `autorizacion_credito_req`, `notas`, `redistribucion_tallas`, `factura_desglosada_talla`, `acepta_segundas`, `updated_at`, `created_at`) VALUES
(3, 'IS350', 'Plaza Lama', 'Ave. 27 de febrero', 'Piantini', 'Distrito Nacional', 'Churchill', '10100026555', 'Jose', '(829) 943-6531', '(809) 288-2113', NULL, '(809) 288-2113', 'plazalama@lama.com', '60 dias', 1, 'Hii', 1, 0, 0, '2020-03-13 16:39:57', '2020-01-23 13:53:39'),
(4, 'IX25v', 'Lordish', 'primera', 'Santo Domingo', 'Santo Domingo', NULL, '10100203220', 'Fulano', '(809) 288-2113', NULL, NULL, '(809) 943-6531', 'lordish@lordish.com', '60 dias', 1, 'test', 1, 0, 0, '2020-03-13 16:40:41', '2020-02-11 08:35:35'),
(5, NULL, 'La Sirena', 'calle sanchez', 'Santo Domingo', 'Santo Domingo', NULL, '10100020202', 'Jose', '(809) 288-2113', '(809) 528-4101', '(809) 525-2410', '(809) 288-2113', 'sirena@sirena.com', '60 dias', 1, NULL, 1, 0, 1, '2020-02-24 08:47:14', '2020-02-19 15:00:50'),
(6, 'x', 'GENERICO', 'Diego tristan', 'El Almirante', 'Santo Domingo', NULL, '00000000000', 'Generico', '(829) 943-6531', NULL, NULL, '(809) 528-4022', 'gen@gen.com', 'Contado', 1, 'Cliente generico para ventas al contado', 1, 0, 0, '2020-03-31 14:52:47', '2020-03-31 14:52:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_sucursales`
--

CREATE TABLE `cliente_sucursales` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `codigo_sucursal` varchar(100) DEFAULT NULL,
  `nombre_sucursal` varchar(150) DEFAULT NULL,
  `telefono_sucursal` varchar(45) DEFAULT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `sector` varchar(150) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `sitios_cercanos` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_sucursales`
--

INSERT INTO `cliente_sucursales` (`id`, `cliente_id`, `codigo_sucursal`, `nombre_sucursal`, `telefono_sucursal`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `updated_at`, `created_at`) VALUES
(2, NULL, NULL, 'Principal ', NULL, NULL, NULL, NULL, NULL, '2019-12-30 10:13:31', '2019-12-30 11:43:38'),
(4, 3, '3-52', 'Plaza lama Luperon', '(829) 655-3053', 'av. Luperon', 'Pantoja', 'Santo Domingo', 'Test', '2020-01-28 16:39:55', '2020-01-23 13:54:44'),
(5, 5, '5-20', 'La sirena San Cristobal', '(809) 288-2113', 'calle sanchez', 'madre vieja sur', 'San Cristóbal', 'Liceo Puello Renville', '2020-02-19 15:01:23', '2020-02-19 15:01:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `composiciones`
--

CREATE TABLE `composiciones` (
  `id` int(11) NOT NULL,
  `codigo_composicion` varchar(60) DEFAULT NULL,
  `nombre_composicion` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `composiciones`
--

INSERT INTO `composiciones` (`id`, `codigo_composicion`, `nombre_composicion`, `updated_at`, `created_at`) VALUES
(1, NULL, 'Algodon', '2019-12-24 10:00:07', '2019-12-24 10:00:07'),
(2, NULL, 'Elastano', '2019-12-24 10:00:18', '2019-12-24 10:00:18'),
(3, NULL, 'Poliester', '2019-12-24 10:00:26', '2019-12-24 10:00:26'),
(4, NULL, 'Viscosa', '2019-12-24 10:08:54', '2019-12-24 10:08:54'),
(5, NULL, 'T-400', '2019-12-24 10:09:09', '2019-12-24 10:09:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `id` int(11) NOT NULL,
  `numero_corte` varchar(20) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `producto_id_ref_2` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `fecha_corte` date DEFAULT NULL,
  `no_marcada` varchar(45) DEFAULT NULL,
  `ancho_marcada` int(11) DEFAULT NULL,
  `largo_marcada` varchar(45) DEFAULT NULL,
  `aprovechamiento` decimal(4,2) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fase` varchar(100) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`id`, `numero_corte`, `producto_id`, `producto_id_ref_2`, `user_id`, `fecha_corte`, `no_marcada`, `ancho_marcada`, `largo_marcada`, `aprovechamiento`, `fecha_entrega`, `fase`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(53, '2020-001', 105, NULL, 1, '2020-03-05', 'ST X29', 50, '30', '88.00', '2020-04-14', 'Almacen', 340, '0.01', '2020-03-05 16:57:57', '2020-03-05 09:44:00'),
(55, '2020-003', 104, NULL, 1, '2020-03-05', 'ST X30', 20, '30', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-05 15:34:23', '2020-03-05 15:22:31'),
(56, '2020-004', 105, NULL, 1, '2020-03-06', 'ST X31', 20, '50', '88.00', '2020-04-14', 'Almacen', 340, '0.01', '2020-03-06 11:11:37', '2020-03-06 11:10:15'),
(57, '2020-005', 104, NULL, 1, '2020-03-06', 'ST X27', 10, '20', '90.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-06 14:20:21', '2020-03-06 13:37:43'),
(58, '2020-006', 105, NULL, 1, '2020-03-09', 'STX 32', 10, '20', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-09 10:49:15', '2020-03-09 10:45:15'),
(59, '2020-007', 104, NULL, 1, '2020-03-09', 'STX 33', 10, '20', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-09 14:07:24', '2020-03-09 13:53:43'),
(60, '2020-008', 105, NULL, 1, '2020-03-09', 'STX 34', 30, '55', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-09 15:22:51', '2020-03-09 15:19:51'),
(63, '2020-009', 110, NULL, 1, '2020-03-10', 'STX 35', 10, '20', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-10 08:29:55', '2020-03-10 08:26:33'),
(64, '2020-010', 112, NULL, 1, '2020-03-10', 'STX 36', 10, '20', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-10 08:56:34', '2020-03-10 08:54:06'),
(65, '2020-011', 105, NULL, 1, '2020-03-11', 'STX 37', 10, '20', '88.00', '2020-04-14', 'Almacen', 440, '0.01', '2020-03-19 11:26:41', '2020-03-11 14:54:24'),
(66, '2020-012', 104, NULL, 1, '2020-03-12', 'STX 39', 10, '20', '88.00', '2020-04-14', 'Lavanderia', 440, '0.01', '2020-03-12 08:41:39', '2020-03-12 08:40:57'),
(67, '2020-013', 114, NULL, 1, '2020-03-17', 'STX 40', 10, '20', '88.00', '2020-04-28', 'Produccion', 600, '0.01', '2020-03-17 17:00:39', '2020-03-17 17:00:39'),
(68, '2020-015', 110, NULL, 1, '2020-03-27', 'STX 38', 30, '20', '88.00', '2020-04-28', 'Produccion', 440, '0.01', '2020-03-27 09:52:51', '2020-03-27 09:52:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curva_producto`
--

CREATE TABLE `curva_producto` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `a` decimal(4,2) DEFAULT NULL,
  `b` decimal(4,2) DEFAULT NULL,
  `c` decimal(4,2) DEFAULT NULL,
  `d` decimal(4,2) DEFAULT NULL,
  `e` decimal(4,2) DEFAULT NULL,
  `f` decimal(4,2) DEFAULT NULL,
  `g` decimal(4,2) DEFAULT NULL,
  `h` decimal(4,2) DEFAULT NULL,
  `i` decimal(4,2) DEFAULT NULL,
  `j` decimal(4,2) DEFAULT NULL,
  `k` decimal(4,2) DEFAULT NULL,
  `l` decimal(4,2) DEFAULT NULL,
  `curva_ref_2` varchar(50) DEFAULT NULL,
  `producto_padre` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `curva_producto`
--

INSERT INTO `curva_producto` (`id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `curva_ref_2`, `producto_padre`, `updated_at`, `created_at`) VALUES
(13, 105, '0.00', '0.00', '10.00', '20.00', '20.00', '20.00', '20.00', '10.00', '0.00', '0.00', '0.00', '0.00', '1', NULL, '2020-03-05 09:45:17', '2020-03-05 08:37:19'),
(14, 104, '20.00', '30.00', '30.00', '20.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-03-05 15:16:01', '2020-03-05 15:16:01'),
(15, 107, NULL, NULL, NULL, NULL, '20.00', '30.00', '30.00', '20.00', NULL, NULL, NULL, NULL, '', 104, '2020-03-05 15:34:23', '2020-03-05 15:16:01'),
(16, 110, '20.00', '30.00', '30.00', '20.00', NULL, NULL, NULL, NULL, '0.00', '0.00', '0.00', '0.00', NULL, NULL, '2020-03-27 09:52:28', '2020-03-10 08:24:21'),
(17, 111, NULL, NULL, NULL, NULL, '20.00', '30.00', '30.00', '20.00', NULL, NULL, NULL, NULL, '', 110, '2020-03-27 09:52:29', '2020-03-10 08:24:21'),
(18, 112, '40.00', '50.00', '60.00', '33.33', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, '2020-03-10 08:54:06', '2020-03-10 08:53:32'),
(19, 113, NULL, NULL, NULL, NULL, '20.00', '30.00', '30.00', '20.00', NULL, NULL, NULL, NULL, '', 112, '2020-03-10 08:56:33', '2020-03-10 08:53:32'),
(20, 114, '17.00', '17.00', '17.00', '17.00', '16.00', '16.00', '16.00', '16.00', '0.00', '0.00', '0.00', '0.00', NULL, NULL, '2020-03-17 17:00:39', '2020-03-17 16:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `codigo` varchar(20) DEFAULT NULL,
  `calle` varchar(255) NOT NULL,
  `sector` varchar(255) NOT NULL,
  `provincia` varchar(200) NOT NULL,
  `sitios_cercanos` varchar(255) DEFAULT NULL,
  `telefono_1` varchar(30) NOT NULL,
  `telefono_2` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `cedula` varchar(50) NOT NULL,
  `departamento` varchar(100) NOT NULL,
  `casado` tinyint(1) DEFAULT NULL,
  `cargo` varchar(100) NOT NULL,
  `fecha_contratacion` datetime DEFAULT NULL,
  `fecha_termino_contrato` datetime DEFAULT NULL,
  `tipo_contrato` varchar(50) NOT NULL,
  `forma_pago` varchar(100) DEFAULT NULL,
  `sueldo` decimal(15,2) DEFAULT NULL,
  `valor_hora` decimal(15,2) DEFAULT NULL,
  `banco_tarjeta_cobro` varchar(100) DEFAULT NULL,
  `no_cuenta` varchar(50) DEFAULT NULL,
  `detallado` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id`, `nombre`, `apellido`, `codigo`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `telefono_1`, `telefono_2`, `email`, `cedula`, `departamento`, `casado`, `cargo`, `fecha_contratacion`, `fecha_termino_contrato`, `tipo_contrato`, `forma_pago`, `sueldo`, `valor_hora`, `banco_tarjeta_cobro`, `no_cuenta`, `detallado`, `updated_at`, `created_at`) VALUES
(5, 'Anel', 'Dominguez', NULL, 'primera', 'madre vieja sur', 'San Cristóbal', 'colmado el vecino', '(809) 288-2113', '(829) 943-6531', 'anel@anel.com', '402-2600929-4', 'VENTA', 1, 'VENDEDOR-219 - VENDEDORA', NULL, NULL, 'Fijo', 'Sueldo Fijo', '13000.00', '110.00', 'Banco Popular', '0000120450', 1, '2020-01-23 13:52:10', '2020-01-23 13:47:56'),
(8, 'Gabriel', 'Garcia', NULL, 'calle sanchez', 'madre vieja sur', 'Santo Domingo', NULL, '(809) 288-2113', '(829) 943-6531', 'gabriel@cch.com', '402-2600929-4', 'VENTA', 1, 'VENDEDOR-219 - VENDEDORA', NULL, NULL, 'Fijo', 'Sueldo Fijo', '20000.00', '120.00', 'Banco Popular', '101202020020', 1, '2020-02-19 14:59:28', '2020-02-19 14:57:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_detalle`
--

CREATE TABLE `empleado_detalle` (
  `id` int(11) NOT NULL,
  `empleado_id` int(11) NOT NULL,
  `nss` varchar(30) DEFAULT NULL,
  `nombre_esposa` varchar(100) DEFAULT NULL,
  `telefono_esposa` varchar(30) DEFAULT NULL,
  `esposa_en_nss` tinyint(1) NOT NULL,
  `cantidad_dependientes` int(11) DEFAULT NULL,
  `dependiente_1_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_1` varchar(100) DEFAULT NULL,
  `dependiente_2_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_2` varchar(100) DEFAULT NULL,
  `dependiente_3_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_3` varchar(100) DEFAULT NULL,
  `dependiente_4_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_4` varchar(100) DEFAULT NULL,
  `dependiente_5_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_5` varchar(100) DEFAULT NULL,
  `dependiente_6_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_6` varchar(100) DEFAULT NULL,
  `dependiente_7_nss` tinyint(1) DEFAULT NULL,
  `nombre_dependiente_7` varchar(100) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado_detalle`
--

INSERT INTO `empleado_detalle` (`id`, `empleado_id`, `nss`, `nombre_esposa`, `telefono_esposa`, `esposa_en_nss`, `cantidad_dependientes`, `dependiente_1_nss`, `nombre_dependiente_1`, `dependiente_2_nss`, `nombre_dependiente_2`, `dependiente_3_nss`, `nombre_dependiente_3`, `dependiente_4_nss`, `nombre_dependiente_4`, `dependiente_5_nss`, `nombre_dependiente_5`, `dependiente_6_nss`, `nombre_dependiente_6`, `dependiente_7_nss`, `nombre_dependiente_7`, `updated_at`, `created_at`) VALUES
(5, 5, '999452142', 'Fulana', '(809) 288-2113', 1, 2, 1, 'Fulano 1', 1, 'Fulano 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-23 13:52:10', '2020-01-23 13:52:10'),
(7, 8, '999520410', 'Fulana', '(809) 288-2113', 0, 2, 1, 'Fulano 1', NULL, 'Fulano 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-19 14:59:28', '2020-02-19 14:59:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `existencias`
--

CREATE TABLE `existencias` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) NOT NULL,
  `j` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `orden_facturacion_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `no_factura` varchar(20) NOT NULL,
  `tipo_factura` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_impresion` datetime DEFAULT NULL,
  `comprobante_fiscal` tinyint(1) DEFAULT NULL,
  `numero_comprobante` varchar(20) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `itbis` int(11) NOT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `nota` longtext DEFAULT NULL,
  `impreso` tinyint(1) DEFAULT NULL,
  `nc_uso` tinyint(1) DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `orden_facturacion_id`, `user_id`, `cliente_id`, `sucursal_id`, `no_factura`, `tipo_factura`, `fecha`, `fecha_vencimiento`, `fecha_impresion`, `comprobante_fiscal`, `numero_comprobante`, `descuento`, `itbis`, `total`, `nota`, `impreso`, `nc_uso`, `sec`, `updated_at`, `created_at`) VALUES
(38, 42, 1, NULL, NULL, 'IN-00353250', 'IN', '2020-03-06', NULL, '2020-03-10 05:30:21', 0, 'B01', 5, 18, '24213.60', NULL, 1, 0, '0.01', '2020-03-20 16:49:19', '2020-03-06 15:11:32'),
(39, 41, 1, NULL, NULL, 'B02-03350', 'B02', '2020-03-06', NULL, '2020-03-16 04:22:50', 0, 'B01', 0, 18, '36816.00', NULL, 1, 0, '0.02', '2020-03-20 16:49:15', '2020-03-06 15:25:02'),
(40, 49, 1, NULL, NULL, 'IN-006015050', 'IN', '2020-03-09', NULL, '2020-03-10 11:42:40', 0, 'B01', 5, 18, '34190.50', NULL, 1, 0, '0.03', '2020-03-20 16:49:12', '2020-03-09 16:43:30'),
(41, 50, 1, NULL, NULL, 'IN-00005500020', 'IN', '2020-03-10', NULL, '2020-03-16 04:52:31', 0, 'B01', 9, 18, '46388.16', NULL, 1, 0, '0.04', '2020-03-20 16:44:20', '2020-03-10 09:14:42'),
(42, 47, 1, NULL, NULL, 'B02-06002550', 'B02', '2020-03-10', NULL, '2020-03-16 04:51:27', 0, 'B01', 5, 10, '22572.00', NULL, 1, 0, '0.04', '2020-03-16 16:51:27', '2020-03-10 09:15:50'),
(43, 45, 1, NULL, NULL, 'B01-5022020', 'B01', '2020-03-10', NULL, '2020-03-16 04:53:45', 1, 'B01600005252', 10, 18, '36108.00', NULL, 1, 0, '0.04', '2020-03-20 16:44:16', '2020-03-10 09:16:17'),
(44, 48, 1, NULL, NULL, 'DN-00603000', 'DN', '2020-03-10', NULL, '2020-03-16 04:54:30', 0, 'B01600005252', 0, 0, '48000.00', NULL, 1, 0, '0.05', '2020-03-20 16:45:32', '2020-03-10 09:21:16'),
(45, 46, 1, NULL, NULL, 'IN-0002002', 'IN', '2020-03-10', NULL, '2020-03-16 04:51:46', 0, 'B01', 20, 18, '40780.80', NULL, 1, 0, '0.06', '2020-03-16 16:51:46', '2020-03-10 11:47:38'),
(46, 44, 1, NULL, NULL, 'IN-000020020', 'IN', '2020-03-10', NULL, '2020-03-16 04:52:41', 0, 'B01', 9, 18, '46388.16', NULL, 1, 0, '0.06', '2020-03-20 16:45:29', '2020-03-10 11:48:02'),
(47, 43, 1, NULL, NULL, 'B01-00001000', 'B01', '2020-03-11', NULL, '2020-03-16 04:51:21', 1, 'B0100000364145', 9, 18, '15462.72', NULL, 1, 0, '0.07', '2020-03-20 16:45:35', '2020-03-10 11:49:40'),
(48, 51, 1, NULL, NULL, 'IN-0012052', 'IN', '2020-03-16', '2020-03-31', '2020-04-01 03:51:29', 0, 'B01', 10, 18, '127440.00', NULL, 1, 0, '0.08', '2020-04-01 15:51:29', '2020-03-16 16:05:11'),
(49, 52, 1, NULL, NULL, 'B01-0000220', 'B01', '2020-03-19', '2020-03-19', '2020-03-20 02:26:47', 1, 'B0100003250', 10, 18, '25488.00', 'Test', 1, 0, '0.09', '2020-03-20 16:45:42', '2020-03-19 08:50:14'),
(50, 53, 1, NULL, NULL, 'B02-00302010', 'B02', '2020-03-19', '2020-03-31', '2020-03-19 09:43:02', 0, 'B01', 5, 18, '72865.00', NULL, 1, 0, '0.10', '2020-03-20 16:45:45', '2020-03-19 09:42:56'),
(51, 54, 1, NULL, NULL, 'B01-00012410', 'B01', '2020-03-20', '2020-03-31', '2020-04-01 05:12:28', 1, 'B0100012410', 10, 18, '15292.80', 'Test update 2', 1, 1, '0.13', '2020-04-03 11:20:49', '2020-03-20 14:45:13'),
(55, NULL, 1, 6, 2, 'IN-001310', 'IN', '2020-04-01', '2020-04-15', '2020-04-02 08:59:16', NULL, NULL, 0, 0, '2240.00', NULL, 1, 0, '0.17', '2020-04-02 08:59:16', '2020-04-01 11:00:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalle`
--

CREATE TABLE `factura_detalle` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(15,2) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura_detalle`
--

INSERT INTO `factura_detalle` (`id`, `factura_id`, `producto_id`, `cantidad`, `precio`, `updated_at`, `created_at`) VALUES
(7, 55, 2, 2, '500.00', '2020-04-01 11:00:30', '2020-04-01 11:00:30'),
(8, 55, 3, 10, '100.00', '2020-04-01 11:00:38', '2020-04-01 11:00:38'),
(9, 55, 4, 2, '120.00', '2020-04-01 11:00:50', '2020-04-01 11:00:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lavanderia`
--

CREATE TABLE `lavanderia` (
  `id` int(11) NOT NULL,
  `numero_envio` varchar(20) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `suplidor_id` int(11) DEFAULT NULL,
  `id_sku` int(11) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `fecha_envio` date NOT NULL,
  `receta_lavado` text NOT NULL,
  `cantidad` int(20) NOT NULL,
  `cantidad_parcial` int(20) NOT NULL,
  `total_enviado` int(20) NOT NULL,
  `pendiente` int(20) DEFAULT NULL,
  `total_devuelto` int(11) DEFAULT NULL,
  `estandar_incluido` tinyint(1) NOT NULL,
  `envio_reparar` tinyint(1) DEFAULT NULL,
  `envio_reparada_lav` tinyint(1) DEFAULT NULL,
  `devuelto` tinyint(1) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lavanderia`
--

INSERT INTO `lavanderia` (`id`, `numero_envio`, `corte_id`, `suplidor_id`, `id_sku`, `producto_id`, `fecha_envio`, `receta_lavado`, `cantidad`, `cantidad_parcial`, `total_enviado`, `pendiente`, `total_devuelto`, `estandar_incluido`, `envio_reparar`, `envio_reparada_lav`, `devuelto`, `sec`, `updated_at`, `created_at`) VALUES
(120, 'EL-001', 55, 7, 290, 104, '2020-03-05', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.01', '2020-03-05 15:31:51', '2020-03-05 15:31:51'),
(123, 'EL-004', 57, 7, 290, 104, '2020-03-06', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.04', '2020-03-06 13:38:20', '2020-03-06 13:38:20'),
(124, 'EL-005', 58, 7, 268, 105, '2020-03-09', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.05', '2020-03-09 10:47:33', '2020-03-09 10:47:33'),
(125, 'EL-006', 59, 7, 290, 104, '2020-03-10', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.06', '2020-03-09 13:54:27', '2020-03-09 13:54:27'),
(126, 'EL-007', 60, 7, 268, 105, '2020-03-09', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.07', '2020-03-09 15:20:41', '2020-03-09 15:20:41'),
(127, 'EL-008', 63, 7, 319, 110, '2020-03-10', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.08', '2020-03-10 08:27:56', '2020-03-10 08:27:56'),
(128, 'EL-009', 64, 7, 337, 112, '2020-03-10', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.09', '2020-03-10 08:55:36', '2020-03-10 08:55:36'),
(129, 'EL-010', 66, 7, 290, 104, '2020-03-12', 'Lavar segun estandar', 400, 400, 400, NULL, 0, 1, NULL, NULL, 1, '0.10', '2020-03-12 08:41:39', '2020-03-12 08:41:39'),
(130, 'EL-011', 65, 7, 268, 105, '2020-03-19', 'Lavar segun estandar', 440, 440, 440, NULL, 0, 1, NULL, NULL, 1, '0.11', '2020-03-19 09:45:17', '2020-03-19 09:45:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito`
--

CREATE TABLE `nota_credito` (
  `id` int(11) NOT NULL,
  `factura_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `no_nota_credito` varchar(20) DEFAULT NULL,
  `ncf` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo_nota_credito` varchar(100) DEFAULT NULL,
  `hora_impresion` datetime DEFAULT NULL,
  `precio_lista_factura` decimal(15,2) NOT NULL,
  `itbis` int(11) DEFAULT NULL,
  `descuento` int(11) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota_credito`
--

INSERT INTO `nota_credito` (`id`, `factura_id`, `user_id`, `cliente_id`, `no_nota_credito`, `ncf`, `fecha`, `tipo_nota_credito`, `hora_impresion`, `precio_lista_factura`, `itbis`, `descuento`, `total`, `sec`, `created_at`, `updated_at`) VALUES
(187, 51, 1, 3, 'CN-0012101', NULL, '2020-04-03 11:20:49', 'CN', '2020-04-03 11:21:40', '15293.00', 18, 10, '2548.80', '0.01', '2020-04-03 11:20:49', '2020-04-03 11:21:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_detalle`
--

CREATE TABLE `nota_credito_detalle` (
  `id` int(11) NOT NULL,
  `nota_credito_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `referencia_father` int(11) DEFAULT NULL,
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) NOT NULL,
  `j` int(11) NOT NULL,
  `k` int(11) NOT NULL,
  `l` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nota_credito_detalle`
--

INSERT INTO `nota_credito_detalle` (`id`, `nota_credito_id`, `producto_id`, `referencia_father`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `updated_at`, `created_at`) VALUES
(32, 187, 104, 104, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 4, '2020-04-03 11:21:35', '2020-04-03 11:21:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_empaque`
--

CREATE TABLE `orden_empaque` (
  `id` int(11) NOT NULL,
  `orden_pedido_id` int(11) NOT NULL,
  `no_orden_empaque` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_empaque`
--

INSERT INTO `orden_empaque` (`id`, `orden_pedido_id`, `no_orden_empaque`, `fecha`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `cantidad`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(72, 631, 'OE - 001', '2020-03-05 04:28:16', 2, 1, 1, 1, 342, 492, 492, 342, 0, 0, 0, 0, NULL, NULL, '0.01', '2020-03-05 16:28:16', '2020-03-05 16:28:16'),
(73, 633, 'OE - 002', '2020-03-05 04:59:30', 0, 0, 5, 4, 4, 4, 4, 5, 0, 0, 0, 0, NULL, NULL, '0.02', '2020-03-05 16:59:30', '2020-03-05 16:59:30'),
(74, 634, 'OE - 003', '2020-03-06 02:46:17', 9, 9, 9, 9, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '0.03', '2020-03-06 14:46:17', '2020-03-06 14:46:17'),
(75, 635, 'OE - 004', '2020-03-06 04:25:29', 0, 0, 8, 6, 6, 6, 6, 8, 0, 0, 0, 0, NULL, NULL, '0.04', '2020-03-06 16:25:29', '2020-03-06 16:25:29'),
(76, 636, 'OE - 005', '2020-03-09 08:46:18', 0, 0, 7, 6, 6, 6, 6, 7, 0, 0, 0, 0, NULL, NULL, '0.05', '2020-03-09 08:46:18', '2020-03-09 08:46:18'),
(77, 637, 'OE-006', '2020-03-09 11:10:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.06', '2020-03-09 11:10:45', '2020-03-09 11:10:45'),
(78, 638, 'OE-007', '2020-03-09 11:41:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.07', '2020-03-09 11:41:16', '2020-03-09 11:41:16'),
(79, 640, 'OE - 008', '2020-03-09 03:37:37', 0, 0, 8, 7, 7, 7, 7, 8, 0, 0, 0, 0, NULL, NULL, '0.08', '2020-03-09 15:37:37', '2020-03-09 15:37:37'),
(80, 639, 'OE-009', '2020-03-09 04:39:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.09', '2020-03-09 16:39:58', '2020-03-09 16:39:58'),
(81, 641, 'OE-010', '2020-03-10 09:13:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.10', '2020-03-10 09:13:45', '2020-03-10 09:13:45'),
(82, 642, 'OE - 011', '2020-03-16 03:55:06', 0, 0, 19, 17, 17, 16, 16, 19, 0, 0, 0, 0, NULL, NULL, '0.11', '2020-03-16 15:55:06', '2020-03-16 15:55:06'),
(83, 643, 'OE - 012', '2020-03-17 01:37:23', 13, 13, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '0.12', '2020-03-17 13:37:23', '2020-03-17 13:37:23'),
(84, 644, 'OE - 013', '2020-03-17 02:14:08', 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '0.13', '2020-03-17 14:14:08', '2020-03-17 14:14:08'),
(85, 645, 'OE - 014', '2020-03-20 02:37:26', 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '0.14', '2020-03-20 14:37:26', '2020-03-20 14:37:26'),
(86, 646, 'OE - 015', '2020-03-20 04:50:53', 0, 0, 4, 4, 4, 4, 4, 4, 0, 0, 0, 0, NULL, NULL, '0.15', '2020-03-20 16:50:53', '2020-03-20 16:50:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_empaque_detalle`
--

CREATE TABLE `orden_empaque_detalle` (
  `id` int(11) NOT NULL,
  `orden_empaque_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `fecha_empacado` datetime NOT NULL,
  `empacado` tinyint(1) NOT NULL,
  `cant_bulto` int(11) NOT NULL,
  `facturado` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_empaque_detalle`
--

INSERT INTO `orden_empaque_detalle` (`id`, `orden_empaque_id`, `producto_id`, `user_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `cantidad`, `precio`, `total`, `fecha_empacado`, `empacado`, `cant_bulto`, `facturado`, `updated_at`, `created_at`) VALUES
(10, 73, 105, 1, 0, 0, 5, 4, 4, 4, 4, 5, 0, 0, 0, 0, 24, '1200.00', 26, '2020-03-06 02:54:20', 1, 2, 1, '2020-03-06 14:54:21', '2020-03-06 14:54:20'),
(11, 74, 104, 1, 9, 9, 9, 9, 0, 0, 0, 0, 0, 0, 0, 0, 36, '600.00', 36, '2020-03-06 03:09:13', 1, 2, 1, '2020-03-06 15:09:14', '2020-03-06 15:09:13'),
(12, 72, 104, 1, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, '2020-03-06 03:09:23', 1, 1, 1, '2020-03-06 15:09:23', '2020-03-06 15:09:23'),
(13, 75, 105, 1, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, '2020-03-06 04:29:30', 1, 1, 1, '2020-03-06 16:29:31', '2020-03-06 16:29:30'),
(14, 77, 104, 1, 0, 0, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 6, '600.00', 6, '2020-03-09 11:15:14', 1, 1, 1, '2020-03-09 11:15:14', '2020-03-09 11:15:14'),
(15, 77, 107, 1, 0, 0, 0, 0, 2, 2, 2, 2, 0, 0, 0, 0, 8, '650.00', 8, '2020-03-09 11:15:18', 1, 1, 1, '2020-03-09 11:15:18', '2020-03-09 11:15:18'),
(16, 77, 105, 1, 0, 0, 3, 3, 4, 4, 4, 3, 0, 0, 0, 0, 21, '1200.00', 21, '2020-03-09 11:15:22', 1, 1, 1, '2020-03-09 11:15:23', '2020-03-09 11:15:22'),
(17, 76, 105, 1, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, '2020-03-09 11:15:37', 1, 2, 1, '2020-03-09 11:15:37', '2020-03-09 11:15:37'),
(18, 78, 105, 1, 0, 0, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 18, '1200.00', 18, '2020-03-09 11:41:56', 1, 1, 1, '2020-03-09 11:41:56', '2020-03-09 11:41:56'),
(19, 79, 105, 1, 0, 0, 6, 7, 7, 7, 7, 6, 0, 0, 0, 0, 40, '1200.00', 40, '2020-03-09 04:40:25', 1, 2, 1, '2020-03-09 16:40:25', '2020-03-09 16:40:25'),
(20, 80, 104, 1, 2, 3, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 10, '600.00', 10, '2020-03-09 04:40:36', 1, 1, 1, '2020-03-09 16:40:36', '2020-03-09 16:40:36'),
(21, 80, 107, 1, 0, 0, 0, 0, 2, 3, 3, 2, 0, 0, 0, 0, 10, '650.00', 10, '2020-03-09 04:40:41', 1, 1, 1, '2020-03-09 16:40:42', '2020-03-09 16:40:41'),
(22, 80, 105, 1, 0, 0, 2, 3, 2, 3, 3, 2, 0, 0, 0, 0, 15, '1200.00', 15, '2020-03-09 04:40:50', 1, 1, 1, '2020-03-09 16:40:50', '2020-03-09 16:40:50'),
(23, 81, 112, 1, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 14, '2020-03-10 09:14:04', 1, 1, 1, '2020-03-10 09:14:04', '2020-03-10 09:14:04'),
(24, 81, 105, 1, 0, 0, 4, 3, 3, 4, 4, 4, 0, 0, 0, 0, 22, '1200.00', 22, '2020-03-10 09:14:10', 1, 1, 1, '2020-03-10 09:14:11', '2020-03-10 09:14:10'),
(25, 81, 110, 1, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 14, '2020-03-10 09:14:14', 1, 1, 1, '2020-03-10 09:14:15', '2020-03-10 09:14:14'),
(26, 82, 105, 1, 0, 0, 17, 17, 17, 16, 16, 17, 0, 0, 0, 0, 100, '1200.00', 100, '2020-03-16 03:55:42', 1, 3, 1, '2020-03-16 15:55:43', '2020-03-16 15:55:42'),
(27, 84, 104, 1, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, '2020-03-19 08:48:38', 1, 1, 1, '2020-03-19 08:48:38', '2020-03-19 08:48:38'),
(28, 84, 105, 1, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, '2020-03-19 08:48:41', 1, 2, 1, '2020-03-19 08:48:42', '2020-03-19 08:48:41'),
(29, 83, 107, 1, 13, 13, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, 50, '650.00', 50, '2020-03-19 09:42:17', 1, 2, 1, '2020-03-19 09:42:17', '2020-03-19 09:42:17'),
(30, 83, 111, 1, 0, 0, 0, 0, 13, 12, 12, 13, 0, 0, 0, 0, 50, '650.00', 50, '2020-03-19 09:42:21', 1, 2, 1, '2020-03-19 09:42:22', '2020-03-19 09:42:21'),
(31, 85, 104, 1, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, '2020-03-20 02:38:23', 1, 1, 1, '2020-03-20 14:38:23', '2020-03-20 14:38:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_facturacion`
--

CREATE TABLE `orden_facturacion` (
  `id` int(11) NOT NULL,
  `orden_empaque_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_orden_facturacion` varchar(20) DEFAULT NULL,
  `por_transporte` tinyint(1) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `impreso` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_facturacion`
--

INSERT INTO `orden_facturacion` (`id`, `orden_empaque_id`, `user_id`, `no_orden_facturacion`, `por_transporte`, `fecha`, `sec`, `impreso`, `updated_at`, `created_at`) VALUES
(41, 73, 1, NULL, 0, '2020-03-06 02:54:25', NULL, 1, '2020-03-06 15:25:02', '2020-03-06 14:54:25'),
(42, 74, 1, NULL, 0, '2020-03-06 03:09:15', NULL, 1, '2020-03-06 15:11:54', '2020-03-06 15:09:15'),
(43, 72, 1, NULL, 0, '2020-03-06 03:09:25', NULL, 1, '2020-03-10 11:49:40', '2020-03-06 15:09:25'),
(44, 75, 1, NULL, 0, '2020-03-06 04:29:37', NULL, 1, '2020-03-10 11:48:02', '2020-03-06 16:29:37'),
(45, 77, 1, NULL, 0, '2020-03-09 11:15:28', NULL, 1, '2020-03-10 09:16:17', '2020-03-09 11:15:28'),
(46, 76, 1, NULL, 0, '2020-03-09 11:15:39', NULL, 1, '2020-03-10 11:47:38', '2020-03-09 11:15:39'),
(47, 78, 1, NULL, 0, '2020-03-09 11:41:58', NULL, 1, '2020-03-10 09:15:50', '2020-03-09 11:41:58'),
(48, 79, 1, NULL, 0, '2020-03-09 04:40:28', NULL, 1, '2020-03-10 09:21:16', '2020-03-09 16:40:28'),
(49, 80, 1, NULL, 0, '2020-03-09 04:40:53', NULL, 1, '2020-03-09 16:43:30', '2020-03-09 16:40:53'),
(50, 81, 1, NULL, 0, '2020-03-10 09:14:18', NULL, 1, '2020-03-10 09:14:42', '2020-03-10 09:14:18'),
(51, 82, 1, NULL, 0, '2020-03-16 03:55:45', NULL, 1, '2020-03-16 16:05:11', '2020-03-16 15:55:45'),
(52, 84, 1, NULL, 0, '2020-03-19 08:48:44', NULL, 1, '2020-03-19 08:50:14', '2020-03-19 08:48:44'),
(53, 83, 1, NULL, 0, '2020-03-19 09:42:24', NULL, 1, '2020-03-19 09:42:56', '2020-03-19 09:42:24'),
(54, 85, 1, NULL, 0, '2020-03-20 02:38:29', NULL, 1, '2020-03-31 11:02:35', '2020-03-20 14:38:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_facturacion_detalle`
--

CREATE TABLE `orden_facturacion_detalle` (
  `id` int(11) NOT NULL,
  `orden_facturacion_id` int(11) NOT NULL,
  `orden_pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `referencia_father` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `cant_bultos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota_credito` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_facturacion_detalle`
--

INSERT INTO `orden_facturacion_detalle` (`id`, `orden_facturacion_id`, `orden_pedido_id`, `producto_id`, `referencia_father`, `user_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cant_bultos`, `fecha`, `nota_credito`, `updated_at`, `created_at`) VALUES
(10, 41, 633, 105, 105, 1, 0, 0, 5, 4, 4, 4, 4, 5, 0, 0, 0, 0, 26, '1200.00', 2, '2020-03-06 02:54:21', 0, '2020-03-06 14:54:21', '2020-03-06 14:54:21'),
(11, 42, 634, 104, 104, 1, 9, 9, 9, 9, 0, 0, 0, 0, 0, 0, 0, 0, 36, '600.00', 2, '2020-03-06 03:09:14', 0, '2020-03-06 15:09:14', '2020-03-06 15:09:14'),
(12, 43, 631, 104, 104, 1, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 1, '2020-03-06 03:09:23', 0, '2020-03-06 15:09:23', '2020-03-06 15:09:23'),
(13, 44, 635, 105, 105, 1, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 1, '2020-03-06 04:29:31', 0, '2020-03-06 16:29:31', '2020-03-06 16:29:31'),
(14, 45, 637, 104, 104, 1, 0, 0, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 6, '600.00', 1, '2020-03-09 11:15:14', 0, '2020-03-09 11:15:14', '2020-03-09 11:15:14'),
(15, 45, 637, 107, 104, 1, 0, 0, 0, 0, 2, 2, 2, 2, 0, 0, 0, 0, 8, '650.00', 1, '2020-03-09 11:15:18', 0, '2020-03-09 11:15:18', '2020-03-09 11:15:18'),
(16, 45, 637, 105, 105, 1, 0, 0, 3, 3, 4, 4, 4, 3, 0, 0, 0, 0, 21, '1200.00', 1, '2020-03-09 11:15:23', 0, '2020-03-09 11:15:23', '2020-03-09 11:15:23'),
(17, 46, 636, 105, 105, 1, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 2, '2020-03-09 11:15:37', 0, '2020-03-09 11:15:37', '2020-03-09 11:15:37'),
(18, 47, 638, 105, 105, 1, 0, 0, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 18, '1200.00', 1, '2020-03-09 11:41:56', 0, '2020-03-09 11:41:56', '2020-03-09 11:41:56'),
(19, 48, 640, 105, 105, 1, 0, 0, 6, 7, 7, 7, 7, 6, 0, 0, 0, 0, 40, '1200.00', 2, '2020-03-09 04:40:25', 0, '2020-03-09 16:40:25', '2020-03-09 16:40:25'),
(20, 49, 639, 104, 104, 1, 2, 3, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 10, '600.00', 1, '2020-03-09 04:40:36', 0, '2020-03-09 16:40:36', '2020-03-09 16:40:36'),
(21, 49, 639, 107, 104, 1, 0, 0, 0, 0, 2, 3, 3, 2, 0, 0, 0, 0, 10, '650.00', 1, '2020-03-09 04:40:42', 0, '2020-03-09 16:40:42', '2020-03-09 16:40:42'),
(22, 49, 639, 105, 105, 1, 0, 0, 2, 3, 2, 3, 3, 2, 0, 0, 0, 0, 15, '1200.00', 1, '2020-03-09 04:40:50', 0, '2020-03-09 16:40:50', '2020-03-09 16:40:50'),
(23, 50, 641, 112, 112, 1, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 1, '2020-03-10 09:14:04', 0, '2020-03-10 09:14:04', '2020-03-10 09:14:04'),
(24, 50, 641, 105, 105, 1, 0, 0, 4, 3, 3, 4, 4, 4, 0, 0, 0, 0, 22, '1200.00', 1, '2020-03-10 09:14:11', 0, '2020-03-10 09:14:11', '2020-03-10 09:14:11'),
(25, 50, 641, 110, 110, 1, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 1, '2020-03-10 09:14:15', 0, '2020-03-10 09:14:15', '2020-03-10 09:14:15'),
(26, 51, 642, 105, 105, 1, 0, 0, 17, 17, 17, 16, 16, 17, 0, 0, 0, 0, 100, '1200.00', 3, '2020-03-16 03:55:43', 0, '2020-03-16 15:55:43', '2020-03-16 15:55:43'),
(27, 52, 644, 104, 104, 1, 2, 2, 2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 8, '600.00', 1, '2020-03-19 08:48:39', 0, '2020-03-19 10:55:57', '2020-03-19 08:48:39'),
(28, 52, 644, 105, 105, 1, 0, 0, 2, 2, 3, 3, 3, 3, 0, 0, 0, 0, 16, '1200.00', 2, '2020-03-19 08:48:42', 0, '2020-03-19 10:55:57', '2020-03-19 08:48:42'),
(29, 53, 643, 107, 104, 1, 10, 10, 10, 10, 0, 0, 0, 0, 0, 0, 0, 0, 40, '650.00', 2, '2020-03-19 09:42:17', 1, '2020-03-19 11:12:18', '2020-03-19 09:42:17'),
(30, 53, 643, 111, 110, 1, 0, 0, 0, 0, 10, 10, 10, 10, 0, 0, 0, 0, 40, '650.00', 2, '2020-03-19 09:42:22', 1, '2020-03-19 11:12:21', '2020-03-19 09:42:22'),
(31, 54, 645, 104, 104, 1, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 1, '2020-03-20 02:38:24', 0, '2020-03-20 14:38:24', '2020-03-20 14:38:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido`
--

CREATE TABLE `orden_pedido` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_aprobacion` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `sucursal_id` int(11) DEFAULT NULL,
  `vendedor_id` int(11) DEFAULT NULL,
  `orden_pedido_father` int(11) DEFAULT NULL,
  `no_orden_pedido` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_entrega` date NOT NULL,
  `notas` text DEFAULT NULL,
  `generado_internamente` tinyint(1) DEFAULT NULL,
  `estado_aprobacion` tinyint(1) DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `status_orden_pedido` varchar(30) DEFAULT NULL,
  `precio` decimal(4,3) DEFAULT NULL,
  `detallada` tinyint(1) DEFAULT NULL,
  `corte_en_proceso` varchar(5) DEFAULT NULL,
  `orden_proceso_impresa` varchar(5) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido`
--

INSERT INTO `orden_pedido` (`id`, `user_id`, `user_aprobacion`, `cliente_id`, `sucursal_id`, `vendedor_id`, `orden_pedido_father`, `no_orden_pedido`, `fecha`, `fecha_entrega`, `notas`, `generado_internamente`, `estado_aprobacion`, `fecha_aprobacion`, `status_orden_pedido`, `precio`, `detallada`, `corte_en_proceso`, `orden_proceso_impresa`, `sec`, `updated_at`, `created_at`) VALUES
(631, 1, 1, 3, 4, 5, NULL, 'OP-002', '2020-03-05 04:15:26', '2020-03-05', NULL, 0, NULL, '2020-03-05 04:16:00', 'Despachado', NULL, 1, 'No', 'Si', '0.02', '2020-03-10 11:49:54', '2020-03-05 16:15:26'),
(633, 1, 1, 3, 4, 5, NULL, 'OP-003', '2020-03-05 04:58:52', '2020-03-05', NULL, 0, NULL, '2020-03-05 04:59:11', 'Despachado', NULL, 1, 'No', 'Si', '0.03', '2020-03-06 15:30:13', '2020-03-05 16:58:52'),
(634, 1, 1, 3, 4, 8, NULL, 'OP-004', '2020-03-06 02:43:58', '2020-03-06', NULL, 0, NULL, '2020-03-06 02:45:38', 'Despachado', NULL, 1, 'No', 'Si', '0.04', '2020-03-06 15:11:54', '2020-03-06 14:43:58'),
(635, 1, 1, 3, 4, 5, NULL, 'OP-005', '2020-03-06 04:19:58', '2020-03-06', NULL, 0, NULL, '2020-03-06 04:20:55', 'Despachado', NULL, 1, 'No', 'Si', '0.05', '2020-03-10 11:49:45', '2020-03-06 16:19:58'),
(636, 1, 1, 3, 4, 5, NULL, 'OP-006', '2020-03-09 08:44:47', '2020-03-13', NULL, 0, NULL, '2020-03-09 08:46:03', 'Despachado', NULL, 1, 'No', 'Si', '0.06', '2020-03-10 11:49:50', '2020-03-09 08:44:47'),
(637, 1, 1, 3, 4, 5, NULL, 'OP-007', '2020-03-09 10:50:43', '2020-03-09', NULL, 0, NULL, '2020-03-09 11:08:52', 'Despachado', NULL, 0, 'No', 'Si', '0.07', '2020-03-10 11:45:48', '2020-03-09 10:50:43'),
(638, 1, 1, 3, 4, 5, NULL, 'OP-008', '2020-03-09 11:39:49', '2020-03-17', NULL, 0, NULL, '2020-03-09 11:40:59', 'Despachado', NULL, 0, 'No', 'Si', '0.08', '2020-03-10 11:45:39', '2020-03-09 11:39:49'),
(639, 12, 1, 3, 4, 8, NULL, 'OP-009', '2020-03-09 02:13:00', '2020-03-09', NULL, 0, NULL, '2020-03-09 02:21:33', 'Despachado', NULL, 0, 'No', 'Si', '0.09', '2020-03-09 16:43:37', '2020-03-09 14:13:00'),
(640, 1, 1, 3, 4, 8, NULL, 'OP-010', '2020-03-09 03:36:33', '2020-03-09', NULL, 0, NULL, '2020-03-09 03:37:21', 'Despachado', NULL, 1, 'No', 'Si', '0.10', '2020-03-10 11:45:31', '2020-03-09 15:36:33'),
(641, 1, 1, 3, 4, 8, NULL, 'OP-011', '2020-03-10 09:04:36', '2020-03-10', NULL, 0, NULL, '2020-03-10 09:12:57', 'Despachado', NULL, 0, 'No', 'Si', '0.11', '2020-03-10 11:43:53', '2020-03-10 09:04:36'),
(642, 1, 1, 3, 4, 5, NULL, 'OP-012', '2020-03-11 05:10:49', '2020-03-11', NULL, 0, NULL, '2020-03-11 05:11:31', 'Despachado', NULL, 1, 'No', 'Si', '0.12', '2020-03-16 16:07:38', '2020-03-11 17:10:49'),
(643, 1, 1, 3, 4, 8, NULL, 'OP-013', '2020-03-17 01:27:38', '2020-03-17', NULL, 0, NULL, '2020-03-17 01:29:22', 'Despachado', NULL, 1, 'No', 'Si', '0.13', '2020-03-19 09:43:02', '2020-03-17 13:27:38'),
(644, 1, 1, 5, 5, 8, NULL, 'OP-014', '2020-03-17 02:11:40', '2020-03-17', NULL, 0, NULL, '2020-03-17 02:14:01', 'Despachado', NULL, 1, 'No', 'Si', '0.14', '2020-03-19 08:50:20', '2020-03-17 14:11:41'),
(645, 1, 1, 3, 4, 8, NULL, 'OP-015', '2020-03-20 02:31:53', '2020-03-20', NULL, 0, NULL, '2020-03-20 02:37:17', 'Despachado', NULL, 1, 'No', 'Si', '0.15', '2020-03-20 14:45:26', '2020-03-20 14:31:53'),
(646, 1, 1, 5, 5, 8, NULL, 'OP-016', '2020-03-20 04:49:43', '2020-03-20', NULL, 0, NULL, '2020-03-20 04:50:47', 'Vigente', NULL, 1, 'No', 'Si', '0.16', '2020-03-20 16:50:53', '2020-03-20 16:49:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido_detalle`
--

CREATE TABLE `orden_pedido_detalle` (
  `id` int(11) NOT NULL,
  `orden_pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `referencia_father` int(11) DEFAULT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `precio` decimal(15,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cant_red` int(11) DEFAULT NULL,
  `orden_redistribuida` tinyint(1) DEFAULT NULL,
  `orden_empacada` tinyint(1) DEFAULT NULL,
  `orden_ajustada` tinyint(1) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido_detalle`
--

INSERT INTO `orden_pedido_detalle` (`id`, `orden_pedido_id`, `producto_id`, `referencia_father`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cantidad`, `cant_red`, `orden_redistribuida`, `orden_empacada`, `orden_ajustada`, `fecha_entrega`, `updated_at`, `created_at`) VALUES
(331, 631, 104, 104, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, 24, 1, 1, NULL, NULL, '2020-03-06 15:09:23', '2020-03-05 16:15:43'),
(332, 633, 105, 105, 0, 0, 5, 4, 4, 4, 4, 5, 0, 0, 0, 0, 26, '1200.00', 24, 24, 1, 1, 1, NULL, '2020-03-06 14:54:20', '2020-03-05 16:59:01'),
(333, 634, 104, 104, 9, 9, 9, 9, 0, 0, 0, 0, 0, 0, 0, 0, 36, '600.00', 36, 36, 1, 1, NULL, NULL, '2020-03-06 15:09:13', '2020-03-06 14:44:47'),
(334, 635, 105, 105, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, 36, 1, 1, 1, NULL, '2020-03-06 16:29:30', '2020-03-06 16:20:15'),
(335, 636, 105, 105, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, 36, 1, 1, 1, NULL, '2020-03-09 11:15:37', '2020-03-09 08:45:19'),
(336, 637, 105, 105, 0, 0, 3, 3, 4, 4, 4, 3, 0, 0, 0, 0, 21, '1200.00', 0, 21, 1, 1, NULL, NULL, '2020-03-09 11:15:22', '2020-03-09 10:51:36'),
(337, 637, 104, 104, 0, 0, 3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 6, '600.00', 0, 6, 1, 1, NULL, NULL, '2020-03-09 11:15:14', '2020-03-09 10:53:34'),
(338, 637, 107, 104, 0, 0, 0, 0, 2, 2, 2, 2, 0, 0, 0, 0, 8, '650.00', 0, 8, 1, 1, NULL, NULL, '2020-03-09 11:15:18', '2020-03-09 10:54:10'),
(339, 638, 105, 105, 0, 0, 3, 3, 3, 3, 3, 3, 0, 0, 0, 0, 18, '1200.00', 0, 18, 1, 1, NULL, NULL, '2020-03-09 11:41:56', '2020-03-09 11:40:33'),
(340, 639, 104, 104, 2, 3, 3, 2, 0, 0, 0, 0, 0, 0, 0, 0, 10, '600.00', 0, 10, 1, 1, NULL, NULL, '2020-03-09 16:40:36', '2020-03-09 14:13:50'),
(341, 639, 107, 104, 0, 0, 0, 0, 2, 3, 3, 2, 0, 0, 0, 0, 10, '650.00', 0, 10, 1, 1, NULL, NULL, '2020-03-09 16:40:41', '2020-03-09 14:14:19'),
(342, 639, 105, 105, 0, 0, 2, 3, 2, 3, 3, 2, 0, 0, 0, 0, 15, '1200.00', 0, 15, 1, 1, NULL, NULL, '2020-03-09 16:40:50', '2020-03-09 14:14:41'),
(343, 640, 105, 105, 0, 0, 6, 7, 7, 7, 7, 6, 0, 0, 0, 0, 40, '1200.00', 40, 40, 1, 1, 1, NULL, '2020-03-09 16:40:25', '2020-03-09 15:36:51'),
(344, 641, 112, 112, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 0, 14, 1, 1, NULL, NULL, '2020-03-10 09:14:04', '2020-03-10 09:06:51'),
(345, 641, 110, 110, 3, 4, 4, 3, 0, 0, 0, 0, 0, 0, 0, 0, 14, '600.00', 0, 14, 1, 1, NULL, NULL, '2020-03-10 09:14:14', '2020-03-10 09:07:42'),
(346, 641, 105, 105, 0, 0, 4, 3, 3, 4, 4, 4, 0, 0, 0, 0, 22, '1200.00', 0, 22, 1, 1, NULL, NULL, '2020-03-10 09:14:10', '2020-03-10 09:08:05'),
(347, 642, 105, 105, 0, 0, 17, 17, 17, 16, 16, 17, 0, 0, 0, 0, 100, '1200.00', 100, 100, 1, 1, 1, NULL, '2020-03-16 15:55:42', '2020-03-11 17:10:59'),
(348, 643, 107, 104, 13, 13, 12, 12, 0, 0, 0, 0, 0, 0, 0, 0, 50, '650.00', 50, 50, 1, 1, NULL, NULL, '2020-03-19 09:42:17', '2020-03-17 13:28:28'),
(349, 643, 111, 110, 0, 0, 0, 0, 13, 12, 12, 13, 0, 0, 0, 0, 50, '650.00', 50, 50, 1, 1, NULL, NULL, '2020-03-19 09:42:21', '2020-03-17 13:29:08'),
(350, 644, 104, 104, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, 24, 1, 1, NULL, NULL, '2020-03-19 08:48:38', '2020-03-17 14:11:59'),
(351, 644, 105, 105, 0, 0, 6, 6, 6, 6, 6, 6, 0, 0, 0, 0, 36, '1200.00', 36, 36, 1, 1, 1, NULL, '2020-03-19 08:48:41', '2020-03-17 14:12:11'),
(352, 645, 104, 104, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, 24, 1, 1, NULL, NULL, '2020-03-20 14:38:23', '2020-03-20 14:37:04'),
(353, 646, 105, 105, 0, 0, 4, 4, 4, 4, 4, 4, 0, 0, 0, 0, 24, '1200.00', 24, 24, 1, 0, NULL, NULL, '2020-03-20 16:50:53', '2020-03-20 16:50:10'),
(354, 646, 110, 110, 6, 6, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 24, '600.00', 24, 24, 1, 0, 0, NULL, '2020-03-27 09:47:04', '2020-03-20 16:50:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perdidas`
--

CREATE TABLE `perdidas` (
  `id` int(11) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `talla_id` int(11) DEFAULT NULL,
  `no_perdida` varchar(20) NOT NULL,
  `tipo_perdida` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `fase` varchar(30) NOT NULL,
  `motivo` varchar(60) NOT NULL,
  `perdida_x` int(11) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', '2020-01-29 08:20:00', '2020-01-29 06:12:24'),
(2, 'Usuarios', '2020-01-29 08:20:00', '2020-01-29 06:12:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso_usuario`
--

CREATE TABLE `permiso_usuario` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permiso` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso_usuario`
--

INSERT INTO `permiso_usuario` (`id`, `user_id`, `permiso`, `created_at`, `updated_at`) VALUES
(21, 12, 'Cliente', '2020-03-09 11:36:39', '2020-03-09 11:36:39'),
(22, 12, 'Sucursales', '2020-03-09 11:36:43', '2020-03-09 11:36:43'),
(23, 12, 'Suplidores', '2020-03-09 11:36:46', '2020-03-09 11:36:46'),
(24, 12, 'Productos', '2020-03-09 11:36:51', '2020-03-09 11:36:51'),
(25, 12, 'Composicion', '2020-03-09 11:37:03', '2020-03-09 11:37:03'),
(26, 12, 'Telas', '2020-03-09 11:37:10', '2020-03-09 11:37:10'),
(27, 12, 'Rollos', '2020-03-09 11:37:13', '2020-03-09 11:37:13'),
(28, 12, 'Corte', '2020-03-09 11:37:16', '2020-03-09 11:37:16'),
(29, 12, 'Lavanderia', '2020-03-09 11:37:19', '2020-03-09 11:37:19'),
(30, 12, 'Recepcion', '2020-03-09 11:37:22', '2020-03-09 11:37:22'),
(36, 12, 'Entrada Almacen', '2020-03-09 13:58:45', '2020-03-09 13:58:45'),
(37, 12, 'Ordenes pedido', '2020-03-09 14:12:24', '2020-03-09 14:12:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_catalogo` int(11) NOT NULL,
  `genero` int(11) DEFAULT NULL,
  `marca` varchar(50) DEFAULT 'NULL',
  `referencia_producto` varchar(50) NOT NULL,
  `referencia_father` int(11) DEFAULT NULL,
  `referencia_producto_2` varchar(50) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `descripcion_2` longtext DEFAULT NULL,
  `ubicacion` varchar(10) DEFAULT NULL,
  `imagen_frente` varchar(255) DEFAULT NULL,
  `imagen_trasero` varchar(255) DEFAULT NULL,
  `imagen_perfil` varchar(255) DEFAULT NULL,
  `imagen_bolsillo` varchar(255) DEFAULT NULL,
  `tono` varchar(50) DEFAULT NULL,
  `intensidad_proceso_seco` varchar(50) DEFAULT NULL,
  `atributo_no_1` varchar(50) DEFAULT NULL,
  `atributo_no_2` varchar(50) DEFAULT NULL,
  `atributo_no_3` varchar(50) DEFAULT NULL,
  `precio_lista` decimal(15,2) DEFAULT NULL,
  `precio_lista_2` decimal(15,2) DEFAULT NULL,
  `precio_venta_publico` decimal(15,2) DEFAULT NULL,
  `precio_venta_publico_2` decimal(15,2) DEFAULT NULL,
  `enviado_lavanderia` tinyint(1) DEFAULT NULL,
  `producto_terminado` tinyint(1) DEFAULT NULL,
  `min` varchar(5) DEFAULT NULL,
  `max` varchar(5) DEFAULT NULL,
  `sec` decimal(2,1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_user`, `id_catalogo`, `genero`, `marca`, `referencia_producto`, `referencia_father`, `referencia_producto_2`, `descripcion`, `descripcion_2`, `ubicacion`, `imagen_frente`, `imagen_trasero`, `imagen_perfil`, `imagen_bolsillo`, `tono`, `intensidad_proceso_seco`, `atributo_no_1`, `atributo_no_2`, `atributo_no_3`, `precio_lista`, `precio_lista_2`, `precio_venta_publico`, `precio_venta_publico_2`, `enviado_lavanderia`, `producto_terminado`, `min`, `max`, `sec`, `updated_at`, `created_at`) VALUES
(104, 1, 0, 4, 'Mythos', 'M402-2001', NULL, NULL, 'Pant de nina 2-8', NULL, 'A-2', '1583777242joker.jpg', '15837772421575388275_145305_1575388338_noticia_normal.jpg', '1583777242super-smash-bros-ultimate-joker_hi.jpg', '158377724261LV8e1BQvL.jpg', 'Crudo o Puro', 'Alto contraste', 'Roto', 'Parcho', 'Bordado', '600.00', NULL, '900.00', NULL, 1, 1, 'e', 'h', '0.1', '2020-03-09 14:07:22', '2020-03-04 14:49:04'),
(105, 1, 0, 1, 'Lavish', 'P105-2001', NULL, NULL, 'Pant de caballero', NULL, 'B-3', '15846315991575388275_145305_1575388338_noticia_normal.jpg', '1584631599índice.jpg', '1584631599super-smash-bros-ultimate-joker_hi.jpg', '158463159961LV8e1BQvL.jpg', 'Crudo o Puro', 'Intermedio', 'Roto', 'Parcho', 'Bordado', '1200.00', '0.00', '2150.00', '0.00', 1, 1, 'd', 'h', '0.1', '2020-03-19 11:26:39', '2020-03-04 15:01:28'),
(107, 1, 0, 4, 'Mythos', 'M402-2002', 104, NULL, 'Pant de nina 10-16', NULL, 'A-2', '158343677561LV8e1BQvL.jpg', '15834367751575388275_145305_1575388338_noticia_normal.jpg', '1583436775joker.jpg', '1583436775índice.jpg', 'Crudo o Puro', 'Alto contraste', 'Roto', 'Parcho', 'Bordado', '650.00', NULL, '990.00', NULL, NULL, NULL, 'e', 'h', NULL, '2020-03-05 15:34:23', '2020-03-05 15:34:23'),
(110, 1, 0, 3, 'Lavish', 'P302-2003', NULL, NULL, 'Pant Nino 2-8', NULL, 'C-7', '1583843361joker.jpg', '15838433611575388275_145305_1575388338_noticia_normal.jpg', '158384336161LV8e1BQvL.jpg', '1583843361índice.jpg', 'Dark Stone', 'Intermedio', 'Parcho', 'Roto', 'Dirty', '600.00', NULL, '990.00', NULL, 1, 1, 'e', 'h', '0.1', '2020-03-10 08:29:55', '2020-03-10 08:19:15'),
(111, 1, 0, 3, 'Lavish', 'P302-2004', 110, NULL, 'Pant Nino 10-16', NULL, 'C-7', '1583843361joker.jpg', '15838433611575388275_145305_1575388338_noticia_normal.jpg', '158384336161LV8e1BQvL.jpg', '1583843361índice.jpg', 'Dark Stone', 'Intermedio', 'Parcho', 'Roto', 'Dirty', '650.00', NULL, '1000.00', NULL, NULL, NULL, 'e', 'h', NULL, '2020-03-10 08:29:54', '2020-03-10 08:29:54'),
(112, 1, 0, 3, 'Mythos', 'M302-2005', NULL, NULL, 'Pant Nino 2-8', NULL, 'D-7', '158384499161LV8e1BQvL.jpg', '15838449911575388275_145305_1575388338_noticia_normal.jpg', '1583844991joker.jpg', '1583844991índice.jpg', 'Dark Stone Suave', 'Alto contraste', 'Parcho', 'Bordado', 'Dirty', '600.00', NULL, '990.00', NULL, 1, 1, 'e', 'h', '0.1', '2020-03-10 08:56:33', '2020-03-10 08:51:49'),
(113, 1, 0, 3, 'Mythos', 'M302-2006', 112, NULL, 'Pant Nino 10-16', NULL, 'D-7', '158384499161LV8e1BQvL.jpg', '15838449911575388275_145305_1575388338_noticia_normal.jpg', '1583844991joker.jpg', '1583844991índice.jpg', 'Dark Stone Suave', 'Alto contraste', 'Parcho', 'Bordado', 'Dirty', '650.00', NULL, '1000.00', NULL, NULL, NULL, 'e', 'h', NULL, '2020-03-10 08:56:33', '2020-03-10 08:56:33'),
(114, 1, 0, 1, 'Genius', 'L104-1101', NULL, NULL, 'Pant. Escolar Khaki Caballero', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '650.00', '0.00', '950.00', '0.00', 0, NULL, 'd', 'h', '0.1', '2020-03-17 16:57:59', '2020-03-17 16:57:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_articulo`
--

CREATE TABLE `producto_articulo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo_articulo` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_articulo`
--

INSERT INTO `producto_articulo` (`id`, `nombre`, `tipo_articulo`, `descripcion`, `updated_at`, `created_at`) VALUES
(2, 'Tubo', 'Material', 'Tubo de media', '2020-03-29 11:57:25', '2020-03-29 11:57:25'),
(3, 'Hilo', 'Hilos', 'Hilos viejos', '2020-04-01 10:56:30', '2020-04-01 10:56:30'),
(4, 'Telas', 'Tela', 'Tela vieja', '2020-04-01 10:56:59', '2020-04-01 10:56:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion`
--

CREATE TABLE `recepcion` (
  `id` int(11) NOT NULL,
  `numero_recepcion` varchar(30) DEFAULT NULL,
  `num_factura_rec` varchar(30) DEFAULT NULL,
  `corte_id` int(11) NOT NULL,
  `id_lavanderia` int(11) DEFAULT NULL,
  `fecha_recepcion` date NOT NULL,
  `recibido_parcial` int(20) NOT NULL,
  `total_recibido` int(20) NOT NULL,
  `total_devuelto` int(11) DEFAULT NULL,
  `pendiente` int(20) NOT NULL,
  `estandar_recibido` tinyint(1) NOT NULL,
  `devuelto_produccion` tinyint(1) DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recepcion`
--

INSERT INTO `recepcion` (`id`, `numero_recepcion`, `num_factura_rec`, `corte_id`, `id_lavanderia`, `fecha_recepcion`, `recibido_parcial`, `total_recibido`, `total_devuelto`, `pendiente`, `estandar_recibido`, `devuelto_produccion`, `sec`, `updated_at`, `created_at`) VALUES
(10, 'RE-001', '00302250', 55, NULL, '2020-03-05', 440, 440, NULL, 0, 1, NULL, '0.01', '2020-03-05 15:32:11', '2020-03-05 15:32:11'),
(11, 'RE-002', '0052040', 53, NULL, '2020-03-05', 340, 340, NULL, 0, 1, NULL, '0.02', '2020-03-05 16:57:17', '2020-03-05 16:57:17'),
(12, 'RE-003', '003561', 56, NULL, '2020-03-06', 340, 340, NULL, 0, 1, NULL, '0.03', '2020-03-06 11:11:05', '2020-03-06 11:11:05'),
(13, 'RE-004', '0065204', 57, NULL, '2020-03-06', 440, 440, NULL, 0, 1, NULL, '0.04', '2020-03-06 13:38:44', '2020-03-06 13:38:44'),
(14, 'RE-005', '03241320', 58, NULL, '2020-03-09', 440, 440, NULL, 0, 1, NULL, '0.05', '2020-03-09 10:48:39', '2020-03-09 10:48:39'),
(15, 'RE-006', '0062050', 59, NULL, '2020-03-10', 440, 440, NULL, 0, 1, NULL, '0.06', '2020-03-09 13:54:54', '2020-03-09 13:54:54'),
(16, 'RE-007', '000083327', 60, NULL, '2020-03-09', 440, 440, NULL, 0, 1, NULL, '0.07', '2020-03-09 15:21:50', '2020-03-09 15:21:50'),
(17, 'RE-008', '0006250', 63, NULL, '2020-03-10', 440, 440, NULL, 0, 1, NULL, '0.08', '2020-03-10 08:28:16', '2020-03-10 08:28:16'),
(18, 'RE-009', '00620450', 64, NULL, '2020-03-10', 440, 440, NULL, 0, 1, NULL, '0.09', '2020-03-10 08:55:57', '2020-03-10 08:55:57'),
(19, 'RE-010', '00030102', 65, NULL, '2020-03-19', 440, 440, NULL, 0, 1, NULL, '0.10', '2020-03-19 09:46:12', '2020-03-19 09:46:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rollos`
--

CREATE TABLE `rollos` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `id_tela` int(11) DEFAULT NULL,
  `codigo_rollo` varchar(100) DEFAULT NULL,
  `num_tono` varchar(100) DEFAULT NULL,
  `no_factura_compra` varchar(100) DEFAULT NULL,
  `fecha_compra` date DEFAULT NULL,
  `longitud_yarda` double DEFAULT NULL,
  `corte_utilizado` varchar(45) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rollos`
--

INSERT INTO `rollos` (`id`, `id_user`, `id_suplidor`, `id_tela`, `codigo_rollo`, `num_tono`, `no_factura_compra`, `fecha_compra`, `longitud_yarda`, `corte_utilizado`, `updated_at`, `created_at`) VALUES
(1, 1, 8, 10, '1', 'C', '000280', '2020-02-28', 156.39, '2020-010', '2020-03-10 08:52:56', '2020-02-28 09:16:56'),
(2, 1, 8, 10, '2', 'V', '000280', '2020-02-28', 166.23, '2020-001', '2020-03-05 09:43:02', '2020-02-28 09:17:05'),
(3, 1, 8, 10, '3', 'M', '000280', '2020-02-28', 164.1, '2020-003', '2020-03-05 15:21:48', '2020-02-28 09:17:21'),
(4, 1, 8, 10, '4', 'N', '000280', '2020-02-28', 130.14, '2020-003', '2020-03-05 15:21:51', '2020-02-28 09:18:11'),
(5, 1, 8, 10, '5', 'D', '000280', '2020-02-28', 100.9, '2020-007', '2020-03-09 13:52:57', '2020-02-28 09:18:20'),
(6, 1, 8, 10, '7', 'D', '000280', '2020-02-28', 161.7, '2020-011', '2020-03-11 14:53:51', '2020-02-28 09:18:30'),
(7, 1, 8, 10, '8', 'A', '000280', '2020-02-28', 166.23, '2020-007', '2020-03-09 13:53:02', '2020-02-28 09:18:52'),
(8, 1, 8, 12, '001', 'B', '003020210', '2020-03-04', 156.39, '2020-005', '2020-03-06 13:35:48', '2020-03-04 14:41:35'),
(9, 1, 8, 12, '002', 'C', '003020210', '2020-03-04', 156.39, '2020-012', '2020-03-12 08:40:28', '2020-03-04 14:41:47'),
(10, 1, 8, 12, '003', 'N', '003020210', '2020-03-04', 130.14, '2020-008', '2020-03-09 15:18:12', '2020-03-04 14:42:01'),
(11, 1, 8, 12, 'M', 'M', '003020210', '2020-03-04', 120, '2020-001', '2020-03-04 15:02:12', '2020-03-04 14:42:11'),
(12, 1, 8, 12, '005', 'K', '003020210', '2020-03-04', 166.23, '2020-002', '2020-03-05 09:44:47', '2020-03-04 14:42:27'),
(13, 1, 8, 12, '006', 'K', '003020210', '2020-03-04', 111.6, '2020-015', '2020-03-27 09:49:10', '2020-03-04 14:42:49'),
(14, 1, 8, 12, '006', 'B', '003020210', '2020-03-04', 164.1, '2020-008', '2020-03-09 15:18:09', '2020-03-04 14:43:32'),
(15, 1, 8, 12, '007', 'L', '003020210', '2020-03-04', 172.6, '2020-004', '2020-03-06 11:09:38', '2020-03-04 14:43:43'),
(16, 1, 8, 12, '008', 'J', '003020210', '2020-03-04', 172.6, '2020-006', '2020-03-09 10:44:25', '2020-03-04 14:43:51'),
(17, 1, 8, 12, '010', 'O', '003020210', '2020-03-04', 164.1, '2020-009', '2020-03-10 08:23:26', '2020-03-04 14:44:03'),
(18, 1, 8, 12, '011', 'I', '003020210', '2020-03-04', 56.87, '2020-006', '2020-03-09 10:44:23', '2020-03-04 14:44:11'),
(19, 1, 8, 12, '012', 'U', '003020210', '2020-03-04', 164.1, '2020-002', '2020-03-05 09:44:49', '2020-03-04 14:44:23'),
(20, 1, 8, 12, '013', 'I', '003020210', '2020-03-04', 200, '2020-001', '2020-03-04 15:02:10', '2020-03-04 14:44:40'),
(21, 1, 9, 13, '1', 'B', '0003582558', '2020-03-17', 100, '2020-013', '2020-03-17 16:58:40', '2020-03-17 16:41:00'),
(22, 1, 9, 13, '2', 'C', '0003582558', '2020-03-17', 120.3, '2020-013', '2020-03-17 16:58:42', '2020-03-17 16:41:09'),
(23, 1, 9, 13, '3', 'F', '0003582558', '2020-03-17', 156.39, '2020-013', '2020-03-17 16:58:44', '2020-03-17 16:41:19'),
(24, 1, 9, 13, '4', 'M', '0003582558', '2020-03-17', 56.87, '2020-013', '2020-03-17 16:58:46', '2020-03-17 16:41:29'),
(25, 1, 9, 13, '5', 'J', '0003582558', '2020-03-17', 106.08, '2020-013', '2020-03-17 16:58:48', '2020-03-17 16:41:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sku`
--

CREATE TABLE `sku` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `referencia_producto` varchar(20) DEFAULT NULL,
  `sku` varchar(50) DEFAULT NULL,
  `talla` varchar(50) DEFAULT NULL,
  `asignado` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sku`
--

INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
(84, 111, 'P302-2004', '7432147218230', 'General', 1, '2019-12-24 10:53:40', '2020-03-10 08:29:54'),
(85, 113, 'M302-2006', '7432147218247', 'General', 1, '2019-12-24 10:53:40', '2020-03-10 08:56:33'),
(86, NULL, NULL, '7432147218254', 'C', 1, '2019-12-24 10:53:40', '2020-01-31 16:49:33'),
(87, 107, 'M402-2002', '7432147218261', 'General', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:03'),
(88, NULL, NULL, '7432147218278', 'C', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:05'),
(89, NULL, NULL, '7432147218285', 'D', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:08'),
(90, NULL, NULL, '7432147218292', 'F', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:10'),
(91, NULL, NULL, '7432147318305', 'G', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:12'),
(92, NULL, NULL, '7432147318312', 'H', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:15'),
(93, NULL, NULL, '7432147318329', 'J', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:18'),
(94, NULL, NULL, '7432147318336', 'General', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:37'),
(95, NULL, NULL, '7432147318343', 'A', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:40'),
(96, NULL, NULL, '7432147318350', 'B', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:42'),
(97, NULL, NULL, '7432147318367', 'C', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:45'),
(98, NULL, NULL, '7432147318374', 'D', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:47'),
(99, NULL, NULL, '7432147318381', 'E', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:49'),
(100, NULL, NULL, '7432147318398', 'F', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:51'),
(101, NULL, NULL, '7432147418401', 'G', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:53'),
(102, NULL, NULL, '7432147418418', 'H', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:56'),
(103, NULL, NULL, '7432147418425', 'I', 1, '2019-12-24 10:53:40', '2020-02-10 16:47:58'),
(104, NULL, NULL, '7432147418432', 'J', 1, '2019-12-24 10:53:40', '2020-02-10 16:48:00'),
(105, NULL, NULL, '7432147418449', 'General', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:25'),
(106, NULL, NULL, '7432147418456', 'C', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:30'),
(107, NULL, NULL, '7432147418463', 'D', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:32'),
(108, NULL, NULL, '7432147418470', 'E', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:34'),
(109, NULL, NULL, '7432147418487', 'F', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:36'),
(110, NULL, NULL, '7432147418494', 'G', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:38'),
(111, NULL, NULL, '7432147518507', 'H', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:40'),
(112, NULL, NULL, '7432147518514', 'I', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:42'),
(113, NULL, NULL, '7432147518521', 'J', 1, '2019-12-24 10:53:40', '2020-02-11 16:26:43'),
(114, NULL, NULL, '7432147518538', 'General', 1, '2019-12-24 10:53:40', '2020-02-11 16:37:59'),
(116, NULL, NULL, '7432147518552', 'General', 1, '2019-12-24 10:53:40', '2020-02-11 16:47:13'),
(255, 105, 'P105-2001', '7432147919946', 'C', 1, '2019-12-24 10:53:40', '2020-03-04 15:05:35'),
(256, 105, 'P105-2001', '7432147919953', 'D', 1, '2019-12-24 10:53:40', '2020-03-04 15:05:38'),
(257, 105, 'P105-2001', '7432147919960', 'E', 1, '2019-12-24 10:53:40', '2020-03-04 15:05:40'),
(258, 105, 'P105-2001', '7432147919977', 'F', 1, '2019-12-24 10:53:40', '2020-03-04 15:05:42'),
(259, 105, 'P105-2001', '7432147919984', 'G', 1, '2019-12-24 10:53:40', '2020-03-04 15:05:50'),
(260, 105, 'P105-2001', '7432147919991', 'H', 1, '2019-12-24 10:53:40', '2020-03-04 15:06:03'),
(262, 105, 'P105-2001', '7432147020017', 'C', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:15'),
(263, 105, 'P105-2001', '7432147020024', 'D', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:17'),
(264, 105, 'P105-2001', '7432147020031', 'E', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:18'),
(265, 105, 'P105-2001', '7432147020048', 'F', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:20'),
(266, 105, 'P105-2001', '7432147020055', 'G', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:26'),
(267, 105, 'P105-2001', '7432147020062', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 08:45:28'),
(268, 105, 'P105-2001', '7432147020079', 'General', 1, '2019-12-24 10:53:40', '2020-03-05 08:56:51'),
(270, 105, 'P105-2001', '7432147020093', 'D', 1, '2019-12-24 10:53:40', '2020-03-05 08:56:55'),
(271, 105, 'P105-2001', '7432147120106', 'E', 1, '2019-12-24 10:53:40', '2020-03-05 08:56:57'),
(272, 105, 'P105-2001', '7432147120113', 'F', 1, '2019-12-24 10:53:40', '2020-03-05 08:56:59'),
(273, 105, 'P105-2001', '7432147120120', 'G', 1, '2019-12-24 10:53:40', '2020-03-05 08:57:01'),
(274, 105, 'P105-2001', '7432147120137', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 08:57:02'),
(275, 105, 'P105-2001', '7432147120144', 'I', 1, '2019-12-24 10:53:40', '2020-03-05 08:57:04'),
(277, 105, 'P105-2001', '7432147120168', 'C', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:27'),
(278, 105, 'P105-2001', '7432147120175', 'D', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:28'),
(279, 105, 'P105-2001', '7432147120182', 'E', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:30'),
(280, 105, 'P105-2001', '7432147120199', 'F', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:32'),
(281, 105, 'P105-2001', '7432147220202', 'G', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:34'),
(282, 105, 'P105-2001', '7432147220219', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 09:33:36'),
(284, 105, 'P105-2001', '7432147220233', 'C', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:42'),
(285, 105, 'P105-2001', '7432147220240', 'D', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:44'),
(286, 105, 'P105-2001', '7432147220257', 'E', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:46'),
(287, 105, 'P105-2001', '7432147220264', 'F', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:53'),
(288, 105, 'P105-2001', '7432147220271', 'G', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:55'),
(289, 105, 'P105-2001', '7432147220288', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 09:43:56'),
(290, 104, 'M402-2001', '7432147220295', 'General', 1, '2019-12-24 10:53:40', '2020-03-05 15:21:56'),
(292, 104, 'M402-2001', '7432147320315', 'A', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:04'),
(294, 104, 'M402-2001', '7432147320339', 'B', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:06'),
(296, 104, 'M402-2001', '7432147320353', 'C', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:08'),
(298, 104, 'M402-2001', '7432147320377', 'D', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:10'),
(300, 107, 'M402-2002', '7432147320391', 'E', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:13'),
(302, 107, 'M402-2002', '7432147420411', 'F', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:14'),
(304, 107, 'M402-2002', '7432147420435', 'G', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:16'),
(306, 104, 'M402-2001', '7432147420459', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:18'),
(307, 107, 'M402-2002', '7432147420466', 'H', 1, '2019-12-24 10:53:40', '2020-03-05 15:22:18'),
(308, 105, 'P105-2001', '7432147420473', 'F', 1, '2019-12-24 10:53:40', '2020-03-06 11:07:51'),
(309, 105, 'P105-2001', '7432147420480', 'G', 1, '2019-12-24 10:53:40', '2020-03-06 11:07:53'),
(310, 105, 'P105-2001', '7432147420497', 'H', 1, '2019-12-24 10:53:40', '2020-03-06 11:07:55'),
(312, 105, 'P105-2001', '7432147520517', 'F', 1, '2019-12-24 10:53:40', '2020-03-06 11:10:01'),
(314, 105, 'P105-2001', '7432147520531', 'G', 1, '2019-12-24 10:53:40', '2020-03-06 11:10:05'),
(315, 105, 'P105-2001', '7432147520548', 'H', 1, '2019-12-24 10:53:40', '2020-03-06 11:10:07'),
(316, 105, 'P105-2001', '7432147520555', 'F', 1, '2019-12-24 10:53:40', '2020-03-09 10:45:04'),
(317, 105, 'P105-2001', '7432147520562', 'G', 1, '2019-12-24 10:53:40', '2020-03-09 10:45:06'),
(318, 105, 'P105-2001', '7432147520579', 'H', 1, '2019-12-24 10:53:40', '2020-03-09 10:45:10'),
(319, 110, 'P302-2003', '7432147520586', 'General', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:34'),
(320, 110, 'P302-2004', '7432147520593', 'General', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:34'),
(321, 110, 'P302-2003', '7432147620606', 'A', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:37'),
(322, 110, 'P302-2004', '7432147620613', 'A', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:37'),
(323, 110, 'P302-2003', '7432147620620', 'B', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:39'),
(324, 110, 'P302-2004', '7432147620637', 'B', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:39'),
(325, 110, 'P302-2003', '7432147620644', 'D', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:41'),
(326, 110, 'P302-2004', '7432147620651', 'D', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:41'),
(327, 110, 'P302-2003', '7432147620668', 'C', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:43'),
(328, 110, 'P302-2004', '7432147620675', 'C', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:43'),
(329, 110, 'P302-2003', '7432147620682', 'E', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:45'),
(330, 111, 'P302-2004', '7432147620699', 'E', 1, '2019-12-24 10:53:40', '2020-03-10 08:29:54'),
(331, 110, 'P302-2003', '7432147720702', 'F', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:47'),
(332, 111, 'P302-2004', '7432147720719', 'F', 1, '2019-12-24 10:53:40', '2020-03-10 08:29:54'),
(333, 110, 'P302-2003', '7432147720726', 'G', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:49'),
(334, 111, 'P302-2004', '7432147720733', 'G', 1, '2019-12-24 10:53:40', '2020-03-10 08:29:54'),
(335, 110, 'P302-2003', '7432147720740', 'H', 1, '2019-12-24 10:53:40', '2020-03-10 08:24:51'),
(336, 111, 'P302-2004', '7432147720757', 'H', 1, '2019-12-24 10:53:40', '2020-03-10 08:29:54'),
(337, 112, 'M302-2005', '7432147720764', 'General', 1, '2019-12-24 10:53:40', '2020-03-10 08:53:47'),
(338, 112, 'M302-2005', '7432147720771', 'A', 1, '2019-12-24 10:53:40', '2020-03-10 08:53:50'),
(339, 112, 'M302-2005', '7432147720788', 'B', 1, '2019-12-24 10:53:40', '2020-03-10 08:53:52'),
(340, 112, 'M302-2005', '7432147720795', 'C', 1, '2019-12-24 10:53:40', '2020-03-10 08:53:54'),
(341, 112, 'M302-2005', '7432147820808', 'D', 1, '2019-12-24 10:53:40', '2020-03-10 08:53:56'),
(342, 113, 'M302-2005', '7432147820815', 'E', 1, '2019-12-24 10:53:40', '2020-03-10 08:56:33'),
(343, 113, 'M302-2005', '7432147820822', 'F', 1, '2019-12-24 10:53:40', '2020-03-10 08:56:33'),
(344, 113, 'M302-2005', '7432147820839', 'G', 1, '2019-12-24 10:53:40', '2020-03-10 08:56:33'),
(345, 113, 'M302-2005', '7432147820846', 'H', 1, '2019-12-24 10:53:40', '2020-03-10 08:56:33'),
(346, 104, 'M402-2001', '7432147820853', 'E', 1, '2019-12-24 10:53:40', '2020-03-12 08:40:46'),
(347, 104, 'M402-2001', '7432147820860', 'F', 1, '2019-12-24 10:53:40', '2020-03-12 08:40:48'),
(348, 104, 'M402-2001', '7432147820877', 'G', 1, '2019-12-24 10:53:40', '2020-03-12 08:40:52'),
(349, 114, 'L104-1101', '7432147820884', 'General', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:02'),
(350, 114, 'L104-1101', '7432147820891', 'A', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:05'),
(351, 114, 'L104-1101', '7432147920904', 'B', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:07'),
(352, 114, 'L104-1101', '7432147920911', 'C', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:08'),
(353, 114, 'L104-1101', '7432147920928', 'D', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:10'),
(354, 114, 'L104-1101', '7432147920935', 'E', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:12'),
(355, 114, 'L104-1101', '7432147920942', 'F', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:14'),
(356, 114, 'L104-1101', '7432147920959', 'G', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:16'),
(357, 114, 'L104-1101', '7432147920966', 'H', 1, '2019-12-24 10:53:40', '2020-03-17 17:00:18'),
(358, NULL, NULL, '7432147920973', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(359, NULL, NULL, '7432147920980', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(360, NULL, NULL, '7432147920997', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(361, NULL, NULL, '7432147021007', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(362, NULL, NULL, '7432147021014', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(363, NULL, NULL, '7432147021021', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(364, NULL, NULL, '7432147021038', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(365, NULL, NULL, '7432147021045', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(366, NULL, NULL, '7432147021052', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(367, NULL, NULL, '7432147021069', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(368, NULL, NULL, '7432147021076', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(369, NULL, NULL, '7432147021083', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(370, NULL, NULL, '7432147021090', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(371, NULL, NULL, '7432147121103', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(372, NULL, NULL, '7432147121110', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(373, NULL, NULL, '7432147121127', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(374, NULL, NULL, '7432147121134', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(375, NULL, NULL, '7432147121141', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(376, NULL, NULL, '7432147121158', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(377, NULL, NULL, '7432147121165', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(378, NULL, NULL, '7432147121172', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(379, NULL, NULL, '7432147121189', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(380, NULL, NULL, '7432147121196', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(381, NULL, NULL, '7432147221209', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(382, NULL, NULL, '7432147221216', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(383, NULL, NULL, '7432147221223', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(384, NULL, NULL, '7432147221230', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(385, NULL, NULL, '7432147221247', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(386, NULL, NULL, '7432147221254', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(387, NULL, NULL, '7432147221261', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(388, NULL, NULL, '7432147221278', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(389, NULL, NULL, '7432147221285', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(390, NULL, NULL, '7432147221292', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(391, NULL, NULL, '7432147321305', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(392, NULL, NULL, '7432147321312', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(393, NULL, NULL, '7432147321329', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(394, NULL, NULL, '7432147321336', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(395, NULL, NULL, '7432147321343', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(396, NULL, NULL, '7432147321350', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(397, NULL, NULL, '7432147321367', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(398, NULL, NULL, '7432147321374', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(399, NULL, NULL, '7432147321381', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(400, NULL, NULL, '7432147321398', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(401, NULL, NULL, '7432147421401', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(402, NULL, NULL, '7432147421418', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(403, NULL, NULL, '7432147421425', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(404, NULL, NULL, '7432147421432', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(405, NULL, NULL, '7432147421449', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(406, NULL, NULL, '7432147421456', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(407, NULL, NULL, '7432147421463', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(408, NULL, NULL, '7432147421470', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(409, NULL, NULL, '7432147421487', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(410, NULL, NULL, '7432147421494', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(411, NULL, NULL, '7432147521507', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(412, NULL, NULL, '7432147521514', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(413, NULL, NULL, '7432147521521', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(414, NULL, NULL, '7432147521538', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(415, NULL, NULL, '7432147521545', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(416, NULL, NULL, '7432147521552', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(417, NULL, NULL, '7432147521569', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(418, NULL, NULL, '7432147521576', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(419, NULL, NULL, '7432147521583', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(420, NULL, NULL, '7432147521590', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(421, NULL, NULL, '7432147621603', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(422, NULL, NULL, '7432147621610', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(423, NULL, NULL, '7432147621627', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(424, NULL, NULL, '7432147621634', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(425, NULL, NULL, '7432147621641', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(426, NULL, NULL, '7432147621658', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(427, NULL, NULL, '7432147621665', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(428, NULL, NULL, '7432147621672', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(429, NULL, NULL, '7432147621689', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(430, NULL, NULL, '7432147621696', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(431, NULL, NULL, '7432147721709', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(432, NULL, NULL, '7432147721716', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(433, NULL, NULL, '7432147721723', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(434, NULL, NULL, '7432147721730', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(435, NULL, NULL, '7432147721747', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(436, NULL, NULL, '7432147721754', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(437, NULL, NULL, '7432147721761', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(438, NULL, NULL, '7432147721778', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(439, NULL, NULL, '7432147721785', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(440, NULL, NULL, '7432147721792', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(441, NULL, NULL, '7432147821805', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(442, NULL, NULL, '7432147821812', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(443, NULL, NULL, '7432147821829', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(444, NULL, NULL, '7432147821836', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(445, NULL, NULL, '7432147821843', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(446, NULL, NULL, '7432147821850', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(447, NULL, NULL, '7432147821867', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(448, NULL, NULL, '7432147821874', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(449, NULL, NULL, '7432147821881', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(450, NULL, NULL, '7432147821898', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(451, NULL, NULL, '7432147921901', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(452, NULL, NULL, '7432147921918', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(453, NULL, NULL, '7432147921925', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(454, NULL, NULL, '7432147921932', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(455, NULL, NULL, '7432147921949', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(456, NULL, NULL, '7432147921956', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(457, NULL, NULL, '7432147921963', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(458, NULL, NULL, '7432147921970', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(459, NULL, NULL, '7432147921987', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(460, NULL, NULL, '7432147921994', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(461, NULL, NULL, '7432147022004', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(462, NULL, NULL, '7432147022011', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(463, NULL, NULL, '7432147022028', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(464, NULL, NULL, '7432147022035', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(465, NULL, NULL, '7432147022042', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(466, NULL, NULL, '7432147022059', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(467, NULL, NULL, '7432147022066', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(468, NULL, NULL, '7432147022073', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(469, NULL, NULL, '7432147022080', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(470, NULL, NULL, '7432147022097', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(471, NULL, NULL, '7432147122100', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(472, NULL, NULL, '7432147122117', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(473, NULL, NULL, '7432147122124', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(474, NULL, NULL, '7432147122131', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(475, NULL, NULL, '7432147122148', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(476, NULL, NULL, '7432147122155', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(477, NULL, NULL, '7432147122162', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(478, NULL, NULL, '7432147122179', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(479, NULL, NULL, '7432147122186', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(480, NULL, NULL, '7432147122193', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(481, NULL, NULL, '7432147222206', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(482, NULL, NULL, '7432147222213', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(483, NULL, NULL, '7432147222220', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(484, NULL, NULL, '7432147222237', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(485, NULL, NULL, '7432147222244', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(486, NULL, NULL, '7432147222251', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(487, NULL, NULL, '7432147222268', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(488, NULL, NULL, '7432147222275', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(489, NULL, NULL, '7432147222282', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(490, NULL, NULL, '7432147222299', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(491, NULL, NULL, '7432147322302', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(492, NULL, NULL, '7432147322319', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(493, NULL, NULL, '7432147322326', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(494, NULL, NULL, '7432147322333', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(495, NULL, NULL, '7432147322340', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(496, NULL, NULL, '7432147322357', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(497, NULL, NULL, '7432147322364', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(498, NULL, NULL, '7432147322371', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(499, NULL, NULL, '7432147322388', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(500, NULL, NULL, '7432147322395', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(501, NULL, NULL, '7432147422408', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(502, NULL, NULL, '7432147422415', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(503, NULL, NULL, '7432147422422', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(504, NULL, NULL, '7432147422439', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(505, NULL, NULL, '7432147422446', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(506, NULL, NULL, '7432147422453', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(507, NULL, NULL, '7432147422460', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(508, NULL, NULL, '7432147422477', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(509, NULL, NULL, '7432147422484', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(510, NULL, NULL, '7432147422491', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(511, NULL, NULL, '7432147522504', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(512, NULL, NULL, '7432147522511', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(513, NULL, NULL, '7432147522528', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(514, NULL, NULL, '7432147522535', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(515, NULL, NULL, '7432147522542', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(516, NULL, NULL, '7432147522559', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(517, NULL, NULL, '7432147522566', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(518, NULL, NULL, '7432147522573', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(519, NULL, NULL, '7432147522580', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(520, NULL, NULL, '7432147522597', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(521, NULL, NULL, '7432147622600', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(522, NULL, NULL, '7432147622617', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(523, NULL, NULL, '7432147622624', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(524, NULL, NULL, '7432147622631', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(525, NULL, NULL, '7432147622648', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(526, NULL, NULL, '7432147622655', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(527, NULL, NULL, '7432147622662', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(528, NULL, NULL, '7432147622679', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(529, NULL, NULL, '7432147622686', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(530, NULL, NULL, '7432147622693', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(531, NULL, NULL, '7432147722706', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(532, NULL, NULL, '7432147722713', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(533, NULL, NULL, '7432147722720', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(534, NULL, NULL, '7432147722737', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(535, NULL, NULL, '7432147722744', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(536, NULL, NULL, '7432147722751', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(537, NULL, NULL, '7432147722768', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(538, NULL, NULL, '7432147722775', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(539, NULL, NULL, '7432147722782', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(540, NULL, NULL, '7432147722799', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(541, NULL, NULL, '7432147822802', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(542, NULL, NULL, '7432147822819', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(543, NULL, NULL, '7432147822826', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(544, NULL, NULL, '7432147822833', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(545, NULL, NULL, '7432147822840', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(546, NULL, NULL, '7432147822857', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(547, NULL, NULL, '7432147822864', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(548, NULL, NULL, '7432147822871', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(549, NULL, NULL, '7432147822888', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(550, NULL, NULL, '7432147822895', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(551, NULL, NULL, '7432147922908', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(552, NULL, NULL, '7432147922915', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(553, NULL, NULL, '7432147922922', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(554, NULL, NULL, '7432147922939', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(555, NULL, NULL, '7432147922946', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(556, NULL, NULL, '7432147922953', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(557, NULL, NULL, '7432147922960', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(558, NULL, NULL, '7432147922977', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(559, NULL, NULL, '7432147922984', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(560, NULL, NULL, '7432147922991', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(561, NULL, NULL, '7432147023001', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(562, NULL, NULL, '7432147023018', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(563, NULL, NULL, '7432147023025', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(564, NULL, NULL, '7432147023032', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(565, NULL, NULL, '7432147023049', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(566, NULL, NULL, '7432147023056', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(567, NULL, NULL, '7432147023063', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(568, NULL, NULL, '7432147023070', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(569, NULL, NULL, '7432147023087', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(570, NULL, NULL, '7432147023094', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(571, NULL, NULL, '7432147123107', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(572, NULL, NULL, '7432147123114', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(573, NULL, NULL, '7432147123121', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(574, NULL, NULL, '7432147123138', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(575, NULL, NULL, '7432147123145', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(576, NULL, NULL, '7432147123152', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(577, NULL, NULL, '7432147123169', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(578, NULL, NULL, '7432147123176', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(579, NULL, NULL, '7432147123183', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(580, NULL, NULL, '7432147123190', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(581, NULL, NULL, '7432147223203', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(582, NULL, NULL, '7432147223210', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(583, NULL, NULL, '7432147223227', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(584, NULL, NULL, '7432147223234', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(585, NULL, NULL, '7432147223241', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(586, NULL, NULL, '7432147223258', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(587, NULL, NULL, '7432147223265', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(588, NULL, NULL, '7432147223272', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(589, NULL, NULL, '7432147223289', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(590, NULL, NULL, '7432147223296', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(591, NULL, NULL, '7432147323309', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(592, NULL, NULL, '7432147323316', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(593, NULL, NULL, '7432147323323', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(594, NULL, NULL, '7432147323330', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(595, NULL, NULL, '7432147323347', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(596, NULL, NULL, '7432147323354', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(597, NULL, NULL, '7432147323361', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(598, NULL, NULL, '7432147323378', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(599, NULL, NULL, '7432147323385', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(600, NULL, NULL, '7432147323392', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(601, NULL, NULL, '7432147423405', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(602, NULL, NULL, '7432147423412', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(603, NULL, NULL, '7432147423429', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(604, NULL, NULL, '7432147423436', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(605, NULL, NULL, '7432147423443', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(606, NULL, NULL, '7432147423450', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(607, NULL, NULL, '7432147423467', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(608, NULL, NULL, '7432147423474', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(609, NULL, NULL, '7432147423481', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(610, NULL, NULL, '7432147423498', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(611, NULL, NULL, '7432147523501', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(612, NULL, NULL, '7432147523518', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(613, NULL, NULL, '7432147523525', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(614, NULL, NULL, '7432147523532', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(615, NULL, NULL, '7432147523549', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(616, NULL, NULL, '7432147523556', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(617, NULL, NULL, '7432147523563', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(618, NULL, NULL, '7432147523570', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(619, NULL, NULL, '7432147523587', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(620, NULL, NULL, '7432147523594', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(621, NULL, NULL, '7432147623607', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(622, NULL, NULL, '7432147623614', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(623, NULL, NULL, '7432147623621', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(624, NULL, NULL, '7432147623638', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(625, NULL, NULL, '7432147623645', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(626, NULL, NULL, '7432147623652', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(627, NULL, NULL, '7432147623669', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(628, NULL, NULL, '7432147623676', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(629, NULL, NULL, '7432147623683', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(630, NULL, NULL, '7432147623690', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(631, NULL, NULL, '7432147723703', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(632, NULL, NULL, '7432147723710', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(633, NULL, NULL, '7432147723727', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(634, NULL, NULL, '7432147723734', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(635, NULL, NULL, '7432147723741', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(636, NULL, NULL, '7432147723758', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(637, NULL, NULL, '7432147723765', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(638, NULL, NULL, '7432147723772', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(639, NULL, NULL, '7432147723789', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(640, NULL, NULL, '7432147723796', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(641, NULL, NULL, '7432147823809', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(642, NULL, NULL, '7432147823816', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(643, NULL, NULL, '7432147823823', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(644, NULL, NULL, '7432147823830', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(645, NULL, NULL, '7432147823847', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(646, NULL, NULL, '7432147823854', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(647, NULL, NULL, '7432147823861', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(648, NULL, NULL, '7432147823878', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(649, NULL, NULL, '7432147823885', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(650, NULL, NULL, '7432147823892', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(651, NULL, NULL, '7432147923905', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(652, NULL, NULL, '7432147923912', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(653, NULL, NULL, '7432147923929', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(654, NULL, NULL, '7432147923936', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(655, NULL, NULL, '7432147923943', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(656, NULL, NULL, '7432147923950', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(657, NULL, NULL, '7432147923967', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(658, NULL, NULL, '7432147923974', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(659, NULL, NULL, '7432147923981', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(660, NULL, NULL, '7432147923998', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(661, NULL, NULL, '7432147024008', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(662, NULL, NULL, '7432147024015', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(663, NULL, NULL, '7432147024022', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(664, NULL, NULL, '7432147024039', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(665, NULL, NULL, '7432147024046', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(666, NULL, NULL, '7432147024053', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(667, NULL, NULL, '7432147024060', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(668, NULL, NULL, '7432147024077', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(669, NULL, NULL, '7432147024084', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(670, NULL, NULL, '7432147024091', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(671, NULL, NULL, '7432147124104', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(672, NULL, NULL, '7432147124111', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(673, NULL, NULL, '7432147124128', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(674, NULL, NULL, '7432147124135', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(675, NULL, NULL, '7432147124142', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(676, NULL, NULL, '7432147124159', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(677, NULL, NULL, '7432147124166', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(678, NULL, NULL, '7432147124173', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(679, NULL, NULL, '7432147124180', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(680, NULL, NULL, '7432147124197', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(681, NULL, NULL, '7432147224200', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(682, NULL, NULL, '7432147224217', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(683, NULL, NULL, '7432147224224', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(684, NULL, NULL, '7432147224231', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(685, NULL, NULL, '7432147224248', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(686, NULL, NULL, '7432147224255', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(687, NULL, NULL, '7432147224262', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(688, NULL, NULL, '7432147224279', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(689, NULL, NULL, '7432147224286', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(690, NULL, NULL, '7432147224293', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(691, NULL, NULL, '7432147324306', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(692, NULL, NULL, '7432147324313', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(693, NULL, NULL, '7432147324320', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(694, NULL, NULL, '7432147324337', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(695, NULL, NULL, '7432147324344', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(696, NULL, NULL, '7432147324351', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(697, NULL, NULL, '7432147324368', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(698, NULL, NULL, '7432147324375', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(699, NULL, NULL, '7432147324382', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(700, NULL, NULL, '7432147324399', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(701, NULL, NULL, '7432147424402', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(702, NULL, NULL, '7432147424419', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(703, NULL, NULL, '7432147424426', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(704, NULL, NULL, '7432147424433', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(705, NULL, NULL, '7432147424440', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(706, NULL, NULL, '7432147424457', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(707, NULL, NULL, '7432147424464', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(708, NULL, NULL, '7432147424471', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(709, NULL, NULL, '7432147424488', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(710, NULL, NULL, '7432147424495', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(711, NULL, NULL, '7432147524508', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(712, NULL, NULL, '7432147524515', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(713, NULL, NULL, '7432147524522', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(714, NULL, NULL, '7432147524539', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(715, NULL, NULL, '7432147524546', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(716, NULL, NULL, '7432147524553', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(717, NULL, NULL, '7432147524560', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(718, NULL, NULL, '7432147524577', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(719, NULL, NULL, '7432147524584', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(720, NULL, NULL, '7432147524591', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(721, NULL, NULL, '7432147624604', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(722, NULL, NULL, '7432147624611', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(723, NULL, NULL, '7432147624628', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(724, NULL, NULL, '7432147624635', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(725, NULL, NULL, '7432147624642', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(726, NULL, NULL, '7432147624659', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(727, NULL, NULL, '7432147624666', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(728, NULL, NULL, '7432147624673', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(729, NULL, NULL, '7432147624680', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(730, NULL, NULL, '7432147624697', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(731, NULL, NULL, '7432147724700', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(732, NULL, NULL, '7432147724717', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(733, NULL, NULL, '7432147724724', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(734, NULL, NULL, '7432147724731', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(735, NULL, NULL, '7432147724748', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(736, NULL, NULL, '7432147724755', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(737, NULL, NULL, '7432147724762', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(738, NULL, NULL, '7432147724779', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(739, NULL, NULL, '7432147724786', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(740, NULL, NULL, '7432147724793', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(741, NULL, NULL, '7432147824806', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(742, NULL, NULL, '7432147824813', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(743, NULL, NULL, '7432147824820', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(744, NULL, NULL, '7432147824837', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(745, NULL, NULL, '7432147824844', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(746, NULL, NULL, '7432147824851', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(747, NULL, NULL, '7432147824868', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(748, NULL, NULL, '7432147824875', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(749, NULL, NULL, '7432147824882', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(750, NULL, NULL, '7432147824899', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(751, NULL, NULL, '7432147924902', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(752, NULL, NULL, '7432147924919', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(753, NULL, NULL, '7432147924926', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(754, NULL, NULL, '7432147924933', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(755, NULL, NULL, '7432147924940', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(756, NULL, NULL, '7432147924957', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(757, NULL, NULL, '7432147924964', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(758, NULL, NULL, '7432147924971', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(759, NULL, NULL, '7432147924988', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(760, NULL, NULL, '7432147924995', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(761, NULL, NULL, '7432147025005', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(762, NULL, NULL, '7432147025012', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(763, NULL, NULL, '7432147025029', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(764, NULL, NULL, '7432147025036', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(765, NULL, NULL, '7432147025043', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(766, NULL, NULL, '7432147025050', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(767, NULL, NULL, '7432147025067', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(768, NULL, NULL, '7432147025074', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(769, NULL, NULL, '7432147025081', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(770, NULL, NULL, '7432147025098', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(771, NULL, NULL, '7432147125101', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(772, NULL, NULL, '7432147125118', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(773, NULL, NULL, '7432147125125', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(774, NULL, NULL, '7432147125132', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(775, NULL, NULL, '7432147125149', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(776, NULL, NULL, '7432147125156', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40');
INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
(777, NULL, NULL, '7432147125163', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(778, NULL, NULL, '7432147125170', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(779, NULL, NULL, '7432147125187', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(780, NULL, NULL, '7432147125194', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(781, NULL, NULL, '7432147225207', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(782, NULL, NULL, '7432147225214', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(783, NULL, NULL, '7432147225221', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(784, NULL, NULL, '7432147225238', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(785, NULL, NULL, '7432147225245', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(786, NULL, NULL, '7432147225252', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(787, NULL, NULL, '7432147225269', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(788, NULL, NULL, '7432147225276', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(789, NULL, NULL, '7432147225283', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(790, NULL, NULL, '7432147225290', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(791, NULL, NULL, '7432147325303', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(792, NULL, NULL, '7432147325310', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(793, NULL, NULL, '7432147325327', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(794, NULL, NULL, '7432147325334', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(795, NULL, NULL, '7432147325341', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(796, NULL, NULL, '7432147325358', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(797, NULL, NULL, '7432147325365', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(798, NULL, NULL, '7432147325372', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(799, NULL, NULL, '7432147325389', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(800, NULL, NULL, '7432147325396', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(801, NULL, NULL, '7432147425409', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(802, NULL, NULL, '7432147425416', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(803, NULL, NULL, '7432147425423', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(804, NULL, NULL, '7432147425430', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(805, NULL, NULL, '7432147425447', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(806, NULL, NULL, '7432147425454', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(807, NULL, NULL, '7432147425461', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(808, NULL, NULL, '7432147425478', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(809, NULL, NULL, '7432147425485', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(810, NULL, NULL, '7432147425492', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(811, NULL, NULL, '7432147525505', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(812, NULL, NULL, '7432147525512', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(813, NULL, NULL, '7432147525529', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(814, NULL, NULL, '7432147525536', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(815, NULL, NULL, '7432147525543', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(816, NULL, NULL, '7432147525550', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(817, NULL, NULL, '7432147525567', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(818, NULL, NULL, '7432147525574', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(819, NULL, NULL, '7432147525581', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(820, NULL, NULL, '7432147525598', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(821, NULL, NULL, '7432147625601', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(822, NULL, NULL, '7432147625618', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(823, NULL, NULL, '7432147625625', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(824, NULL, NULL, '7432147625632', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(825, NULL, NULL, '7432147625649', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(826, NULL, NULL, '7432147625656', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(827, NULL, NULL, '7432147625663', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(828, NULL, NULL, '7432147625670', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(829, NULL, NULL, '7432147625687', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(830, NULL, NULL, '7432147625694', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(831, NULL, NULL, '7432147725707', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(832, NULL, NULL, '7432147725714', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(833, NULL, NULL, '7432147725721', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(834, NULL, NULL, '7432147725738', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(835, NULL, NULL, '7432147725745', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(836, NULL, NULL, '7432147725752', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(837, NULL, NULL, '7432147725769', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(838, NULL, NULL, '7432147725776', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(839, NULL, NULL, '7432147725783', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(840, NULL, NULL, '7432147725790', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(841, NULL, NULL, '7432147825803', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(842, NULL, NULL, '7432147825810', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(843, NULL, NULL, '7432147825827', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(844, NULL, NULL, '7432147825834', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(845, NULL, NULL, '7432147825841', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(846, NULL, NULL, '7432147825858', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(847, NULL, NULL, '7432147825865', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(848, NULL, NULL, '7432147825872', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(849, NULL, NULL, '7432147825889', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(850, NULL, NULL, '7432147825896', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(851, NULL, NULL, '7432147925909', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(852, NULL, NULL, '7432147925916', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(853, NULL, NULL, '7432147925923', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(854, NULL, NULL, '7432147925930', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(855, NULL, NULL, '7432147925947', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(856, NULL, NULL, '7432147925954', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(857, NULL, NULL, '7432147925961', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(858, NULL, NULL, '7432147925978', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(859, NULL, NULL, '7432147925985', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(860, NULL, NULL, '7432147925992', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(861, NULL, NULL, '7432147026002', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(862, NULL, NULL, '7432147026019', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(863, NULL, NULL, '7432147026026', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(864, NULL, NULL, '7432147026033', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(865, NULL, NULL, '7432147026040', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(866, NULL, NULL, '7432147026057', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(867, NULL, NULL, '7432147026064', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(868, NULL, NULL, '7432147026071', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(869, NULL, NULL, '7432147026088', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(870, NULL, NULL, '7432147026095', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(871, NULL, NULL, '7432147126108', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(872, NULL, NULL, '7432147126115', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(873, NULL, NULL, '7432147126122', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(874, NULL, NULL, '7432147126139', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(875, NULL, NULL, '7432147126146', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(876, NULL, NULL, '7432147126153', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(877, NULL, NULL, '7432147126160', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(878, NULL, NULL, '7432147126177', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(879, NULL, NULL, '7432147126184', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(880, NULL, NULL, '7432147126191', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(881, NULL, NULL, '7432147226204', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(882, NULL, NULL, '7432147226211', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(883, NULL, NULL, '7432147226228', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(884, NULL, NULL, '7432147226235', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(885, NULL, NULL, '7432147226242', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(886, NULL, NULL, '7432147226259', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(887, NULL, NULL, '7432147226266', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(888, NULL, NULL, '7432147226273', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(889, NULL, NULL, '7432147226280', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(890, NULL, NULL, '7432147226297', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(891, NULL, NULL, '7432147326300', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(892, NULL, NULL, '7432147326317', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(893, NULL, NULL, '7432147326324', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(894, NULL, NULL, '7432147326331', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(895, NULL, NULL, '7432147326348', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(896, NULL, NULL, '7432147326355', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(897, NULL, NULL, '7432147326362', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(898, NULL, NULL, '7432147326379', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(899, NULL, NULL, '7432147326386', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(900, NULL, NULL, '7432147326393', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(901, NULL, NULL, '7432147426406', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(902, NULL, NULL, '7432147426413', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(903, NULL, NULL, '7432147426420', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(904, NULL, NULL, '7432147426437', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(905, NULL, NULL, '7432147426444', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(906, NULL, NULL, '7432147426451', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(907, NULL, NULL, '7432147426468', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(908, NULL, NULL, '7432147426475', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(909, NULL, NULL, '7432147426482', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(910, NULL, NULL, '7432147426499', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(911, NULL, NULL, '7432147526502', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(912, NULL, NULL, '7432147526519', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(913, NULL, NULL, '7432147526526', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(914, NULL, NULL, '7432147526533', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(915, NULL, NULL, '7432147526540', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(916, NULL, NULL, '7432147526557', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(917, NULL, NULL, '7432147526564', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(918, NULL, NULL, '7432147526571', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(919, NULL, NULL, '7432147526588', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(920, NULL, NULL, '7432147526595', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(921, NULL, NULL, '7432147626608', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(922, NULL, NULL, '7432147626615', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(923, NULL, NULL, '7432147626622', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(924, NULL, NULL, '7432147626639', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(925, NULL, NULL, '7432147626646', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(926, NULL, NULL, '7432147626653', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(927, NULL, NULL, '7432147626660', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(928, NULL, NULL, '7432147626677', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(929, NULL, NULL, '7432147626684', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(930, NULL, NULL, '7432147626691', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(931, NULL, NULL, '7432147726704', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(932, NULL, NULL, '7432147726711', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(933, NULL, NULL, '7432147726728', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(934, NULL, NULL, '7432147726735', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(935, NULL, NULL, '7432147726742', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(936, NULL, NULL, '7432147726759', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(937, NULL, NULL, '7432147726766', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(938, NULL, NULL, '7432147726773', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(939, NULL, NULL, '7432147726780', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(940, NULL, NULL, '7432147726797', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(941, NULL, NULL, '7432147826800', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(942, NULL, NULL, '7432147826817', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(943, NULL, NULL, '7432147826824', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(944, NULL, NULL, '7432147826831', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(945, NULL, NULL, '7432147826848', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(946, NULL, NULL, '7432147826855', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(947, NULL, NULL, '7432147826862', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(948, NULL, NULL, '7432147826879', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(949, NULL, NULL, '7432147826886', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(950, NULL, NULL, '7432147826893', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(951, NULL, NULL, '7432147926906', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(952, NULL, NULL, '7432147926913', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(953, NULL, NULL, '7432147926920', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(954, NULL, NULL, '7432147926937', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(955, NULL, NULL, '7432147926944', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(956, NULL, NULL, '7432147926951', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(957, NULL, NULL, '7432147926968', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(958, NULL, NULL, '7432147926975', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(959, NULL, NULL, '7432147926982', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(960, NULL, NULL, '7432147926999', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(961, NULL, NULL, '7432147027009', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(962, NULL, NULL, '7432147027016', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(963, NULL, NULL, '7432147027023', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(964, NULL, NULL, '7432147027030', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(965, NULL, NULL, '7432147027047', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(966, NULL, NULL, '7432147027054', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(967, NULL, NULL, '7432147027061', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(968, NULL, NULL, '7432147027078', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(969, NULL, NULL, '7432147027085', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(970, NULL, NULL, '7432147027092', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(971, NULL, NULL, '7432147127105', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(972, NULL, NULL, '7432147127112', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(973, NULL, NULL, '7432147127129', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(974, NULL, NULL, '7432147127136', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(975, NULL, NULL, '7432147127143', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(976, NULL, NULL, '7432147127150', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(977, NULL, NULL, '7432147127167', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(978, NULL, NULL, '7432147127174', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(979, NULL, NULL, '7432147127181', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(980, NULL, NULL, '7432147127198', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(981, NULL, NULL, '7432147227201', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(982, NULL, NULL, '7432147227218', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(983, NULL, NULL, '7432147227225', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(984, NULL, NULL, '7432147227232', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(985, NULL, NULL, '7432147227249', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(986, NULL, NULL, '7432147227256', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(987, NULL, NULL, '7432147227263', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(988, NULL, NULL, '7432147227270', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(989, NULL, NULL, '7432147227287', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(990, NULL, NULL, '7432147227294', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(991, NULL, NULL, '7432147327307', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(992, NULL, NULL, '7432147327314', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(993, NULL, NULL, '7432147327321', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(994, NULL, NULL, '7432147327338', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(995, NULL, NULL, '7432147327345', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(996, NULL, NULL, '7432147327352', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(997, NULL, NULL, '7432147327369', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(998, NULL, NULL, '7432147327376', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(999, NULL, NULL, '7432147327383', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(1000, NULL, NULL, '7432147327390', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplidor`
--

CREATE TABLE `suplidor` (
  `id` int(11) NOT NULL,
  `codigo_suplidor` varchar(50) DEFAULT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `rnc` varchar(30) DEFAULT NULL,
  `tipo_suplidor` varchar(50) NOT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `provincia` varchar(100) DEFAULT NULL,
  `pais` varchar(255) DEFAULT NULL,
  `sitios_cercanos` varchar(255) DEFAULT NULL,
  `contacto_suplidor` varchar(100) DEFAULT NULL,
  `telefono_1` varchar(45) DEFAULT NULL,
  `telefono_2` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `terminos_de_pago` varchar(100) DEFAULT NULL,
  `nota` longtext DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `suplidor`
--

INSERT INTO `suplidor` (`id`, `codigo_suplidor`, `nombre`, `rnc`, `tipo_suplidor`, `calle`, `sector`, `provincia`, `pais`, `sitios_cercanos`, `contacto_suplidor`, `telefono_1`, `telefono_2`, `celular`, `email`, `terminos_de_pago`, `nota`, `updated_at`, `created_at`) VALUES
(5, NULL, 'Textiles Agua Azul SRL', '130664897', 'Material', 'bohechio #33', 'ensanche quizqueya', 'Santo Domingo', 'República Dominicana', NULL, 'Luis Fernandez', '(809) 682-7284', NULL, '(809) 481-4881', 'lfernandez@taa.com.do', '90 dias', NULL, '2020-01-28 16:43:41', '2020-01-23 13:56:11'),
(6, NULL, 'Artistic Fabric & Garment Industries LTD', '0102012011', 'Material', 'Deh Landhi,', 'Bn Qasim Twon', 'No pertenece al pais', 'Paquistán', 'Karachi', 'Arslan Bati', '(921) 350-2517', NULL, NULL, 'denimculture@artisticgabricmills.com', '120 dias', 'Suplidor Internacional', '2020-01-28 16:43:09', '2020-01-23 14:29:16'),
(7, 'IS200H', 'Industria del Yaque SRL', '102013195', 'Lavanderia', 'ave. circunvalacion #417', 'santiago', 'Santiago', 'República Dominicana', NULL, 'Doris', '(809) 241-5646', NULL, '(829) 904-6602', 'indusriadelyaque@gmail.com', '60 dias', NULL, '2020-03-16 17:07:18', '2020-01-23 16:46:12'),
(8, NULL, 'Vicunha Textil', '10000122212', 'Material', 'primera', 'madre vieja sur', 'San Cristóbal', 'República Dominicana', NULL, 'Ozema Faxas', '(809) 2882-113_', '(809) 9436-6531', NULL, 'vicunha@vicunha.com', '60 dias', NULL, '2020-02-11 15:22:08', '2020-02-11 15:22:08'),
(9, 'Tx100', 'MOLINO FABRICATO', '1012052023', 'Material', 'Leger', 'San cristobal', 'San Cristóbal', 'República Dominicana', 'Cachicha', 'Fulano', '(809) 288-2113', '(829) 943-6531', NULL, 'molino@molino.com', '60 dias', 'Nothin', '2020-03-17 16:37:10', '2020-03-17 16:37:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id` int(11) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tallas`
--

INSERT INTO `tallas` (`id`, `corte_id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `updated_at`, `created_at`) VALUES
(52, 53, 105, 0, 0, 50, 60, 60, 60, 60, 50, 0, 0, 0, 0, 340, '2020-03-05 09:44:00', '2020-03-05 09:44:00'),
(54, 55, 104, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-05 15:22:32', '2020-03-05 15:22:32'),
(55, 56, 105, 0, 0, 50, 60, 60, 60, 60, 50, 0, 0, 0, 0, 340, '2020-03-06 11:10:16', '2020-03-06 11:10:16'),
(56, 57, 104, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-06 13:37:43', '2020-03-06 13:37:43'),
(57, 58, 105, 0, 0, 60, 80, 80, 80, 80, 60, 0, 0, 0, 0, 440, '2020-03-09 10:45:15', '2020-03-09 10:45:15'),
(58, 59, 104, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-09 13:53:43', '2020-03-09 13:53:43'),
(59, 60, 105, 0, 0, 60, 80, 80, 80, 80, 60, 0, 0, 0, 0, 440, '2020-03-09 15:19:51', '2020-03-09 15:19:51'),
(62, 63, 110, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-10 08:26:33', '2020-03-10 08:26:33'),
(63, 64, 112, 50, 60, 50, 60, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-10 08:54:06', '2020-03-10 08:54:06'),
(64, 65, 105, 0, 0, 60, 80, 80, 80, 80, 60, 0, 0, 0, 0, 440, '2020-03-11 14:54:25', '2020-03-11 14:54:25'),
(65, 66, 104, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-12 08:40:58', '2020-03-12 08:40:58'),
(66, 67, 114, 100, 100, 100, 100, 50, 50, 50, 50, 0, 0, 0, 0, 600, '2020-03-17 17:00:39', '2020-03-17 17:00:39'),
(67, 68, 110, 50, 60, 60, 50, 50, 60, 60, 50, 0, 0, 0, 0, 440, '2020-03-27 09:52:51', '2020-03-27 09:52:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas_perdidas`
--

CREATE TABLE `tallas_perdidas` (
  `id` int(11) NOT NULL,
  `perdida_id` int(11) NOT NULL,
  `a` int(11) DEFAULT NULL,
  `b` int(11) DEFAULT NULL,
  `c` int(11) DEFAULT NULL,
  `d` int(11) DEFAULT NULL,
  `e` int(11) DEFAULT NULL,
  `f` int(11) DEFAULT NULL,
  `g` int(11) DEFAULT NULL,
  `h` int(11) DEFAULT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `talla_x` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela`
--

CREATE TABLE `tela` (
  `id` int(11) NOT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `id_composiciones` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `precio_usd` decimal(15,2) DEFAULT NULL,
  `composicion` varchar(100) DEFAULT NULL,
  `composicion_2` varchar(100) DEFAULT NULL,
  `composicion_3` varchar(100) DEFAULT NULL,
  `composicion_4` varchar(100) DEFAULT NULL,
  `composicion_5` varchar(100) DEFAULT NULL,
  `tipo_tela` varchar(45) DEFAULT NULL,
  `ancho_cortable` decimal(4,2) DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `elasticidad_trama` decimal(4,2) DEFAULT NULL,
  `elasticidad_urdimbre` decimal(4,2) DEFAULT NULL,
  `encogimiento_trama` decimal(4,2) DEFAULT NULL,
  `encogimiento_urdimbre` decimal(4,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tela`
--

INSERT INTO `tela` (`id`, `id_suplidor`, `id_composiciones`, `user_id`, `referencia`, `precio_usd`, `composicion`, `composicion_2`, `composicion_3`, `composicion_4`, `composicion_5`, `tipo_tela`, `ancho_cortable`, `peso`, `elasticidad_trama`, `elasticidad_urdimbre`, `encogimiento_trama`, `encogimiento_urdimbre`, `updated_at`, `created_at`) VALUES
(2, 5, 1, 1, 'test3', '3.55', 'Algodon-70.00', 'Elastano-15.00', '5-05.00', '3-10.00', '', 'Denim', '50.00', 30, '60.00', '65.55', '52.00', '51.00', '2020-01-28 17:41:13', '2020-01-23 13:59:41'),
(3, 6, 1, 1, 'A4-13488', '2.70', 'Algodon-82.00', 'Poliester-16.00', '2-02.00', '', '', 'Denim', '44.00', 8.5, '56.00', '0.00', '0.00', '0.00', '2020-01-29 09:07:08', '2020-01-23 14:41:17'),
(8, 8, 1, 1, 'Gisele Dark Power', '3.30', 'Algodon-90', 'T-400-8_', 'Elastano-2_', '', '', 'Denim', '53.00', 9.2, '60.00', '0.00', '13.00', '4.00', '2020-02-11 16:21:42', '2020-02-11 16:21:42'),
(9, 8, 1, 1, 'A4-13488', '3.50', 'Algodon-90', 'Elastano-8_', 'T-400-2_', '', '', 'Denim', '20.00', 20, '30.00', '10.00', '50.00', '50.00', '2020-02-19 15:23:51', '2020-02-19 15:23:51'),
(10, 8, 1, 1, 'MARINA DARK POWER II', '3.40', 'Algodon-98', 'Elastano-2_', '', '', '', 'Denim', '56.00', 10.2, '36.00', '0.00', '90.00', '20.00', '2020-02-25 10:58:04', '2020-02-25 10:53:32'),
(12, 8, 1, 1, 'MARINA BLACK BLACK II', '3.60', 'Algodon-98', 'Elastano-2_', '', '', '', 'Denim', '56.00', 10, '20.00', '0.00', '-5.00', '-2.00', '2020-03-04 14:38:14', '2020-03-04 14:38:14'),
(13, 9, 1, 1, 'PUTUMAYO', '3.44', 'Algodon-100', '', '', '', '', 'Denim', '20.00', 20, '30.00', '80.00', '99.00', '0.00', '2020-03-17 16:40:09', '2020-03-17 16:40:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `permiso_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `edad` varchar(45) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `permiso_id`, `name`, `surname`, `email`, `password`, `role`, `telefono`, `celular`, `direccion`, `edad`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Anel', 'Dominguez', 'anel@anel.com', '$2y$10$PHttFrCrA/UNjmsHTamiLuUGU8Z.cMI42HHW1sx0PTB0MuwAXreg2', 'Administrador', '(809) 288-2113', '(829) 943-6531', 'c/ primera #4, Madre vieja, SC', '23', '15821274111575388275_145305_1575388338_noticia_normal.jpg', 'XyGbnMhu74RtuvElHqjaUOQep8HSPDtUsZG46sEniqFYZ4Q48NsOwppH9bnT', '2019-12-24 09:37:56', '2020-02-19 11:50:13'),
(6, 0, 'UserOfi', 'Oficina', 'oficina@cch.com', '$2y$10$XGYgd8v6yownWZua53lNae5wmUtFG40PXFbyjVkITMua6LjMKMAKa', 'Oficina', '(809) 288-2113', '(809) 211-2022', 'c/ sanchez vieja', '20', '15821269392589018171f934247c228119079fbc4b.jpg', NULL, '2020-01-29 11:32:33', '2020-02-19 11:42:21'),
(8, NULL, 'Juan', 'Jose', 'juan@juan.com', '$2y$10$HO.UJZcmRJAkBIJNweb90OE.jXeH0KGyJVc.TerihkD.mwxzrJDzG', 'Oficina', '(809) 288-2113', '(829) 943-6531', 'c/ primera', '20', NULL, NULL, '2020-02-11 08:58:44', '2020-02-11 08:58:44'),
(12, NULL, 'Gabriel', 'Garcia', 'gabriel@cch.com', '$2y$10$Mrztnn8BTrGwN6v3aEsWXeQjNChm7nJDELGU4boWeXQgo6ASWU9cS', 'General', '(809) 288-2113', '(829) 943-6531', 'c/ trina de moya', '23', '1583777072P5R-artt.jpg', NULL, '2020-02-19 14:55:18', '2020-03-09 14:04:33');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `corte_id` (`corte_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `almacen_detalle`
--
ALTER TABLE `almacen_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `catalogo_cuenta`
--
ALTER TABLE `catalogo_cuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cliente_sucursales_idx` (`cliente_id`);

--
-- Indices de la tabla `composiciones`
--
ALTER TABLE `composiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `producto_id_ref_2` (`producto_id_ref_2`);

--
-- Indices de la tabla `curva_producto`
--
ALTER TABLE `curva_producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado_detalle`
--
ALTER TABLE `empleado_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empleado_id` (`empleado_id`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_factura_id` (`orden_facturacion_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `sucursal_id` (`sucursal_id`);

--
-- Indices de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corte_id` (`corte_id`),
  ADD KEY `suplidor_id` (`suplidor_id`),
  ADD KEY `id_sku` (`id_sku`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `nota_credito_detalle`
--
ALTER TABLE `nota_credito_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nota_credito_id` (`nota_credito_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_pedido_id` (`orden_pedido_id`);

--
-- Indices de la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orden_empaque_id` (`orden_empaque_id`);

--
-- Indices de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orden_facturacion_id` (`orden_facturacion_id`);

--
-- Indices de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `sucursal_id` (`sucursal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_aprobacion` (`user_aprobacion`),
  ADD KEY `vendedor_id` (`vendedor_id`);

--
-- Indices de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corte_id` (`corte_id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `talla_id` (`talla_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_catalogo` (`id_catalogo`);

--
-- Indices de la tabla `producto_articulo`
--
ALTER TABLE `producto_articulo`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indices de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_lavanderia` (`id_lavanderia`),
  ADD KEY `corte_id` (`corte_id`);

--
-- Indices de la tabla `rollos`
--
ALTER TABLE `rollos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_suplidor_rollos_idx` (`id_suplidor`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_tela` (`id_tela`);

--
-- Indices de la tabla `sku`
--
ALTER TABLE `sku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `suplidor`
--
ALTER TABLE `suplidor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corte_id` (`corte_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perdidas_id` (`perdida_id`);

--
-- Indices de la tabla `tela`
--
ALTER TABLE `tela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_composition_tela_idx` (`id_composiciones`),
  ADD KEY `fk_user_tela_idx` (`user_id`),
  ADD KEY `fk_suply_tela_idx` (`id_suplidor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permiso_id` (`permiso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `almacen_detalle`
--
ALTER TABLE `almacen_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de la tabla `catalogo_cuenta`
--
ALTER TABLE `catalogo_cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `composiciones`
--
ALTER TABLE `composiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `curva_producto`
--
ALTER TABLE `curva_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empleado_detalle`
--
ALTER TABLE `empleado_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de la tabla `nota_credito_detalle`
--
ALTER TABLE `nota_credito_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT de la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=647;

--
-- AUTO_INCREMENT de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=355;

--
-- AUTO_INCREMENT de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT de la tabla `producto_articulo`
--
ALTER TABLE `producto_articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `sku`
--
ALTER TABLE `sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `suplidor`
--
ALTER TABLE `suplidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `almacen_ibfk_2` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `almacen_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `almacen_detalle`
--
ALTER TABLE `almacen_detalle`
  ADD CONSTRAINT `almacen_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  ADD CONSTRAINT `fk_cliente_sucursales` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `corte`
--
ALTER TABLE `corte`
  ADD CONSTRAINT `corte_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `corte_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `corte_ibfk_3` FOREIGN KEY (`producto_id_ref_2`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `curva_producto`
--
ALTER TABLE `curva_producto`
  ADD CONSTRAINT `curva_producto_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `empleado_detalle`
--
ALTER TABLE `empleado_detalle`
  ADD CONSTRAINT `empleado_detalle_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_4` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`orden_facturacion_id`) REFERENCES `orden_facturacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`sucursal_id`) REFERENCES `cliente_sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura_detalle`
--
ALTER TABLE `factura_detalle`
  ADD CONSTRAINT `factura_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto_articulo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  ADD CONSTRAINT `lavanderia_ibfk_1` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_2` FOREIGN KEY (`suplidor_id`) REFERENCES `suplidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_4` FOREIGN KEY (`id_sku`) REFERENCES `sku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  ADD CONSTRAINT `nota_credito_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `factura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_credito_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_credito_ibfk_3` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nota_credito_detalle`
--
ALTER TABLE `nota_credito_detalle`
  ADD CONSTRAINT `nota_credito_detalle_ibfk_1` FOREIGN KEY (`nota_credito_id`) REFERENCES `nota_credito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nota_credito_detalle_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  ADD CONSTRAINT `orden_empaque_ibfk_1` FOREIGN KEY (`orden_pedido_id`) REFERENCES `orden_pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  ADD CONSTRAINT `orden_empaque_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  ADD CONSTRAINT `orden_facturacion_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_facturacion_ibfk_2` FOREIGN KEY (`orden_empaque_id`) REFERENCES `orden_empaque` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD CONSTRAINT `orden_pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_pedido_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `cliente_sucursales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_pedido_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_pedido_ibfk_4` FOREIGN KEY (`user_aprobacion`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orden_pedido_ibfk_5` FOREIGN KEY (`vendedor_id`) REFERENCES `empleado` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  ADD CONSTRAINT `orden_pedido_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `perdidas`
--
ALTER TABLE `perdidas`
  ADD CONSTRAINT `perdidas_ibfk_1` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perdidas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perdidas_ibfk_3` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perdidas_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  ADD CONSTRAINT `permiso_usuario_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `recepcion`
--
ALTER TABLE `recepcion`
  ADD CONSTRAINT `recepcion_ibfk_1` FOREIGN KEY (`id_lavanderia`) REFERENCES `lavanderia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recepcion_ibfk_2` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rollos`
--
ALTER TABLE `rollos`
  ADD CONSTRAINT `fk_suplidor_rollos` FOREIGN KEY (`id_suplidor`) REFERENCES `suplidor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rollos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rollos_ibfk_2` FOREIGN KEY (`id_tela`) REFERENCES `tela` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sku`
--
ALTER TABLE `sku`
  ADD CONSTRAINT `sku_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tallas`
--
ALTER TABLE `tallas`
  ADD CONSTRAINT `tallas_ibfk_1` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tallas_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION;

--
-- Filtros para la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  ADD CONSTRAINT `tallas_perdidas_ibfk_1` FOREIGN KEY (`perdida_id`) REFERENCES `perdidas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tela`
--
ALTER TABLE `tela`
  ADD CONSTRAINT `fk_composition_tela` FOREIGN KEY (`id_composiciones`) REFERENCES `composiciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_suply_tela` FOREIGN KEY (`id_suplidor`) REFERENCES `suplidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_tela` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
