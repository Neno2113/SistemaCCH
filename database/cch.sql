-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2019 a las 21:58:42
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
-- Estructura de tabla para la tabla `orden_facturacion_detalle`
--

CREATE TABLE `orden_facturacion_detalle` (
  `id` int(11) NOT NULL,
  `orden_facturacion_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
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
  `precio` decimal(4,3) DEFAULT NULL,
  `cant_bultos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `orden_facturacion_detalle`
--

INSERT INTO `orden_facturacion_detalle` (`id`, `orden_facturacion_id`, `producto_id`, `user_id`, `a`, `b`, `c`, `d`, `e`, `f`, `g`, `h`, `i`, `j`, `k`, `l`, `total`, `precio`, `cant_bultos`, `fecha`, `updated_at`, `created_at`) VALUES
(1, 1, 10, 1, 4, 4, 4, 6, 5, 6, 5, 6, 4, 6, 0, 0, 50, NULL, 2, '2019-12-06 11:31:23', '2019-12-06 11:31:23', '2019-12-06 11:31:23'),
(2, 1, 11, 1, 5, 6, 6, 6, 6, 6, 6, 6, 4, 4, 0, 0, 55, NULL, 3, '2019-12-06 11:31:41', '2019-12-06 11:31:41', '2019-12-06 11:31:41'),
(3, 1, 10, 1, 10, 10, 9, 12, 12, 13, 12, 13, 9, 13, 0, 0, 113, NULL, 4, '2019-12-06 11:32:47', '2019-12-06 11:32:47', '2019-12-06 11:32:47'),
(4, 1, 11, 1, 6, 5, 5, 5, 5, 5, 5, 5, 4, 4, 0, 0, 50, NULL, 2, '2019-12-06 11:32:49', '2019-12-06 11:32:49', '2019-12-06 11:32:49');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `orden_facturacion_id` (`orden_facturacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden_facturacion_detalle`
--
ALTER TABLE `orden_facturacion_detalle`
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orden_facturacion_detalle_ibfk_3` FOREIGN KEY (`orden_facturacion_id`) REFERENCES `orden_facturacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
