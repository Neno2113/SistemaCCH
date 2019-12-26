-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-12-2019 a las 22:57:07
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
(1, 'Lordish', 'presidente Vasquez #256', 'Alma rosa primera', 'Santo Domingo', 'Al lado de la cafeteria Roma', 131609262, 'Yeimy', '(809) 937-7411', NULL, NULL, NULL, 'pichardodanny@gmail.com', '60 dias', 1, NULL, 1, 0, 0, '2019-12-24 09:50:02', '2019-12-24 09:50:02');

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
(1, 1, '1-31', 'Lordish Romana', '(809) 288-2113', 'primera', NULL, 'La Romana', NULL, '2019-12-26 11:31:19', '2019-12-26 11:31:19');

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
  `sec` decimal(3,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`id`, `numero_corte`, `producto_id`, `user_id`, `fecha_corte`, `no_marcada`, `ancho_marcada`, `largo_marcada`, `aprovechamiento`, `fecha_entrega`, `fase`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(1, '2019-001', 1, 1, '2019-12-24', '50', 52, '90', '80.00', '2020-01-28', 'Lavanderia', 680, '0.01', '2019-12-26 16:50:37', '2019-12-24 11:36:41');

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
(3, 'EL-001', 1, 2, 1, 1, '2019-12-26', 'Lavar segun estandar', 200, 200, 200, 1, 1, 0, '0.01', '2019-12-26 17:07:45', '2019-12-26 16:42:25');

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
(1, 1, 1, NULL, 'PE-001', 'Normal', '2019-12-25', 'Produccion', 'Fallo en Dpto.corte', NULL, '0.01', '2019-12-24 12:22:16', '2019-12-24 12:22:16'),
(3, 1, 1, NULL, 'PE-002', 'Normal', '2019-12-26', 'Procesos secos', 'Extraviado', NULL, '0.02', '2019-12-24 12:25:39', '2019-12-24 12:25:39');

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
(1, 1, NULL, 'M205-1901', NULL, 'Pantalon Talle Alto de Dama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.800', NULL, '1.695', NULL, 1, NULL, '0.1', '2019-12-24 12:42:35', '2019-12-24 10:54:35');

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
(1, 1, 1, 1, '9812', 'E', '147', '2019-12-23', 43.8, NULL, '2019-12-24 10:39:40', '2019-12-24 10:39:40'),
(2, 1, 1, 1, '9835', 'D', '147', '2019-12-23', 175.7, '2019-001', '2019-12-24 11:23:11', '2019-12-24 10:40:20'),
(3, 1, 1, 1, '9793', 'D', '147', '2019-12-23', 174.4, '2019-001', '2019-12-24 11:29:46', '2019-12-24 10:40:35'),
(4, 1, 1, 1, '9786', 'D', '147', '2019-12-23', 156.9, '2019-001', '2019-12-24 11:30:00', '2019-12-24 10:41:33'),
(5, 1, 1, 1, '9788', 'D', '147', '2019-12-23', 154.1, '2019-001', '2019-12-24 11:30:11', '2019-12-24 10:42:32'),
(6, 1, 1, 1, '9820', 'D', '147', '2019-12-23', 151.2, '2019-001', '2019-12-24 11:30:14', '2019-12-24 10:43:12'),
(7, 1, 1, 1, '9792', 'D', '147', '2019-12-23', 150, '2019-001', '2019-12-24 11:30:21', '2019-12-24 10:43:30'),
(8, 1, 1, 1, '9792', 'D', '147', '2019-12-23', 150, '2019-001', '2019-12-24 11:30:26', '2019-12-24 10:43:49'),
(9, 1, 1, 1, '9791', 'D', '147', '2019-12-23', 133.2, NULL, '2019-12-24 10:44:05', '2019-12-24 10:44:05'),
(10, 1, 1, 1, '9816', 'D', '147', '2019-12-23', 111.6, NULL, '2019-12-24 10:44:23', '2019-12-24 10:44:23'),
(11, 1, 1, 1, '9822', 'D', '147', '2019-12-23', 100.9, NULL, '2019-12-24 10:44:35', '2019-12-24 10:44:35'),
(12, 1, 1, 1, '9817', 'D', '147', '2019-12-23', 99.9, NULL, '2019-12-24 10:44:48', '2019-12-24 10:44:48'),
(13, 1, 1, 1, '9817', 'D', '147', '2019-12-23', 99.9, NULL, '2019-12-24 10:45:02', '2019-12-24 10:45:02'),
(14, 1, 1, 1, '9825', 'E', '147', '2019-12-23', 172.6, '2019-001', '2019-12-24 11:29:52', '2019-12-24 10:45:16'),
(15, 1, 1, 1, '9803', 'D', '147', '2019-12-23', 69.1, NULL, '2019-12-24 10:45:30', '2019-12-24 10:45:30'),
(16, 1, 1, 1, '9803', 'D', '147', '2019-12-23', 69.1, NULL, '2019-12-24 10:45:44', '2019-12-24 10:45:44'),
(17, 1, 1, 1, '9797', 'D', '147', '2019-12-23', 76.3, NULL, '2019-12-24 10:45:55', '2019-12-24 10:45:55'),
(18, 1, 1, 1, '9828', 'E', '147', '2019-12-23', 164.1, '2019-001', '2019-12-24 11:29:57', '2019-12-24 10:46:07');

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
(1, 1, 'M205-1901', '7432147417404', 'General', 1, '2019-12-24 10:53:40', '2019-12-24 10:55:28'),
(2, 1, 'M205-1901', '7432147417411', 'A', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:03'),
(3, 1, 'M205-1901', '7432147417428', 'B', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:06'),
(4, 1, 'M205-1901', '7432147417435', 'C', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:08'),
(5, 1, 'M205-1901', '7432147417442', 'D', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:10'),
(6, 1, 'M205-1901', '7432147417459', 'E', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:13'),
(7, 1, 'M205-1901', '7432147417466', 'F', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:15'),
(8, 1, 'M205-1901', '7432147417473', 'G', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:18'),
(9, 1, 'M205-1901', '7432147417480', 'H', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:20'),
(10, 1, 'M205-1901', '7432147417497', 'I', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:22'),
(11, 1, 'M205-1901', '7432147517500', 'J', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:24'),
(12, 1, 'M205-1901', '7432147517517', 'K', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:26'),
(13, 1, 'M205-1901', '7432147517524', 'L', 1, '2019-12-24 10:53:40', '2019-12-24 10:57:29'),
(21, NULL, NULL, '7432147617606', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(22, NULL, NULL, '7432147617613', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(23, NULL, NULL, '7432147617620', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(24, NULL, NULL, '7432147617637', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(25, NULL, NULL, '7432147617644', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(26, NULL, NULL, '7432147617651', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(27, NULL, NULL, '7432147617668', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(28, NULL, NULL, '7432147617675', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(29, NULL, NULL, '7432147617682', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(30, NULL, NULL, '7432147617699', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(31, NULL, NULL, '7432147717702', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(32, NULL, NULL, '7432147717719', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(33, NULL, NULL, '7432147717726', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(34, NULL, NULL, '7432147717733', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(35, NULL, NULL, '7432147717740', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(36, NULL, NULL, '7432147717757', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(37, NULL, NULL, '7432147717764', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(38, NULL, NULL, '7432147717771', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(39, NULL, NULL, '7432147717788', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(40, NULL, NULL, '7432147717795', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(41, NULL, NULL, '7432147817808', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(42, NULL, NULL, '7432147817815', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(43, NULL, NULL, '7432147817822', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(44, NULL, NULL, '7432147817839', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(45, NULL, NULL, '7432147817846', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(46, NULL, NULL, '7432147817853', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(47, NULL, NULL, '7432147817860', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(48, NULL, NULL, '7432147817877', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(49, NULL, NULL, '7432147817884', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(50, NULL, NULL, '7432147817891', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(51, NULL, NULL, '7432147917904', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(52, NULL, NULL, '7432147917911', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(53, NULL, NULL, '7432147917928', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(54, NULL, NULL, '7432147917935', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(55, NULL, NULL, '7432147917942', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(56, NULL, NULL, '7432147917959', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(57, NULL, NULL, '7432147917966', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(58, NULL, NULL, '7432147917973', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(59, NULL, NULL, '7432147917980', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(60, NULL, NULL, '7432147917997', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(61, NULL, NULL, '7432147018007', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(62, NULL, NULL, '7432147018014', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(63, NULL, NULL, '7432147018021', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(64, NULL, NULL, '7432147018038', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(65, NULL, NULL, '7432147018045', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(66, NULL, NULL, '7432147018052', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(67, NULL, NULL, '7432147018069', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(68, NULL, NULL, '7432147018076', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(69, NULL, NULL, '7432147018083', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(70, NULL, NULL, '7432147018090', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(71, NULL, NULL, '7432147118103', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(72, NULL, NULL, '7432147118110', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(73, NULL, NULL, '7432147118127', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(74, NULL, NULL, '7432147118134', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(75, NULL, NULL, '7432147118141', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(76, NULL, NULL, '7432147118158', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(77, NULL, NULL, '7432147118165', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(78, NULL, NULL, '7432147118172', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(79, NULL, NULL, '7432147118189', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(80, NULL, NULL, '7432147118196', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(81, NULL, NULL, '7432147218209', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(82, NULL, NULL, '7432147218216', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(83, NULL, NULL, '7432147218223', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(84, NULL, NULL, '7432147218230', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(85, NULL, NULL, '7432147218247', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(86, NULL, NULL, '7432147218254', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(87, NULL, NULL, '7432147218261', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(88, NULL, NULL, '7432147218278', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(89, NULL, NULL, '7432147218285', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(90, NULL, NULL, '7432147218292', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(91, NULL, NULL, '7432147318305', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(92, NULL, NULL, '7432147318312', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
(93, NULL, NULL, '7432147318329', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40'),
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
(550, NULL, NULL, '7432147822895', NULL, NULL, '2019-12-24 10:53:40', '2019-12-24 10:53:40');
INSERT INTO `sku` (`id`, `producto_id`, `referencia_producto`, `sku`, `talla`, `asignado`, `created_at`, `updated_at`) VALUES
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

INSERT INTO `suplidor` (`id`, `nombre`, `rnc`, `tipo_suplidor`, `calle`, `sector`, `provincia`, `sitios_cercanos`, `contacto_suplidor`, `telefono_1`, `telefono_2`, `celular`, `email`, `terminos_de_pago`, `nota`, `updated_at`, `created_at`) VALUES
(1, 'Textiles Agua Azul SRL', '130664897', 'Material', 'c/ bohechio #33, ensanche quisqueya', NULL, NULL, NULL, 'LuisFernandez', '(809) 682-7284', NULL, NULL, 'lfernandez@taa.com.do', '90 dias', NULL, '2019-12-24 09:59:41', '2019-12-24 09:59:41'),
(2, 'Industria del Yaque SRL', '102013195', 'Lavanderia', 'ave. circunvalacion #417', NULL, 'Santiago', NULL, 'Jose Miguel Abreu', '(809) 583-5522', NULL, NULL, 'indusriadelyaque@gmail.com', '60 dias', NULL, '2019-12-26 10:44:01', '2019-12-24 12:39:56'),
(3, 'Suplidor prueba 2', '10120133335', 'Lavanderia', 'primera', 'madre vieja', 'San Cristóbal', 'Liceo Puello Renville', 'Test', '(809) 528-2112', NULL, NULL, 'test@test.com', '60 dias', 'test', '2019-12-26 10:07:02', '2019-12-26 10:02:47');

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
(1, 1, 0, 0, 40, 40, 80, 80, 120, 120, 120, 80, 0, 0, 680, '2019-12-24 11:36:42', '2019-12-24 11:36:42');

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
(1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, NULL, '2019-12-24 12:22:17', '2019-12-24 12:22:17'),
(2, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '2019-12-24 12:25:40', '2019-12-24 12:25:40');

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
(1, 1, 1, 1, 'Dune', 4.9, 'Algodon-90.00', 'Elastano-03.00', '4-07.00', '', '', 'Denim', '52.00', 9.5, '45.00', '0.00', '15.00', '4.00', '2019-12-24 10:23:50', '2019-12-24 10:23:50');

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
(1, 'Anel', 'Dominguez', 'anel@anel.com', '$2y$10$J2IB.7dLUDdmMyYTBgzQCONs8hcnJ7H0JESsX7ejnGtm2bmaXEfnC', 'Administrador', '(809) 288-2113', '(829) 943-6531', 'c/ primera #4, Madre vieja, SC', '23', NULL, '2019-12-24 09:37:56', '2019-12-26 09:18:59');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `existencias`
--
ALTER TABLE `existencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lavanderia`
--
ALTER TABLE `lavanderia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `orden_empaque`
--
ALTER TABLE `orden_empaque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_empaque_detalle`
--
ALTER TABLE `orden_empaque_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion`
--
ALTER TABLE `orden_facturacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_pedido`
--
ALTER TABLE `orden_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `orden_pedido_detalle`
--
ALTER TABLE `orden_pedido_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perdidas`
--
ALTER TABLE `perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `recepcion`
--
ALTER TABLE `recepcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rollos`
--
ALTER TABLE `rollos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tallas_perdidas`
--
ALTER TABLE `tallas_perdidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tela`
--
ALTER TABLE `tela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
