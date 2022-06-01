-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2022 a las 03:21:41
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestorservicios`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DATOS` ()  SELECT * FROM inventario$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL,
  `gasto` varchar(200) NOT NULL,
  `total` float NOT NULL,
  `fecha` date NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `gasto`, `total`, `fecha`, `dia`, `mes`, `anio`) VALUES
(1, 'Compra de bolsas 3LB', 15, '2022-04-05', 5, 4, 2022),
(2, 'Compra de mouse', 20, '2022-04-11', 11, 4, 2022),
(3, 'Compra de Fosforos', 5, '2022-04-12', 12, 4, 2022),
(4, 'Compra de Bolsas', 15, '2022-04-18', 18, 4, 2022),
(5, 'Compra de Bolsas', 15, '2022-04-18', 18, 4, 2022),
(6, 'Compra de Limpia Contacto', 25, '2022-04-27', 27, 4, 2022),
(7, 'Compra de bolsas', 5, '2022-04-27', 27, 4, 2022),
(8, 'Compra de Bolsas', 10, '2022-05-03', 3, 5, 2022),
(9, 'Compra de bolsas', 15, '2022-05-28', 28, 5, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `Total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `descripcion`, `Total`) VALUES
(1, 'Ingreso', 1014),
(2, 'Ganancia', 889),
(3, 'Egreso', 125),
(4, '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(500) NOT NULL,
  `total` float NOT NULL,
  `fecha` date NOT NULL,
  `dia` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `anio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `servicio`, `total`, `fecha`, `dia`, `mes`, `anio`) VALUES
(1, 'Venta USB', 60, '2022-04-05', 5, 4, 2022),
(2, 'Impresiones ', 15, '2022-04-05', 5, 4, 2022),
(3, 'Primer NIT', 60, '2022-04-05', 5, 4, 2022),
(4, 'Instalación Office', 35, '2022-04-05', 5, 4, 2022),
(5, 'Inventigación', 10, '2022-04-05', 5, 4, 2022),
(6, 'Impreciones', 10, '2022-04-11', 11, 4, 2022),
(7, 'Venta DVD', 15, '2022-04-11', 11, 4, 2022),
(8, 'Inventigacion', 15, '2022-04-11', 11, 4, 2022),
(9, 'Instalacion de Office', 30, '2022-04-11', 11, 4, 2022),
(10, 'Resma de hoja carta', 25, '2022-04-11', 11, 4, 2022),
(11, 'Venta Cuaderno', 10, '2022-04-12', 12, 4, 2022),
(12, 'Venta MicroSD', 70, '2022-04-12', 12, 4, 2022),
(13, 'Venta MicroSD', 80, '2022-04-18', 18, 4, 2022),
(14, 'Trabajo de investigacion', 20, '2022-04-18', 18, 4, 2022),
(15, 'Impresionces ', 10, '2022-04-18', 18, 4, 2022),
(16, 'Creacion de Correo Electronico', 20, '2022-04-18', 18, 4, 2022),
(17, 'Instalacion de office', 35, '2022-04-18', 18, 4, 2022),
(18, 'Venta de USB', 50, '2022-04-27', 27, 4, 2022),
(19, 'Venta de CD', 100, '2022-04-27', 27, 4, 2022),
(20, 'Creacion de Nit', 50, '2022-04-27', 27, 4, 2022),
(21, 'Creacion de Correo', 25, '2022-04-27', 27, 4, 2022),
(22, 'Impreciones', 10, '2022-04-27', 27, 4, 2022),
(23, 'Fotocopias', 5, '2022-04-27', 27, 4, 2022),
(24, 'Investigación', 10, '2022-05-03', 3, 5, 2022),
(25, 'fotocopias', 2, '2022-05-03', 3, 5, 2022),
(26, 'fotocopia', 2, '2022-05-03', 3, 5, 2022),
(27, '2 pliegos papel china', 1, '2022-05-03', 3, 5, 2022),
(28, 'Lapiz mongol', 2, '2022-05-03', 3, 5, 2022),
(29, 'impresion', 3, '2022-05-03', 3, 5, 2022),
(30, 'investigacion', 3, '2022-05-03', 3, 5, 2022),
(31, 'impresion', 4, '2022-05-03', 3, 5, 2022),
(32, 'escaneo + investigacion + fotocopias', 8, '2022-05-03', 3, 5, 2022),
(33, 'renas', 5, '2022-05-03', 3, 5, 2022),
(34, 'ampliacion dpi a color', 5, '2022-05-03', 3, 5, 2022),
(35, 'contraloria general de cuentas', 5, '2022-05-03', 3, 5, 2022),
(36, 'fotocopias + encuadernado', 34, '2022-05-03', 3, 5, 2022),
(37, '2 folderes + fotocopias', 7, '2022-05-03', 3, 5, 2022),
(38, 'Creación y Activación Agencia Virtual', 50, '2022-05-03', 3, 5, 2022),
(39, 'Investigación + Impresión', 12, '2022-05-03', 3, 5, 2022),
(40, 'Renas', 5, '2022-05-03', 3, 5, 2022),
(41, 'Contraloria', 5, '2022-05-03', 3, 5, 2022),
(42, 'impresión + folder a color', 10, '2022-05-03', 3, 5, 2022),
(43, 'investigación', 9, '2022-05-03', 3, 5, 2022),
(44, 'fotocopia', 1, '2022-05-03', 3, 5, 2022),
(45, 'fotocopia', 0.5, '2022-05-03', 3, 5, 2022),
(46, 'Venta USB', 60, '2022-05-28', 28, 5, 2022),
(47, 'Impresiones', 10, '2022-05-28', 28, 5, 2022);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellido` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `contraseña` varchar(200) NOT NULL,
  `rol` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `contraseña`, `rol`) VALUES
(1, 'Alberto Fabricio', 'Cabrera Dueñas', 'empleado@proyecto.com', 'empleado', 'Empleado'),
(2, 'Juan Beto', 'Crisóstomo Mus', 'patitojuan@proyecto.com', 'patitojuan', 'Empleado');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
