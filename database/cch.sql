-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2019 a las 16:54:50
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
  `a` int(11) NOT NULL,
  `b` int(11) NOT NULL,
  `c` int(11) NOT NULL,
  `d` int(11) NOT NULL,
  `e` int(11) NOT NULL,
  `f` int(11) NOT NULL,
  `g` int(11) NOT NULL,
  `h` int(11) NOT NULL,
  `i` int(11) DEFAULT NULL,
  `j` int(11) DEFAULT NULL,
  `k` int(11) DEFAULT NULL,
  `l` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `usado_curva` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id`, `corte_id`, `producto_id`, `user_id`, `codigo_almacen`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `usado_curva`, `updated_at`, `created_at`) VALUES
(2, 2, 11, 1, NULL, 50, 50, 50, 50, 50, 50, 50, 50, 40, 40, NULL, NULL, 480, 1, '2019-11-27 11:11:39', '2019-11-05 20:10:42'),
(4, 6, 10, 1, NULL, 25, 25, 25, 25, 25, 25, 25, 25, 25, 50, NULL, NULL, 275, 1, '2019-11-06 15:10:04', '2019-11-06 14:49:08'),
(6, 10, 58, 1, NULL, 50, 50, 50, 50, 50, 50, 50, 50, 25, 25, NULL, NULL, 450, 0, '2019-11-06 15:21:46', '2019-11-06 15:21:46'),
(7, 7, 10, 1, NULL, 25, 25, 30, 40, 56, 58, 50, 50, 25, 30, NULL, NULL, 389, 1, '2019-11-06 20:17:53', '2019-11-06 20:17:53'),
(8, 8, 10, 1, NULL, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, NULL, NULL, 300, 1, '2019-11-27 09:42:12', '2019-11-06 20:45:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `direccion_principal` varchar(255) DEFAULT NULL,
  `rnc` int(11) DEFAULT NULL,
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

INSERT INTO `cliente` (`id`, `nombre_cliente`, `direccion_principal`, `rnc`, `contacto_cliente_principal`, `telefono_1`, `telefono_2`, `telefono_3`, `celular_principal`, `email_principal`, `condiciones_credito`, `autorizacion_credito_req`, `notas`, `redistribucion_tallas`, `factura_desglosada_talla`, `acepta_segundas`, `updated_at`, `created_at`) VALUES
(3, 'La Sirena', 'c/ principal', 528656544, 'Fulano', '(809) 882-1113', '(809) 525-2516', '(984) 095-5656', '(809) 599-9898', 'anel@anel.com', '30 dias', 1, 'Notas de prueba', 1, 1, 1, '2019-10-17 18:03:33', '2019-10-04 15:29:18'),
(4, 'Plaza Lama', 'c/ Av 27 de febrero con Churchill', 362655452, 'Gabriel Dominguez', '(809) 288-2113', '(829) 943-6531', '(849) 520-6969', '(829) 943-6531', 'plazalama@lama.com', '60 dias', 1, 'test', 1, 1, 1, '2019-10-17 18:03:44', '2019-10-10 15:03:46'),
(5, 'Antonys', 'c/ principal Santo Domingo, Dn', 2656565, 'Teresa', '(809) 288-2113', '(829) 528-4255', '(849) 566-2222', '(809) 633-2555', 'anel@anel.com', '90 dias', 1, 'Antonys cliente de prueba', 0, 1, 1, '2019-10-17 18:03:54', '2019-10-15 14:00:19'),
(6, 'Ole', 'c\\ principal, Santo Domingo, Republicad Dominicana', 25826565, 'Leandro', '(809) 528-2113', '(809) 528-6362', '(809) 955-5556', '(829) 943-6531', 'ole@ole.com', '30 dias', 1, 'Nota de prueba', 1, 1, 0, '2019-10-17 17:40:51', '2019-10-17 17:40:51');

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
  `direccion` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_sucursales`
--

INSERT INTO `cliente_sucursales` (`id`, `cliente_id`, `codigo_sucursal`, `nombre_sucursal`, `telefono_sucursal`, `direccion`, `updated_at`, `created_at`) VALUES
(1, 3, '3-48', 'La Sirena San Cristobal', '(809) 528-6633', 'c/ sanchez vieja, San Cristobal', '2019-10-07 18:24:38', '2019-10-07 15:29:56'),
(3, 3, '3-40', 'La sire av. luperon', '(809) 528-6356', 'av luperon con independencia', '2019-10-09 12:42:55', '2019-10-09 12:42:55'),
(4, 4, '4-71', 'Plaza lama Luperon', '(809) 528-2113', 'c/ nose', '2019-10-11 20:04:51', '2019-10-11 20:04:51'),
(5, 5, '5-94', 'Antonys  Agora Mall', '(809) 288-2113', 'esquina Tiradentes con Roberto Pastoriza', '2019-10-15 14:11:38', '2019-10-15 14:11:38'),
(7, NULL, NULL, 'Principal', NULL, NULL, '2019-11-21 10:27:23', '2019-11-21 06:27:24');

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
(1, '1', 'Algodon', '2019-10-02 17:39:36', '2019-10-02 14:59:22'),
(2, '2', 'Poliestemo', '2019-10-02 15:27:04', '2019-10-02 15:27:04'),
(5, NULL, 'Nilon', '2019-10-10 14:42:52', '2019-10-10 14:42:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `id` int(11) NOT NULL,
  `numero_corte` varchar(20) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha_corte` date DEFAULT NULL,
  `no_marcada` varchar(45) DEFAULT NULL,
  `ancho_marcada` int(11) DEFAULT NULL,
  `largo_marcada` varchar(45) DEFAULT NULL,
  `aprovechamiento` decimal(4,2) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fase` varchar(100) DEFAULT NULL,
  `total` int(10) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`id`, `numero_corte`, `producto_id`, `user_id`, `fecha_corte`, `no_marcada`, `ancho_marcada`, `largo_marcada`, `aprovechamiento`, `fecha_entrega`, `fase`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(2, '2019-002', 11, 1, '2019-10-16', '20', 30, '40', '60.00', NULL, 'Almacen', 240, '0.02', '2019-11-05 20:05:48', '2019-10-21 19:53:16'),
(3, '2019-003', 19, 1, '2019-10-17', '10', 10, '10', '50.00', NULL, 'Almacen', 600, '0.03', '2019-11-06 13:41:25', '2019-10-21 20:00:18'),
(6, '2019-006', 10, 1, '2019-10-23', '30', 80, '40', '80.00', NULL, 'Almacen', 360, '0.06', '2019-11-06 14:49:08', '2019-10-21 20:13:09'),
(7, '2019-007', 10, 1, '2019-10-21', '50', 60, '30', '90.00', NULL, 'Almacen', 444, '0.07', '2019-11-06 20:17:53', '2019-10-21 20:15:38'),
(8, '2019-008', 10, 1, '2019-10-18', '20', 30, '30', '60.00', NULL, 'Almacen', 600, '0.08', '2019-11-06 20:45:56', '2019-10-21 20:23:56'),
(9, '2019-009', 51, 1, '2019-10-24', '50', 30, '20', '70.00', NULL, 'Lavanderia', 520, '0.09', '2019-10-28 17:12:25', '2019-10-24 17:58:01'),
(10, '2019-010', 58, 1, '2019-01-09', '50', 50, '50', '60.00', NULL, 'Almacen', 58, '0.10', '2019-11-06 15:21:46', '2019-10-29 17:25:28'),
(11, '2019-011', 57, 1, '2019-10-11', '50', 50, '50', '55.00', NULL, 'Produccion', 540, '0.11', '2019-10-29 17:30:41', '2019-10-29 17:30:40'),
(12, '2019-012', 56, 1, '2019-10-17', '50', 50, '50', '60.00', NULL, 'Lavanderia', 120, '0.12', '2019-11-06 17:08:58', '2019-10-29 17:32:56'),
(13, '2019-013', 56, 1, '2019-10-29', '50', 50, '50', '30.00', NULL, 'Lavanderia', 240, '0.13', '2019-11-01 13:13:09', '2019-10-29 17:43:35'),
(14, '2019-014', 11, 1, '2019-11-12', '50', 50, '50', '65.55', '2019-12-14', 'Produccion', 500, '0.14', '2019-11-12 17:50:32', '2019-11-12 17:50:32'),
(15, '2019-015', 10, 1, '2019-11-14', '5', 30, '20', '70.00', '2019-12-14', 'Produccion', 0, '0.15', '2019-11-14 18:50:50', '2019-11-14 18:50:50'),
(16, '2019-016', 5, 1, '2019-11-20', '20', 20, '20', '60.00', '2019-12-28', 'Produccion', 35, '0.01', '2019-11-20 15:55:29', '2019-11-20 15:55:28');

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

--
-- Volcado de datos para la tabla `existencias`
--

INSERT INTO `existencias` (`id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `updated_at`, `created_at`) VALUES
(1, 10, 117, 118, 116, 120, 76, 113, 118, 118, 118, 116, 118, 118, 1366, '2019-11-11 17:28:41', '2019-11-11 17:28:41'),
(2, 10, 117, 118, 116, 120, 76, 113, 118, 118, 118, 116, 118, 118, 1366, '2019-11-11 17:30:00', '2019-11-11 17:30:00'),
(3, 10, 117, 118, 116, 120, 76, 113, 118, 118, 118, 116, 118, 118, 1366, '2019-11-11 17:31:23', '2019-11-11 17:31:23'),
(4, 10, 117, 118, 116, 120, 76, 113, 118, 118, 118, 116, 118, 118, 1366, '2019-11-11 20:07:47', '2019-11-11 20:07:47'),
(5, 11, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 240, '2019-11-11 20:08:54', '2019-11-11 20:08:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lavanderia`
--

CREATE TABLE `lavanderia` (
  `id` int(11) NOT NULL,
  `numero_envio` varchar(20) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `suplidor_id` int(11) DEFAULT NULL,
  `id_sku` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `fecha_envio` date NOT NULL,
  `receta_lavado` text NOT NULL,
  `cantidad` int(20) NOT NULL,
  `cantidad_parcial` int(20) NOT NULL,
  `total_enviado` int(20) NOT NULL,
  `estandar_incluido` tinyint(1) NOT NULL,
  `enviado` tinyint(1) DEFAULT NULL,
  `recibido` tinyint(1) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lavanderia`
--

INSERT INTO `lavanderia` (`id`, `numero_envio`, `corte_id`, `suplidor_id`, `id_sku`, `producto_id`, `fecha_envio`, `receta_lavado`, `cantidad`, `cantidad_parcial`, `total_enviado`, `estandar_incluido`, `enviado`, `recibido`, `sec`, `updated_at`, `created_at`) VALUES
(1, 'EL-001', 2, 5, 26, 46, '2019-10-11', 'Descripcion actualizada test de espacio para ver si se ajusta correctamente a la hora de impirmir este conduce de envio, probando espacios de impresion ahora mismo test test test test tets tets tets ttest tetst tetst', 300, 0, 0, 1, 0, 0, '0.01', '2019-10-28 19:45:06', '2019-10-23 19:20:18'),
(2, 'EL-002', 9, 5, 31, 51, '2019-10-17', 'Receta de lavado larga para probar el invoice como sale ajhsjhdjjjjjjjjjjjjjjjjjjjjjjjjjfffffffffffkjfkljlkjlfjlkjfljflfjljlkfjlfja;ldakd;lakdpoadkpodpowdpwedpwdwpdpwdwpdwdwdw', 350, 0, 0, 1, 0, 0, '0.02', '2019-10-24 17:59:40', '2019-10-24 17:59:40'),
(3, 'EL-003', 2, 5, 31, 51, '2019-10-23', 'Receta de lavado de prueba aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 500, 0, 0, 1, 0, 0, '0.03', '2019-10-24 18:26:35', '2019-10-24 18:26:35'),
(5, 'EL-004', 6, 5, 38, 52, '2019-10-23', 'Receta de lavado', 500, 0, 0, 1, 1, 1, '0.04', '2019-10-25 20:29:51', '2019-10-24 20:21:41'),
(6, 'EL-005', 6, 5, 47, 55, '2019-10-17', 'receta', 500, 0, 0, 1, 1, 1, '0.05', '2019-10-28 15:45:07', '2019-10-24 20:35:43'),
(7, 'EL-006', 7, 5, 57, 57, '2019-10-23', 'des', 500, 0, 0, 0, 0, 0, '0.06', '2019-10-24 21:17:29', '2019-10-24 21:17:29'),
(8, 'EL-007', 2, 5, 26, 4, '2019-10-24', 'Receta de lavado a 500 pantalones', 500, 0, 0, 1, NULL, 0, '0.07', '2019-10-25 17:22:02', '2019-10-25 17:22:02'),
(9, 'EL-008', 3, 5, 26, 4, '2019-10-24', 'Receta de lavado estandar de acuerdo al estandar de lavado', 500, 0, 0, 1, NULL, 0, '0.08', '2019-10-25 17:24:44', '2019-10-25 17:24:44'),
(10, 'EL-009', 6, 5, 57, 57, '2019-10-24', 'Receta de lavado enviada', 300, 0, 0, 1, NULL, 0, '0.09', '2019-10-25 17:30:53', '2019-10-25 17:30:53'),
(11, 'EL-010', 8, 5, 26, 46, '2019-10-24', 'Receta de lavado de prueba', 500, 0, 0, 1, NULL, 0, '0.10', '2019-10-25 17:32:43', '2019-10-25 17:32:43'),
(12, 'EL-011', 9, 5, 58, 58, '2019-10-25', 'Receta de lavado estandar', 600, 0, 0, 1, 1, 1, '0.11', '2019-10-29 14:25:55', '2019-10-28 17:12:25'),
(13, 'EL-012', 9, 5, 47, 55, '2019-10-25', 'Receta de lavado', 170, 170, 0, 1, 1, 0, '0.12', '2019-10-31 19:12:42', '2019-10-31 19:12:42'),
(14, 'EL-013', 9, 5, 31, 51, '2019-10-31', 'descipcion de', 350, 170, 0, 1, 1, 0, '0.13', '2019-10-31 19:25:34', '2019-10-31 19:25:34'),
(15, 'EL-014', 9, 5, 31, 51, '2019-10-30', 'Receta de lavado', 340, 180, 0, 1, 1, 0, '0.14', '2019-10-31 20:02:53', '2019-10-31 20:02:53'),
(27, 'EL-015', 10, 5, 31, 51, '2019-10-31', 'receta de lavado estandar', 18, 40, 40, 1, 1, 0, '0.15', '2019-10-31 21:37:50', '2019-10-31 21:37:50'),
(30, 'EL-016', 10, 5, 31, 51, '2019-10-31', 'receta de lavado estandar', 46, 12, 52, 1, 1, 0, '0.16', '2019-10-31 21:53:57', '2019-10-31 21:53:57'),
(31, 'EL-017', 10, NULL, 31, 51, '2019-10-31', 'receta de lavado estandar', 56, 2, 54, 1, 1, 0, '0.17', '2019-10-31 21:54:44', '2019-10-31 21:54:44'),
(32, 'EL-018', 10, 5, 31, 51, '2019-11-07', 'receta de lavado enviado', 56, 2, 56, 1, 1, 1, '0.18', '2019-11-01 17:20:44', '2019-11-01 12:32:46'),
(33, 'EL-019', 13, 5, 57, 57, '2019-11-01', 'receta de lavado', 140, 100, 100, 1, 1, 0, '0.19', '2019-11-01 13:07:41', '2019-11-01 13:07:41'),
(34, 'EL-020', 13, 5, 57, 57, '2019-11-02', 'receta de lavado', 140, 100, 200, 1, 1, 0, '0.20', '2019-11-01 13:08:29', '2019-11-01 13:08:29'),
(35, 'EL-021', 13, NULL, 57, 57, '2019-11-01', 'receta de lavado estandar', 220, 20, 220, 1, 1, 0, '0.21', '2019-11-01 13:11:22', '2019-11-01 13:11:22'),
(36, 'EL-022', 13, NULL, 57, 57, '2019-11-01', 'Receta de lavado estandar', 230, 10, 230, 1, 1, 0, '0.22', '2019-11-01 13:13:09', '2019-11-01 13:13:09'),
(37, 'EL-023', 12, 5, 69, 56, '2019-11-06', 'Receta estandar', 60, 60, 60, 1, 1, 0, '0.23', '2019-11-06 15:47:54', '2019-11-06 15:47:54'),
(38, 'EL-024', 12, 5, 69, 56, '2019-11-07', 'Segundo envio 20 restan 40 de 120', 100, 20, 80, 1, 1, 0, '0.24', '2019-11-06 15:58:00', '2019-11-06 15:58:00'),
(39, 'EL-025', 12, 5, 69, 56, '2019-11-14', 'Enviados 20 de 40 sin enviar de 120', 100, 20, 100, 1, 1, 0, '0.25', '2019-11-06 17:01:54', '2019-11-06 17:01:54'),
(40, 'EL-026', 12, 5, 69, 56, '2019-11-06', 'Receta de lavado estandar', 103, 17, 117, 1, 1, 0, '0.26', '2019-11-06 17:08:13', '2019-11-06 17:08:13'),
(41, 'EL-027', 12, 5, 69, 56, '2019-11-06', 'Cambio de fase', 118, 2, 119, 1, 1, 0, '0.27', '2019-11-06 17:08:58', '2019-11-06 17:08:58');

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
  `empacado` tinyint(1) DEFAULT NULL,
  `fecha_empacado` datetime DEFAULT NULL,
  `cant_bultos` int(11) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_empaque`
--

INSERT INTO `orden_empaque` (`id`, `orden_pedido_id`, `no_orden_empaque`, `fecha`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `cantidad`, `total`, `empacado`, `fecha_empacado`, `cant_bultos`, `sec`, `updated_at`, `created_at`) VALUES
(2, 1, 'OE - 001', '2019-11-29 04:35:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.01', '2019-11-29 16:35:25', '2019-11-29 16:35:25');

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
  `no_orden_pedido` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_entrega` date NOT NULL,
  `notas` text NOT NULL,
  `generado_internamente` tinyint(1) NOT NULL,
  `estado_aprobacion` tinyint(1) DEFAULT NULL,
  `fecha_aprobacion` datetime DEFAULT NULL,
  `status_orden_pedido` varchar(30) DEFAULT NULL,
  `precio` decimal(4,3) DEFAULT NULL,
  `detallada` tinyint(1) NOT NULL,
  `corte_en_proceso` varchar(5) DEFAULT NULL,
  `orden_proceso_impresa` varchar(5) DEFAULT NULL,
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido`
--

INSERT INTO `orden_pedido` (`id`, `user_id`, `user_aprobacion`, `cliente_id`, `sucursal_id`, `no_orden_pedido`, `fecha`, `fecha_entrega`, `notas`, `generado_internamente`, `estado_aprobacion`, `fecha_aprobacion`, `status_orden_pedido`, `precio`, `detallada`, `corte_en_proceso`, `orden_proceso_impresa`, `sec`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 4, 4, 'OP-001', '2019-11-29 04:34:20', '2019-11-28', 'test', 0, NULL, '2019-12-02 10:58:33', 'Vigente', NULL, 1, 'No', 'Si', '0.01', '2019-12-02 10:58:33', '2019-11-29 16:34:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_pedido_detalle`
--

CREATE TABLE `orden_pedido_detalle` (
  `id` int(11) NOT NULL,
  `orden_pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
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
  `precio` decimal(4,3) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cant_red` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido_detalle`
--

INSERT INTO `orden_pedido_detalle` (`id`, `orden_pedido_id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cantidad`, `cant_red`, `updated_at`, `created_at`) VALUES
(1, 1, 10, 9, 10, 9, 12, 12, 13, 12, 13, 9, 13, 0, 0, 113, '2.500', NULL, 113, '2019-12-02 10:14:12', '2019-11-29 16:34:02'),
(2, 1, 11, 6, 5, 5, 5, 5, 5, 5, 5, 4, 4, 0, 0, 50, '2.500', 50, 50, '2019-12-02 10:14:21', '2019-11-29 16:34:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perdidas`
--

CREATE TABLE `perdidas` (
  `id` int(11) NOT NULL,
  `corte_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
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

--
-- Volcado de datos para la tabla `perdidas`
--

INSERT INTO `perdidas` (`id`, `corte_id`, `producto_id`, `talla_id`, `no_perdida`, `tipo_perdida`, `fecha`, `fase`, `motivo`, `perdida_x`, `sec`, `updated_at`, `created_at`) VALUES
(2, 3, 1, NULL, 'SE-001', 'Segundas', '2019-10-29', 'Produccion', 'Fallo de la maquina', NULL, '0.01', '2019-10-30 18:18:54', '2019-10-30 18:18:54'),
(3, 3, 11, NULL, 'SE-002', 'Segundas', '2019-10-23', 'Lavanderia', 'Manchados', NULL, '0.00', '2019-10-30 18:27:53', '2019-10-30 18:27:53'),
(4, 11, 49, NULL, 'SE-003', 'Segundas', '2019-10-24', 'Almacen', 'Termita', NULL, '0.00', '2019-10-30 18:32:54', '2019-10-30 18:32:54'),
(5, 11, 12, NULL, 'PE-002', 'Normal', '2019-10-25', 'Lavanderia', 'Manchados', NULL, '0.02', '2019-10-30 18:33:45', '2019-10-30 18:33:45'),
(7, 3, 4, NULL, 'SE-004', 'Segundas', '2019-10-15', 'Procesos secos', 'Extraviado', NULL, '0.01', '2019-10-30 18:38:12', '2019-10-30 18:38:12'),
(8, 9, 1, NULL, 'PE-004', 'Normal', '2019-10-24', 'Lavanderia', 'Extraviado', NULL, '0.04', '2019-10-30 18:39:15', '2019-10-30 18:39:15'),
(9, 10, 4, NULL, 'PE-005', 'Normal', '2019-10-25', 'Terminacion', 'Defecto de tela', NULL, '0.05', '2019-10-30 18:51:58', '2019-10-30 18:51:58'),
(10, 10, 24, NULL, 'PE-006', 'Segundas', '2019-10-24', 'Terminacion', 'Defecto de tela', NULL, '0.01', '2019-11-01 20:42:31', '2019-10-30 19:03:22'),
(11, 8, 10, NULL, 'PE-006', 'Normal', '2019-11-07', 'Almacen', 'Extraviado', 3, '0.06', '2019-11-08 17:16:39', '2019-11-08 17:16:39'),
(12, 8, 10, NULL, 'PE-007', 'Normal', '2019-11-07', 'Almacen', 'Extraviado', 3, '0.07', '2019-11-08 17:19:39', '2019-11-08 17:19:39'),
(13, 8, 10, NULL, 'PE-008', 'Normal', '2019-11-07', 'Almacen', 'Extraviado', 3, '0.08', '2019-11-08 17:21:09', '2019-11-08 17:21:09'),
(14, 8, 10, NULL, 'PE-009', 'Normal', '2019-11-08', 'Almacen', 'Extraviado', 3, '0.09', '2019-11-08 17:22:41', '2019-11-08 17:22:41'),
(15, 8, 10, NULL, 'SE-010', 'Segundas', '2019-11-08', 'Terminacion', 'Error del operador', NULL, '0.10', '2019-11-08 20:23:10', '2019-11-08 20:23:10'),
(16, 8, 10, NULL, 'SE-010', 'Segundas', '2019-11-08', 'Terminacion', 'Error del operador', NULL, '0.10', '2019-11-08 20:24:11', '2019-11-08 20:24:11'),
(17, 8, 10, NULL, 'SE-011', 'Segundas', '2019-11-08', 'Terminacion', 'Defecto de tela', NULL, '0.11', '2019-11-08 20:27:32', '2019-11-08 20:27:32'),
(18, 2, 11, NULL, 'PE-012', 'Normal', '2019-11-12', 'Terminacion', 'Defecto de tela', NULL, '0.12', '2019-11-13 15:11:51', '2019-11-13 15:11:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sku` int(11) DEFAULT NULL,
  `referencia_producto` varchar(50) NOT NULL,
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
  `precio_lista` decimal(4,3) DEFAULT NULL,
  `precio_lista_2` decimal(4,3) DEFAULT NULL,
  `precio_venta_publico` decimal(4,3) DEFAULT NULL,
  `precio_venta_publico_2` decimal(4,3) DEFAULT NULL,
  `enviado_lavanderia` tinyint(1) DEFAULT NULL,
  `producto_terminado` tinyint(1) DEFAULT NULL,
  `sec` decimal(2,1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `id_user`, `id_sku`, `referencia_producto`, `referencia_producto_2`, `descripcion`, `descripcion_2`, `ubicacion`, `imagen_frente`, `imagen_trasero`, `imagen_perfil`, `imagen_bolsillo`, `tono`, `intensidad_proceso_seco`, `atributo_no_1`, `atributo_no_2`, `atributo_no_3`, `precio_lista`, `precio_lista_2`, `precio_venta_publico`, `precio_venta_publico_2`, `enviado_lavanderia`, `producto_terminado`, `sec`, `updated_at`, `created_at`) VALUES
(1, 1, 0, 'P233-1910', '', 'probando', '', 'a-2', NULL, NULL, NULL, NULL, 'Dark Stone Suave', 'Alto contraste', 'Roto', 'Bordado', 'Dirty', '2.000', '0.000', '2.100', '0.000', 0, 1, NULL, '2019-11-05 19:46:29', '2019-10-10 00:00:00'),
(2, 1, 0, 'L140-1910', '', 'Referencia producto actualizada', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.200', '0.000', '1.300', '0.000', 0, NULL, NULL, '2019-10-17 15:48:21', '2019-10-10 07:00:00'),
(4, 1, 0, 'P105-1903', '', 'ahora sii', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.600', '0.000', '1.500', '0.000', 1, NULL, NULL, '2019-10-25 17:24:43', '2019-10-10 21:56:33'),
(5, 1, 0, 'P201-1904', '', 'test', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.000', '0.000', '2.000', '0.000', 0, NULL, NULL, '2019-10-17 15:48:42', '2019-10-11 12:37:06'),
(6, 1, 0, 'L163-1905', '', 'actualizando referencia', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, NULL, '2019-10-11 13:51:17', '2019-10-11 12:37:45'),
(7, 1, 0, 'M312-1906', '', 'producto de nino', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '0.6', '2019-10-11 12:42:00', '2019-10-11 12:42:00'),
(8, 1, 0, 'M312-1906', '', 'producto de nino', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '0.1', '2019-10-11 12:42:14', '2019-10-11 12:42:14'),
(9, 1, 0, 'M312-1906', '', 'producto de nino', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '0.1', '2019-10-11 12:42:24', '2019-10-11 12:42:24'),
(10, 1, 0, 'L110-1907', '', 'producto de bermuda basico', '', 'a-1', '1573149972jean_frontal.jpg', '1573149972jean_trasera.jpg', '157314997200351523-03.jpg', '1573149972bolsillo.jpg', 'Crudo o Puro', 'Alto contraste', 'Parcho', 'Roto', 'Bordado', '2.500', '0.000', NULL, '0.000', 0, 1, '0.7', '2019-11-07 18:06:12', '2019-10-11 12:43:51'),
(11, 1, 0, 'P100-1908', '', 'prueba de pantalon basico', '1', 'a-4', '1573154037eclipse-solar-avion-national-04072019in5.jpg', '1573154037hipertextual-estas-son-imagenes-que-se-juegan-premio-mejor-astrofotografo-ano-2019530966.jpg', '1573154037cool-wallpaper-3.jpg', '1573154037as-imagens-por-foto-ja.jpg', 'Dark Stone Suave', 'Alto contraste', 'Parcho', 'Bordado', 'Roto', '2.500', '0.000', '2.600', '0.000', 1, 1, '0.8', '2019-11-07 19:14:00', '2019-10-11 12:45:16'),
(12, 1, 0, 'P114-1901', '', 'Bermuda escolar', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '0.1', '2019-10-11 13:15:48', '2019-10-11 13:15:48'),
(14, 1, 0, 'L121-1909', '', 'now yes', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '0.9', '2019-10-11 13:17:26', '2019-10-11 13:17:26'),
(15, 1, 0, 'P100-1910', NULL, 'Hola', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '1.0', '2019-10-15 15:12:44', '2019-10-15 15:12:44'),
(16, 1, 0, 'P300-1911', 'P300-1912', 'l', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '1.2', '2019-10-15 15:47:56', '2019-10-15 15:47:56'),
(17, 1, NULL, 'P105-1913', 'L410-1914', 'prueba descripcion form producto, terminado', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 1, NULL, '1.3', '2019-10-25 17:27:50', '2019-10-17 14:57:07'),
(18, 1, NULL, 'P300-1914', 'P300-1915', 'prueba', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '1.5', '2019-10-17 15:20:05', '2019-10-17 15:20:05'),
(19, 1, NULL, 'P421-1916', 'P421-1917', 'hoal', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '1.7', '2019-10-17 15:21:18', '2019-10-17 15:21:18'),
(20, 1, NULL, 'P160-1918', NULL, 'jaja', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.000', NULL, '0.000', 0, NULL, '1.8', '2019-10-17 15:21:56', '2019-10-17 15:21:56'),
(21, 1, NULL, 'P100-1919', NULL, 'la', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', '0.000', '2.000', '0.000', 0, NULL, '1.9', '2019-10-17 15:28:01', '2019-10-17 15:28:01'),
(22, 1, NULL, 'P100-1920', NULL, 'hola', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', '0.000', '2.000', '0.000', 0, NULL, '2.0', '2019-10-17 15:29:55', '2019-10-17 15:29:55'),
(23, 1, NULL, 'P100-1921', NULL, 'ma', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', '0.000', '2.300', '0.000', 0, NULL, '2.1', '2019-10-17 15:31:44', '2019-10-17 15:31:44'),
(24, 1, NULL, 'P200-1922', NULL, 'test', '', 'a-5', '157315361961c0S3MDEKL._SX425_.jpg', '1573153619eclipse-solar-avion-national-04072019in5.jpg', '1573153619myanmar.jpg', '1573153619cool-wallpaper-3.jpg', 'Dark Stone Suave', 'Alto contraste', 'Parcho', 'Bordado', 'Roto', '2.100', '0.000', '2.300', '0.000', 0, NULL, '2.2', '2019-11-07 19:07:02', '2019-10-17 15:35:38'),
(25, 1, NULL, 'P100-1923', NULL, 'hi', '', 'x', NULL, NULL, NULL, NULL, 'Intermedio', 'Intermedio', 'Parcho', 'Bordado', 'Dirty', '3.000', '0.000', '2.100', '0.000', 0, 1, '2.3', '2019-11-06 13:41:25', '2019-10-17 15:36:35'),
(26, 1, NULL, 'P100-1924', NULL, 'test', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', '0.000', '1.500', '0.000', 0, NULL, '2.4', '2019-10-17 19:01:50', '2019-10-17 19:01:50'),
(27, 1, NULL, 'P302-1925', 'P302-1926', 'hola', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', '0.000', '3.200', '0.000', 0, NULL, '2.6', '2019-10-17 19:58:32', '2019-10-17 19:58:32'),
(28, 1, NULL, 'P302-1927', 'P302-1928', 'Prueba ref 1', 'Prueba ref 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.300', '1.350', '2.100', '2.150', 0, NULL, '2.8', '2019-10-17 21:32:41', '2019-10-17 21:32:41'),
(29, 1, NULL, 'P400-1929', 'P400-1930', 'prueba 1', 'prueba 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.200', '2.500', '2.300', '2.600', 0, NULL, '3.0', '2019-10-17 21:39:10', '2019-10-17 21:39:10'),
(31, 1, NULL, 'P100-1931', '', 'Descripcion actualizada', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.100', NULL, '3.200', NULL, 0, NULL, NULL, '2019-10-23 14:55:22', '2019-10-23 14:50:05'),
(32, 1, NULL, 'L100-1931', '', 'Descripcion creada!!', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.200', NULL, '1.200', NULL, 0, NULL, '3.1', '2019-10-23 14:56:05', '2019-10-23 14:55:41'),
(33, 1, NULL, 'L100-1932', '', 'desc actualizada 11:05', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', NULL, '2.200', NULL, 0, NULL, NULL, '2019-10-23 15:05:41', '2019-10-23 14:57:13'),
(39, 1, NULL, 'L300-1933', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, '2019-10-23 17:15:08', '2019-10-23 17:15:08'),
(42, 1, NULL, 'P100-1932', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '1.1', '2019-10-23 18:44:45', '2019-10-23 18:44:45'),
(43, 1, NULL, 'P102-1932', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '1.1', '2019-10-23 18:45:06', '2019-10-23 18:45:06'),
(44, 1, NULL, 'P102-1932', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '3.2', '2019-10-23 18:46:07', '2019-10-23 18:46:07'),
(45, 1, NULL, 'M100-1933', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '3.3', '2019-10-23 18:46:17', '2019-10-23 18:46:17'),
(46, 1, NULL, 'P100-1934', '1', 'de', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.100', NULL, '2.500', NULL, 1, NULL, '3.4', '2019-10-25 17:32:42', '2019-10-23 18:50:19'),
(47, 1, NULL, 'P202-1935', '1', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.000', NULL, '3.100', NULL, 0, NULL, '3.5', '2019-10-23 18:53:00', '2019-10-23 18:50:56'),
(48, 1, NULL, 'P232-1936', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '3.6', '2019-10-31 19:25:18', '2019-10-23 18:53:14'),
(49, 1, NULL, 'P102-1937', '1', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.200', NULL, '3.200', NULL, 0, NULL, '3.7', '2019-10-23 18:57:22', '2019-10-23 18:57:04'),
(50, 1, NULL, 'L115-1938', '1', 'e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.200', NULL, '1.200', NULL, 0, NULL, '3.8', '2019-10-23 18:57:50', '2019-10-23 18:57:38'),
(51, 1, NULL, 'P107-1939', '1', 'desc de venta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.300', NULL, '2.400', NULL, 1, NULL, '3.9', '2019-10-31 21:01:51', '2019-10-24 17:44:39'),
(52, 1, NULL, 'P302-1940', '1', 'Desc 1', 'Desc 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.200', '1.400', '1.300', '1.500', 0, NULL, '4.1', '2019-10-24 20:20:55', '2019-10-24 20:20:06'),
(53, 1, NULL, 'P300-1942', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '4.3', '2019-10-24 20:30:50', '2019-10-24 20:30:50'),
(54, 1, NULL, 'P102-1944', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '4.4', '2019-10-31 19:11:39', '2019-10-24 20:33:07'),
(55, 1, NULL, 'P300-1945', 'P300-1946', 'des 1', 'des 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.200', '2.100', '2.100', '2.300', 1, NULL, '4.6', '2019-10-31 19:12:42', '2019-10-24 20:33:25'),
(56, 1, NULL, 'P102-1947', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '4.7', '2019-10-31 19:12:13', '2019-10-24 20:34:31'),
(57, 1, NULL, 'P100-1948', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '4.8', '2019-10-25 17:30:53', '2019-10-24 21:16:52'),
(58, 1, NULL, 'P100-1949', NULL, 'descripcion 4', NULL, 'x', '15731485762589018171f934247c228119079fbc4b.jpg', '1573148576cool-wallpaper-3.jpg', '157314857661c0S3MDEKL._SX425_.jpg', '1573148576IMG-20191010-WA0012.jpg', 'Intermedio claro', 'Alto contraste', 'Roto', 'Dirty', 'Parcho', '3.600', NULL, '4.500', NULL, 1, 1, '4.9', '2019-11-07 17:43:00', '2019-10-28 16:03:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcion`
--

CREATE TABLE `recepcion` (
  `id` int(11) NOT NULL,
  `numero_recepcion` varchar(20) DEFAULT NULL,
  `corte_id` int(11) NOT NULL,
  `id_lavanderia` int(11) NOT NULL,
  `fecha_recepcion` date NOT NULL,
  `recibido_parcial` int(20) NOT NULL,
  `total_recibido` int(20) NOT NULL,
  `pendiente` int(20) NOT NULL,
  `estandar_recibido` tinyint(1) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recepcion`
--

INSERT INTO `recepcion` (`id`, `numero_recepcion`, `corte_id`, `id_lavanderia`, `fecha_recepcion`, `recibido_parcial`, `total_recibido`, `pendiente`, `estandar_recibido`, `updated_at`, `created_at`) VALUES
(1, NULL, 2, 5, '2019-10-24', 480, 0, 0, 0, '2019-10-28 15:34:16', '2019-10-25 19:23:10'),
(2, NULL, 3, 5, '2019-10-24', 449, 0, 0, 1, '2019-10-25 20:18:58', '2019-10-25 20:18:58'),
(5, NULL, 7, 12, '2019-10-24', 584, 0, 0, 1, '2019-10-28 17:41:16', '2019-10-28 17:41:16'),
(6, NULL, 8, 12, '2019-10-28', 550, 0, 0, 1, '2019-10-29 14:25:55', '2019-10-29 14:25:55'),
(12, NULL, 10, 32, '2019-11-01', 40, 40, 18, 1, '2019-11-01 18:27:35', '2019-11-01 18:27:35'),
(13, NULL, 10, 32, '2019-11-01', 8, 48, 10, 1, '2019-11-01 18:28:12', '2019-11-01 18:28:12'),
(14, NULL, 10, 32, '2019-11-01', 4, 52, 6, 1, '2019-11-01 18:28:51', '2019-11-01 18:28:51'),
(15, NULL, 10, 32, '2019-11-01', 2, 54, 4, 1, '2019-11-01 18:30:10', '2019-11-01 18:30:10'),
(16, NULL, 10, 32, '2019-11-01', 1, 55, 3, 1, '2019-11-01 18:30:36', '2019-11-01 18:30:36');

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
(1, 1, 1, 1, '25000', 'm2555', 'm5252250', '2019-10-09', 20.333, '2019-001', '2019-10-18 15:09:24', '2019-10-09 21:12:03'),
(2, 1, 1, 4, 'man-fff', '32c', 'mnkn j4656', '2019-10-09', 25.336, '2019-001', '2019-10-18 15:09:27', '2019-10-10 12:32:03'),
(3, 1, 1, 4, 'man-fff', '33c', 'mnkn j4656', '2019-10-09', 23.333, '2019-001', '2019-10-18 15:09:17', '2019-10-10 12:37:43'),
(6, 1, 1, 4, 'T-5225', 'W20', '302555m55', '2019-10-18', 30, '2019-001', '2019-10-18 17:27:03', '2019-10-18 15:30:17'),
(7, 1, 7, 1, 'P-5154', 'B-15', 'm5252250', '2019-10-18', 50, '2019-004', '2019-10-18 19:33:21', '2019-10-18 17:31:41'),
(8, 1, 6, 2, 'V-445', 'B-36', '332251150', '2019-10-08', 60, '2019-006', '2019-10-18 19:48:08', '2019-10-18 19:42:20'),
(9, 1, 7, 2, 'M-526', 'B-15', '6161652', '2019-10-01', 60, '2019-007', '2019-10-18 20:11:53', '2019-10-18 20:10:54'),
(10, 1, 7, 2, 'B-815', 'M-5466', '6161652', '2019-10-01', 30, '2019-008', '2019-10-18 20:28:52', '2019-10-18 20:11:16'),
(11, 1, 4, 4, 'T-6566', 'B-15', '62166666', '2019-10-15', 60, '2019-009', '2019-10-18 20:37:43', '2019-10-18 20:30:25'),
(12, 1, 4, 4, '626mmj', 'B-36', '62166666', '2019-10-15', 50, '2019-011', '2019-10-18 20:50:34', '2019-10-18 20:30:39'),
(13, 1, 4, 4, 'B-815', 'M-5466', '62166666', '2019-10-15', 50, '2019-010', '2019-10-18 20:47:23', '2019-10-18 20:30:57'),
(14, 1, 6, 1, 'M-526', 'T-15', '633525', '2019-10-18', 50, '2019-013', '2019-10-21 19:43:11', '2019-10-21 18:28:13'),
(15, 1, 6, 1, 'M-526', 'T-15', '633525', '2019-10-18', 30, '2019-002', '2019-10-21 19:53:02', '2019-10-21 19:43:33'),
(16, 1, 6, 1, 'B-815', '50', '633525', '2019-10-18', 60, '2019-003', '2019-10-21 19:59:42', '2019-10-21 19:43:42'),
(17, 1, 6, 1, 'T-5225', 'B-36', '633525', '2019-10-18', 60, '2019-001', '2019-10-21 19:44:20', '2019-10-21 19:43:56'),
(18, 1, 5, 4, 'M-526', 'T-15', '51512661661', '2019-10-17', 30, '2019-007', '2019-10-21 20:15:19', '2019-10-21 20:06:07'),
(19, 1, 5, 4, 'T-5225', 'B-15', '51512661661', '2019-10-17', 60, '2019-006', '2019-10-21 20:12:55', '2019-10-21 20:06:18'),
(20, 1, 5, 4, 'T-6566', 'M-5466', '51512661661', '2019-10-17', 80, '2019-005', '2019-10-21 20:11:53', '2019-10-21 20:06:34'),
(21, 1, 6, 4, 'T-6656', 'B-36', '51512661661', '2019-10-17', 70, '2019-004', '2019-10-21 20:08:57', '2019-10-21 20:07:08'),
(22, 1, 5, 1, 'M-456', 'B-63', '16266565', '2019-10-16', 63, '2019-008', '2019-10-21 20:23:35', '2019-10-21 20:22:38'),
(23, 1, 5, 2, 'B-815', 'T-15', '3625', '2019-10-16', 30, '2019-009', '2019-10-24 17:54:04', '2019-10-24 17:53:34'),
(24, 1, 7, 5, 'M-526', 'T-15', '6565665', '2019-10-22', 50, '2019-010', '2019-10-29 17:25:13', '2019-10-29 17:24:45'),
(25, 1, 5, 2, 'A-20', 'B-36', '5464646545', '2019-10-22', 50, '2019-011', '2019-10-29 17:27:11', '2019-10-29 17:26:37'),
(26, 1, 1, 2, 'B-815', 'T-15', '464454545', '2019-10-22', 50, '2019-012', '2019-10-29 17:32:47', '2019-10-29 17:31:57'),
(27, 1, 6, 2, 'T-6656', 'B-36', '545445', '2019-10-29', 50, '2019-013', '2019-10-29 17:43:17', '2019-10-29 17:42:49'),
(28, 1, 1, 2, 'M-456', 'B-36', '61662626', '2019-11-08', 50, '2019-014', '2019-11-12 17:30:50', '2019-11-12 13:48:48'),
(29, 1, 6, 4, 'M-526', 'T-15', '61656659651616', '2019-11-08', 60, '2019-014', '2019-11-12 17:49:31', '2019-11-12 17:49:03'),
(30, 1, 6, 2, 'B-815', 'T-15', '51565565', '2019-11-15', 60, '2019-015', '2019-11-14 18:50:41', '2019-11-14 18:50:10');

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
(26, 46, 'P100-1934', '7432147617651', 'General', 1, '2019-10-23 11:16:55', '2019-10-23 18:50:23'),
(27, 47, 'P202-1935', '7432147617668', 'A', 1, '2019-10-23 11:16:55', '2019-10-23 18:52:53'),
(28, 47, 'P202-1935', '7432147617675', 'B', 1, '2019-10-23 11:16:55', '2019-10-23 18:52:55'),
(29, 49, 'P102-1937', '7432147617682', 'General', 1, '2019-10-23 11:16:55', '2019-10-23 18:57:12'),
(30, 50, 'L115-1938', '7432147617699', 'General', 1, '2019-10-23 11:16:55', '2019-10-23 18:57:41'),
(31, 51, 'P107-1939', '7432147717702', 'General', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:44'),
(32, 51, 'P107-1939', '7432147717719', 'A', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:47'),
(33, 51, 'P107-1939', '7432147717726', 'B', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:49'),
(34, 51, 'P107-1939', '7432147717733', 'C', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:52'),
(35, 51, 'P107-1939', '7432147717740', 'D', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:54'),
(36, 51, 'P107-1939', '7432147717757', 'E', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:57'),
(37, 51, 'P107-1939', '7432147717764', 'F', 1, '2019-10-23 11:16:55', '2019-10-24 17:44:59'),
(38, 52, 'P302-1940', '7432147717771', 'General', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:12'),
(39, 52, 'P302-1940', '7432147717788', 'A', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:15'),
(40, 52, 'P302-1940', '7432147717795', 'B', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:18'),
(41, 52, 'P302-1940', '7432147817808', 'C', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:21'),
(42, 52, 'P302-1940', '7432147817815', 'D', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:24'),
(43, 52, 'P302-1941', '7432147817822', 'E', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:26'),
(44, 52, 'P302-1941', '7432147817839', 'F', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:28'),
(45, 52, 'P302-1941', '7432147817846', 'G', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:30'),
(46, 52, 'P302-1941', '7432147817853', 'H', 1, '2019-10-23 11:16:55', '2019-10-24 20:20:32'),
(47, 55, 'P300-1945', '7432147817860', 'General', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:28'),
(48, 55, 'P300-1945', '7432147817877', 'A', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:30'),
(49, 55, 'P300-1945', '7432147817884', 'B', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:32'),
(50, 55, 'P300-1945', '7432147817891', 'C', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:34'),
(51, 55, 'P300-1945', '7432147917904', 'D', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:36'),
(52, 55, 'P300-1946', '7432147917911', 'F', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:38'),
(53, 55, 'P300-1946', '7432147917928', 'E', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:40'),
(54, 55, 'P300-1946', '7432147917935', 'G', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:42'),
(55, 55, 'P300-1946', '7432147917942', 'H', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:43'),
(56, 55, 'P300-1945', '7432147917959', 'I', 1, '2019-10-23 11:16:55', '2019-10-24 20:33:45'),
(57, 57, 'P100-1948', '7432147917966', 'General', 1, '2019-10-23 11:16:55', '2019-10-24 21:16:56'),
(58, 58, 'P100-1949', '7432147917973', 'General', 1, '2019-10-23 11:16:55', '2019-10-28 16:03:52'),
(59, NULL, '', '7432147917980', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(60, NULL, '', '7432147917997', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(61, NULL, '', '7432147018007', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(62, NULL, '', '7432147018014', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(63, NULL, '', '7432147018021', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(64, NULL, '', '7432147018038', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(65, NULL, '', '7432147018045', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(66, NULL, '', '7432147018052', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(67, NULL, '', '7432147018069', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(68, NULL, '', '7432147018076', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(69, 56, '', '7432147018083', 'General', NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(70, NULL, '', '7432147018090', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(71, NULL, '', '7432147118103', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(72, NULL, '', '7432147118110', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(73, NULL, '', '7432147118127', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(74, NULL, '', '7432147118134', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(75, NULL, '', '7432147118141', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(76, NULL, '', '7432147118158', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(77, NULL, '', '7432147118165', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(78, NULL, '', '7432147118172', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(79, NULL, '', '7432147118189', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(80, NULL, '', '7432147118196', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(81, NULL, '', '7432147218209', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(82, NULL, '', '7432147218216', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(83, NULL, '', '7432147218223', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(84, NULL, '', '7432147218230', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(85, NULL, '', '7432147218247', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(86, NULL, '', '7432147218254', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(87, NULL, '', '7432147218261', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(88, NULL, '', '7432147218278', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(89, NULL, '', '7432147218285', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(90, NULL, '', '7432147218292', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(91, NULL, '', '7432147318305', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(92, NULL, '', '7432147318312', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(93, NULL, '', '7432147318329', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(94, NULL, '', '7432147318336', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(95, NULL, '', '7432147318343', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(96, NULL, '', '7432147318350', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(97, NULL, '', '7432147318367', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(98, NULL, '', '7432147318374', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(99, NULL, '', '7432147318381', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(100, NULL, '', '7432147318398', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(101, NULL, '', '7432147418401', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(102, NULL, '', '7432147418418', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(103, NULL, '', '7432147418425', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(104, NULL, '', '7432147418432', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(105, NULL, '', '7432147418449', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(106, NULL, '', '7432147418456', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(107, NULL, '', '7432147418463', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(108, NULL, '', '7432147418470', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(109, NULL, '', '7432147418487', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(110, NULL, '', '7432147418494', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(111, NULL, '', '7432147518507', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(112, NULL, '', '7432147518514', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(113, NULL, '', '7432147518521', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(114, NULL, '', '7432147518538', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(115, NULL, '', '7432147518545', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(116, NULL, '', '7432147518552', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(117, NULL, '', '7432147518569', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(118, NULL, '', '7432147518576', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(119, NULL, '', '7432147518583', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(120, NULL, '', '7432147518590', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(121, NULL, '', '7432147618603', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(122, NULL, '', '7432147618610', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(123, NULL, '', '7432147618627', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(124, NULL, '', '7432147618634', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(125, NULL, '', '7432147618641', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(126, NULL, '', '7432147618658', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(127, NULL, '', '7432147618665', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(128, NULL, '', '7432147618672', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(129, NULL, '', '7432147618689', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(130, NULL, '', '7432147618696', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(131, NULL, '', '7432147718709', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(132, NULL, '', '7432147718716', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(133, NULL, '', '7432147718723', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(134, NULL, '', '7432147718730', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(135, NULL, '', '7432147718747', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(136, NULL, '', '7432147718754', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(137, NULL, '', '7432147718761', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(138, NULL, '', '7432147718778', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(139, NULL, '', '7432147718785', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(140, NULL, '', '7432147718792', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(141, NULL, '', '7432147818805', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(142, NULL, '', '7432147818812', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(143, NULL, '', '7432147818829', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(144, NULL, '', '7432147818836', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(145, NULL, '', '7432147818843', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(146, NULL, '', '7432147818850', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(147, NULL, '', '7432147818867', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(148, NULL, '', '7432147818874', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(149, NULL, '', '7432147818881', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(150, NULL, '', '7432147818898', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(151, NULL, '', '7432147918901', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(152, NULL, '', '7432147918918', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(153, NULL, '', '7432147918925', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(154, NULL, '', '7432147918932', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(155, NULL, '', '7432147918949', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(156, NULL, '', '7432147918956', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(157, NULL, '', '7432147918963', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(158, NULL, '', '7432147918970', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(159, NULL, '', '7432147918987', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(160, NULL, '', '7432147918994', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(161, NULL, '', '7432147019004', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(162, NULL, '', '7432147019011', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(163, NULL, '', '7432147019028', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(164, NULL, '', '7432147019035', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(165, NULL, '', '7432147019042', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(166, NULL, '', '7432147019059', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(167, NULL, '', '7432147019066', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(168, NULL, '', '7432147019073', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(169, NULL, '', '7432147019080', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(170, NULL, '', '7432147019097', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(171, NULL, '', '7432147119100', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(172, NULL, '', '7432147119117', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(173, NULL, '', '7432147119124', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(174, NULL, '', '7432147119131', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(175, NULL, '', '7432147119148', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(176, NULL, '', '7432147119155', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(177, NULL, '', '7432147119162', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(178, NULL, '', '7432147119179', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(179, NULL, '', '7432147119186', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(180, NULL, '', '7432147119193', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(181, NULL, '', '7432147219206', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(182, NULL, '', '7432147219213', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(183, NULL, '', '7432147219220', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(184, NULL, '', '7432147219237', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(185, NULL, '', '7432147219244', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(186, NULL, '', '7432147219251', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(187, NULL, '', '7432147219268', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(188, NULL, '', '7432147219275', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(189, NULL, '', '7432147219282', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(190, NULL, '', '7432147219299', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(191, NULL, '', '7432147319302', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(192, NULL, '', '7432147319319', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(193, NULL, '', '7432147319326', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(194, NULL, '', '7432147319333', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(195, NULL, '', '7432147319340', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(196, NULL, '', '7432147319357', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(197, NULL, '', '7432147319364', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(198, NULL, '', '7432147319371', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(199, NULL, '', '7432147319388', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(200, NULL, '', '7432147319395', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(201, NULL, '', '7432147419408', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(202, NULL, '', '7432147419415', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(203, NULL, '', '7432147419422', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(204, NULL, '', '7432147419439', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(205, NULL, '', '7432147419446', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(206, NULL, '', '7432147419453', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(207, NULL, '', '7432147419460', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(208, NULL, '', '7432147419477', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(209, NULL, '', '7432147419484', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(210, NULL, '', '7432147419491', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(211, NULL, '', '7432147519504', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(212, NULL, '', '7432147519511', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(213, NULL, '', '7432147519528', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(214, NULL, '', '7432147519535', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(215, NULL, '', '7432147519542', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(216, NULL, '', '7432147519559', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(217, NULL, '', '7432147519566', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(218, NULL, '', '7432147519573', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(219, NULL, '', '7432147519580', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(220, NULL, '', '7432147519597', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(221, NULL, '', '7432147619600', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(222, NULL, '', '7432147619617', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(223, NULL, '', '7432147619624', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(224, NULL, '', '7432147619631', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(225, NULL, '', '7432147619648', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(226, NULL, '', '7432147619655', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(227, NULL, '', '7432147619662', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(228, NULL, '', '7432147619679', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(229, NULL, '', '7432147619686', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(230, NULL, '', '7432147619693', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(231, NULL, '', '7432147719706', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(232, NULL, '', '7432147719713', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(233, NULL, '', '7432147719720', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(234, NULL, '', '7432147719737', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(235, NULL, '', '7432147719744', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(236, NULL, '', '7432147719751', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(237, NULL, '', '7432147719768', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(238, NULL, '', '7432147719775', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(239, NULL, '', '7432147719782', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(240, NULL, '', '7432147719799', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(241, NULL, '', '7432147819802', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(242, NULL, '', '7432147819819', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(243, NULL, '', '7432147819826', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(244, NULL, '', '7432147819833', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(245, NULL, '', '7432147819840', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(246, NULL, '', '7432147819857', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(247, NULL, '', '7432147819864', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(248, NULL, '', '7432147819871', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(249, NULL, '', '7432147819888', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(250, NULL, '', '7432147819895', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(251, NULL, '', '7432147919908', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(252, NULL, '', '7432147919915', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(253, NULL, '', '7432147919922', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(254, NULL, '', '7432147919939', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(255, NULL, '', '7432147919946', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(256, NULL, '', '7432147919953', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(257, NULL, '', '7432147919960', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(258, NULL, '', '7432147919977', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(259, NULL, '', '7432147919984', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(260, NULL, '', '7432147919991', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(261, NULL, '', '7432147020000', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(262, NULL, '', '7432147020017', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(263, NULL, '', '7432147020024', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(264, NULL, '', '7432147020031', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(265, NULL, '', '7432147020048', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(266, NULL, '', '7432147020055', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(267, NULL, '', '7432147020062', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(268, NULL, '', '7432147020079', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(269, NULL, '', '7432147020086', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(270, NULL, '', '7432147020093', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(271, NULL, '', '7432147120106', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(272, NULL, '', '7432147120113', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(273, NULL, '', '7432147120120', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(274, NULL, '', '7432147120137', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(275, NULL, '', '7432147120144', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(276, NULL, '', '7432147120151', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(277, NULL, '', '7432147120168', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(278, NULL, '', '7432147120175', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(279, NULL, '', '7432147120182', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(280, NULL, '', '7432147120199', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(281, NULL, '', '7432147220202', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(282, NULL, '', '7432147220219', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(283, NULL, '', '7432147220226', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(284, NULL, '', '7432147220233', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(285, NULL, '', '7432147220240', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(286, NULL, '', '7432147220257', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(287, NULL, '', '7432147220264', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(288, NULL, '', '7432147220271', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(289, NULL, '', '7432147220288', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(290, NULL, '', '7432147220295', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(291, NULL, '', '7432147320308', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(292, NULL, '', '7432147320315', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(293, NULL, '', '7432147320322', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(294, NULL, '', '7432147320339', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(295, NULL, '', '7432147320346', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(296, NULL, '', '7432147320353', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(297, NULL, '', '7432147320360', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(298, NULL, '', '7432147320377', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(299, NULL, '', '7432147320384', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(300, NULL, '', '7432147320391', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(301, NULL, '', '7432147420404', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(302, NULL, '', '7432147420411', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(303, NULL, '', '7432147420428', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(304, NULL, '', '7432147420435', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(305, NULL, '', '7432147420442', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(306, NULL, '', '7432147420459', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(307, NULL, '', '7432147420466', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(308, NULL, '', '7432147420473', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(309, NULL, '', '7432147420480', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(310, NULL, '', '7432147420497', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(311, NULL, '', '7432147520500', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(312, NULL, '', '7432147520517', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(313, NULL, '', '7432147520524', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(314, NULL, '', '7432147520531', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(315, NULL, '', '7432147520548', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(316, NULL, '', '7432147520555', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(317, NULL, '', '7432147520562', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(318, NULL, '', '7432147520579', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(319, NULL, '', '7432147520586', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(320, NULL, '', '7432147520593', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(321, NULL, '', '7432147620606', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(322, NULL, '', '7432147620613', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(323, NULL, '', '7432147620620', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(324, NULL, '', '7432147620637', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(325, NULL, '', '7432147620644', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(326, NULL, '', '7432147620651', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(327, NULL, '', '7432147620668', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(328, NULL, '', '7432147620675', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(329, NULL, '', '7432147620682', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(330, NULL, '', '7432147620699', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(331, NULL, '', '7432147720702', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(332, NULL, '', '7432147720719', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(333, NULL, '', '7432147720726', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(334, NULL, '', '7432147720733', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(335, NULL, '', '7432147720740', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(336, NULL, '', '7432147720757', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(337, NULL, '', '7432147720764', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(338, NULL, '', '7432147720771', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(339, NULL, '', '7432147720788', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(340, NULL, '', '7432147720795', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(341, NULL, '', '7432147820808', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(342, NULL, '', '7432147820815', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(343, NULL, '', '7432147820822', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(344, NULL, '', '7432147820839', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(345, NULL, '', '7432147820846', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(346, NULL, '', '7432147820853', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(347, NULL, '', '7432147820860', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(348, NULL, '', '7432147820877', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(349, NULL, '', '7432147820884', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(350, NULL, '', '7432147820891', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(351, NULL, '', '7432147920904', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(352, NULL, '', '7432147920911', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(353, NULL, '', '7432147920928', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(354, NULL, '', '7432147920935', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(355, NULL, '', '7432147920942', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(356, NULL, '', '7432147920959', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(357, NULL, '', '7432147920966', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(358, NULL, '', '7432147920973', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(359, NULL, '', '7432147920980', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(360, NULL, '', '7432147920997', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(361, NULL, '', '7432147021007', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(362, NULL, '', '7432147021014', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(363, NULL, '', '7432147021021', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(364, NULL, '', '7432147021038', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(365, NULL, '', '7432147021045', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(366, NULL, '', '7432147021052', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(367, NULL, '', '7432147021069', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(368, NULL, '', '7432147021076', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(369, NULL, '', '7432147021083', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(370, NULL, '', '7432147021090', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(371, NULL, '', '7432147121103', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(372, NULL, '', '7432147121110', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(373, NULL, '', '7432147121127', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(374, NULL, '', '7432147121134', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(375, NULL, '', '7432147121141', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(376, NULL, '', '7432147121158', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(377, NULL, '', '7432147121165', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(378, NULL, '', '7432147121172', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(379, NULL, '', '7432147121189', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(380, NULL, '', '7432147121196', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(381, NULL, '', '7432147221209', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(382, NULL, '', '7432147221216', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(383, NULL, '', '7432147221223', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(384, NULL, '', '7432147221230', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(385, NULL, '', '7432147221247', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(386, NULL, '', '7432147221254', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(387, NULL, '', '7432147221261', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(388, NULL, '', '7432147221278', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(389, NULL, '', '7432147221285', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(390, NULL, '', '7432147221292', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(391, NULL, '', '7432147321305', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(392, NULL, '', '7432147321312', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(393, NULL, '', '7432147321329', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(394, NULL, '', '7432147321336', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(395, NULL, '', '7432147321343', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(396, NULL, '', '7432147321350', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(397, NULL, '', '7432147321367', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(398, NULL, '', '7432147321374', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(399, NULL, '', '7432147321381', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(400, NULL, '', '7432147321398', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(401, NULL, '', '7432147421401', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(402, NULL, '', '7432147421418', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(403, NULL, '', '7432147421425', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(404, NULL, '', '7432147421432', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(405, NULL, '', '7432147421449', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(406, NULL, '', '7432147421456', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(407, NULL, '', '7432147421463', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(408, NULL, '', '7432147421470', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(409, NULL, '', '7432147421487', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(410, NULL, '', '7432147421494', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(411, NULL, '', '7432147521507', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(412, NULL, '', '7432147521514', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(413, NULL, '', '7432147521521', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(414, NULL, '', '7432147521538', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(415, NULL, '', '7432147521545', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(416, NULL, '', '7432147521552', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(417, NULL, '', '7432147521569', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(418, NULL, '', '7432147521576', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(419, NULL, '', '7432147521583', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(420, NULL, '', '7432147521590', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(421, NULL, '', '7432147621603', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(422, NULL, '', '7432147621610', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(423, NULL, '', '7432147621627', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(424, NULL, '', '7432147621634', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(425, NULL, '', '7432147621641', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(426, NULL, '', '7432147621658', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(427, NULL, '', '7432147621665', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(428, NULL, '', '7432147621672', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(429, NULL, '', '7432147621689', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(430, NULL, '', '7432147621696', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(431, NULL, '', '7432147721709', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(432, NULL, '', '7432147721716', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(433, NULL, '', '7432147721723', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(434, NULL, '', '7432147721730', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(435, NULL, '', '7432147721747', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(436, NULL, '', '7432147721754', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(437, NULL, '', '7432147721761', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(438, NULL, '', '7432147721778', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(439, NULL, '', '7432147721785', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(440, NULL, '', '7432147721792', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(441, NULL, '', '7432147821805', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(442, NULL, '', '7432147821812', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(443, NULL, '', '7432147821829', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(444, NULL, '', '7432147821836', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(445, NULL, '', '7432147821843', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(446, NULL, '', '7432147821850', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(447, NULL, '', '7432147821867', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(448, NULL, '', '7432147821874', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(449, NULL, '', '7432147821881', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(450, NULL, '', '7432147821898', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(451, NULL, '', '7432147921901', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(452, NULL, '', '7432147921918', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(453, NULL, '', '7432147921925', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(454, NULL, '', '7432147921932', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(455, NULL, '', '7432147921949', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(456, NULL, '', '7432147921956', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(457, NULL, '', '7432147921963', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(458, NULL, '', '7432147921970', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(459, NULL, '', '7432147921987', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(460, NULL, '', '7432147921994', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(461, NULL, '', '7432147022004', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(462, NULL, '', '7432147022011', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(463, NULL, '', '7432147022028', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(464, NULL, '', '7432147022035', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(465, NULL, '', '7432147022042', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(466, NULL, '', '7432147022059', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(467, NULL, '', '7432147022066', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(468, NULL, '', '7432147022073', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(469, NULL, '', '7432147022080', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(470, NULL, '', '7432147022097', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(471, NULL, '', '7432147122100', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(472, NULL, '', '7432147122117', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(473, NULL, '', '7432147122124', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(474, NULL, '', '7432147122131', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(475, NULL, '', '7432147122148', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(476, NULL, '', '7432147122155', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(477, NULL, '', '7432147122162', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(478, NULL, '', '7432147122179', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(479, NULL, '', '7432147122186', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(480, NULL, '', '7432147122193', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(481, NULL, '', '7432147222206', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(482, NULL, '', '7432147222213', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(483, NULL, '', '7432147222220', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(484, NULL, '', '7432147222237', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(485, NULL, '', '7432147222244', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(486, NULL, '', '7432147222251', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(487, NULL, '', '7432147222268', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(488, NULL, '', '7432147222275', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(489, NULL, '', '7432147222282', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(490, NULL, '', '7432147222299', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(491, NULL, '', '7432147322302', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(492, NULL, '', '7432147322319', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(493, NULL, '', '7432147322326', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(494, NULL, '', '7432147322333', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(495, NULL, '', '7432147322340', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(496, NULL, '', '7432147322357', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(497, NULL, '', '7432147322364', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(498, NULL, '', '7432147322371', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(499, NULL, '', '7432147322388', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(500, NULL, '', '7432147322395', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(501, NULL, '', '7432147422408', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(502, NULL, '', '7432147422415', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(503, NULL, '', '7432147422422', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(504, NULL, '', '7432147422439', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(505, NULL, '', '7432147422446', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(506, NULL, '', '7432147422453', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(507, NULL, '', '7432147422460', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(508, NULL, '', '7432147422477', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(509, NULL, '', '7432147422484', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(510, NULL, '', '7432147422491', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(511, NULL, '', '7432147522504', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(512, NULL, '', '7432147522511', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(513, NULL, '', '7432147522528', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(514, NULL, '', '7432147522535', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(515, NULL, '', '7432147522542', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(516, NULL, '', '7432147522559', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(517, NULL, '', '7432147522566', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(518, NULL, '', '7432147522573', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(519, NULL, '', '7432147522580', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(520, NULL, '', '7432147522597', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(521, NULL, '', '7432147622600', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(522, NULL, '', '7432147622617', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(523, NULL, '', '7432147622624', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(524, NULL, '', '7432147622631', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(525, NULL, '', '7432147622648', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(526, NULL, '', '7432147622655', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(527, NULL, '', '7432147622662', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(528, NULL, '', '7432147622679', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(529, NULL, '', '7432147622686', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(530, NULL, '', '7432147622693', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(531, NULL, '', '7432147722706', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(532, NULL, '', '7432147722713', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(533, NULL, '', '7432147722720', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(534, NULL, '', '7432147722737', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(535, NULL, '', '7432147722744', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(536, NULL, '', '7432147722751', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(537, NULL, '', '7432147722768', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(538, NULL, '', '7432147722775', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(539, NULL, '', '7432147722782', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(540, NULL, '', '7432147722799', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(541, NULL, '', '7432147822802', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(542, NULL, '', '7432147822819', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(543, NULL, '', '7432147822826', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(544, NULL, '', '7432147822833', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(545, NULL, '', '7432147822840', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(546, NULL, '', '7432147822857', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(547, NULL, '', '7432147822864', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(548, NULL, '', '7432147822871', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(549, NULL, '', '7432147822888', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(550, NULL, '', '7432147822895', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(551, NULL, '', '7432147922908', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(552, NULL, '', '7432147922915', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(553, NULL, '', '7432147922922', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(554, NULL, '', '7432147922939', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(555, NULL, '', '7432147922946', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(556, NULL, '', '7432147922953', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(557, NULL, '', '7432147922960', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(558, NULL, '', '7432147922977', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(559, NULL, '', '7432147922984', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(560, NULL, '', '7432147922991', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(561, NULL, '', '7432147023001', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(562, NULL, '', '7432147023018', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(563, NULL, '', '7432147023025', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(564, NULL, '', '7432147023032', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(565, NULL, '', '7432147023049', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(566, NULL, '', '7432147023056', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(567, NULL, '', '7432147023063', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(568, NULL, '', '7432147023070', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(569, NULL, '', '7432147023087', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(570, NULL, '', '7432147023094', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(571, NULL, '', '7432147123107', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(572, NULL, '', '7432147123114', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(573, NULL, '', '7432147123121', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(574, NULL, '', '7432147123138', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(575, NULL, '', '7432147123145', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(576, NULL, '', '7432147123152', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(577, NULL, '', '7432147123169', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(578, NULL, '', '7432147123176', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55');
INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
(579, NULL, '', '7432147123183', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(580, NULL, '', '7432147123190', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(581, NULL, '', '7432147223203', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(582, NULL, '', '7432147223210', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(583, NULL, '', '7432147223227', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(584, NULL, '', '7432147223234', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(585, NULL, '', '7432147223241', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(586, NULL, '', '7432147223258', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(587, NULL, '', '7432147223265', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(588, NULL, '', '7432147223272', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(589, NULL, '', '7432147223289', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(590, NULL, '', '7432147223296', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(591, NULL, '', '7432147323309', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(592, NULL, '', '7432147323316', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(593, NULL, '', '7432147323323', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(594, NULL, '', '7432147323330', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(595, NULL, '', '7432147323347', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(596, NULL, '', '7432147323354', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(597, NULL, '', '7432147323361', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(598, NULL, '', '7432147323378', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(599, NULL, '', '7432147323385', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(600, NULL, '', '7432147323392', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(601, NULL, '', '7432147423405', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(602, NULL, '', '7432147423412', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(603, NULL, '', '7432147423429', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(604, NULL, '', '7432147423436', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(605, NULL, '', '7432147423443', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(606, NULL, '', '7432147423450', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(607, NULL, '', '7432147423467', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(608, NULL, '', '7432147423474', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(609, NULL, '', '7432147423481', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(610, NULL, '', '7432147423498', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(611, NULL, '', '7432147523501', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(612, NULL, '', '7432147523518', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(613, NULL, '', '7432147523525', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(614, NULL, '', '7432147523532', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(615, NULL, '', '7432147523549', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(616, NULL, '', '7432147523556', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(617, NULL, '', '7432147523563', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(618, NULL, '', '7432147523570', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(619, NULL, '', '7432147523587', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(620, NULL, '', '7432147523594', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(621, NULL, '', '7432147623607', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(622, NULL, '', '7432147623614', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(623, NULL, '', '7432147623621', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(624, NULL, '', '7432147623638', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(625, NULL, '', '7432147623645', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(626, NULL, '', '7432147623652', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(627, NULL, '', '7432147623669', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(628, NULL, '', '7432147623676', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(629, NULL, '', '7432147623683', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(630, NULL, '', '7432147623690', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(631, NULL, '', '7432147723703', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(632, NULL, '', '7432147723710', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(633, NULL, '', '7432147723727', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(634, NULL, '', '7432147723734', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(635, NULL, '', '7432147723741', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(636, NULL, '', '7432147723758', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(637, NULL, '', '7432147723765', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(638, NULL, '', '7432147723772', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(639, NULL, '', '7432147723789', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(640, NULL, '', '7432147723796', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(641, NULL, '', '7432147823809', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(642, NULL, '', '7432147823816', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(643, NULL, '', '7432147823823', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(644, NULL, '', '7432147823830', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(645, NULL, '', '7432147823847', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(646, NULL, '', '7432147823854', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(647, NULL, '', '7432147823861', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(648, NULL, '', '7432147823878', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(649, NULL, '', '7432147823885', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(650, NULL, '', '7432147823892', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(651, NULL, '', '7432147923905', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(652, NULL, '', '7432147923912', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(653, NULL, '', '7432147923929', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(654, NULL, '', '7432147923936', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(655, NULL, '', '7432147923943', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(656, NULL, '', '7432147923950', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(657, NULL, '', '7432147923967', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(658, NULL, '', '7432147923974', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(659, NULL, '', '7432147923981', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(660, NULL, '', '7432147923998', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(661, NULL, '', '7432147024008', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(662, NULL, '', '7432147024015', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(663, NULL, '', '7432147024022', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(664, NULL, '', '7432147024039', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(665, NULL, '', '7432147024046', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(666, NULL, '', '7432147024053', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(667, NULL, '', '7432147024060', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(668, NULL, '', '7432147024077', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(669, NULL, '', '7432147024084', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(670, NULL, '', '7432147024091', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(671, NULL, '', '7432147124104', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(672, NULL, '', '7432147124111', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(673, NULL, '', '7432147124128', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(674, NULL, '', '7432147124135', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(675, NULL, '', '7432147124142', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(676, NULL, '', '7432147124159', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(677, NULL, '', '7432147124166', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(678, NULL, '', '7432147124173', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(679, NULL, '', '7432147124180', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(680, NULL, '', '7432147124197', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(681, NULL, '', '7432147224200', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(682, NULL, '', '7432147224217', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(683, NULL, '', '7432147224224', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(684, NULL, '', '7432147224231', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(685, NULL, '', '7432147224248', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(686, NULL, '', '7432147224255', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(687, NULL, '', '7432147224262', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(688, NULL, '', '7432147224279', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(689, NULL, '', '7432147224286', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(690, NULL, '', '7432147224293', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(691, NULL, '', '7432147324306', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(692, NULL, '', '7432147324313', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(693, NULL, '', '7432147324320', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(694, NULL, '', '7432147324337', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(695, NULL, '', '7432147324344', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(696, NULL, '', '7432147324351', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(697, NULL, '', '7432147324368', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(698, NULL, '', '7432147324375', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(699, NULL, '', '7432147324382', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(700, NULL, '', '7432147324399', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(701, NULL, '', '7432147424402', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(702, NULL, '', '7432147424419', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(703, NULL, '', '7432147424426', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(704, NULL, '', '7432147424433', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(705, NULL, '', '7432147424440', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(706, NULL, '', '7432147424457', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(707, NULL, '', '7432147424464', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(708, NULL, '', '7432147424471', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(709, NULL, '', '7432147424488', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(710, NULL, '', '7432147424495', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(711, NULL, '', '7432147524508', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(712, NULL, '', '7432147524515', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(713, NULL, '', '7432147524522', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(714, NULL, '', '7432147524539', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(715, NULL, '', '7432147524546', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(716, NULL, '', '7432147524553', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(717, NULL, '', '7432147524560', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(718, NULL, '', '7432147524577', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(719, NULL, '', '7432147524584', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(720, NULL, '', '7432147524591', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(721, NULL, '', '7432147624604', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(722, NULL, '', '7432147624611', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(723, NULL, '', '7432147624628', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(724, NULL, '', '7432147624635', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(725, NULL, '', '7432147624642', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(726, NULL, '', '7432147624659', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(727, NULL, '', '7432147624666', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(728, NULL, '', '7432147624673', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(729, NULL, '', '7432147624680', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(730, NULL, '', '7432147624697', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(731, NULL, '', '7432147724700', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(732, NULL, '', '7432147724717', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(733, NULL, '', '7432147724724', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(734, NULL, '', '7432147724731', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(735, NULL, '', '7432147724748', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(736, NULL, '', '7432147724755', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(737, NULL, '', '7432147724762', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(738, NULL, '', '7432147724779', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(739, NULL, '', '7432147724786', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(740, NULL, '', '7432147724793', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(741, NULL, '', '7432147824806', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(742, NULL, '', '7432147824813', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(743, NULL, '', '7432147824820', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(744, NULL, '', '7432147824837', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(745, NULL, '', '7432147824844', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(746, NULL, '', '7432147824851', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(747, NULL, '', '7432147824868', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(748, NULL, '', '7432147824875', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(749, NULL, '', '7432147824882', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(750, NULL, '', '7432147824899', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(751, NULL, '', '7432147924902', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(752, NULL, '', '7432147924919', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(753, NULL, '', '7432147924926', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(754, NULL, '', '7432147924933', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(755, NULL, '', '7432147924940', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(756, NULL, '', '7432147924957', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(757, NULL, '', '7432147924964', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(758, NULL, '', '7432147924971', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(759, NULL, '', '7432147924988', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(760, NULL, '', '7432147924995', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(761, NULL, '', '7432147025005', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(762, NULL, '', '7432147025012', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(763, NULL, '', '7432147025029', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(764, NULL, '', '7432147025036', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(765, NULL, '', '7432147025043', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(766, NULL, '', '7432147025050', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(767, NULL, '', '7432147025067', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(768, NULL, '', '7432147025074', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(769, NULL, '', '7432147025081', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(770, NULL, '', '7432147025098', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(771, NULL, '', '7432147125101', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(772, NULL, '', '7432147125118', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(773, NULL, '', '7432147125125', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(774, NULL, '', '7432147125132', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(775, NULL, '', '7432147125149', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(776, NULL, '', '7432147125156', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(777, NULL, '', '7432147125163', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(778, NULL, '', '7432147125170', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(779, NULL, '', '7432147125187', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(780, NULL, '', '7432147125194', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(781, NULL, '', '7432147225207', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(782, NULL, '', '7432147225214', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(783, NULL, '', '7432147225221', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(784, NULL, '', '7432147225238', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(785, NULL, '', '7432147225245', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(786, NULL, '', '7432147225252', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(787, NULL, '', '7432147225269', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(788, NULL, '', '7432147225276', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(789, NULL, '', '7432147225283', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(790, NULL, '', '7432147225290', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(791, NULL, '', '7432147325303', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(792, NULL, '', '7432147325310', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(793, NULL, '', '7432147325327', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(794, NULL, '', '7432147325334', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(795, NULL, '', '7432147325341', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(796, NULL, '', '7432147325358', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(797, NULL, '', '7432147325365', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(798, NULL, '', '7432147325372', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(799, NULL, '', '7432147325389', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(800, NULL, '', '7432147325396', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(801, NULL, '', '7432147425409', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(802, NULL, '', '7432147425416', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(803, NULL, '', '7432147425423', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(804, NULL, '', '7432147425430', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(805, NULL, '', '7432147425447', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(806, NULL, '', '7432147425454', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(807, NULL, '', '7432147425461', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(808, NULL, '', '7432147425478', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(809, NULL, '', '7432147425485', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(810, NULL, '', '7432147425492', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(811, NULL, '', '7432147525505', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(812, NULL, '', '7432147525512', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(813, NULL, '', '7432147525529', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(814, NULL, '', '7432147525536', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(815, NULL, '', '7432147525543', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(816, NULL, '', '7432147525550', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(817, NULL, '', '7432147525567', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(818, NULL, '', '7432147525574', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(819, NULL, '', '7432147525581', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(820, NULL, '', '7432147525598', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(821, NULL, '', '7432147625601', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(822, NULL, '', '7432147625618', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(823, NULL, '', '7432147625625', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(824, NULL, '', '7432147625632', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(825, NULL, '', '7432147625649', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(826, NULL, '', '7432147625656', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(827, NULL, '', '7432147625663', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(828, NULL, '', '7432147625670', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(829, NULL, '', '7432147625687', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(830, NULL, '', '7432147625694', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(831, NULL, '', '7432147725707', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(832, NULL, '', '7432147725714', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(833, NULL, '', '7432147725721', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(834, NULL, '', '7432147725738', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(835, NULL, '', '7432147725745', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(836, NULL, '', '7432147725752', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(837, NULL, '', '7432147725769', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(838, NULL, '', '7432147725776', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(839, NULL, '', '7432147725783', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(840, NULL, '', '7432147725790', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(841, NULL, '', '7432147825803', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(842, NULL, '', '7432147825810', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(843, NULL, '', '7432147825827', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(844, NULL, '', '7432147825834', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(845, NULL, '', '7432147825841', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(846, NULL, '', '7432147825858', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(847, NULL, '', '7432147825865', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(848, NULL, '', '7432147825872', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(849, NULL, '', '7432147825889', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(850, NULL, '', '7432147825896', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(851, NULL, '', '7432147925909', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(852, NULL, '', '7432147925916', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(853, NULL, '', '7432147925923', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(854, NULL, '', '7432147925930', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(855, NULL, '', '7432147925947', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(856, NULL, '', '7432147925954', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(857, NULL, '', '7432147925961', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(858, NULL, '', '7432147925978', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(859, NULL, '', '7432147925985', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(860, NULL, '', '7432147925992', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(861, NULL, '', '7432147026002', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(862, NULL, '', '7432147026019', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(863, NULL, '', '7432147026026', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(864, NULL, '', '7432147026033', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(865, NULL, '', '7432147026040', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(866, NULL, '', '7432147026057', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(867, NULL, '', '7432147026064', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(868, NULL, '', '7432147026071', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(869, NULL, '', '7432147026088', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(870, NULL, '', '7432147026095', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(871, NULL, '', '7432147126108', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(872, NULL, '', '7432147126115', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(873, NULL, '', '7432147126122', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(874, NULL, '', '7432147126139', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(875, NULL, '', '7432147126146', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(876, NULL, '', '7432147126153', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(877, NULL, '', '7432147126160', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(878, NULL, '', '7432147126177', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(879, NULL, '', '7432147126184', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(880, NULL, '', '7432147126191', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(881, NULL, '', '7432147226204', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(882, NULL, '', '7432147226211', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(883, NULL, '', '7432147226228', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(884, NULL, '', '7432147226235', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(885, NULL, '', '7432147226242', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(886, NULL, '', '7432147226259', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(887, NULL, '', '7432147226266', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(888, NULL, '', '7432147226273', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(889, NULL, '', '7432147226280', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(890, NULL, '', '7432147226297', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(891, NULL, '', '7432147326300', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(892, NULL, '', '7432147326317', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(893, NULL, '', '7432147326324', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(894, NULL, '', '7432147326331', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(895, NULL, '', '7432147326348', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(896, NULL, '', '7432147326355', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(897, NULL, '', '7432147326362', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(898, NULL, '', '7432147326379', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(899, NULL, '', '7432147326386', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(900, NULL, '', '7432147326393', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(901, NULL, '', '7432147426406', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(902, NULL, '', '7432147426413', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(903, NULL, '', '7432147426420', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(904, NULL, '', '7432147426437', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(905, NULL, '', '7432147426444', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(906, NULL, '', '7432147426451', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(907, NULL, '', '7432147426468', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(908, NULL, '', '7432147426475', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(909, NULL, '', '7432147426482', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(910, NULL, '', '7432147426499', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(911, NULL, '', '7432147526502', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(912, NULL, '', '7432147526519', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(913, NULL, '', '7432147526526', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(914, NULL, '', '7432147526533', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(915, NULL, '', '7432147526540', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(916, NULL, '', '7432147526557', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(917, NULL, '', '7432147526564', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(918, NULL, '', '7432147526571', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(919, NULL, '', '7432147526588', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(920, NULL, '', '7432147526595', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(921, NULL, '', '7432147626608', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(922, NULL, '', '7432147626615', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(923, NULL, '', '7432147626622', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(924, NULL, '', '7432147626639', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(925, NULL, '', '7432147626646', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(926, NULL, '', '7432147626653', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(927, NULL, '', '7432147626660', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(928, NULL, '', '7432147626677', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(929, NULL, '', '7432147626684', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(930, NULL, '', '7432147626691', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(931, NULL, '', '7432147726704', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(932, NULL, '', '7432147726711', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(933, NULL, '', '7432147726728', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(934, NULL, '', '7432147726735', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(935, NULL, '', '7432147726742', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(936, NULL, '', '7432147726759', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(937, NULL, '', '7432147726766', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(938, NULL, '', '7432147726773', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(939, NULL, '', '7432147726780', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(940, NULL, '', '7432147726797', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(941, NULL, '', '7432147826800', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(942, NULL, '', '7432147826817', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(943, NULL, '', '7432147826824', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(944, NULL, '', '7432147826831', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(945, NULL, '', '7432147826848', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(946, NULL, '', '7432147826855', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(947, NULL, '', '7432147826862', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(948, NULL, '', '7432147826879', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(949, NULL, '', '7432147826886', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(950, NULL, '', '7432147826893', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(951, NULL, '', '7432147926906', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(952, NULL, '', '7432147926913', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(953, NULL, '', '7432147926920', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(954, NULL, '', '7432147926937', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(955, NULL, '', '7432147926944', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(956, NULL, '', '7432147926951', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(957, NULL, '', '7432147926968', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(958, NULL, '', '7432147926975', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(959, NULL, '', '7432147926982', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(960, NULL, '', '7432147926999', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(961, NULL, '', '7432147027009', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(962, NULL, '', '7432147027016', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(963, NULL, '', '7432147027023', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(964, NULL, '', '7432147027030', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(965, NULL, '', '7432147027047', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(966, NULL, '', '7432147027054', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(967, NULL, '', '7432147027061', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(968, NULL, '', '7432147027078', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(969, NULL, '', '7432147027085', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(970, NULL, '', '7432147027092', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(971, NULL, '', '7432147127105', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(972, NULL, '', '7432147127112', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(973, NULL, '', '7432147127129', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(974, NULL, '', '7432147127136', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(975, NULL, '', '7432147127143', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(976, NULL, '', '7432147127150', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(977, NULL, '', '7432147127167', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(978, NULL, '', '7432147127174', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(979, NULL, '', '7432147127181', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(980, NULL, '', '7432147127198', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(981, NULL, '', '7432147227201', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(982, NULL, '', '7432147227218', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(983, NULL, '', '7432147227225', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(984, NULL, '', '7432147227232', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(985, NULL, '', '7432147227249', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(986, NULL, '', '7432147227256', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(987, NULL, '', '7432147227263', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(988, NULL, '', '7432147227270', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(989, NULL, '', '7432147227287', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(990, NULL, '', '7432147227294', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(991, NULL, '', '7432147327307', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(992, NULL, '', '7432147327314', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(993, NULL, '', '7432147327321', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(994, NULL, '', '7432147327338', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(995, NULL, '', '7432147327345', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(996, NULL, '', '7432147327352', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(997, NULL, '', '7432147327369', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(998, NULL, '', '7432147327376', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(999, NULL, '', '7432147327383', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55'),
(1000, NULL, '', '7432147327390', NULL, NULL, '2019-10-23 11:16:55', '2019-10-23 11:16:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplidor`
--

CREATE TABLE `suplidor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `rnc` int(20) NOT NULL,
  `tipo_suplidor` varchar(50) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
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

INSERT INTO `suplidor` (`id`, `nombre`, `rnc`, `tipo_suplidor`, `direccion`, `contacto_suplidor`, `telefono_1`, `telefono_2`, `celular`, `email`, `terminos_de_pago`, `nota`, `updated_at`, `created_at`) VALUES
(1, 'Anel', 80953268, 'Material', 'c/ no se', 'Gabriel Dominguez', '(809) 288-2113', '(829) 680-4022', '(849) 541-6369', 'anelgabriel002@gmail.com', '30 dias', 'Agregando nota en update', '2019-10-17 18:29:22', '2019-10-02 20:00:40'),
(4, 'Gabriel', 803955656, 'Servicio', 'c/ trina de moya', 'Anel', '(809) 288-2113', '(809) 288-2113', '(829) 528-4022', 'gabriel@gabriel.com', 'Contado', 'Probando', '2019-10-17 18:29:14', '2019-10-10 14:48:05'),
(5, 'Alibaba', 62362644, 'Lavanderia', 'c/ diego tristan, el almirante', 'Waskar', '(809) 528-3600', '(809) 528-2113', NULL, 'fulano@fulano.com', '30 dias', 'test tipo suplidor', '2019-10-17 18:29:01', '2019-10-15 13:04:51'),
(6, 'EBAY', 100002215, 'Material', 'cl no se', 'IDK', '(809) 288-2213', '(211) 111-1___', '(809) 595-55__', 'anelgabriel002@gmail.com', 'Contado', 'test', '2019-10-17 18:28:24', '2019-10-17 16:04:51'),
(7, 'Amazon', 85564665, 'Material', 'San francisco, EEUU', 'Jeff Bezos', '(809) 288-2113', '(809) 288-2113', NULL, 'amazon@amazon.com', 'Contado', 'Suplidor de prueba', '2019-10-17 18:23:18', '2019-10-17 18:23:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tallas`
--

CREATE TABLE `tallas` (
  `id` int(11) NOT NULL,
  `corte_id` int(11) NOT NULL,
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

INSERT INTO `tallas` (`id`, `corte_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `updated_at`, `created_at`) VALUES
(2, 2, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 240, '2019-10-21 19:53:16', '2019-10-21 19:53:16'),
(3, 3, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 600, '2019-10-21 20:00:18', '2019-10-21 20:00:18'),
(6, 6, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 360, '2019-10-21 20:13:09', '2019-10-21 20:13:09'),
(7, 7, 40, 40, 40, 40, 4, 40, 40, 40, 40, 40, 40, 40, 444, '2019-10-21 20:15:38', '2019-10-21 20:15:38'),
(8, 8, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, 600, '2019-10-21 20:23:56', '2019-10-21 20:23:56'),
(9, 9, 50, 50, 30, 100, 50, 30, 40, 50, 30, 10, 50, 30, 520, '2019-10-24 17:58:01', '2019-10-24 17:58:01'),
(10, 10, 1, 2, 3, 6, 5, 8, 7, 4, 4, 7, 4, 7, 58, '2019-10-29 17:25:29', '2019-10-29 17:25:29'),
(11, 11, 50, 50, 50, 40, 40, 40, 60, 40, 40, 40, 40, 50, 540, '2019-10-29 17:30:41', '2019-10-29 17:30:41'),
(12, 12, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 120, '2019-10-29 17:32:56', '2019-10-29 17:32:56'),
(13, 13, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 20, 240, '2019-10-29 17:43:35', '2019-10-29 17:43:35'),
(14, 14, 50, 50, 50, 50, 50, 50, 50, 50, 50, 50, NULL, NULL, 500, '2019-11-12 17:50:32', '2019-11-12 17:50:32'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2019-11-14 18:50:50', '2019-11-14 18:50:50'),
(16, 16, 10, 1, 0, 10, 10, 1, 1, 0, 1, 0, 1, 0, 35, '2019-11-20 15:55:29', '2019-11-20 15:55:29');

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

--
-- Volcado de datos para la tabla `tallas_perdidas`
--

INSERT INTO `tallas_perdidas` (`id`, `perdida_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `talla_x`, `updated_at`, `created_at`) VALUES
(1, 10, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2019-11-01 20:51:16', '2019-10-30 19:03:22'),
(2, 11, 1, NULL, 2, NULL, NULL, NULL, 2, NULL, NULL, NULL, 2, NULL, 0, 3, '2019-11-08 17:16:40', '2019-11-08 17:16:40'),
(3, 12, NULL, 2, NULL, NULL, 3, NULL, NULL, NULL, 2, NULL, NULL, 1, 0, 3, '2019-11-08 17:19:39', '2019-11-08 17:19:39'),
(4, 13, 1, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 1, NULL, 1, 0, 3, '2019-11-08 17:21:09', '2019-11-08 17:21:09'),
(5, 14, 1, NULL, 2, NULL, 5, 6, NULL, 2, NULL, 3, NULL, NULL, 19, 3, '2019-11-08 17:22:41', '2019-11-08 17:22:41'),
(6, 16, 2, NULL, 2, NULL, 2, NULL, 2, NULL, 2, NULL, NULL, NULL, 12, 2, '2019-11-08 20:24:11', '2019-11-08 20:24:11'),
(7, 17, 2, NULL, 2, NULL, 2, NULL, 2, NULL, 2, NULL, NULL, NULL, 12, 2, '2019-11-08 20:27:32', '2019-11-08 20:27:32'),
(8, 18, 3, 3, 3, 3, 3, 3, 3, 3, 3, 3, NULL, NULL, 32, 2, '2019-11-13 15:11:51', '2019-11-13 15:11:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tela`
--

CREATE TABLE `tela` (
  `id` int(11) NOT NULL,
  `id_suplidor` int(11) DEFAULT NULL,
  `id_composiciones` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `precio_usd` double DEFAULT NULL,
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

INSERT INTO `tela` (`id`, `id_suplidor`, `id_composiciones`, `id_user`, `referencia`, `precio_usd`, `composicion`, `composicion_2`, `composicion_3`, `composicion_4`, `composicion_5`, `tipo_tela`, `ancho_cortable`, `peso`, `elasticidad_trama`, `elasticidad_urdimbre`, `encogimiento_trama`, `encogimiento_urdimbre`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 1, 'P100-1920', 50, 'Algodon-98.00', 'Poliestemo-02.00', '', '', '', 'Denim', '50.66', 50, '50.22', '50.22', '52.00', '22.22', '2019-10-08 21:44:04', '2019-10-08 17:56:18'),
(2, 1, 1, 1, 'P100-1920', 60, 'Algodon-90.00', 'Poliestemo-10.00', '', '', '', 'Twill', '52.00', 5000, '60.00', '52.00', '30.00', '52.00', '2019-10-10 14:33:59', '2019-10-08 18:00:35'),
(4, 1, 1, 1, 'P100-1920', 60, 'Algodon-90.00', 'Poliestemo-10.00', '', '', '', 'Twill', '30.22', 50, '50.22', '89.66', '50.55', '60.88', '2019-10-10 14:36:19', '2019-10-09 13:09:15'),
(5, 7, 1, 1, 'Marx-23', 30, 'Algodon-50.00', 'Poliestemo-50.00', '', '', '', 'Twill', '60.00', 30, '40.00', '50.00', '60.00', '70.00', '2019-10-21 18:27:01', '2019-10-21 18:27:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `edad` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `telefono`, `celular`, `direccion`, `edad`, `created_at`, `updated_at`) VALUES
(1, 'Anel', 'Dominguez', 'anel@anel.com', '$2y$10$zazXA6f/9vIl3JbiMMC/cO0Sj2DImrVAXUlsIdZcwcd9S/0YVpml6', 'Administrador', NULL, NULL, NULL, NULL, '2019-09-30 14:07:00', '2019-09-30 14:07:00'),
(2, 'Neno', 'Dominguez', 'neno@neno.com', '$2y$10$h/Wtzldj9w/iHqq/dFOH0.mP0O6ASE0et/PvbhWaNUeMKYzA0GbEa', 'Administrador', '(809) 288-2113', '(829) 943-2111', 'c/ primera', '22', '2019-09-30 17:27:20', '2019-10-01 19:11:13'),
(3, 'Manuel', 'Galvan', 'cristobal@cristobal.com', '$2y$10$gmElAb.gON08XtEpjvQf/eqxIi.zd8e1Tfh/EDyhXAmCupfd00rYy', 'Administrador', '(809) 288-2113', '(809) 288-2113', 'c/ no se', '22', '2019-09-30 18:03:58', '2019-10-08 12:21:18'),
(4, 'Rosa', 'Duarte', 'rosa@cch.com', '$2y$10$wS5uDVFCKW6.i.ef9O.yseJkuqWaZn6YuDts8nbC/4x9JYSqABQE2', 'Oficina', '(809) 288-2113', '(809) 288-2113', 'c/ no se', '35', '2019-09-30 18:04:13', '2019-10-01 19:00:31'),
(5, 'Sergio', 'Viloria', 'sergio@cch.com', '$2y$10$Llq2nO2dBwXolrVO8HV5kOQDZlRvrfRQ8/6d52CuQ6L23hqGg8Ty.', 'Soporte', '(809) 288-2113', '(809) 288-2113', 'c/ no se', '30', '2019-09-30 18:04:40', '2019-10-01 19:04:57'),
(6, 'Gabriel', 'Garcia', 'gabriel@gabriel.com', '$2y$10$fP6f5XIvLPq3hFyJkHOJIuSpOWDMr6tf7Ro8.C6fSqpHGQilsXGy6', 'General', '(809) 528-2113', '(809) 525-5555', 'c/ primera', '22', '2019-09-30 18:06:49', '2019-10-01 19:05:27'),
(7, 'Ana', 'Garcia', 'ana@ana.com', '$2y$10$.EXWExMe9/CmYMPX.iLrVuSPzKtwU0VsYfoGl/vAbAMiO0eYy0ytm', 'General', '(809) 222-2222', '(808) 888-8484', 'c/ primera', '60', '2019-09-30 19:07:30', '2019-09-30 19:07:30');

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
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `existencias`
--
ALTER TABLE `existencias`
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
-- Indices de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_pedido_id` (`orden_pedido_id`);

--
-- Indices de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `sucursal_id` (`sucursal_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_aprobacion` (`user_aprobacion`);

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
  ADD KEY `talla_id` (`talla_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

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
  ADD KEY `corte_id` (`corte_id`);

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
  ADD KEY `fk_user_tela_idx` (`id_user`),
  ADD KEY `fk_suply_tela_idx` (`id_suplidor`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `composiciones`
--
ALTER TABLE `composiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `sku`
--
ALTER TABLE `sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `suplidor`
--
ALTER TABLE `suplidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Filtros para la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  ADD CONSTRAINT `fk_cliente_sucursales` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `corte`
--
ALTER TABLE `corte`
  ADD CONSTRAINT `corte_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `corte_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `existencias`
--
ALTER TABLE `existencias`
  ADD CONSTRAINT `existencias_ibfk_4` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  ADD CONSTRAINT `lavanderia_ibfk_1` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_2` FOREIGN KEY (`suplidor_id`) REFERENCES `suplidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_3` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lavanderia_ibfk_4` FOREIGN KEY (`id_sku`) REFERENCES `sku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  ADD CONSTRAINT `orden_empaque_ibfk_1` FOREIGN KEY (`orden_pedido_id`) REFERENCES `orden_pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  ADD CONSTRAINT `orden_pedido_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_pedido_ibfk_2` FOREIGN KEY (`sucursal_id`) REFERENCES `cliente_sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_pedido_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_pedido_ibfk_4` FOREIGN KEY (`user_aprobacion`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `perdidas_ibfk_3` FOREIGN KEY (`talla_id`) REFERENCES `tallas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tallas_ibfk_1` FOREIGN KEY (`corte_id`) REFERENCES `corte` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_suply_tela` FOREIGN KEY (`id_suplidor`) REFERENCES `suplidor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_tela` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
