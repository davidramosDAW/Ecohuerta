-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2016 a las 10:16:29
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecohuerta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE `login` (
  `usuario` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Puesto` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Departamento` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Privilegios` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `login`
--

INSERT INTO `login` (`usuario`, `password`, `Nombre`, `Apellidos`, `Puesto`, `Departamento`, `Privilegios`) VALUES
('dramos', 'dramos', 'David ', 'Ramos Barajas', 'Administrador WEB', 'Informática', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productores`
--

CREATE TABLE `productores` (
  `ID_PRODUCTOR` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOM_PRODUCTOR` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CIF_PRODUCTOR` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `DIR_PRODUCTOR` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `POB_PRODUCTOR` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TEL_PRODUCTOR` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `CORREO_PRODUCTOR` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productores`
--

INSERT INTO `productores` (`ID_PRODUCTOR`, `NOM_PRODUCTOR`, `CIF_PRODUCTOR`, `DIR_PRODUCTOR`, `POB_PRODUCTOR`, `TEL_PRODUCTOR`, `CORREO_PRODUCTOR`) VALUES
('F_001', 'PELCAM, S.A', 'A58818501H', 'EL MINAT, 17', 'VALENCIA', '963465678', 'INFO@PELCAM.COM'),
('F_002', 'ECOGRAIN, S.A.', 'B83211970', 'BALMES, 280', 'BARCELONA', '935297600', 'INFO@ECOGRAIN.ES'),
('F_003', 'MONCAYO, S.L.', 'B82846825J', 'ZARAGOZA, 60', 'NAVARRA', '948656502', 'INFO@GRUPOMONCAYO.COM'),
('F_004', 'EL GRANERO, S.A.', 'A81948077', 'MARIA CARCINI, 16', 'MADRID', '917896297', 'INFO.MADRID@GRANERO.COM'),
('F_005', 'GASTROMANIACOS, S.L.', 'A50990173', 'MONTEARAGON, 34', 'MADRID', '914343098', 'INFO.GASTRO@GASTROMANIACOS.ES'),
('F_007', 'PEPE', 'PEPEEP', 'EPEPEPE', 'ALICANTE', '911002020', 'DEEE@GMAIL.COM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID_PRODUCTO` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ID_PRODUCTOR` varchar(5) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `NOM_COMERCIAL_PRODUCTO` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `TIPO_PRODUCTO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `FAMILIA_PRODUCTO` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `KG_STOCK_PRODUCTO` int(4) NOT NULL,
  `PVP_KG_STOCK` float NOT NULL,
  `IMAGEN_PRODUCTO` longblob
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID_PRODUCTO`, `ID_PRODUCTOR`, `NOM_COMERCIAL_PRODUCTO`, `TIPO_PRODUCTO`, `FAMILIA_PRODUCTO`, `KG_STOCK_PRODUCTO`, `PVP_KG_STOCK`, `IMAGEN_PRODUCTO`) VALUES
('ERRE', 'TE RO', 'F_003', 'INFUSIONES', 'FRUTO_SECO', 3, 1300, NULL),
('FGRT', 'F_005', 'DFGDFG', 'INFUSION', 'CEREALES_Y_GRANOS', 4, 150, NULL),
('FGRTS', 'F_004', 'SSDFSDF', 'CEREAL', 'FRUTOS_SECOS', 2, 250, NULL),
('P_001', 'F_003', 'PINTA', 'ALUBIA', 'LEGUMBRES', 2500, 3.5, NULL),
('P_002', 'F_005', 'CANELA', 'ALUBIA', 'LEGUMBRES', 2350, 2.5, NULL),
('P_003', 'F_004', 'ROJA', 'LENTEJA', 'LEGUMBRES', 2222, 2.75, NULL),
('P_004', 'F_002', 'PARDINA', 'LENTEJA', 'LEGUMBRES', 2200, 3.75, NULL),
('P_005', 'F_001', 'LECHOSO', 'GARBANZO', 'LEGUMBRES', 2102, 3.35, NULL),
('P_006', 'F_003', 'CASTELLANO', 'GARBANZO', 'LEGUMBRES', 2300, 3.5, NULL),
('P_007', 'F_005', 'LARGO', 'ARROZ', 'ARROCES', 1930, 2.25, NULL),
('P_008', 'F_001', 'NEGRO', 'ARROZ', 'ARROCES', 1854, 3.4, NULL),
('P_009', 'F_003', 'REDONDO', 'ARROZ', 'ARROCES', 1923, 3.3, NULL),
('P_010', 'F_004', 'JAZMIN', 'ARROZ', 'ARROCES', 1789, 2.15, NULL),
('P_011', 'F_002', 'AVELLANA', 'FRUTO_SECO', 'FRUTOS_SECOS', 1340, 1.25, NULL),
('P_012', 'F_003', 'ALMENDRA', 'FRUTO_SECO', 'FRUTOS_SECOS', 1369, 1.3, NULL),
('P_013', 'F_001', 'PISTACHO', 'FRUTO_SECO', 'FRUTOS_SECOS', 1456, 2.5, NULL),
('P_014', 'F_005', 'CACAHUETE', 'FRUTO_SECO', 'FRUTOS_SECOS', 1799, 2, NULL),
('P_015', 'F_003', 'MENTA POLEO', 'INFUSION', 'INFUSIONES', 940, 1.75, NULL),
('P_016', 'F_001', 'MANZANILLA', 'INFUSION', 'INFUSIONES', 923, 1.8, NULL),
('P_017', 'F_004', 'REGALIZ', 'INFUSION', 'INFUSIONES', 976, 1.9, NULL),
('P_018', 'F_002', 'GINSENG', 'INFUSION', 'INFUSIONES', 956, 2, NULL),
('P_019', 'F_005', 'AVENA', 'CEREAL', 'CEREALES_Y_GRANOS', 876, 1.65, NULL),
('P_020', 'F_004', 'MUESLI', 'CEREAL', 'CEREALES_Y_GRANOS', 888, 1.25, NULL),
('P_021', 'F_002', 'QUINOA_BLANCA', 'GRANO', 'CEREALES_Y_GRANOS', 807, 1.1, NULL),
('P_022', 'F_001', 'MIJO', 'GRANO', 'CEREALES_Y_GRANOS', 856, 1.05, NULL),
('P_023', 'F_003', 'DESCAFEINADO', 'CAFE', 'CAFES', 1027, 1.85, NULL),
('P_024', 'F_001', 'BIRMANIA', 'CAFE', 'CAFES', 1033, 2, NULL),
('P_025', 'F_005', 'ETIOPE', 'CAFE', 'CAFES', 1100, 1.83, NULL),
('P_026', 'F_003', 'JAMAICANO', 'CAFÉ', 'CAFES', 1200, 1.5, NULL),
('P_027', 'F_005', 'SESAMO', 'SEMILLA', 'SEMILLAS', 945, 1.3, NULL),
('P_029', 'F_002', 'GIRASOL', 'SEMILLA', 'SEMILLAS', 870, 1.46, NULL),
('P_030', 'F_004', 'LINO', 'SEMILLA', 'SEMILLAS', 865, 1.32, NULL),
('P_031', 'F_001', 'AMAPOLA', 'SEMILLA', 'SEMILLAS', 943, 1.5, NULL),
('UI', 'F_002', 'YUU', 'GARBANZO', 'FRUTOS_SECOS', 87, 87, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(125) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(15, 'Coruña, A'),
(1, 'Alava'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almería'),
(33, 'Asturias'),
(5, 'Avila'),
(6, 'Badajoz'),
(8, 'Barcelona'),
(9, 'Burgos'),
(10, 'Cáceres'),
(11, 'Cádiz'),
(39, 'Cantabria'),
(12, 'Cástellón'),
(51, 'Ceuta'),
(13, 'Ciudad Real'),
(16, 'Cuenca'),
(14, 'Córdoba'),
(17, 'Girona'),
(18, 'Granada'),
(19, 'Guadalajara'),
(20, 'Guipuzcoa'),
(21, 'Huelva'),
(22, 'Huesca'),
(7, 'Illes Baleares'),
(23, 'Jaén'),
(26, 'Rioja, La'),
(35, 'Palmas, Las'),
(24, 'León'),
(25, 'Lleida'),
(27, 'Lugo'),
(29, 'Málaga'),
(28, 'Madrid'),
(52, 'Melilla'),
(30, 'Murcia'),
(31, 'Navarra'),
(32, 'Ourense'),
(34, 'Palencia'),
(36, 'Pontevedra'),
(37, 'Salamanca'),
(40, 'Segovia'),
(41, 'Sevilla'),
(42, 'Soria'),
(38, 'Santa Cruz de Tenerife'),
(43, 'Tarragona'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(48, 'Vizcaya'),
(49, 'Zamora'),
(50, 'Zaragoza');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `productores`
--
ALTER TABLE `productores`
  ADD PRIMARY KEY (`ID_PRODUCTOR`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID_PRODUCTO`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
