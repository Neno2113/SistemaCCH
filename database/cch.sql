-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2020 a las 13:21:09
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
(11, 13, 64, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2020-02-06 11:56:29', '2020-02-06 11:56:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen_detalle`
--

CREATE TABLE `almacen_detalle` (
  `id` int(11) NOT NULL,
  `almacen_id` int(11) DEFAULT NULL,
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
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `almacen_detalle`
--

INSERT INTO `almacen_detalle` (`id`, `almacen_id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `created_at`, `updated_at`) VALUES
(92, 11, 64, 0, 0, 50, 50, 50, 50, 50, 50, 50, 50, 0, 0, 400, '2020-02-06 11:55:45', '2020-02-06 11:55:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
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

INSERT INTO `cliente` (`id`, `nombre_cliente`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `rnc`, `contacto_cliente_principal`, `telefono_1`, `telefono_2`, `telefono_3`, `celular_principal`, `email_principal`, `condiciones_credito`, `autorizacion_credito_req`, `notas`, `redistribucion_tallas`, `factura_desglosada_talla`, `acepta_segundas`, `updated_at`, `created_at`) VALUES
(3, 'Plaza Lama', 'Ave. 27 de febrero', 'Piantini', 'Distrito Nacional', 'Churchill', '10100026555', 'Jose', '(829) 943-6531', '(809) 288-2113', NULL, '(809) 288-2113', 'plazalama@lama.com', '60 dias', 1, 'Hii', 1, 0, 0, '2020-01-28 16:36:55', '2020-01-23 13:53:39');

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
(4, 3, '3-52', 'Plaza lama Luperon', '(829) 655-3053', 'av. Luperon', 'Pantoja', 'Santo Domingo', 'Test', '2020-01-28 16:39:55', '2020-01-23 13:54:44');

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

INSERT INTO `corte` (`id`, `numero_corte`, `producto_id`, `user_id`, `fecha_corte`, `no_marcada`, `ancho_marcada`, `largo_marcada`, `aprovechamiento`, `fecha_entrega`, `fase`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(7, '2019-1', 39, 1, '2020-01-23', 'st x26', 20, '30', '80.00', '2020-02-14', 'Terminacion', 490, '0.01', '2020-01-27 15:21:16', '2020-01-23 14:04:51'),
(8, '2020-9', 41, 1, '2020-01-23', 'st x27', 46, '12.61', '86.23', '2020-03-04', 'Terminacion', 800, '0.01', '2020-01-27 16:20:28', '2020-01-23 15:55:22'),
(9, '2020-002', 41, 1, '2020-01-29', 'tsx-na3', 20, '30', '90.00', '2020-02-28', 'Terminacion', 620, '0.01', '2020-02-03 16:47:04', '2020-01-29 09:41:50'),
(10, '2019-003', 64, 1, '2020-01-30', 'ajka66v', 30, '20', '60.00', '2020-02-28', 'Terminacion', 800, '0.01', '2020-02-06 13:58:53', '2020-01-30 14:10:05'),
(12, '2019-002', 64, 1, '2020-02-03', 'st x26', 30, '25', '80.00', '2020-03-14', 'Lavanderia', 480, '0.01', '2020-02-04 15:11:52', '2020-02-03 09:37:07'),
(13, '2020-005', 64, 1, '2020-02-04', 'st x27', 20, '30', '90.00', '2020-03-14', 'Almacen', 740, '0.01', '2020-02-06 11:56:29', '2020-02-04 09:07:57');

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
(5, 'Anel', 'Dominguez', NULL, 'primera', 'madre vieja sur', 'San Cristóbal', 'colmado el vecino', '(809) 288-2113', '(829) 943-6531', 'anel@anel.com', '402-2600929-4', 'VENTA', 1, 'VENDEDOR-219 - VENDEDORA', NULL, NULL, 'Fijo', 'Sueldo Fijo', '13000.00', '110.00', 'Banco Popular', '0000120450', 1, '2020-01-23 13:52:10', '2020-01-23 13:47:56');

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
(5, 5, '999452142', 'Fulana', '(809) 288-2113', 1, 2, 1, 'Fulano 1', 1, 'Fulano 2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-23 13:52:10', '2020-01-23 13:52:10');

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
  `orden_facturacion_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_factura` varchar(20) NOT NULL,
  `tipo_factura` varchar(10) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_impresion` datetime DEFAULT NULL,
  `comprobante_fiscal` tinyint(1) NOT NULL,
  `numero_comprobante` varchar(20) DEFAULT NULL,
  `precio_factura` int(11) DEFAULT NULL,
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

INSERT INTO `factura` (`id`, `orden_facturacion_id`, `user_id`, `no_factura`, `tipo_factura`, `fecha`, `fecha_impresion`, `comprobante_fiscal`, `numero_comprobante`, `precio_factura`, `descuento`, `itbis`, `total`, `nota`, `impreso`, `nc_uso`, `sec`, `updated_at`, `created_at`) VALUES
(15, 16, 1, 'IN-00001341', 'IN', '2020-01-24', '2020-01-23 02:14:56', 0, 'B01', NULL, 9, 18, '38656.80', 'test', 1, 0, '0.01', '2020-01-23 14:14:56', '2020-01-23 14:14:39'),
(18, 19, 1, 'B01-00001751', 'B01', '2020-02-05', '2020-01-28 10:58:26', 1, 'B01000032635', NULL, 6, 18, '46586.40', NULL, 1, 1, '0.04', '2020-01-30 18:10:14', '2020-01-28 10:57:44'),
(19, 20, 1, 'B02-000302252', 'B02', '2020-01-29', '2020-01-28 10:59:53', 0, 'B01', NULL, 10, 18, '65047.50', 'test', 1, 0, '0.05', '2020-01-28 10:59:53', '2020-01-28 10:59:40'),
(20, 21, 1, 'DN-03020010', 'DN', '2020-01-28', '2020-01-28 11:09:26', 0, 'B01', NULL, 0, 18, '49560.00', NULL, 1, 0, '0.06', '2020-01-28 11:09:26', '2020-01-28 11:09:10'),
(21, 22, 1, 'B15-00000120', 'B15', '2020-01-30', '2020-01-28 11:13:28', 0, 'B01', NULL, 3, 18, '70106.75', 'test', 1, 0, '0.07', '2020-01-28 11:13:28', '2020-01-28 11:13:22');

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
(25, 'EL-001', 7, 5, 48, 39, '2020-01-23', 'Lavar segun estandar', 200, 200, 200, NULL, 0, 1, 1, 0, 1, '0.01', '2020-01-23 14:05:45', '2020-01-23 14:05:45'),
(26, 'EL-002', 7, 5, 48, 39, '2020-01-23', 'Lavar segun estandar', 290, 290, 490, NULL, 0, 1, 1, 0, 1, '0.02', '2020-01-23 14:06:43', '2020-01-23 14:06:43'),
(27, 'EL-003', 8, 7, 58, 41, '2020-01-23', 'Lavar segun estandar', 400, 400, 400, NULL, 0, 1, 1, 0, 1, '0.03', '2020-01-23 16:46:47', '2020-01-23 16:46:47'),
(28, 'EL-004', 8, 7, 58, 41, '2020-01-23', 'lavar segun estandar', 397, 397, 797, NULL, 0, 1, 1, 0, 1, '0.04', '2020-01-23 17:01:55', '2020-01-23 17:01:55'),
(29, 'EL-005', 9, 7, 58, 41, '2020-01-29', 'Lavar segun eatndar', 720, 720, 720, NULL, 0, 1, 1, 0, 1, '0.05', '2020-01-29 09:42:55', '2020-01-29 09:42:55'),
(30, 'EL-006', 10, 7, 66, 64, '2020-01-30', 'Lavar segun estandar', 400, 400, 400, NULL, 0, 1, 1, 0, 1, '0.06', '2020-01-30 14:19:56', '2020-01-30 14:19:56'),
(31, 'EL-007', 10, 7, 66, 64, '2020-01-30', 'lavar segun estandar', 386, 386, 786, NULL, 0, 1, 1, 0, 1, '0.07', '2020-01-30 14:21:04', '2020-01-30 14:21:04'),
(48, 'EL-008', 9, 7, 58, 41, '2020-02-04', 'Lavar segun estandar', 100, 100, 720, NULL, 100, 1, 1, 0, 1, '0.08', '2020-02-03 16:18:39', '2020-02-03 16:18:39'),
(49, 'EL-009', 9, 7, 58, 41, '2020-02-04', 'Devuletaaaaaa', 100, 100, 720, NULL, 100, 1, 1, 0, 1, '0.09', '2020-02-03 16:20:55', '2020-02-03 16:20:55'),
(50, 'EL-010', 9, 7, 58, 41, '2020-02-03', 'Devolver aaaaaa', 25, 25, 720, NULL, 25, 1, 1, 0, 1, '0.10', '2020-02-03 16:21:44', '2020-02-03 16:21:44'),
(51, 'EL-011', 9, 7, 58, 41, '2020-02-03', 'Devolver Segun estandar', 300, 300, 720, NULL, 300, 1, 1, 0, 1, '0.11', '2020-02-03 16:22:56', '2020-02-03 16:22:56'),
(52, 'EL-012', 9, 7, 58, 41, '2020-02-03', 'devolver a lavanderia', 20, 20, 720, NULL, 20, 1, 1, 0, 1, '0.12', '2020-02-03 16:33:06', '2020-02-03 16:33:06'),
(53, 'EL-013', 9, 7, 58, 41, '2020-02-03', 'Devuelta a lavanderia para lavar de nuevo', 7, 7, 720, NULL, 7, 1, 1, 0, 1, '0.13', '2020-02-03 16:46:00', '2020-02-03 16:46:00'),
(54, 'EL-014', 12, 7, 66, 64, '2020-02-03', 'Lavar segun estandar', 450, 450, 450, NULL, 0, 1, 1, 0, 1, '0.14', '2020-02-03 16:47:48', '2020-02-03 16:47:48'),
(57, 'EL-015', 12, 7, 66, 64, '2020-02-03', 'Devuelta para relavar en lavanderia', 100, 100, 450, NULL, 100, 1, 1, 0, 1, '0.15', '2020-02-03 17:09:27', '2020-02-03 17:09:27'),
(58, 'EL-016', 12, 7, 66, 64, '2020-02-03', 'envio aaaaaaaaaa', 12, 12, 462, NULL, 0, 1, 1, 0, 1, '0.16', '2020-02-03 17:17:47', '2020-02-03 17:17:47'),
(59, 'EL-017', 12, 7, 66, 64, '2020-02-04', 'devuelta para lavar de nuevo en lavanderia', 100, 100, 462, NULL, 100, 1, 1, 0, 1, '0.17', '2020-02-03 17:20:37', '2020-02-03 17:20:37'),
(60, 'EL-018', 12, 7, 66, 64, '2020-02-04', 'Lavar segun estandar', 100, 100, 462, NULL, 100, 1, 1, 0, 1, '0.18', '2020-02-04 08:49:08', '2020-02-04 08:49:08'),
(86, 'EL-019', 13, 7, 66, 64, '2020-02-04', 'Lavar segun estandar', 500, 500, 300, NULL, 0, 1, NULL, NULL, 1, '0.19', '2020-02-04 14:26:23', '2020-02-04 14:25:53'),
(87, 'EL-020', 13, 7, 66, 64, '2020-02-06', 'Lavar segun estandar', 200, 200, 500, NULL, 0, 1, NULL, 1, 1, '0.20', '2020-02-04 14:27:15', '2020-02-04 14:27:15'),
(88, 'EL-021', 13, 7, 66, 64, '2020-02-11', 'Relavar en lavanderia', 100, 100, 500, NULL, 100, 1, 1, NULL, 1, '0.21', '2020-02-04 14:28:35', '2020-02-04 14:28:35'),
(89, 'EL-022', 13, 7, 66, 64, '2020-02-13', 'Lavar segun estandar', 5, 5, 500, NULL, 5, 1, 1, NULL, 1, '0.22', '2020-02-04 14:29:57', '2020-02-04 14:29:57');

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
  `sec` decimal(3,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota_credito_detalle`
--

CREATE TABLE `nota_credito_detalle` (
  `id` int(11) NOT NULL,
  `nota_credito_id` int(11) NOT NULL,
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
(22, 127, 'OE - 001', '2020-01-23 02:13:08', 0, 0, 2, 2, 4, 4, 5, 5, 4, 3, 0, 0, NULL, NULL, '0.01', '2020-01-23 14:13:08', '2020-01-23 14:13:08'),
(27, 132, 'OE - 003', '2020-01-27 08:33:11', 0, 0, 2, 5, 8, 7, 0, 8, 7, 5, 0, 0, NULL, NULL, '0.03', '2020-01-27 08:33:11', '2020-01-27 08:33:11'),
(28, 133, 'OE - 004', '2020-01-27 09:49:32', 0, 0, 1, 3, 5, 5, 0, 4, 4, 2, 0, 0, NULL, NULL, '0.04', '2020-01-27 09:49:32', '2020-01-27 09:49:32'),
(29, 134, 'OE - 005', '2020-01-27 09:50:43', 0, 0, 2, 5, 8, 7, 0, 7, 6, 4, 0, 0, NULL, NULL, '0.05', '2020-01-27 09:50:43', '2020-01-27 09:50:43'),
(30, 135, 'OE - 006', '2020-01-27 10:14:27', 0, 0, 0, 2, 4, 4, 0, 4, 4, 2, 0, 0, NULL, NULL, '0.06', '2020-01-27 10:14:27', '2020-01-27 10:14:27'),
(35, 189, 'OE - 007', '2020-02-06 04:41:47', 0, 0, 5, 5, 5, 5, 5, 5, 5, 5, 0, 0, NULL, NULL, '0.07', '2020-02-06 16:41:47', '2020-02-06 16:41:47');

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
(24, 22, 39, 1, 0, 0, 2, 2, 4, 4, 5, 5, 4, 3, 0, 0, 30, '1200.00', 30, '2020-01-23 02:13:55', 1, 2, 1, '2020-01-23 14:13:56', '2020-01-23 14:13:55'),
(25, 32, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, '2020-01-27 04:52:31', 1, 2, 1, '2020-01-27 16:52:32', '2020-01-27 16:52:31'),
(26, 31, 41, 1, 0, 0, 1, 4, 6, 6, 0, 6, 6, 4, 0, 0, 34, '1750.00', 34, '2020-01-28 10:50:00', 1, 2, 1, '2020-01-28 10:50:01', '2020-01-28 10:50:00'),
(27, 30, 41, 1, 0, 0, 0, 2, 4, 4, 0, 4, 4, 2, 0, 0, 24, '1750.00', 24, '2020-01-28 10:57:00', 1, 1, 1, '2020-01-28 10:57:00', '2020-01-28 10:57:00'),
(28, 29, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, '2020-01-28 10:59:08', 1, 2, 1, '2020-01-28 10:59:08', '2020-01-28 10:59:08'),
(29, 28, 41, 1, 0, 0, 1, 3, 5, 5, 0, 4, 4, 2, 0, 0, 24, '1750.00', 24, '2020-01-28 11:08:45', 1, 1, 1, '2020-01-28 11:08:46', '2020-01-28 11:08:45'),
(30, 27, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, '2020-01-28 11:12:46', 1, 2, 1, '2020-01-28 11:12:47', '2020-01-28 11:12:46'),
(31, 33, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, '2020-01-28 04:10:38', 1, 2, 1, '2020-01-28 16:10:38', '2020-01-28 16:10:38');

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
(16, 22, 1, NULL, 0, '2020-01-23 02:13:58', NULL, 1, '2020-01-23 14:14:56', '2020-01-23 14:13:58'),
(19, 30, 1, NULL, 0, '2020-01-28 10:57:03', NULL, 1, '2020-01-28 10:58:26', '2020-01-28 10:57:03'),
(20, 29, 1, NULL, 0, '2020-01-28 10:59:10', NULL, 1, '2020-01-28 10:59:53', '2020-01-28 10:59:10'),
(21, 28, 1, NULL, 0, '2020-01-28 11:08:48', NULL, 1, '2020-01-28 11:09:26', '2020-01-28 11:08:48'),
(22, 27, 1, NULL, 0, '2020-01-28 11:12:49', NULL, 1, '2020-01-28 11:13:28', '2020-01-28 11:12:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_facturacion_detalle`
--

CREATE TABLE `orden_facturacion_detalle` (
  `id` int(11) NOT NULL,
  `orden_facturacion_id` int(11) NOT NULL,
  `orden_pedido_id` int(11) NOT NULL,
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

INSERT INTO `orden_facturacion_detalle` (`id`, `orden_facturacion_id`, `orden_pedido_id`, `producto_id`, `user_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cant_bultos`, `fecha`, `nota_credito`, `updated_at`, `created_at`) VALUES
(22, 16, 127, 39, 1, 0, 0, 2, 2, 4, 4, 5, 5, 4, 3, 0, 0, 30, '1200.00', 2, '2020-01-23 02:13:56', 0, '2020-01-23 14:13:56', '2020-01-23 14:13:56'),
(23, 17, 160, 41, 1, 0, 0, 0, 3, 6, 5, 0, 6, 5, 3, 0, 0, 28, '1750.00', 2, '2020-01-27 04:52:32', 1, '2020-01-28 16:30:04', '2020-01-27 16:52:32'),
(24, 18, 136, 41, 1, 0, 0, 1, 4, 6, 6, 0, 6, 6, 4, 0, 0, 34, '1750.00', 2, '2020-01-28 10:50:01', 0, '2020-01-28 10:50:01', '2020-01-28 10:50:01'),
(25, 19, 135, 41, 1, 0, 0, 0, 2, 4, 4, 0, 4, 4, 2, 0, 0, 24, '1750.00', 1, '2020-01-28 10:57:00', 0, '2020-01-28 10:57:00', '2020-01-28 10:57:00'),
(26, 20, 134, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 2, '2020-01-28 10:59:08', 0, '2020-01-28 10:59:08', '2020-01-28 10:59:08'),
(27, 21, 133, 41, 1, 0, 0, 1, 3, 5, 5, 0, 4, 4, 2, 0, 0, 24, '1750.00', 1, '2020-01-28 11:08:46', 0, '2020-01-28 11:08:46', '2020-01-28 11:08:46'),
(29, 25, 174, 41, 1, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 2, '2020-01-28 04:10:38', 0, '2020-01-28 16:10:38', '2020-01-28 16:10:38');

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
  `no_orden_pedido` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `fecha_entrega` date NOT NULL,
  `notas` text DEFAULT NULL,
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

INSERT INTO `orden_pedido` (`id`, `user_id`, `user_aprobacion`, `cliente_id`, `sucursal_id`, `vendedor_id`, `no_orden_pedido`, `fecha`, `fecha_entrega`, `notas`, `generado_internamente`, `estado_aprobacion`, `fecha_aprobacion`, `status_orden_pedido`, `precio`, `detallada`, `corte_en_proceso`, `orden_proceso_impresa`, `sec`, `updated_at`, `created_at`) VALUES
(127, 1, 1, 3, 4, 5, 'OP-001', '2020-01-23 02:11:28', '2020-01-29', 'test', 0, NULL, '2020-01-23 02:12:39', 'Despachado', NULL, 1, 'No', 'Si', '0.01', '2020-01-23 14:14:56', '2020-01-23 14:11:28'),
(132, 1, 1, 3, 4, 5, 'OP-003', '2020-01-27 08:29:56', '2020-01-27', NULL, 0, NULL, '2020-01-27 08:32:57', 'Despachado', NULL, 1, 'No', 'Si', '0.03', '2020-01-28 11:13:28', '2020-01-27 08:29:57'),
(133, 1, 1, 3, 4, 5, 'OP-004', '2020-01-27 09:49:00', '2020-01-27', NULL, 0, NULL, '2020-01-27 09:49:25', 'Despachado', NULL, 1, 'No', 'Si', '0.04', '2020-01-28 11:09:26', '2020-01-27 09:49:00'),
(134, 1, 1, 3, 4, 5, 'OP-005', '2020-01-27 09:50:15', '2020-01-27', NULL, 0, NULL, '2020-01-27 09:50:37', 'Despachado', NULL, 1, 'No', 'Si', '0.05', '2020-01-28 10:59:53', '2020-01-27 09:50:15'),
(135, 1, 1, 3, 4, 5, 'OP-006', '2020-01-27 10:13:56', '2020-01-27', NULL, 0, NULL, '2020-01-27 10:14:19', 'Despachado', NULL, 1, 'No', 'Si', '0.06', '2020-01-28 10:58:26', '2020-01-27 10:13:56'),
(189, 1, 1, 3, 4, 5, 'OP-007', '2020-02-06 04:25:48', '2020-02-06', NULL, 0, NULL, '2020-02-06 04:28:42', 'Vigente', NULL, 1, 'No', 'Si', '0.07', '2020-02-06 16:29:02', '2020-02-06 16:25:48');

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
  `precio` decimal(15,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `cant_red` int(11) DEFAULT NULL,
  `orden_redistribuida` tinyint(1) DEFAULT NULL,
  `orden_empacada` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido_detalle`
--

INSERT INTO `orden_pedido_detalle` (`id`, `orden_pedido_id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cantidad`, `cant_red`, `orden_redistribuida`, `orden_empacada`, `updated_at`, `created_at`) VALUES
(102, 127, 39, 0, 0, 2, 2, 4, 4, 5, 5, 4, 3, 0, 0, 30, '1200.00', 30, 30, 1, 1, '2020-01-27 10:54:53', '2020-01-23 14:12:01'),
(107, 132, 41, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, 35, 1, 1, '2020-01-28 11:12:46', '2020-01-27 08:32:39'),
(108, 133, 41, 0, 0, 1, 3, 5, 5, 0, 4, 4, 2, 0, 0, 24, '1750.00', 24, 24, 1, 1, '2020-01-28 11:08:45', '2020-01-27 09:49:14'),
(109, 134, 41, 0, 0, 1, 4, 7, 6, 0, 7, 6, 4, 0, 0, 35, '1750.00', 35, 35, 1, 1, '2020-01-28 10:59:07', '2020-01-27 09:50:26'),
(110, 135, 41, 0, 0, 0, 2, 4, 4, 0, 4, 4, 2, 0, 0, 24, '1750.00', 24, 24, 1, 1, '2020-01-28 10:57:00', '2020-01-27 10:14:08'),
(118, 189, 64, 0, 0, 5, 5, 5, 5, 5, 5, 5, 5, 0, 0, 40, '1750.00', NULL, 40, 1, 0, '2020-02-06 16:29:02', '2020-02-06 16:26:15');

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

--
-- Volcado de datos para la tabla `perdidas`
--

INSERT INTO `perdidas` (`id`, `corte_id`, `producto_id`, `user_id`, `talla_id`, `no_perdida`, `tipo_perdida`, `fecha`, `fase`, `motivo`, `perdida_x`, `sec`, `updated_at`, `created_at`) VALUES
(7, 8, 41, 1, NULL, 'PE-001', 'Normal', '2020-01-23', 'Produccion', 'Error del operador', NULL, '0.01', '2020-01-23 16:26:44', '2020-01-23 16:26:44'),
(8, 8, 41, 1, NULL, 'PE-002', 'Normal', '2020-01-23', 'Procesos secos', 'Extraviado', NULL, '0.02', '2020-01-23 16:27:16', '2020-01-23 16:27:16'),
(10, 8, 41, 1, NULL, 'SE-003', 'Segundas', '2020-01-23', 'Terminacion', 'Error del operador', NULL, '0.03', '2020-01-23 17:12:53', '2020-01-23 17:12:53'),
(12, 10, 64, 1, NULL, 'PE-004', 'Normal', '2020-01-30', 'Produccion', 'Fallo en Dpto.corte', NULL, '0.04', '2020-01-30 14:18:02', '2020-01-30 14:18:02'),
(13, 10, 64, 1, NULL, 'PE-005', 'Normal', '2020-01-30', 'Procesos secos', 'Error del operador', NULL, '0.05', '2020-01-30 14:18:44', '2020-01-30 14:18:44'),
(14, 10, 64, 1, NULL, 'SE-006', 'Segundas', '2020-01-30', 'Terminacion', 'Defecto de tela', NULL, '0.06', '2020-01-30 15:22:20', '2020-01-30 15:22:20'),
(15, 12, 64, 1, NULL, 'PE-007', 'Normal', '2020-02-03', 'Produccion', 'Fallo de la maquina', NULL, '0.07', '2020-02-03 09:51:14', '2020-02-03 09:51:14');

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
(3, 1, 'Dashboard', '2020-01-29 17:05:35', '2020-01-29 17:05:35'),
(4, 1, 'Usuarios', '2020-01-29 17:05:42', '2020-01-29 17:05:42'),
(5, 1, 'Empleados', '2020-01-29 17:05:48', '2020-01-29 17:05:48'),
(6, 1, 'Cliente', '2020-01-29 17:05:55', '2020-01-29 17:05:55'),
(7, 1, 'Sucursales', '2020-01-29 17:06:02', '2020-01-29 17:06:02'),
(8, 1, 'Suplidores', '2020-01-29 17:06:08', '2020-01-29 17:06:08'),
(9, 1, 'Sku', '2020-01-29 17:06:13', '2020-01-29 17:06:13'),
(10, 1, 'Producto', '2020-01-29 17:06:18', '2020-01-29 17:06:18'),
(11, 1, 'Producto Terminado', '2020-01-29 17:06:22', '2020-01-29 17:06:22'),
(12, 1, 'Composicion', '2020-01-29 17:06:27', '2020-01-29 17:06:27'),
(13, 1, 'Telas', '2020-01-29 17:06:31', '2020-01-29 17:06:31'),
(14, 1, 'Corte', '2020-01-29 17:06:36', '2020-01-29 17:06:36'),
(15, 1, 'Lavanderia', '2020-01-29 17:06:42', '2020-01-29 17:06:42'),
(16, 1, 'Recepcion', '2020-01-29 17:06:46', '2020-01-29 17:06:46'),
(17, 1, 'Almacen', '2020-01-29 17:06:51', '2020-01-29 17:06:51'),
(18, 1, 'Perdidas', '2020-01-29 17:06:56', '2020-01-29 17:06:56'),
(19, 1, 'Orden Pedido', '2020-01-29 17:07:02', '2020-01-29 17:07:02'),
(20, 1, 'Aprobacion', '2020-01-29 17:07:06', '2020-01-29 17:07:06'),
(21, 1, 'Ordenes Procesos', '2020-01-29 17:07:10', '2020-01-29 17:07:10'),
(22, 1, 'Imprimir Empaque', '2020-01-29 17:07:15', '2020-01-29 17:07:15'),
(23, 1, 'Reportar Empaque', '2020-01-29 17:07:19', '2020-01-29 17:07:19'),
(24, 1, 'Generar Factura', '2020-01-29 17:07:27', '2020-01-29 17:07:27'),
(25, 1, 'Nota Credito', '2020-01-29 17:07:32', '2020-01-29 17:07:32'),
(26, 1, 'Existencia', '2020-01-29 17:07:38', '2020-01-29 17:07:38'),
(48, 6, 'Lavanderia', '2020-01-30 09:43:04', '2020-01-30 09:43:04'),
(49, 6, 'Almacen', '2020-01-30 09:43:10', '2020-01-30 09:43:10'),
(50, 6, 'Perdidas', '2020-01-30 09:43:14', '2020-01-30 09:43:14'),
(51, 6, 'Orden Pedido', '2020-01-30 09:43:32', '2020-01-30 09:43:32'),
(52, 6, 'Aprobacion', '2020-01-30 09:43:36', '2020-01-30 09:43:36'),
(55, 6, 'Reportar Empaque', '2020-01-30 09:43:50', '2020-01-30 09:43:50'),
(59, 6, 'Corte', '2020-01-30 11:17:20', '2020-01-30 11:17:20'),
(60, 6, 'Recepcion', '2020-01-30 11:39:20', '2020-01-30 11:39:20');

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
  `precio_lista` decimal(15,2) DEFAULT NULL,
  `precio_lista_2` decimal(15,2) DEFAULT NULL,
  `precio_venta_publico` decimal(15,2) DEFAULT NULL,
  `precio_venta_publico_2` decimal(15,2) DEFAULT NULL,
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
(39, 1, NULL, 'M202-2001', NULL, 'Pant. Mujer Moda', NULL, 'a-1', '1579803029jean_frontal.jpg', '1579803029jean_trasera.jpg', '1579803029eclipse-solar-avion-national-04072019in5.jpg', '15798030292589018171f934247c228119079fbc4b.jpg', 'Dark Stone Suave', 'Alto contraste', 'Parcho', 'Bordado', 'Roto', '980.00', NULL, '1200.00', NULL, 1, 1, '0.1', '2020-01-23 14:10:34', '2020-01-23 13:56:48'),
(41, 1, NULL, 'M206-2003', NULL, 'Pantalon Dama Talle Alto', NULL, 'a-1', '1580308132persona-5-review-style-first-10-1280x720.jpg', '15803081321575388275_145305_1575388338_noticia_normal.jpg', '1580308132hipertextual-estas-son-imagenes-que-se-juegan-premio-mejor-astrofotografo-ano-2019530966.jpg', '15803081322589018171f934247c228119079fbc4b.jpg', 'Crudo o Puro', 'Alto contraste', 'Parcho', 'Parcho', 'Parcho', '980.00', NULL, '1750.00', NULL, 1, 1, '0.3', '2020-01-29 10:28:52', '2020-01-23 15:34:51'),
(64, 1, NULL, 'M206-2006', NULL, 'Pant. Dama Talle Alto', NULL, 'A-2', '1581011877persona-5-review-style-first-10-1280x720.jpg', '15810118771575388275_145305_1575388338_noticia_normal.jpg', '158101187700351523-03.jpg', '15810118772589018171f934247c228119079fbc4b.jpg', 'Crudo o Puro', 'Intermedio', 'Bordado', 'Parcho', 'Parcho', '980.00', NULL, '1750.00', NULL, 1, 1, '0.1', '2020-02-06 13:57:57', '2020-01-30 13:59:30'),
(65, 1, NULL, 'M103-2003', NULL, 'Panta', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '980.00', NULL, '1750.00', NULL, 0, NULL, '0.1', '2020-01-31 09:40:30', '2020-01-31 09:39:53'),
(66, 1, NULL, 'M212-2004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '0.1', '2020-01-31 10:17:08', '2020-01-31 10:17:08');

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
(36, 'RE-001', '00010100', 7, NULL, '2020-01-23', 400, 400, NULL, 90, 1, NULL, '0.01', '2020-01-23 14:07:25', '2020-01-23 14:07:25'),
(37, 'RE-002', '0002201', 7, NULL, '2020-01-23', 90, 490, NULL, 0, 1, NULL, '0.02', '2020-01-23 14:07:47', '2020-01-23 14:07:47'),
(38, 'RE-003', '00011214', 8, NULL, '2020-01-23', 200, 200, NULL, 597, 1, NULL, '0.03', '2020-01-23 17:04:30', '2020-01-23 17:04:30'),
(39, 'RE-004', '00012254', 8, NULL, '2020-01-23', 200, 400, NULL, 397, 1, NULL, '0.04', '2020-01-23 17:04:49', '2020-01-23 17:04:49'),
(40, 'RE-005', '0001204', 8, NULL, '2020-01-23', 200, 600, NULL, 197, 1, NULL, '0.05', '2020-01-23 17:05:05', '2020-01-23 17:05:05'),
(41, 'RE-006', '0001245', 8, NULL, '2020-01-23', 197, 797, NULL, 0, 1, NULL, '0.06', '2020-01-23 17:05:47', '2020-01-23 17:05:47'),
(42, 'RE-007', '000102012', 9, NULL, '2020-01-30', 620, 620, NULL, 100, 1, NULL, '0.07', '2020-02-03 16:18:39', '2020-01-29 09:43:40'),
(43, 'RE-008', '0000021', 10, NULL, '2020-01-30', 300, 300, NULL, 486, 1, NULL, '0.08', '2020-01-30 14:28:53', '2020-01-30 14:28:53'),
(44, 'RE-009', '0002015', 10, NULL, '2020-01-30', 300, 600, NULL, 186, 1, NULL, '0.09', '2020-01-30 14:29:49', '2020-01-30 14:29:49'),
(45, 'RE-010', '0002', 10, NULL, '2020-01-30', 176, 776, NULL, 10, 1, NULL, '0.10', '2020-01-30 14:30:32', '2020-01-30 14:30:32'),
(46, 'RE-011', '11122222', 10, NULL, '2020-01-30', 1, 777, NULL, 9, 1, NULL, '0.11', '2020-01-30 15:25:41', '2020-01-30 15:25:41'),
(51, 'RE-012', '0002121', 9, NULL, '2020-02-04', 0, 620, NULL, 100, 1, NULL, '0.12', '2020-02-03 16:20:55', '2020-02-03 16:20:18'),
(52, 'RE-013', '00001212', 9, NULL, '2020-02-03', 75, 695, NULL, 25, 1, NULL, '0.13', '2020-02-03 16:21:44', '2020-02-03 16:21:18'),
(53, 'RE-014', '0002112', 9, NULL, '2020-02-03', -275, 420, NULL, 300, 1, NULL, '0.14', '2020-02-03 16:22:56', '2020-02-03 16:22:15'),
(54, 'RE-015', '0000111', 9, NULL, '2020-02-03', 150, 570, NULL, 150, 1, NULL, '0.15', '2020-02-03 16:26:21', '2020-02-03 16:26:21'),
(55, 'RE-016', '000022', 9, NULL, '2020-02-03', 100, 670, NULL, 50, 1, NULL, '0.16', '2020-02-03 16:26:40', '2020-02-03 16:26:40'),
(56, 'RE-017', '0000212', 9, NULL, '2020-02-03', 30, 700, NULL, 20, 1, NULL, '0.17', '2020-02-03 16:33:06', '2020-02-03 16:26:59'),
(57, 'RE-018', '000000', 9, NULL, '2020-02-03', 13, 713, NULL, 7, 1, NULL, '0.18', '2020-02-03 16:46:00', '2020-02-03 16:33:30'),
(58, 'RE-019', '00021212', 9, NULL, '2020-02-03', 7, 720, NULL, 0, 1, NULL, '0.19', '2020-02-03 16:47:04', '2020-02-03 16:47:04'),
(61, 'RE-020', '0000001211', 12, NULL, '2020-02-03', 300, 300, NULL, 150, 1, NULL, '0.20', '2020-02-03 17:09:27', '2020-02-03 17:08:35'),
(62, 'RE-021', '00002121', 12, NULL, '2020-02-04', 150, 450, NULL, 0, 1, NULL, '0.21', '2020-02-03 17:16:00', '2020-02-03 17:16:00'),
(63, 'RE-022', '0002112', 12, NULL, '2020-02-03', -88, 362, NULL, 100, 1, NULL, '0.22', '2020-02-03 17:20:37', '2020-02-03 17:19:52'),
(64, 'RE-023', '0000111', 12, NULL, '2020-02-03', 50, 412, NULL, 50, 1, NULL, '0.23', '2020-02-03 17:21:28', '2020-02-03 17:21:28'),
(65, 'RE-024', '0000001111', 12, NULL, '2020-02-03', 40, 452, NULL, 10, 1, NULL, '0.24', '2020-02-03 17:30:46', '2020-02-03 17:30:46'),
(66, 'RE-025', '023330200', 12, NULL, '2020-02-03', 0, 452, NULL, 10, 1, NULL, '0.25', '2020-02-04 08:45:56', '2020-02-03 17:31:29'),
(67, 'RE-026', '00012212', 12, NULL, '2020-02-04', 5, 457, NULL, 5, 1, NULL, '0.26', '2020-02-04 08:45:56', '2020-02-04 08:45:56'),
(68, 'RE-027', '00020112', 12, NULL, '2020-02-04', 100, 557, NULL, 5, 1, NULL, '0.27', '2020-02-04 08:51:20', '2020-02-04 08:51:20'),
(69, 'RE-028', '00202010', 12, NULL, '2020-02-04', 5, -99438, NULL, 100000, 1, NULL, '0.28', '2020-02-04 15:20:12', '2020-02-04 08:52:07'),
(91, 'RE-029', '0003301', 13, NULL, '2020-02-05', 200, 0, 200, 300, 1, 1, '0.29', '2020-02-04 14:26:23', '2020-02-04 14:26:23'),
(92, 'RE-030', '0034200', 13, NULL, '2020-02-07', 500, 400, NULL, 100, 1, NULL, '0.30', '2020-02-04 14:28:35', '2020-02-04 14:27:41'),
(93, 'RE-031', '002141', 13, NULL, '2020-02-12', 100, 495, NULL, 5, 1, NULL, '0.31', '2020-02-04 14:29:57', '2020-02-04 14:29:20'),
(94, 'RE-032', '00311400', 13, NULL, '2020-02-14', 5, 500, NULL, 0, 1, NULL, '0.32', '2020-02-04 14:30:37', '2020-02-04 14:30:37');

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
(19, 1, 5, 2, 'B-815', 'T-15', '0102222', '2020-01-23', 30, '2019-1', '2020-01-27 16:23:10', '2020-01-23 14:00:51'),
(20, 1, 6, 3, '10', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-003', '2020-01-30 14:09:31', '2020-01-23 14:44:14'),
(21, 1, 6, 3, '11', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 120.3, '2019-003', '2020-01-30 14:09:08', '2020-01-23 14:44:27'),
(22, 1, 6, 3, '12', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-003', '2020-01-30 14:09:21', '2020-01-23 14:44:40'),
(23, 1, 6, 3, '16', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 156.39, '2020-005', '2020-02-04 09:07:25', '2020-01-23 14:44:51'),
(24, 1, 6, 3, '17', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-002', '2020-02-03 09:04:50', '2020-01-23 14:45:21'),
(25, 1, 6, 3, '18', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '', '2020-02-03 08:48:33', '2020-01-23 14:45:42'),
(26, 1, 6, 3, '19', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 45.93, '2020-9', '2020-01-23 15:52:36', '2020-01-23 14:48:16'),
(27, 1, 6, 3, '20', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 56.87, '', '2020-02-03 08:47:32', '2020-01-23 14:48:32'),
(28, 1, 6, 3, '21', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 78.74, '2020-9', '2020-01-23 15:52:15', '2020-01-23 14:48:46'),
(29, 1, 6, 3, '13', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-003', '2020-01-30 14:09:29', '2020-01-23 14:49:57'),
(30, 1, 6, 3, '14', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2020-005', '2020-02-04 09:07:28', '2020-01-23 14:50:27'),
(31, 1, 6, 3, '15', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-003', '2020-01-30 14:09:19', '2020-01-23 14:52:02'),
(32, 1, 6, 3, '1', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 166.23, '2019-006', '2020-01-24 10:30:12', '2020-01-23 14:52:29'),
(33, 1, 6, 3, '2', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 130.14, '2020-002', '2020-01-29 09:40:28', '2020-01-23 14:52:43'),
(34, 1, 6, 3, '9', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 106.08, '2020-9', '2020-01-23 15:52:43', '2020-01-23 14:53:14'),
(35, 1, 6, 3, '3', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2020-9', '2020-01-23 15:52:48', '2020-01-23 14:53:27'),
(36, 1, 6, 3, '4', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.1, '2019-001', '2020-01-24 11:58:45', '2020-01-23 14:55:16'),
(37, 1, 6, 3, '5', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2020-9', '2020-01-23 15:52:31', '2020-01-23 14:56:01'),
(38, 1, 6, 3, '6', '44', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-003', '2020-01-30 14:09:24', '2020-01-23 14:56:18'),
(39, 1, 6, 3, '7', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-002', '2020-02-03 09:36:44', '2020-01-23 14:56:32'),
(40, 1, 6, 3, '8', '43', 'AFGI/EXP/0162/19-20', '2020-01-23', 164.04, '2019-002', '2020-02-03 09:36:41', '2020-01-23 14:56:47');

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
(48, 39, 'M202-2001', '7432147817877', 'General', 1, '2019-12-24 10:53:40', '2020-01-23 13:56:53'),
(49, 39, 'M202-2001', '7432147817884', 'A', 1, '2019-12-24 10:53:40', '2020-01-23 13:56:55'),
(50, 39, 'M202-2001', '7432147817891', 'C', 1, '2019-12-24 10:53:40', '2020-01-23 13:56:58'),
(51, 39, 'M202-2001', '7432147917904', 'D', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:00'),
(52, 39, 'M202-2001', '7432147917911', 'E', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:02'),
(53, 39, 'M202-2001', '7432147917928', 'F', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:04'),
(54, 39, 'M202-2001', '7432147917935', 'G', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:06'),
(55, 39, 'M202-2001', '7432147917942', 'H', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:08'),
(56, 39, 'M202-2001', '7432147917959', 'I', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:12'),
(57, 39, 'M202-2001', '7432147917966', 'J', 1, '2019-12-24 10:53:40', '2020-01-23 13:57:16'),
(58, 41, 'M206-2003', '7432147917973', 'General', 1, '2019-12-24 10:53:40', '2020-01-23 15:36:48'),
(59, 41, 'M206-2003', '7432147917980', 'C', 1, '2019-12-24 10:53:40', '2020-01-23 15:42:58'),
(60, 41, 'M206-2003', '7432147917997', 'D', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:01'),
(61, 41, 'M206-2003', '7432147018007', 'E', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:03'),
(62, 41, 'M206-2003', '7432147018014', 'F', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:05'),
(63, 41, 'M206-2003', '7432147018021', 'G', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:07'),
(64, 41, 'M206-2003', '7432147018038', 'H', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:09'),
(65, 41, 'M206-2003', '7432147018045', 'I', 1, '2019-12-24 10:53:40', '2020-01-23 15:43:11'),
(66, 64, 'M206-2006', '7432147018052', 'General', 1, '2019-12-24 10:53:40', '2020-01-30 14:03:23'),
(67, 64, 'M206-2006', '7432147018069', 'C', 1, '2019-12-24 10:53:40', '2020-01-30 14:06:50'),
(68, 64, 'M206-2006', '7432147018076', 'D', 1, '2019-12-24 10:53:40', '2020-01-30 14:06:53'),
(69, 64, 'M206-2006', '7432147018083', 'E', 1, '2019-12-24 10:53:40', '2020-01-30 14:06:55'),
(70, 64, 'M206-2006', '7432147018090', 'F', 1, '2019-12-24 10:53:40', '2020-01-30 14:06:56'),
(71, 64, 'M206-2006', '7432147118103', 'G', 1, '2019-12-24 10:53:40', '2020-01-30 14:06:58'),
(72, 64, 'M206-2006', '7432147118110', 'H', 1, '2019-12-24 10:53:40', '2020-01-30 14:07:00'),
(73, 64, 'M206-2006', '7432147118127', 'I', 1, '2019-12-24 10:53:40', '2020-01-30 14:07:02'),
(74, 64, 'M206-2006', '7432147118134', 'J', 1, '2019-12-24 10:53:40', '2020-01-30 14:07:04'),
(75, 65, 'M103-2003', '7432147118141', 'General', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:03'),
(76, 65, 'M103-2003', '7432147118158', 'B', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:05'),
(77, 65, 'M103-2003', '7432147118165', 'D', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:07'),
(78, 65, 'M103-2003', '7432147118172', 'C', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:09'),
(79, 65, 'M103-2003', '7432147118189', 'E', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:11'),
(80, 65, 'M103-2003', '7432147118196', 'G', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:13'),
(81, 65, 'M103-2003', '7432147218209', 'F', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:15'),
(82, 65, 'M103-2003', '7432147218216', 'H', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:17'),
(83, 65, 'M103-2003', '7432147218223', 'I', 1, '2019-12-24 10:53:40', '2020-01-31 09:40:18'),
(84, NULL, NULL, '7432147218230', 'General', 1, '2019-12-24 10:53:40', '2020-01-31 16:49:24'),
(85, NULL, NULL, '7432147218247', 'A', 1, '2019-12-24 10:53:40', '2020-01-31 16:49:30'),
(86, NULL, NULL, '7432147218254', 'C', 1, '2019-12-24 10:53:40', '2020-01-31 16:49:33'),
(87, NULL, NULL, '7432147218261', 'General', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:03'),
(88, NULL, NULL, '7432147218278', 'C', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:05'),
(89, NULL, NULL, '7432147218285', 'D', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:08'),
(90, NULL, NULL, '7432147218292', 'F', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:10'),
(91, NULL, NULL, '7432147318305', 'G', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:12'),
(92, NULL, NULL, '7432147318312', 'H', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:15'),
(93, NULL, NULL, '7432147318329', 'J', 1, '2019-12-24 10:53:40', '2020-01-31 16:50:18'),
(94, NULL, NULL, '7432147318336', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(95, NULL, NULL, '7432147318343', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(96, NULL, NULL, '7432147318350', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(97, NULL, NULL, '7432147318367', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(98, NULL, NULL, '7432147318374', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(99, NULL, NULL, '7432147318381', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(100, NULL, NULL, '7432147318398', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(101, NULL, NULL, '7432147418401', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(102, NULL, NULL, '7432147418418', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(103, NULL, NULL, '7432147418425', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(104, NULL, NULL, '7432147418432', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(105, NULL, NULL, '7432147418449', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(106, NULL, NULL, '7432147418456', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(107, NULL, NULL, '7432147418463', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(108, NULL, NULL, '7432147418470', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(109, NULL, NULL, '7432147418487', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(110, NULL, NULL, '7432147418494', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(111, NULL, NULL, '7432147518507', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(112, NULL, NULL, '7432147518514', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(113, NULL, NULL, '7432147518521', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(114, NULL, NULL, '7432147518538', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(115, NULL, NULL, '7432147518545', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(116, NULL, NULL, '7432147518552', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(117, NULL, NULL, '7432147518569', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(118, NULL, NULL, '7432147518576', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(119, NULL, NULL, '7432147518583', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(120, NULL, NULL, '7432147518590', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(121, NULL, NULL, '7432147618603', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(122, NULL, NULL, '7432147618610', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(123, NULL, NULL, '7432147618627', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(124, NULL, NULL, '7432147618634', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(125, NULL, NULL, '7432147618641', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(126, NULL, NULL, '7432147618658', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(127, NULL, NULL, '7432147618665', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(128, NULL, NULL, '7432147618672', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(129, NULL, NULL, '7432147618689', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(130, NULL, NULL, '7432147618696', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(131, NULL, NULL, '7432147718709', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(132, NULL, NULL, '7432147718716', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(133, NULL, NULL, '7432147718723', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(134, NULL, NULL, '7432147718730', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(135, NULL, NULL, '7432147718747', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(136, NULL, NULL, '7432147718754', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(137, NULL, NULL, '7432147718761', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(138, NULL, NULL, '7432147718778', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(139, NULL, NULL, '7432147718785', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(140, NULL, NULL, '7432147718792', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(141, NULL, NULL, '7432147818805', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(142, NULL, NULL, '7432147818812', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(143, NULL, NULL, '7432147818829', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(144, NULL, NULL, '7432147818836', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(145, NULL, NULL, '7432147818843', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(146, NULL, NULL, '7432147818850', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(147, NULL, NULL, '7432147818867', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(148, NULL, NULL, '7432147818874', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(149, NULL, NULL, '7432147818881', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(150, NULL, NULL, '7432147818898', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(151, NULL, NULL, '7432147918901', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(152, NULL, NULL, '7432147918918', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(153, NULL, NULL, '7432147918925', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(154, NULL, NULL, '7432147918932', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(155, NULL, NULL, '7432147918949', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(156, NULL, NULL, '7432147918956', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(157, NULL, NULL, '7432147918963', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(158, NULL, NULL, '7432147918970', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(159, NULL, NULL, '7432147918987', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(160, NULL, NULL, '7432147918994', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(161, NULL, NULL, '7432147019004', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(162, NULL, NULL, '7432147019011', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(163, NULL, NULL, '7432147019028', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(164, NULL, NULL, '7432147019035', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(165, NULL, NULL, '7432147019042', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(166, NULL, NULL, '7432147019059', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(167, NULL, NULL, '7432147019066', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(168, NULL, NULL, '7432147019073', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(169, NULL, NULL, '7432147019080', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(170, NULL, NULL, '7432147019097', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(171, NULL, NULL, '7432147119100', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(172, NULL, NULL, '7432147119117', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(173, NULL, NULL, '7432147119124', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(174, NULL, NULL, '7432147119131', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(175, NULL, NULL, '7432147119148', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(176, NULL, NULL, '7432147119155', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(177, NULL, NULL, '7432147119162', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(178, NULL, NULL, '7432147119179', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(179, NULL, NULL, '7432147119186', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(180, NULL, NULL, '7432147119193', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(181, NULL, NULL, '7432147219206', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(182, NULL, NULL, '7432147219213', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(183, NULL, NULL, '7432147219220', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(184, NULL, NULL, '7432147219237', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(185, NULL, NULL, '7432147219244', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(186, NULL, NULL, '7432147219251', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(187, NULL, NULL, '7432147219268', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(188, NULL, NULL, '7432147219275', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(189, NULL, NULL, '7432147219282', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(190, NULL, NULL, '7432147219299', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(191, NULL, NULL, '7432147319302', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(192, NULL, NULL, '7432147319319', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(193, NULL, NULL, '7432147319326', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(194, NULL, NULL, '7432147319333', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(195, NULL, NULL, '7432147319340', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(196, NULL, NULL, '7432147319357', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(197, NULL, NULL, '7432147319364', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(198, NULL, NULL, '7432147319371', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(199, NULL, NULL, '7432147319388', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(200, NULL, NULL, '7432147319395', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(201, NULL, NULL, '7432147419408', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(202, NULL, NULL, '7432147419415', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(203, NULL, NULL, '7432147419422', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(204, NULL, NULL, '7432147419439', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(205, NULL, NULL, '7432147419446', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(206, NULL, NULL, '7432147419453', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(207, NULL, NULL, '7432147419460', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(208, NULL, NULL, '7432147419477', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(209, NULL, NULL, '7432147419484', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(210, NULL, NULL, '7432147419491', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(211, NULL, NULL, '7432147519504', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(212, NULL, NULL, '7432147519511', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(213, NULL, NULL, '7432147519528', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(214, NULL, NULL, '7432147519535', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(215, NULL, NULL, '7432147519542', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(216, NULL, NULL, '7432147519559', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(217, NULL, NULL, '7432147519566', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(218, NULL, NULL, '7432147519573', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(219, NULL, NULL, '7432147519580', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(220, NULL, NULL, '7432147519597', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(221, NULL, NULL, '7432147619600', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(222, NULL, NULL, '7432147619617', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(223, NULL, NULL, '7432147619624', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(224, NULL, NULL, '7432147619631', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(225, NULL, NULL, '7432147619648', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(226, NULL, NULL, '7432147619655', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(227, NULL, NULL, '7432147619662', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(228, NULL, NULL, '7432147619679', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(229, NULL, NULL, '7432147619686', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(230, NULL, NULL, '7432147619693', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(231, NULL, NULL, '7432147719706', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(232, NULL, NULL, '7432147719713', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(233, NULL, NULL, '7432147719720', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(234, NULL, NULL, '7432147719737', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(235, NULL, NULL, '7432147719744', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(236, NULL, NULL, '7432147719751', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(237, NULL, NULL, '7432147719768', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(238, NULL, NULL, '7432147719775', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(239, NULL, NULL, '7432147719782', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(240, NULL, NULL, '7432147719799', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(241, NULL, NULL, '7432147819802', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(242, NULL, NULL, '7432147819819', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(243, NULL, NULL, '7432147819826', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(244, NULL, NULL, '7432147819833', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(245, NULL, NULL, '7432147819840', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(246, NULL, NULL, '7432147819857', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(247, NULL, NULL, '7432147819864', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(248, NULL, NULL, '7432147819871', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(249, NULL, NULL, '7432147819888', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(250, NULL, NULL, '7432147819895', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(251, NULL, NULL, '7432147919908', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(252, NULL, NULL, '7432147919915', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(253, NULL, NULL, '7432147919922', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(254, NULL, NULL, '7432147919939', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(255, NULL, NULL, '7432147919946', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(256, NULL, NULL, '7432147919953', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(257, NULL, NULL, '7432147919960', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(258, NULL, NULL, '7432147919977', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(259, NULL, NULL, '7432147919984', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(260, NULL, NULL, '7432147919991', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(261, NULL, NULL, '7432147020000', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(262, NULL, NULL, '7432147020017', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(263, NULL, NULL, '7432147020024', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(264, NULL, NULL, '7432147020031', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(265, NULL, NULL, '7432147020048', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(266, NULL, NULL, '7432147020055', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(267, NULL, NULL, '7432147020062', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(268, NULL, NULL, '7432147020079', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(269, NULL, NULL, '7432147020086', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(270, NULL, NULL, '7432147020093', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(271, NULL, NULL, '7432147120106', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(272, NULL, NULL, '7432147120113', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(273, NULL, NULL, '7432147120120', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(274, NULL, NULL, '7432147120137', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(275, NULL, NULL, '7432147120144', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(276, NULL, NULL, '7432147120151', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(277, NULL, NULL, '7432147120168', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(278, NULL, NULL, '7432147120175', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(279, NULL, NULL, '7432147120182', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(280, NULL, NULL, '7432147120199', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(281, NULL, NULL, '7432147220202', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(282, NULL, NULL, '7432147220219', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(283, NULL, NULL, '7432147220226', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(284, NULL, NULL, '7432147220233', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(285, NULL, NULL, '7432147220240', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(286, NULL, NULL, '7432147220257', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(287, NULL, NULL, '7432147220264', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(288, NULL, NULL, '7432147220271', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(289, NULL, NULL, '7432147220288', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(290, NULL, NULL, '7432147220295', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(291, NULL, NULL, '7432147320308', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(292, NULL, NULL, '7432147320315', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(293, NULL, NULL, '7432147320322', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(294, NULL, NULL, '7432147320339', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(295, NULL, NULL, '7432147320346', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(296, NULL, NULL, '7432147320353', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(297, NULL, NULL, '7432147320360', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(298, NULL, NULL, '7432147320377', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(299, NULL, NULL, '7432147320384', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(300, NULL, NULL, '7432147320391', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(301, NULL, NULL, '7432147420404', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(302, NULL, NULL, '7432147420411', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(303, NULL, NULL, '7432147420428', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(304, NULL, NULL, '7432147420435', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(305, NULL, NULL, '7432147420442', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(306, NULL, NULL, '7432147420459', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(307, NULL, NULL, '7432147420466', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(308, NULL, NULL, '7432147420473', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(309, NULL, NULL, '7432147420480', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(310, NULL, NULL, '7432147420497', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(311, NULL, NULL, '7432147520500', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(312, NULL, NULL, '7432147520517', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(313, NULL, NULL, '7432147520524', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(314, NULL, NULL, '7432147520531', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(315, NULL, NULL, '7432147520548', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(316, NULL, NULL, '7432147520555', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(317, NULL, NULL, '7432147520562', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(318, NULL, NULL, '7432147520579', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(319, NULL, NULL, '7432147520586', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(320, NULL, NULL, '7432147520593', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(321, NULL, NULL, '7432147620606', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(322, NULL, NULL, '7432147620613', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(323, NULL, NULL, '7432147620620', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(324, NULL, NULL, '7432147620637', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(325, NULL, NULL, '7432147620644', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(326, NULL, NULL, '7432147620651', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(327, NULL, NULL, '7432147620668', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(328, NULL, NULL, '7432147620675', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(329, NULL, NULL, '7432147620682', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(330, NULL, NULL, '7432147620699', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(331, NULL, NULL, '7432147720702', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(332, NULL, NULL, '7432147720719', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(333, NULL, NULL, '7432147720726', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(334, NULL, NULL, '7432147720733', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(335, NULL, NULL, '7432147720740', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(336, NULL, NULL, '7432147720757', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(337, NULL, NULL, '7432147720764', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(338, NULL, NULL, '7432147720771', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(339, NULL, NULL, '7432147720788', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(340, NULL, NULL, '7432147720795', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(341, NULL, NULL, '7432147820808', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(342, NULL, NULL, '7432147820815', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(343, NULL, NULL, '7432147820822', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(344, NULL, NULL, '7432147820839', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(345, NULL, NULL, '7432147820846', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(346, NULL, NULL, '7432147820853', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(347, NULL, NULL, '7432147820860', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(348, NULL, NULL, '7432147820877', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(349, NULL, NULL, '7432147820884', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(350, NULL, NULL, '7432147820891', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(351, NULL, NULL, '7432147920904', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(352, NULL, NULL, '7432147920911', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(353, NULL, NULL, '7432147920928', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(354, NULL, NULL, '7432147920935', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(355, NULL, NULL, '7432147920942', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(356, NULL, NULL, '7432147920959', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(357, NULL, NULL, '7432147920966', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
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
(589, NULL, NULL, '7432147223289', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40');
INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
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
(776, NULL, NULL, '7432147125156', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
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

INSERT INTO `suplidor` (`id`, `nombre`, `rnc`, `tipo_suplidor`, `calle`, `sector`, `provincia`, `pais`, `sitios_cercanos`, `contacto_suplidor`, `telefono_1`, `telefono_2`, `celular`, `email`, `terminos_de_pago`, `nota`, `updated_at`, `created_at`) VALUES
(5, 'Textiles Agua Azul SRL', '130664897', 'Material', 'bohechio #33', 'ensanche quizqueya', 'Santo Domingo', 'República Dominicana', NULL, 'Luis Fernandez', '(809) 682-7284', NULL, '(809) 481-4881', 'lfernandez@taa.com.do', '90 dias', NULL, '2020-01-28 16:43:41', '2020-01-23 13:56:11'),
(6, 'Artistic Fabric & Garment Industries LTD', '0102012011', 'Material', 'Deh Landhi,', 'Bn Qasim Twon', 'No pertenece al pais', 'Paquistán', 'Karachi', 'Arslan Bati', '(921) 350-2517', NULL, NULL, 'denimculture@artisticgabricmills.com', '120 dias', 'Suplidor Internacional', '2020-01-28 16:43:09', '2020-01-23 14:29:16'),
(7, 'Industria del Yaque SRL', '102013195', 'Lavanderia', 'ave. circunvalacion #417', 'santiago', 'Santiago', 'República Dominicana', NULL, 'Doris', '(809) 241-5646', NULL, '(829) 904-6602', 'indusriadelyaque@gmail.com', '60 dias', NULL, '2020-01-28 16:43:31', '2020-01-23 16:46:12');

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
(6, 7, 0, 0, 40, 40, 70, 70, 80, 80, 60, 50, 0, 0, 490, '2020-01-27 15:19:04', '2020-01-23 14:04:51'),
(7, 8, 0, 0, 40, 80, 120, 120, 120, 120, 120, 80, 0, 0, 800, '2020-01-23 15:55:22', '2020-01-23 15:55:22'),
(8, 9, 0, 0, 40, 50, 70, 80, 110, 110, 80, 80, 0, 0, 620, '2020-01-29 09:41:50', '2020-01-29 09:41:50'),
(9, 10, 0, 0, 40, 80, 120, 120, 120, 120, 120, 80, 0, 0, 800, '2020-01-30 14:10:05', '2020-01-30 14:10:05'),
(11, 12, 0, 0, 40, 50, 30, 80, 80, 80, 40, 80, 0, 0, 480, '2020-02-03 09:37:07', '2020-02-03 09:37:07'),
(12, 13, 0, 0, 50, 80, 120, 120, 120, 120, 80, 50, 0, 0, 740, '2020-02-04 09:07:57', '2020-02-04 09:07:57');

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
(6, 7, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2020-01-23 16:26:44', '2020-01-23 16:26:44'),
(7, 8, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 2, 0, '2020-01-23 16:27:17', '2020-01-23 16:27:17'),
(11, 12, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2, 0, '2020-01-30 14:18:03', '2020-01-30 14:18:03'),
(12, 13, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 2, 0, '2020-01-30 14:18:44', '2020-01-30 14:18:44'),
(13, 14, 0, 0, 2, 2, 2, 2, 2, 2, 2, 2, 0, 0, 16, 0, '2020-01-30 15:22:21', '2020-01-30 15:22:21'),
(14, 15, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 8, 0, '2020-02-03 09:51:14', '2020-02-03 09:51:14');

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
(3, 6, 1, 1, 'A4-13488', '2.70', 'Algodon-82.00', 'Poliester-16.00', '2-02.00', '', '', 'Denim', '44.00', 8.5, '56.00', '0.00', '0.00', '0.00', '2020-01-29 09:07:08', '2020-01-23 14:41:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `edad` varchar(45) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `permiso_id`, `name`, `surname`, `email`, `password`, `role`, `telefono`, `celular`, `direccion`, `edad`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Anel', 'Dominguez', 'anel@anel.com', '$2y$10$J2IB.7dLUDdmMyYTBgzQCONs8hcnJ7H0JESsX7ejnGtm2bmaXEfnC', 'Administrador', '(809) 288-2113', '(829) 943-6531', 'c/ primera #4, Madre vieja, SC', '23', 'oAKSIIY6XxdoD5k32DDtF7b886BDfXVRit4WlQfwkdIVFkHu1obTRu48Cl1H', '2019-12-24 09:37:56', '2019-12-26 09:18:59'),
(6, 0, 'UserOfi', 'Oficina', 'oficina@cch.com', '$2y$10$LlB19o0yaz4ZKu1c7RCLbuvQt6nZVO3nk1Xt1LbvY1HZdySUckCyu', 'Oficina', '(809) 288-2113', '(809) 211-2022', 'c/ sanchez vieja', '20', NULL, '2020-01-29 11:32:33', '2020-01-29 11:32:33');

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
  ADD KEY `user_id` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `almacen_detalle`
--
ALTER TABLE `almacen_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `composiciones`
--
ALTER TABLE `composiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `empleado_detalle`
--
ALTER TABLE `empleado_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `nota_credito`
--
ALTER TABLE `nota_credito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT de la tabla `nota_credito_detalle`
--
ALTER TABLE `nota_credito_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permiso_usuario`
--
ALTER TABLE `permiso_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `corte_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_suply_tela` FOREIGN KEY (`id_suplidor`) REFERENCES `suplidor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_tela` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
