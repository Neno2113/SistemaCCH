-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-12-2019 a las 14:33:20
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
(3, 24, 1, 1, NULL, 28, 38, 48, 60, 70, 78, 78, 78, 78, 78, 0, 0, 634, 1, '2019-12-23 13:41:17', '2019-12-20 15:59:37'),
(5, 24, 1, 1, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-12-23 14:23:30', '2019-12-20 16:50:25');

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

INSERT INTO `cliente` (`id`, `nombre_cliente`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `rnc`, `contacto_cliente_principal`, `telefono_1`, `telefono_2`, `telefono_3`, `celular_principal`, `email_principal`, `condiciones_credito`, `autorizacion_credito_req`, `notas`, `redistribucion_tallas`, `factura_desglosada_talla`, `acepta_segundas`, `updated_at`, `created_at`) VALUES
(1, 'La Sirena', 'c/ sanchez vieja', 'madre vieja', 'San Cristóbal', 'Liceo Puello Renville', 15432156, 'Rosa', '(809) 341-2113', NULL, NULL, '(809) 288-2113', 'sirena@sirena.com', '60 dias', 1, 'primer cliente, prueba real', 1, 0, 0, '2019-12-18 09:43:09', '2019-12-18 09:43:09');

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
(1, 1, '1-12', 'La sirena San Cristobal', '(809) 288-2113', 'c/ sanchez vieja, San Cristobal', '2019-12-18 09:43:49', '2019-12-18 09:43:49');

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
(1, NULL, 'Algodon', '2019-12-18 09:46:47', '2019-12-18 09:46:47');

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
(24, '2019-001', 1, 1, '2019-12-20', '10', 10, '20', '60.00', '2020-01-28', 'Almacen', 590, '0.01', '2019-12-20 15:59:37', '2019-12-20 11:27:21');

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
  `descuento` int(11) NOT NULL,
  `itbis` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `impreso` tinyint(1) DEFAULT NULL,
  `sec` decimal(3,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `orden_facturacion_id`, `user_id`, `no_factura`, `tipo_factura`, `fecha`, `fecha_impresion`, `comprobante_fiscal`, `numero_comprobante`, `precio_factura`, `descuento`, `itbis`, `total`, `impreso`, `sec`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 'IN-00001751', 'IN', '2019-12-18', '2019-12-18 01:28:19', 1, 'B013000141446', NULL, 10, 18, 38880, 1, '0.01', '2019-12-18 13:28:19', '2019-12-18 11:38:30');

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
(9, 'EL-001', 24, 1, 1, 1, '2019-12-06', 'receta estandar', 390, 200, 200, 1, 1, 1, '0.01', '2019-12-20 11:38:45', '2019-12-20 11:29:27'),
(10, 'EL-002', 24, 1, 1, 1, '2019-12-13', 'Receta de lavado estandar', 290, 300, 500, 1, 1, 1, '0.02', '2019-12-20 11:41:25', '2019-12-20 11:34:17'),
(11, 'EL-003', 24, 1, 1, 1, '2019-12-20', 'Receta estandar', 510, 80, 580, 1, 1, 1, '0.03', '2019-12-20 11:42:26', '2019-12-20 11:36:28');

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
(1, 1, 'OE - 001', '2019-12-18 11:35:13', 1, 2, 3, 3, 4, 4, 4, 4, 3, 2, 0, 0, NULL, NULL, '0.01', '2019-12-18 11:35:13', '2019-12-18 11:35:13'),
(2, 2, 'OE - 002', '2019-12-23 02:23:31', 7, 11, 13, 17, 19, 22, 22, 22, 22, 22, 0, 0, NULL, NULL, '0.02', '2019-12-23 14:23:31', '2019-12-23 14:23:31');

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
  `precio` decimal(4,3) DEFAULT NULL,
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
(1, 1, 1, 1, 1, 2, 3, 3, 4, 4, 4, 4, 3, 2, 0, 0, 30, '1.200', 30, '2019-12-18 11:36:32', 1, 2, 1, '2019-12-18 11:37:20', '2019-12-18 11:36:32'),
(2, 2, 1, 1, 7, 11, 13, 17, 19, 22, 22, 22, 22, 22, 0, 0, 176, '1.200', 176, '2019-12-23 02:30:45', 1, 5, 0, '2019-12-23 14:30:45', '2019-12-23 14:30:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_facturacion`
--

CREATE TABLE `orden_facturacion` (
  `id` int(11) NOT NULL,
  `orden_empaque_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_orden_facturacion` varchar(20) NOT NULL,
  `por_transporte` tinyint(1) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `sec` decimal(3,2) NOT NULL,
  `impreso` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_facturacion`
--

INSERT INTO `orden_facturacion` (`id`, `orden_empaque_id`, `user_id`, `no_orden_facturacion`, `por_transporte`, `fecha`, `sec`, `impreso`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 'OF-001', 1, '2019-12-18 11:37:14', '0.01', NULL, '2019-12-18 11:37:14', '2019-12-18 11:37:14');

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
  `precio` decimal(4,3) DEFAULT NULL,
  `cant_bultos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_facturacion_detalle`
--

INSERT INTO `orden_facturacion_detalle` (`id`, `orden_facturacion_id`, `orden_pedido_id`, `producto_id`, `user_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cant_bultos`, `fecha`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, 2, 3, 3, 4, 4, 4, 4, 3, 2, 0, 0, 30, '1.200', 2, '2019-12-18 11:37:20', '2019-12-18 11:37:20', '2019-12-18 11:37:20');

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
(1, 1, 1, 1, 1, 'OP-001', '2019-12-18 11:33:50', '2019-12-25', 'test', 0, NULL, '2019-12-18 11:34:59', 'Despachado', NULL, 1, 'No', 'Si', '0.01', '2019-12-18 11:38:34', '2019-12-18 11:33:50'),
(2, 1, 1, 1, 1, 'OP-002', '2019-12-23 02:21:11', '2019-12-26', 'test 2', 0, NULL, '2019-12-23 02:24:08', 'Vigente', NULL, 1, 'No', 'Si', '0.02', '2019-12-23 14:24:08', '2019-12-23 14:21:11');

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
  `orden_redistribuida` tinyint(1) DEFAULT NULL,
  `orden_empacada` tinyint(1) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_pedido_detalle`
--

INSERT INTO `orden_pedido_detalle` (`id`, `orden_pedido_id`, `producto_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cantidad`, `cant_red`, `orden_redistribuida`, `orden_empacada`, `updated_at`, `created_at`) VALUES
(1, 1, 1, 1, 2, 3, 3, 4, 4, 4, 4, 3, 2, 0, 0, 30, '1.200', 30, 30, 1, 1, '2019-12-18 11:36:32', '2019-12-18 11:34:19'),
(2, 2, 1, 7, 11, 13, 17, 19, 22, 22, 22, 22, 22, 0, 0, 176, '1.200', NULL, 176, 1, 1, '2019-12-23 14:30:45', '2019-12-23 14:21:48');

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
(1, 1, NULL, 'P102-1901', NULL, 'Pant. Lavish Hombre Moda', NULL, 'a-1', '157687502161LV8e1BQvL.jpg', '1576875021super-smash-bros-ultimate-joker_hi.jpg', '1576875021índice.jpg', '15768750211575388275_145305_1575388338_noticia_normal.jpg', 'Intermedio', 'Intermedio', 'Parcho', 'Roto', 'Dirty', '1.200', NULL, '1.300', NULL, 1, 1, '0.1', '2019-12-20 16:50:21', '2019-12-18 09:57:42'),
(2, 1, NULL, 'M304-1902', 'M304-1903', 'test', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.200', '1.300', '1.300', '1.400', 1, NULL, '0.3', '2019-12-20 11:46:21', '2019-12-20 10:14:02');

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
(7, NULL, 24, 9, '2019-12-13', 200, 200, 390, 1, '2019-12-20 11:38:45', '2019-12-20 11:38:45'),
(8, NULL, 24, 10, '2019-12-20', 300, 500, 90, 1, '2019-12-20 11:41:25', '2019-12-20 11:41:25'),
(9, NULL, 24, 11, '2019-12-20', 90, 590, 0, 1, '2019-12-20 11:42:27', '2019-12-20 11:42:27');

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
(1, 1, 3, 1, 'x-asdhwf', 'idk', '00017325', '2019-12-04', 30, '2019-001', '2019-12-18 10:41:24', '2019-12-18 09:52:03'),
(2, 1, 3, 1, 'x-asdhwf', 'T-15', '51461614651', '2019-12-11', 30, '2019-002', '2019-12-20 11:16:28', '2019-12-18 16:00:59'),
(3, 1, 3, 1, 'M-456', 'black', '32136165465', '2019-12-13', 30, '2019-001', '2019-12-20 11:26:58', '2019-12-20 10:17:45'),
(4, 1, 3, 1, 'B-815', 'white', '32165165', '2019-12-18', 630, '2019-002', '2019-12-20 11:27:46', '2019-12-20 10:35:04'),
(5, 1, 3, 1, 'B-815', 'Smoke', '6514646', '2019-12-25', 30, NULL, '2019-12-20 11:03:36', '2019-12-20 11:03:10');

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
(1, 1, 'P102-1901', '7432147417404', 'General', 1, '2019-12-18 09:54:05', '2019-12-18 09:57:51'),
(2, 1, 'P102-1901', '7432147417411', 'A', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:04'),
(3, 1, 'P102-1901', '7432147417428', 'H', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:08'),
(4, NULL, 'P102-1901', '7432147417435', 'G', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:10'),
(5, 1, 'P102-1901', '7432147417442', 'F', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:13'),
(6, 1, 'P102-1901', '7432147417459', 'E', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:15'),
(7, 1, 'P102-1901', '7432147417466', 'D', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:18'),
(8, 1, 'P102-1901', '7432147417473', 'C', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:19'),
(9, 1, 'P102-1901', '7432147417480', 'B', 1, '2019-12-18 09:54:05', '2019-12-18 09:58:21'),
(10, 2, 'M304-1902', '7432147417497', 'General', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:12'),
(11, 2, 'M304-1902', '7432147517500', 'A', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:14'),
(12, 2, 'M304-1902', '7432147517517', 'B', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:17'),
(13, 2, 'M304-1902', '7432147517524', 'C', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:19'),
(14, 2, 'M304-1902', '7432147517531', 'D', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:21'),
(15, 2, 'M304-1903', '7432147517548', 'E', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:23'),
(16, 2, 'M304-1903', '7432147517555', 'F', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:25'),
(17, 2, 'M304-1903', '7432147517562', 'G', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:27'),
(18, 2, 'M304-1903', '7432147517579', 'H', 1, '2019-12-18 09:54:05', '2019-12-20 10:14:29'),
(19, NULL, NULL, '7432147517586', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(20, NULL, NULL, '7432147517593', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(21, NULL, NULL, '7432147617606', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(22, NULL, NULL, '7432147617613', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(23, NULL, NULL, '7432147617620', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(24, NULL, NULL, '7432147617637', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(25, NULL, NULL, '7432147617644', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(26, NULL, NULL, '7432147617651', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(27, NULL, NULL, '7432147617668', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(28, NULL, NULL, '7432147617675', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(29, NULL, NULL, '7432147617682', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(30, NULL, NULL, '7432147617699', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(31, NULL, NULL, '7432147717702', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(32, NULL, NULL, '7432147717719', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(33, NULL, NULL, '7432147717726', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(34, NULL, NULL, '7432147717733', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(35, NULL, NULL, '7432147717740', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(36, NULL, NULL, '7432147717757', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(37, NULL, NULL, '7432147717764', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(38, NULL, NULL, '7432147717771', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(39, NULL, NULL, '7432147717788', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(40, NULL, NULL, '7432147717795', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(41, NULL, NULL, '7432147817808', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(42, NULL, NULL, '7432147817815', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(43, NULL, NULL, '7432147817822', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(44, NULL, NULL, '7432147817839', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(45, NULL, NULL, '7432147817846', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(46, NULL, NULL, '7432147817853', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(47, NULL, NULL, '7432147817860', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(48, NULL, NULL, '7432147817877', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(49, NULL, NULL, '7432147817884', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(50, NULL, NULL, '7432147817891', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(51, NULL, NULL, '7432147917904', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(52, NULL, NULL, '7432147917911', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(53, NULL, NULL, '7432147917928', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(54, NULL, NULL, '7432147917935', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(55, NULL, NULL, '7432147917942', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(56, NULL, NULL, '7432147917959', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(57, NULL, NULL, '7432147917966', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(58, NULL, NULL, '7432147917973', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(59, NULL, NULL, '7432147917980', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(60, NULL, NULL, '7432147917997', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(61, NULL, NULL, '7432147018007', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(62, NULL, NULL, '7432147018014', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(63, NULL, NULL, '7432147018021', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(64, NULL, NULL, '7432147018038', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(65, NULL, NULL, '7432147018045', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(66, NULL, NULL, '7432147018052', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(67, NULL, NULL, '7432147018069', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(68, NULL, NULL, '7432147018076', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(69, NULL, NULL, '7432147018083', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(70, NULL, NULL, '7432147018090', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(71, NULL, NULL, '7432147118103', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(72, NULL, NULL, '7432147118110', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(73, NULL, NULL, '7432147118127', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(74, NULL, NULL, '7432147118134', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(75, NULL, NULL, '7432147118141', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(76, NULL, NULL, '7432147118158', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(77, NULL, NULL, '7432147118165', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(78, NULL, NULL, '7432147118172', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(79, NULL, NULL, '7432147118189', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(80, NULL, NULL, '7432147118196', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(81, NULL, NULL, '7432147218209', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(82, NULL, NULL, '7432147218216', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(83, NULL, NULL, '7432147218223', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(84, NULL, NULL, '7432147218230', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(85, NULL, NULL, '7432147218247', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(86, NULL, NULL, '7432147218254', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(87, NULL, NULL, '7432147218261', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(88, NULL, NULL, '7432147218278', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(89, NULL, NULL, '7432147218285', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(90, NULL, NULL, '7432147218292', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(91, NULL, NULL, '7432147318305', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(92, NULL, NULL, '7432147318312', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(93, NULL, NULL, '7432147318329', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(94, NULL, NULL, '7432147318336', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(95, NULL, NULL, '7432147318343', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(96, NULL, NULL, '7432147318350', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(97, NULL, NULL, '7432147318367', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(98, NULL, NULL, '7432147318374', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(99, NULL, NULL, '7432147318381', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(100, NULL, NULL, '7432147318398', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(101, NULL, NULL, '7432147418401', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(102, NULL, NULL, '7432147418418', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(103, NULL, NULL, '7432147418425', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(104, NULL, NULL, '7432147418432', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(105, NULL, NULL, '7432147418449', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(106, NULL, NULL, '7432147418456', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(107, NULL, NULL, '7432147418463', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(108, NULL, NULL, '7432147418470', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(109, NULL, NULL, '7432147418487', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(110, NULL, NULL, '7432147418494', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(111, NULL, NULL, '7432147518507', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(112, NULL, NULL, '7432147518514', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(113, NULL, NULL, '7432147518521', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(114, NULL, NULL, '7432147518538', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(115, NULL, NULL, '7432147518545', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(116, NULL, NULL, '7432147518552', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(117, NULL, NULL, '7432147518569', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(118, NULL, NULL, '7432147518576', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(119, NULL, NULL, '7432147518583', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(120, NULL, NULL, '7432147518590', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(121, NULL, NULL, '7432147618603', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(122, NULL, NULL, '7432147618610', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(123, NULL, NULL, '7432147618627', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(124, NULL, NULL, '7432147618634', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(125, NULL, NULL, '7432147618641', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(126, NULL, NULL, '7432147618658', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(127, NULL, NULL, '7432147618665', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(128, NULL, NULL, '7432147618672', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(129, NULL, NULL, '7432147618689', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(130, NULL, NULL, '7432147618696', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(131, NULL, NULL, '7432147718709', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(132, NULL, NULL, '7432147718716', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(133, NULL, NULL, '7432147718723', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(134, NULL, NULL, '7432147718730', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(135, NULL, NULL, '7432147718747', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(136, NULL, NULL, '7432147718754', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(137, NULL, NULL, '7432147718761', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(138, NULL, NULL, '7432147718778', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(139, NULL, NULL, '7432147718785', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(140, NULL, NULL, '7432147718792', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(141, NULL, NULL, '7432147818805', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(142, NULL, NULL, '7432147818812', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(143, NULL, NULL, '7432147818829', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(144, NULL, NULL, '7432147818836', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(145, NULL, NULL, '7432147818843', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(146, NULL, NULL, '7432147818850', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(147, NULL, NULL, '7432147818867', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(148, NULL, NULL, '7432147818874', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(149, NULL, NULL, '7432147818881', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(150, NULL, NULL, '7432147818898', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(151, NULL, NULL, '7432147918901', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(152, NULL, NULL, '7432147918918', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(153, NULL, NULL, '7432147918925', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(154, NULL, NULL, '7432147918932', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(155, NULL, NULL, '7432147918949', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(156, NULL, NULL, '7432147918956', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(157, NULL, NULL, '7432147918963', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(158, NULL, NULL, '7432147918970', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(159, NULL, NULL, '7432147918987', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(160, NULL, NULL, '7432147918994', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(161, NULL, NULL, '7432147019004', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(162, NULL, NULL, '7432147019011', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(163, NULL, NULL, '7432147019028', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(164, NULL, NULL, '7432147019035', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(165, NULL, NULL, '7432147019042', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(166, NULL, NULL, '7432147019059', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(167, NULL, NULL, '7432147019066', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(168, NULL, NULL, '7432147019073', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(169, NULL, NULL, '7432147019080', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(170, NULL, NULL, '7432147019097', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(171, NULL, NULL, '7432147119100', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(172, NULL, NULL, '7432147119117', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(173, NULL, NULL, '7432147119124', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(174, NULL, NULL, '7432147119131', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(175, NULL, NULL, '7432147119148', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(176, NULL, NULL, '7432147119155', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(177, NULL, NULL, '7432147119162', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(178, NULL, NULL, '7432147119179', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(179, NULL, NULL, '7432147119186', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(180, NULL, NULL, '7432147119193', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(181, NULL, NULL, '7432147219206', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(182, NULL, NULL, '7432147219213', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(183, NULL, NULL, '7432147219220', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(184, NULL, NULL, '7432147219237', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(185, NULL, NULL, '7432147219244', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(186, NULL, NULL, '7432147219251', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(187, NULL, NULL, '7432147219268', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(188, NULL, NULL, '7432147219275', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(189, NULL, NULL, '7432147219282', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(190, NULL, NULL, '7432147219299', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(191, NULL, NULL, '7432147319302', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(192, NULL, NULL, '7432147319319', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(193, NULL, NULL, '7432147319326', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(194, NULL, NULL, '7432147319333', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(195, NULL, NULL, '7432147319340', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(196, NULL, NULL, '7432147319357', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(197, NULL, NULL, '7432147319364', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(198, NULL, NULL, '7432147319371', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(199, NULL, NULL, '7432147319388', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(200, NULL, NULL, '7432147319395', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(201, NULL, NULL, '7432147419408', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(202, NULL, NULL, '7432147419415', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(203, NULL, NULL, '7432147419422', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(204, NULL, NULL, '7432147419439', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(205, NULL, NULL, '7432147419446', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(206, NULL, NULL, '7432147419453', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(207, NULL, NULL, '7432147419460', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(208, NULL, NULL, '7432147419477', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(209, NULL, NULL, '7432147419484', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(210, NULL, NULL, '7432147419491', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(211, NULL, NULL, '7432147519504', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(212, NULL, NULL, '7432147519511', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(213, NULL, NULL, '7432147519528', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(214, NULL, NULL, '7432147519535', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(215, NULL, NULL, '7432147519542', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(216, NULL, NULL, '7432147519559', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(217, NULL, NULL, '7432147519566', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(218, NULL, NULL, '7432147519573', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(219, NULL, NULL, '7432147519580', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(220, NULL, NULL, '7432147519597', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(221, NULL, NULL, '7432147619600', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(222, NULL, NULL, '7432147619617', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(223, NULL, NULL, '7432147619624', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(224, NULL, NULL, '7432147619631', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(225, NULL, NULL, '7432147619648', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(226, NULL, NULL, '7432147619655', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(227, NULL, NULL, '7432147619662', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(228, NULL, NULL, '7432147619679', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(229, NULL, NULL, '7432147619686', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(230, NULL, NULL, '7432147619693', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(231, NULL, NULL, '7432147719706', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(232, NULL, NULL, '7432147719713', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(233, NULL, NULL, '7432147719720', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(234, NULL, NULL, '7432147719737', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(235, NULL, NULL, '7432147719744', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(236, NULL, NULL, '7432147719751', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(237, NULL, NULL, '7432147719768', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(238, NULL, NULL, '7432147719775', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(239, NULL, NULL, '7432147719782', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(240, NULL, NULL, '7432147719799', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(241, NULL, NULL, '7432147819802', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(242, NULL, NULL, '7432147819819', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(243, NULL, NULL, '7432147819826', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(244, NULL, NULL, '7432147819833', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(245, NULL, NULL, '7432147819840', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(246, NULL, NULL, '7432147819857', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(247, NULL, NULL, '7432147819864', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(248, NULL, NULL, '7432147819871', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(249, NULL, NULL, '7432147819888', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(250, NULL, NULL, '7432147819895', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(251, NULL, NULL, '7432147919908', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(252, NULL, NULL, '7432147919915', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(253, NULL, NULL, '7432147919922', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(254, NULL, NULL, '7432147919939', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(255, NULL, NULL, '7432147919946', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(256, NULL, NULL, '7432147919953', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(257, NULL, NULL, '7432147919960', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(258, NULL, NULL, '7432147919977', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(259, NULL, NULL, '7432147919984', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(260, NULL, NULL, '7432147919991', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(261, NULL, NULL, '7432147020000', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(262, NULL, NULL, '7432147020017', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(263, NULL, NULL, '7432147020024', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(264, NULL, NULL, '7432147020031', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(265, NULL, NULL, '7432147020048', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(266, NULL, NULL, '7432147020055', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(267, NULL, NULL, '7432147020062', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(268, NULL, NULL, '7432147020079', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(269, NULL, NULL, '7432147020086', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(270, NULL, NULL, '7432147020093', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(271, NULL, NULL, '7432147120106', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(272, NULL, NULL, '7432147120113', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(273, NULL, NULL, '7432147120120', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(274, NULL, NULL, '7432147120137', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(275, NULL, NULL, '7432147120144', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(276, NULL, NULL, '7432147120151', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(277, NULL, NULL, '7432147120168', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(278, NULL, NULL, '7432147120175', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(279, NULL, NULL, '7432147120182', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(280, NULL, NULL, '7432147120199', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(281, NULL, NULL, '7432147220202', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(282, NULL, NULL, '7432147220219', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(283, NULL, NULL, '7432147220226', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(284, NULL, NULL, '7432147220233', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(285, NULL, NULL, '7432147220240', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(286, NULL, NULL, '7432147220257', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(287, NULL, NULL, '7432147220264', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(288, NULL, NULL, '7432147220271', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(289, NULL, NULL, '7432147220288', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(290, NULL, NULL, '7432147220295', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(291, NULL, NULL, '7432147320308', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(292, NULL, NULL, '7432147320315', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(293, NULL, NULL, '7432147320322', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(294, NULL, NULL, '7432147320339', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(295, NULL, NULL, '7432147320346', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(296, NULL, NULL, '7432147320353', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(297, NULL, NULL, '7432147320360', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(298, NULL, NULL, '7432147320377', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(299, NULL, NULL, '7432147320384', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(300, NULL, NULL, '7432147320391', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(301, NULL, NULL, '7432147420404', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(302, NULL, NULL, '7432147420411', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(303, NULL, NULL, '7432147420428', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(304, NULL, NULL, '7432147420435', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(305, NULL, NULL, '7432147420442', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(306, NULL, NULL, '7432147420459', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(307, NULL, NULL, '7432147420466', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(308, NULL, NULL, '7432147420473', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(309, NULL, NULL, '7432147420480', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(310, NULL, NULL, '7432147420497', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(311, NULL, NULL, '7432147520500', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(312, NULL, NULL, '7432147520517', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(313, NULL, NULL, '7432147520524', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(314, NULL, NULL, '7432147520531', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(315, NULL, NULL, '7432147520548', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(316, NULL, NULL, '7432147520555', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(317, NULL, NULL, '7432147520562', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(318, NULL, NULL, '7432147520579', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(319, NULL, NULL, '7432147520586', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(320, NULL, NULL, '7432147520593', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(321, NULL, NULL, '7432147620606', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(322, NULL, NULL, '7432147620613', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(323, NULL, NULL, '7432147620620', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(324, NULL, NULL, '7432147620637', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(325, NULL, NULL, '7432147620644', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(326, NULL, NULL, '7432147620651', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(327, NULL, NULL, '7432147620668', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(328, NULL, NULL, '7432147620675', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(329, NULL, NULL, '7432147620682', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(330, NULL, NULL, '7432147620699', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(331, NULL, NULL, '7432147720702', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(332, NULL, NULL, '7432147720719', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(333, NULL, NULL, '7432147720726', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(334, NULL, NULL, '7432147720733', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(335, NULL, NULL, '7432147720740', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(336, NULL, NULL, '7432147720757', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(337, NULL, NULL, '7432147720764', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(338, NULL, NULL, '7432147720771', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(339, NULL, NULL, '7432147720788', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(340, NULL, NULL, '7432147720795', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(341, NULL, NULL, '7432147820808', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(342, NULL, NULL, '7432147820815', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(343, NULL, NULL, '7432147820822', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(344, NULL, NULL, '7432147820839', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(345, NULL, NULL, '7432147820846', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(346, NULL, NULL, '7432147820853', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(347, NULL, NULL, '7432147820860', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(348, NULL, NULL, '7432147820877', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(349, NULL, NULL, '7432147820884', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(350, NULL, NULL, '7432147820891', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(351, NULL, NULL, '7432147920904', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(352, NULL, NULL, '7432147920911', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(353, NULL, NULL, '7432147920928', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(354, NULL, NULL, '7432147920935', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(355, NULL, NULL, '7432147920942', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(356, NULL, NULL, '7432147920959', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(357, NULL, NULL, '7432147920966', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(358, NULL, NULL, '7432147920973', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(359, NULL, NULL, '7432147920980', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(360, NULL, NULL, '7432147920997', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(361, NULL, NULL, '7432147021007', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(362, NULL, NULL, '7432147021014', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(363, NULL, NULL, '7432147021021', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(364, NULL, NULL, '7432147021038', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(365, NULL, NULL, '7432147021045', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(366, NULL, NULL, '7432147021052', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(367, NULL, NULL, '7432147021069', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(368, NULL, NULL, '7432147021076', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(369, NULL, NULL, '7432147021083', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(370, NULL, NULL, '7432147021090', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(371, NULL, NULL, '7432147121103', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(372, NULL, NULL, '7432147121110', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(373, NULL, NULL, '7432147121127', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(374, NULL, NULL, '7432147121134', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(375, NULL, NULL, '7432147121141', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(376, NULL, NULL, '7432147121158', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(377, NULL, NULL, '7432147121165', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(378, NULL, NULL, '7432147121172', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(379, NULL, NULL, '7432147121189', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(380, NULL, NULL, '7432147121196', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(381, NULL, NULL, '7432147221209', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(382, NULL, NULL, '7432147221216', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(383, NULL, NULL, '7432147221223', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(384, NULL, NULL, '7432147221230', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(385, NULL, NULL, '7432147221247', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(386, NULL, NULL, '7432147221254', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(387, NULL, NULL, '7432147221261', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(388, NULL, NULL, '7432147221278', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(389, NULL, NULL, '7432147221285', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(390, NULL, NULL, '7432147221292', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(391, NULL, NULL, '7432147321305', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(392, NULL, NULL, '7432147321312', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(393, NULL, NULL, '7432147321329', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(394, NULL, NULL, '7432147321336', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(395, NULL, NULL, '7432147321343', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(396, NULL, NULL, '7432147321350', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(397, NULL, NULL, '7432147321367', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(398, NULL, NULL, '7432147321374', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(399, NULL, NULL, '7432147321381', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(400, NULL, NULL, '7432147321398', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(401, NULL, NULL, '7432147421401', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(402, NULL, NULL, '7432147421418', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(403, NULL, NULL, '7432147421425', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(404, NULL, NULL, '7432147421432', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(405, NULL, NULL, '7432147421449', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(406, NULL, NULL, '7432147421456', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(407, NULL, NULL, '7432147421463', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(408, NULL, NULL, '7432147421470', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(409, NULL, NULL, '7432147421487', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(410, NULL, NULL, '7432147421494', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(411, NULL, NULL, '7432147521507', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(412, NULL, NULL, '7432147521514', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(413, NULL, NULL, '7432147521521', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(414, NULL, NULL, '7432147521538', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(415, NULL, NULL, '7432147521545', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(416, NULL, NULL, '7432147521552', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(417, NULL, NULL, '7432147521569', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(418, NULL, NULL, '7432147521576', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(419, NULL, NULL, '7432147521583', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(420, NULL, NULL, '7432147521590', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(421, NULL, NULL, '7432147621603', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(422, NULL, NULL, '7432147621610', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(423, NULL, NULL, '7432147621627', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(424, NULL, NULL, '7432147621634', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(425, NULL, NULL, '7432147621641', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(426, NULL, NULL, '7432147621658', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(427, NULL, NULL, '7432147621665', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(428, NULL, NULL, '7432147621672', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(429, NULL, NULL, '7432147621689', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(430, NULL, NULL, '7432147621696', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(431, NULL, NULL, '7432147721709', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(432, NULL, NULL, '7432147721716', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(433, NULL, NULL, '7432147721723', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(434, NULL, NULL, '7432147721730', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(435, NULL, NULL, '7432147721747', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(436, NULL, NULL, '7432147721754', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(437, NULL, NULL, '7432147721761', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(438, NULL, NULL, '7432147721778', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(439, NULL, NULL, '7432147721785', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(440, NULL, NULL, '7432147721792', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(441, NULL, NULL, '7432147821805', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(442, NULL, NULL, '7432147821812', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(443, NULL, NULL, '7432147821829', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(444, NULL, NULL, '7432147821836', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(445, NULL, NULL, '7432147821843', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(446, NULL, NULL, '7432147821850', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(447, NULL, NULL, '7432147821867', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(448, NULL, NULL, '7432147821874', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(449, NULL, NULL, '7432147821881', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(450, NULL, NULL, '7432147821898', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(451, NULL, NULL, '7432147921901', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(452, NULL, NULL, '7432147921918', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(453, NULL, NULL, '7432147921925', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(454, NULL, NULL, '7432147921932', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(455, NULL, NULL, '7432147921949', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(456, NULL, NULL, '7432147921956', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(457, NULL, NULL, '7432147921963', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(458, NULL, NULL, '7432147921970', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(459, NULL, NULL, '7432147921987', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(460, NULL, NULL, '7432147921994', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(461, NULL, NULL, '7432147022004', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(462, NULL, NULL, '7432147022011', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(463, NULL, NULL, '7432147022028', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(464, NULL, NULL, '7432147022035', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(465, NULL, NULL, '7432147022042', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(466, NULL, NULL, '7432147022059', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(467, NULL, NULL, '7432147022066', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(468, NULL, NULL, '7432147022073', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(469, NULL, NULL, '7432147022080', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(470, NULL, NULL, '7432147022097', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(471, NULL, NULL, '7432147122100', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(472, NULL, NULL, '7432147122117', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(473, NULL, NULL, '7432147122124', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(474, NULL, NULL, '7432147122131', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(475, NULL, NULL, '7432147122148', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(476, NULL, NULL, '7432147122155', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(477, NULL, NULL, '7432147122162', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(478, NULL, NULL, '7432147122179', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(479, NULL, NULL, '7432147122186', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(480, NULL, NULL, '7432147122193', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(481, NULL, NULL, '7432147222206', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(482, NULL, NULL, '7432147222213', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(483, NULL, NULL, '7432147222220', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(484, NULL, NULL, '7432147222237', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(485, NULL, NULL, '7432147222244', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(486, NULL, NULL, '7432147222251', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(487, NULL, NULL, '7432147222268', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(488, NULL, NULL, '7432147222275', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(489, NULL, NULL, '7432147222282', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(490, NULL, NULL, '7432147222299', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(491, NULL, NULL, '7432147322302', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(492, NULL, NULL, '7432147322319', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(493, NULL, NULL, '7432147322326', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(494, NULL, NULL, '7432147322333', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(495, NULL, NULL, '7432147322340', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(496, NULL, NULL, '7432147322357', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(497, NULL, NULL, '7432147322364', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(498, NULL, NULL, '7432147322371', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(499, NULL, NULL, '7432147322388', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(500, NULL, NULL, '7432147322395', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(501, NULL, NULL, '7432147422408', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(502, NULL, NULL, '7432147422415', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(503, NULL, NULL, '7432147422422', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(504, NULL, NULL, '7432147422439', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(505, NULL, NULL, '7432147422446', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(506, NULL, NULL, '7432147422453', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(507, NULL, NULL, '7432147422460', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(508, NULL, NULL, '7432147422477', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(509, NULL, NULL, '7432147422484', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(510, NULL, NULL, '7432147422491', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(511, NULL, NULL, '7432147522504', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(512, NULL, NULL, '7432147522511', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(513, NULL, NULL, '7432147522528', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(514, NULL, NULL, '7432147522535', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(515, NULL, NULL, '7432147522542', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(516, NULL, NULL, '7432147522559', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(517, NULL, NULL, '7432147522566', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(518, NULL, NULL, '7432147522573', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(519, NULL, NULL, '7432147522580', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(520, NULL, NULL, '7432147522597', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(521, NULL, NULL, '7432147622600', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(522, NULL, NULL, '7432147622617', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(523, NULL, NULL, '7432147622624', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(524, NULL, NULL, '7432147622631', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(525, NULL, NULL, '7432147622648', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(526, NULL, NULL, '7432147622655', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(527, NULL, NULL, '7432147622662', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(528, NULL, NULL, '7432147622679', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(529, NULL, NULL, '7432147622686', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(530, NULL, NULL, '7432147622693', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(531, NULL, NULL, '7432147722706', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(532, NULL, NULL, '7432147722713', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(533, NULL, NULL, '7432147722720', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(534, NULL, NULL, '7432147722737', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(535, NULL, NULL, '7432147722744', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(536, NULL, NULL, '7432147722751', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(537, NULL, NULL, '7432147722768', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(538, NULL, NULL, '7432147722775', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(539, NULL, NULL, '7432147722782', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(540, NULL, NULL, '7432147722799', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(541, NULL, NULL, '7432147822802', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(542, NULL, NULL, '7432147822819', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(543, NULL, NULL, '7432147822826', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05');
INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
(544, NULL, NULL, '7432147822833', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(545, NULL, NULL, '7432147822840', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(546, NULL, NULL, '7432147822857', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(547, NULL, NULL, '7432147822864', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(548, NULL, NULL, '7432147822871', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(549, NULL, NULL, '7432147822888', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(550, NULL, NULL, '7432147822895', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(551, NULL, NULL, '7432147922908', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(552, NULL, NULL, '7432147922915', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(553, NULL, NULL, '7432147922922', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(554, NULL, NULL, '7432147922939', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(555, NULL, NULL, '7432147922946', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(556, NULL, NULL, '7432147922953', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(557, NULL, NULL, '7432147922960', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(558, NULL, NULL, '7432147922977', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(559, NULL, NULL, '7432147922984', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(560, NULL, NULL, '7432147922991', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(561, NULL, NULL, '7432147023001', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(562, NULL, NULL, '7432147023018', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(563, NULL, NULL, '7432147023025', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(564, NULL, NULL, '7432147023032', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(565, NULL, NULL, '7432147023049', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(566, NULL, NULL, '7432147023056', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(567, NULL, NULL, '7432147023063', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(568, NULL, NULL, '7432147023070', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(569, NULL, NULL, '7432147023087', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(570, NULL, NULL, '7432147023094', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(571, NULL, NULL, '7432147123107', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(572, NULL, NULL, '7432147123114', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(573, NULL, NULL, '7432147123121', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(574, NULL, NULL, '7432147123138', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(575, NULL, NULL, '7432147123145', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(576, NULL, NULL, '7432147123152', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(577, NULL, NULL, '7432147123169', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(578, NULL, NULL, '7432147123176', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(579, NULL, NULL, '7432147123183', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(580, NULL, NULL, '7432147123190', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(581, NULL, NULL, '7432147223203', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(582, NULL, NULL, '7432147223210', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(583, NULL, NULL, '7432147223227', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(584, NULL, NULL, '7432147223234', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(585, NULL, NULL, '7432147223241', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(586, NULL, NULL, '7432147223258', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(587, NULL, NULL, '7432147223265', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(588, NULL, NULL, '7432147223272', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(589, NULL, NULL, '7432147223289', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(590, NULL, NULL, '7432147223296', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(591, NULL, NULL, '7432147323309', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(592, NULL, NULL, '7432147323316', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(593, NULL, NULL, '7432147323323', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(594, NULL, NULL, '7432147323330', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(595, NULL, NULL, '7432147323347', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(596, NULL, NULL, '7432147323354', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(597, NULL, NULL, '7432147323361', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(598, NULL, NULL, '7432147323378', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(599, NULL, NULL, '7432147323385', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(600, NULL, NULL, '7432147323392', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(601, NULL, NULL, '7432147423405', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(602, NULL, NULL, '7432147423412', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(603, NULL, NULL, '7432147423429', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(604, NULL, NULL, '7432147423436', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(605, NULL, NULL, '7432147423443', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(606, NULL, NULL, '7432147423450', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(607, NULL, NULL, '7432147423467', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(608, NULL, NULL, '7432147423474', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(609, NULL, NULL, '7432147423481', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(610, NULL, NULL, '7432147423498', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(611, NULL, NULL, '7432147523501', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(612, NULL, NULL, '7432147523518', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(613, NULL, NULL, '7432147523525', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(614, NULL, NULL, '7432147523532', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(615, NULL, NULL, '7432147523549', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(616, NULL, NULL, '7432147523556', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(617, NULL, NULL, '7432147523563', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(618, NULL, NULL, '7432147523570', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(619, NULL, NULL, '7432147523587', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(620, NULL, NULL, '7432147523594', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(621, NULL, NULL, '7432147623607', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(622, NULL, NULL, '7432147623614', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(623, NULL, NULL, '7432147623621', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(624, NULL, NULL, '7432147623638', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(625, NULL, NULL, '7432147623645', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(626, NULL, NULL, '7432147623652', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(627, NULL, NULL, '7432147623669', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(628, NULL, NULL, '7432147623676', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(629, NULL, NULL, '7432147623683', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(630, NULL, NULL, '7432147623690', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(631, NULL, NULL, '7432147723703', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(632, NULL, NULL, '7432147723710', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(633, NULL, NULL, '7432147723727', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(634, NULL, NULL, '7432147723734', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(635, NULL, NULL, '7432147723741', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(636, NULL, NULL, '7432147723758', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(637, NULL, NULL, '7432147723765', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(638, NULL, NULL, '7432147723772', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(639, NULL, NULL, '7432147723789', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(640, NULL, NULL, '7432147723796', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(641, NULL, NULL, '7432147823809', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(642, NULL, NULL, '7432147823816', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(643, NULL, NULL, '7432147823823', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(644, NULL, NULL, '7432147823830', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(645, NULL, NULL, '7432147823847', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(646, NULL, NULL, '7432147823854', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(647, NULL, NULL, '7432147823861', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(648, NULL, NULL, '7432147823878', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(649, NULL, NULL, '7432147823885', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(650, NULL, NULL, '7432147823892', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(651, NULL, NULL, '7432147923905', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(652, NULL, NULL, '7432147923912', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(653, NULL, NULL, '7432147923929', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(654, NULL, NULL, '7432147923936', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(655, NULL, NULL, '7432147923943', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(656, NULL, NULL, '7432147923950', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(657, NULL, NULL, '7432147923967', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(658, NULL, NULL, '7432147923974', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(659, NULL, NULL, '7432147923981', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(660, NULL, NULL, '7432147923998', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(661, NULL, NULL, '7432147024008', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(662, NULL, NULL, '7432147024015', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(663, NULL, NULL, '7432147024022', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(664, NULL, NULL, '7432147024039', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(665, NULL, NULL, '7432147024046', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(666, NULL, NULL, '7432147024053', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(667, NULL, NULL, '7432147024060', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(668, NULL, NULL, '7432147024077', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(669, NULL, NULL, '7432147024084', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(670, NULL, NULL, '7432147024091', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(671, NULL, NULL, '7432147124104', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(672, NULL, NULL, '7432147124111', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(673, NULL, NULL, '7432147124128', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(674, NULL, NULL, '7432147124135', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(675, NULL, NULL, '7432147124142', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(676, NULL, NULL, '7432147124159', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(677, NULL, NULL, '7432147124166', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(678, NULL, NULL, '7432147124173', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(679, NULL, NULL, '7432147124180', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(680, NULL, NULL, '7432147124197', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(681, NULL, NULL, '7432147224200', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(682, NULL, NULL, '7432147224217', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(683, NULL, NULL, '7432147224224', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(684, NULL, NULL, '7432147224231', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(685, NULL, NULL, '7432147224248', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(686, NULL, NULL, '7432147224255', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(687, NULL, NULL, '7432147224262', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(688, NULL, NULL, '7432147224279', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(689, NULL, NULL, '7432147224286', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(690, NULL, NULL, '7432147224293', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(691, NULL, NULL, '7432147324306', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(692, NULL, NULL, '7432147324313', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(693, NULL, NULL, '7432147324320', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(694, NULL, NULL, '7432147324337', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(695, NULL, NULL, '7432147324344', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(696, NULL, NULL, '7432147324351', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(697, NULL, NULL, '7432147324368', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(698, NULL, NULL, '7432147324375', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(699, NULL, NULL, '7432147324382', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(700, NULL, NULL, '7432147324399', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(701, NULL, NULL, '7432147424402', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(702, NULL, NULL, '7432147424419', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(703, NULL, NULL, '7432147424426', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(704, NULL, NULL, '7432147424433', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(705, NULL, NULL, '7432147424440', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(706, NULL, NULL, '7432147424457', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(707, NULL, NULL, '7432147424464', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(708, NULL, NULL, '7432147424471', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(709, NULL, NULL, '7432147424488', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(710, NULL, NULL, '7432147424495', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(711, NULL, NULL, '7432147524508', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(712, NULL, NULL, '7432147524515', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(713, NULL, NULL, '7432147524522', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(714, NULL, NULL, '7432147524539', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(715, NULL, NULL, '7432147524546', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(716, NULL, NULL, '7432147524553', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(717, NULL, NULL, '7432147524560', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(718, NULL, NULL, '7432147524577', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(719, NULL, NULL, '7432147524584', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(720, NULL, NULL, '7432147524591', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(721, NULL, NULL, '7432147624604', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(722, NULL, NULL, '7432147624611', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(723, NULL, NULL, '7432147624628', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(724, NULL, NULL, '7432147624635', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(725, NULL, NULL, '7432147624642', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(726, NULL, NULL, '7432147624659', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(727, NULL, NULL, '7432147624666', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(728, NULL, NULL, '7432147624673', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(729, NULL, NULL, '7432147624680', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(730, NULL, NULL, '7432147624697', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(731, NULL, NULL, '7432147724700', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(732, NULL, NULL, '7432147724717', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(733, NULL, NULL, '7432147724724', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(734, NULL, NULL, '7432147724731', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(735, NULL, NULL, '7432147724748', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(736, NULL, NULL, '7432147724755', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(737, NULL, NULL, '7432147724762', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(738, NULL, NULL, '7432147724779', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(739, NULL, NULL, '7432147724786', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(740, NULL, NULL, '7432147724793', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(741, NULL, NULL, '7432147824806', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(742, NULL, NULL, '7432147824813', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(743, NULL, NULL, '7432147824820', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(744, NULL, NULL, '7432147824837', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(745, NULL, NULL, '7432147824844', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(746, NULL, NULL, '7432147824851', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(747, NULL, NULL, '7432147824868', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(748, NULL, NULL, '7432147824875', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(749, NULL, NULL, '7432147824882', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(750, NULL, NULL, '7432147824899', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(751, NULL, NULL, '7432147924902', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(752, NULL, NULL, '7432147924919', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(753, NULL, NULL, '7432147924926', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(754, NULL, NULL, '7432147924933', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(755, NULL, NULL, '7432147924940', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(756, NULL, NULL, '7432147924957', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(757, NULL, NULL, '7432147924964', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(758, NULL, NULL, '7432147924971', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(759, NULL, NULL, '7432147924988', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(760, NULL, NULL, '7432147924995', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(761, NULL, NULL, '7432147025005', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(762, NULL, NULL, '7432147025012', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(763, NULL, NULL, '7432147025029', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(764, NULL, NULL, '7432147025036', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(765, NULL, NULL, '7432147025043', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(766, NULL, NULL, '7432147025050', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(767, NULL, NULL, '7432147025067', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(768, NULL, NULL, '7432147025074', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(769, NULL, NULL, '7432147025081', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(770, NULL, NULL, '7432147025098', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(771, NULL, NULL, '7432147125101', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(772, NULL, NULL, '7432147125118', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(773, NULL, NULL, '7432147125125', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(774, NULL, NULL, '7432147125132', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(775, NULL, NULL, '7432147125149', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(776, NULL, NULL, '7432147125156', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(777, NULL, NULL, '7432147125163', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(778, NULL, NULL, '7432147125170', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(779, NULL, NULL, '7432147125187', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(780, NULL, NULL, '7432147125194', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(781, NULL, NULL, '7432147225207', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(782, NULL, NULL, '7432147225214', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(783, NULL, NULL, '7432147225221', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(784, NULL, NULL, '7432147225238', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(785, NULL, NULL, '7432147225245', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(786, NULL, NULL, '7432147225252', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(787, NULL, NULL, '7432147225269', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(788, NULL, NULL, '7432147225276', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(789, NULL, NULL, '7432147225283', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(790, NULL, NULL, '7432147225290', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(791, NULL, NULL, '7432147325303', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(792, NULL, NULL, '7432147325310', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(793, NULL, NULL, '7432147325327', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(794, NULL, NULL, '7432147325334', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(795, NULL, NULL, '7432147325341', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(796, NULL, NULL, '7432147325358', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(797, NULL, NULL, '7432147325365', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(798, NULL, NULL, '7432147325372', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(799, NULL, NULL, '7432147325389', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(800, NULL, NULL, '7432147325396', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(801, NULL, NULL, '7432147425409', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(802, NULL, NULL, '7432147425416', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(803, NULL, NULL, '7432147425423', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(804, NULL, NULL, '7432147425430', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(805, NULL, NULL, '7432147425447', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(806, NULL, NULL, '7432147425454', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(807, NULL, NULL, '7432147425461', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(808, NULL, NULL, '7432147425478', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(809, NULL, NULL, '7432147425485', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(810, NULL, NULL, '7432147425492', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(811, NULL, NULL, '7432147525505', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(812, NULL, NULL, '7432147525512', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(813, NULL, NULL, '7432147525529', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(814, NULL, NULL, '7432147525536', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(815, NULL, NULL, '7432147525543', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(816, NULL, NULL, '7432147525550', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(817, NULL, NULL, '7432147525567', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(818, NULL, NULL, '7432147525574', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(819, NULL, NULL, '7432147525581', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(820, NULL, NULL, '7432147525598', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(821, NULL, NULL, '7432147625601', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(822, NULL, NULL, '7432147625618', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(823, NULL, NULL, '7432147625625', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(824, NULL, NULL, '7432147625632', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(825, NULL, NULL, '7432147625649', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(826, NULL, NULL, '7432147625656', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(827, NULL, NULL, '7432147625663', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(828, NULL, NULL, '7432147625670', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(829, NULL, NULL, '7432147625687', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(830, NULL, NULL, '7432147625694', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(831, NULL, NULL, '7432147725707', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(832, NULL, NULL, '7432147725714', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(833, NULL, NULL, '7432147725721', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(834, NULL, NULL, '7432147725738', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(835, NULL, NULL, '7432147725745', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(836, NULL, NULL, '7432147725752', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(837, NULL, NULL, '7432147725769', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(838, NULL, NULL, '7432147725776', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(839, NULL, NULL, '7432147725783', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(840, NULL, NULL, '7432147725790', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(841, NULL, NULL, '7432147825803', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(842, NULL, NULL, '7432147825810', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(843, NULL, NULL, '7432147825827', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(844, NULL, NULL, '7432147825834', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(845, NULL, NULL, '7432147825841', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(846, NULL, NULL, '7432147825858', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(847, NULL, NULL, '7432147825865', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(848, NULL, NULL, '7432147825872', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(849, NULL, NULL, '7432147825889', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(850, NULL, NULL, '7432147825896', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(851, NULL, NULL, '7432147925909', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(852, NULL, NULL, '7432147925916', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(853, NULL, NULL, '7432147925923', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(854, NULL, NULL, '7432147925930', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(855, NULL, NULL, '7432147925947', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(856, NULL, NULL, '7432147925954', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(857, NULL, NULL, '7432147925961', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(858, NULL, NULL, '7432147925978', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(859, NULL, NULL, '7432147925985', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(860, NULL, NULL, '7432147925992', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(861, NULL, NULL, '7432147026002', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(862, NULL, NULL, '7432147026019', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(863, NULL, NULL, '7432147026026', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(864, NULL, NULL, '7432147026033', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(865, NULL, NULL, '7432147026040', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(866, NULL, NULL, '7432147026057', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(867, NULL, NULL, '7432147026064', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(868, NULL, NULL, '7432147026071', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(869, NULL, NULL, '7432147026088', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(870, NULL, NULL, '7432147026095', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(871, NULL, NULL, '7432147126108', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(872, NULL, NULL, '7432147126115', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(873, NULL, NULL, '7432147126122', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(874, NULL, NULL, '7432147126139', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(875, NULL, NULL, '7432147126146', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(876, NULL, NULL, '7432147126153', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(877, NULL, NULL, '7432147126160', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(878, NULL, NULL, '7432147126177', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(879, NULL, NULL, '7432147126184', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(880, NULL, NULL, '7432147126191', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(881, NULL, NULL, '7432147226204', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(882, NULL, NULL, '7432147226211', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(883, NULL, NULL, '7432147226228', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(884, NULL, NULL, '7432147226235', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(885, NULL, NULL, '7432147226242', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(886, NULL, NULL, '7432147226259', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(887, NULL, NULL, '7432147226266', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(888, NULL, NULL, '7432147226273', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(889, NULL, NULL, '7432147226280', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(890, NULL, NULL, '7432147226297', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(891, NULL, NULL, '7432147326300', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(892, NULL, NULL, '7432147326317', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(893, NULL, NULL, '7432147326324', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(894, NULL, NULL, '7432147326331', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(895, NULL, NULL, '7432147326348', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(896, NULL, NULL, '7432147326355', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(897, NULL, NULL, '7432147326362', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(898, NULL, NULL, '7432147326379', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(899, NULL, NULL, '7432147326386', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(900, NULL, NULL, '7432147326393', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(901, NULL, NULL, '7432147426406', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(902, NULL, NULL, '7432147426413', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(903, NULL, NULL, '7432147426420', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(904, NULL, NULL, '7432147426437', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(905, NULL, NULL, '7432147426444', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(906, NULL, NULL, '7432147426451', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(907, NULL, NULL, '7432147426468', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(908, NULL, NULL, '7432147426475', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(909, NULL, NULL, '7432147426482', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(910, NULL, NULL, '7432147426499', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(911, NULL, NULL, '7432147526502', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(912, NULL, NULL, '7432147526519', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(913, NULL, NULL, '7432147526526', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(914, NULL, NULL, '7432147526533', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(915, NULL, NULL, '7432147526540', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(916, NULL, NULL, '7432147526557', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(917, NULL, NULL, '7432147526564', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(918, NULL, NULL, '7432147526571', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(919, NULL, NULL, '7432147526588', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(920, NULL, NULL, '7432147526595', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(921, NULL, NULL, '7432147626608', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(922, NULL, NULL, '7432147626615', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(923, NULL, NULL, '7432147626622', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(924, NULL, NULL, '7432147626639', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(925, NULL, NULL, '7432147626646', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(926, NULL, NULL, '7432147626653', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(927, NULL, NULL, '7432147626660', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(928, NULL, NULL, '7432147626677', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(929, NULL, NULL, '7432147626684', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(930, NULL, NULL, '7432147626691', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(931, NULL, NULL, '7432147726704', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(932, NULL, NULL, '7432147726711', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(933, NULL, NULL, '7432147726728', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(934, NULL, NULL, '7432147726735', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(935, NULL, NULL, '7432147726742', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(936, NULL, NULL, '7432147726759', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(937, NULL, NULL, '7432147726766', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(938, NULL, NULL, '7432147726773', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(939, NULL, NULL, '7432147726780', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(940, NULL, NULL, '7432147726797', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(941, NULL, NULL, '7432147826800', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(942, NULL, NULL, '7432147826817', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(943, NULL, NULL, '7432147826824', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(944, NULL, NULL, '7432147826831', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(945, NULL, NULL, '7432147826848', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(946, NULL, NULL, '7432147826855', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(947, NULL, NULL, '7432147826862', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(948, NULL, NULL, '7432147826879', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(949, NULL, NULL, '7432147826886', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(950, NULL, NULL, '7432147826893', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(951, NULL, NULL, '7432147926906', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(952, NULL, NULL, '7432147926913', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(953, NULL, NULL, '7432147926920', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(954, NULL, NULL, '7432147926937', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(955, NULL, NULL, '7432147926944', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(956, NULL, NULL, '7432147926951', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(957, NULL, NULL, '7432147926968', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(958, NULL, NULL, '7432147926975', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(959, NULL, NULL, '7432147926982', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(960, NULL, NULL, '7432147926999', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(961, NULL, NULL, '7432147027009', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(962, NULL, NULL, '7432147027016', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(963, NULL, NULL, '7432147027023', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(964, NULL, NULL, '7432147027030', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(965, NULL, NULL, '7432147027047', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(966, NULL, NULL, '7432147027054', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(967, NULL, NULL, '7432147027061', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(968, NULL, NULL, '7432147027078', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(969, NULL, NULL, '7432147027085', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(970, NULL, NULL, '7432147027092', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(971, NULL, NULL, '7432147127105', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(972, NULL, NULL, '7432147127112', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(973, NULL, NULL, '7432147127129', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(974, NULL, NULL, '7432147127136', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(975, NULL, NULL, '7432147127143', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(976, NULL, NULL, '7432147127150', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(977, NULL, NULL, '7432147127167', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(978, NULL, NULL, '7432147127174', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(979, NULL, NULL, '7432147127181', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(980, NULL, NULL, '7432147127198', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(981, NULL, NULL, '7432147227201', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(982, NULL, NULL, '7432147227218', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(983, NULL, NULL, '7432147227225', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(984, NULL, NULL, '7432147227232', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(985, NULL, NULL, '7432147227249', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(986, NULL, NULL, '7432147227256', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(987, NULL, NULL, '7432147227263', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(988, NULL, NULL, '7432147227270', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(989, NULL, NULL, '7432147227287', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(990, NULL, NULL, '7432147227294', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(991, NULL, NULL, '7432147327307', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(992, NULL, NULL, '7432147327314', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(993, NULL, NULL, '7432147327321', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(994, NULL, NULL, '7432147327338', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(995, NULL, NULL, '7432147327345', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(996, NULL, NULL, '7432147327352', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(997, NULL, NULL, '7432147327369', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(998, NULL, NULL, '7432147327376', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(999, NULL, NULL, '7432147327383', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05'),
(1000, NULL, NULL, '7432147327390', NULL, NULL, '2019-12-18 09:54:05', '2019-12-18 09:54:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suplidor`
--

CREATE TABLE `suplidor` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `rnc` varchar(30) DEFAULT NULL,
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
(1, 'Lavanderia', '846469165489', 'Lavanderia', 'c/ prueba', 'Juan', '(809) 288-2113', '(809) 341-2113', NULL, 'lav@lav.com', '90 dias', 'prueba', '2019-12-18 09:46:32', '2019-12-18 09:46:32'),
(2, 'Suplidor tela', '446516546', 'Material', 'c/ diego tristan', 'Esteban', '(809) 288-2113', '(809) 341-2113', NULL, 'tela@tela.com', '90 dias', 'test', '2019-12-18 09:48:00', '2019-12-18 09:48:00'),
(3, 'Suplidor rollos', '651464351', 'Material', 'c/ primera, santiago', 'Pedro', '(809) 288-2113', '(829) 394-4265', NULL, 'rollo@rollo.com', '60 dias', 'prueba', '2019-12-18 09:51:14', '2019-12-18 09:51:14');

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
(7, 24, 30, 40, 50, 60, 70, 80, 80, 70, 60, 50, 0, 0, 590, '2019-12-20 11:27:21', '2019-12-20 11:27:21');

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
(1, 2, 1, 1, 'M-31313', 99.99, 'Algodon-98.22', '', '', '', '', 'Denim', '20.00', 30, '30.00', '50.00', '65.99', '55.11', '2019-12-18 09:49:59', '2019-12-18 09:49:59');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `password`, `role`, `telefono`, `celular`, `direccion`, `edad`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Anel', 'Dominguez', 'anel@anel.com', '$2y$10$ZgSvQfV0nAFLGUbhuy.VzOZjipoSPdpq2/vgQDHKcdheJhaCNRsfK', 'Administrador', '(809) 288-2113', '(809) 341-2113', 'c/ primera madre vieja sur, San Cristobal', '25', 'xQlXUJBR8Dzk57t208qs9Y7bofd5Hr4Zv6GWAdL7NmuEaM7fCrToFIUPiV0K', '2019-09-30 14:07:00', '2019-12-18 14:56:17'),
(13, 'Jose', 'Fernandez', 'anelabriel002@gmail.com', '$2y$10$pHiXEF8C.ZCZ5Qmzi6flxeYnipPgvm.p6mq1PGhw2BLM1Qfh5K8gO', 'Soporte', '(809) 288-2113', '(809) 288-2113', 'c primera', '30', NULL, '2019-12-19 13:52:47', '2019-12-19 13:52:47'),
(14, 'Pedro', 'Hernadez', 'pedro@cch.com', '$2y$10$CKxF1hX157a7JCOhKq38HupJdsukkP8KnRJbkPiXV3MsaiyB.pkpW', 'Administrador', '(809) 288-2113', '(829) 943-6531', 'c/ diego tristan, el almirante', '30', NULL, '2019-12-19 13:53:48', '2019-12-19 13:53:48'),
(15, 'Alejandro', 'Falcon', 'ale@cch.com', '$2y$10$P/VOMdEEcR5PXshGl7BHf.nwffli31Ce1aOpNDaBsK3eo28lYxAGu', 'Administrador', '(809) 288-215_', '(654) 654-6465', 'c/ trina de moya', '22', NULL, '2019-12-19 13:54:22', '2019-12-19 13:54:22'),
(16, 'Manuel', 'Dominguez', 'manuel@cch.com', '$2y$10$Q/T.2cREJpPlcyMqdqE.0.CG/iqmmygx4x4Wb3il/CRaainlL8vli', 'Administrador', '(809) 528-4456', '(454) 646-4655', 'c/ sanchez vieja, San Cristobal', '30', NULL, '2019-12-19 13:55:10', '2019-12-19 13:55:10'),
(17, 'Juan', 'Pichardo', 'juan@cch.com', '$2y$10$GEC1YxDKTjqQ70DYwkomk.bE7yJfRo4QEGvCDTkdW1VvHXhTYDBBO', 'General', '(809) 288-2113', '(809) 546-4654', 'c/ trina de moya', '30', NULL, '2019-12-19 13:56:07', '2019-12-19 13:56:07');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cliente_sucursales`
--
ALTER TABLE `cliente_sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `composiciones`
--
ALTER TABLE `composiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sku`
--
ALTER TABLE `sku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `suplidor`
--
ALTER TABLE `suplidor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tallas`
--
ALTER TABLE `tallas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- Filtros para la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  ADD CONSTRAINT `orden_empaque_ibfk_1` FOREIGN KEY (`orden_pedido_id`) REFERENCES `orden_pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  ADD CONSTRAINT `orden_empaque_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_3` FOREIGN KEY (`orden_facturacion_id`) REFERENCES `orden_facturacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
