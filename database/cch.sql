-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-12-2019 a las 14:35:11
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
  `sec` decimal(3,2) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `orden_facturacion_id`, `user_id`, `no_factura`, `tipo_factura`, `fecha`, `fecha_impresion`, `comprobante_fiscal`, `numero_comprobante`, `precio_factura`, `descuento`, `itbis`, `total`, `sec`, `updated_at`, `created_at`) VALUES
(2, 1, 1, 'IN-322326', 'IN', '2019-12-25', '2019-12-11 05:24:25', 0, NULL, NULL, 10, 18, 0, '0.02', '2019-12-11 17:24:25', '2019-12-09 14:34:28'),
(3, 2, 1, 'IN-00001751', 'IN', '2019-12-11', '2019-12-12 09:53:07', 1, 'B0100017534', NULL, 5, 18, 757100, '0.03', '2019-12-12 09:53:07', '2019-12-11 15:14:22'),
(4, 3, 1, 'IN-00017351', 'IN', '2019-12-12', '2019-12-17 08:56:38', 1, 'B0100155495', NULL, 8, 18, 55000, '0.04', '2019-12-17 08:56:38', '2019-12-12 10:30:40'),
(5, 4, 1, 'IN-15251654', 'IN', '2019-12-16', '2019-12-16 05:52:37', 0, 'B01', NULL, 5, 18, 42375, '0.05', '2019-12-16 17:52:37', '2019-12-16 17:52:25'),
(6, 5, 1, 'DN-0017351', 'DN', '2019-12-17', '2019-12-17 08:57:06', 1, 'B01350265695', NULL, 5, 18, 28250, '0.06', '2019-12-17 08:57:06', '2019-12-17 08:54:18'),
(7, 6, 1, 'IN-0019514', 'IN', '2019-12-17', '2019-12-17 09:08:42', 0, 'B01', NULL, 6, 18, 80640, '0.07', '2019-12-17 09:08:42', '2019-12-17 09:07:37'),
(9, 11, 1, 'B02-222216', 'B02', '2019-12-17', '2019-12-17 10:11:32', 0, 'B01', NULL, 90, 18, 14000, '0.08', '2019-12-17 10:11:32', '2019-12-17 10:11:25'),
(10, 12, 1, 'B15-1161216', 'B15', '2019-12-17', '2019-12-17 03:53:11', 1, 'B019516250525', NULL, 20, 19, 366300, '0.09', '2019-12-17 15:53:11', '2019-12-17 15:52:55'),
(11, 13, 1, 'B14-621646', 'B14', '2019-12-17', '2019-12-17 04:30:21', 0, 'B01', NULL, 15, 20, 81375, '0.10', '2019-12-17 16:30:21', '2019-12-17 16:30:05');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orden_factura_id` (`orden_facturacion_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`orden_facturacion_id`) REFERENCES `orden_facturacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
