-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2019 a las 00:10:07
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sgoa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogooa`
--

CREATE TABLE `catalogooa` (
  `idCatalogoOA` int(11) NOT NULL,
  `materia` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogooa`
--

INSERT INTO `catalogooa` (`idCatalogoOA`, `materia`, `cantidad`) VALUES
(1, 'Matematicas', 3),
(2, 'Literatura', 1),
(3, 'Medicina', 1),
(4, 'Ciencias Sociales', 0),
(5, 'Ciencias Sociales', 0),
(6, 'Ciencias Naturales', 0),
(7, 'Inteligencia Artificial', 0),
(8, 'Computacion', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idcomentario` int(11) NOT NULL,
  `contenido` varchar(500) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `id_objeto_aprendizaje` int(11) DEFAULT NULL,
  `fechacomentario` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `rutaimagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idcomentario`, `contenido`, `idusuario`, `id_objeto_aprendizaje`, `fechacomentario`, `rutaimagen`) VALUES
(1, 'Este recurso no tiene bibliografía, por favor incluirla', 9, 16, '2018-07-26 22:01:31', '../../imagenes/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `iddepartamento` int(11) NOT NULL,
  `departamento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`iddepartamento`, `departamento`) VALUES
(1, 'Física (DF)'),
(2, 'Matemática (DM)'),
(3, 'Ciencias Administrativas (DEPCA)'),
(4, 'Estudios Organizacionales Desarrollo Humano ('),
(5, 'Ingeniería Civil y Ambiental (DICA)'),
(6, 'Automatización y Control Industrial (DACI)'),
(7, 'Energía Eléctrica (DEE)'),
(8, 'Electrónica, Telecomunicaciones y Redes de In'),
(9, 'Geología (DG)\r\n'),
(10, 'Petróleos (DP)'),
(11, 'Ingeniería Mecánica (DIM)'),
(12, 'Materiales (DMT)'),
(13, 'Ingeniería Química (DIQ)'),
(14, 'Ciencias de Alimentos y Biotecnología (DECAB)'),
(15, 'Ciencias Nucleares (DCN)'),
(16, 'Metalurgia Extractiva (DEMEX)'),
(17, ' Informática y Ciencias de la Computación (DI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `ci` varchar(45) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `carrera` varchar(45) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_nacimiento` varchar(45) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `ciudad` varchar(10) DEFAULT NULL,
  `domicilio` varchar(60) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `convencional` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `ci`, `nombres`, `apellidos`, `carrera`, `id_facultad`, `mail`, `id_usuario`, `fecha_nacimiento`, `genero`, `ciudad`, `domicilio`, `celular`, `convencional`) VALUES
(1, '1714296603', 'Karina', 'Tapia', 'Sistemas', 8, 'alexisalex31@hotmail.com', 2, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia`
--

CREATE TABLE `experiencia` (
  `idComentario` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `descripcion` varchar(60) DEFAULT NULL,
  `comentario` varchar(200) DEFAULT NULL,
  `respondido` varchar(2) DEFAULT 'NO',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facultad`
--

CREATE TABLE `facultad` (
  `idfacultad` int(11) NOT NULL,
  `facultad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `facultad`
--

INSERT INTO `facultad` (`idfacultad`, `facultad`) VALUES
(1, 'Ciencias'),
(2, 'Ingenieria en Ciencias Administrativas'),
(3, 'Ingenieria Civil & Ambiental'),
(4, 'Ingenieria Electrica y Electronica'),
(5, 'Ingenieria en Geologia y Petroleos'),
(6, 'Ingenieria Mecanica'),
(7, 'Ingenieria Quimica y Agroindustrial'),
(8, 'Ingenieria en Sistemas'),
(9, 'ESFOT'),
(10, 'Formacion Basica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foro`
--

CREATE TABLE `foro` (
  `idForo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `titulo` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `mensaje` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `respuestas` int(11) NOT NULL DEFAULT '0',
  `identificador` int(7) NOT NULL DEFAULT '0',
  `ult_respuesta` date DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_unicode_ci DEFAULT '',
  `video` varchar(45) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `foro`
--

INSERT INTO `foro` (`idForo`, `idUsuario`, `titulo`, `mensaje`, `fecha`, `respuestas`, `identificador`, `ult_respuesta`, `imagen`, `video`) VALUES
(3, 1, 'presentacion', 'presentar proyecto', '2019-04-24 03:39:46', 1, 0, NULL, 'imagenes/WhatsApp Image 2019-02-23 at 20.01.0', 'videos/WhatsApp Image 2019-02-23 at 20.01.00.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `materia_id` int(11) NOT NULL,
  `materia_nombre` varchar(100) NOT NULL,
  `facultad_id` int(11) DEFAULT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`materia_id`, `materia_nombre`, `facultad_id`, `cantidad`) VALUES
(1, 'FÍSICA GENERAL I', 8, 0),
(2, 'FUNDAMENTOS DE CIENCIAS DE COMPUTACIÓN', 8, 0),
(3, 'PROGRAMACIÓN I ', 8, 0),
(4, 'MATEMÁTICAS DISCRETAS', 8, 0),
(5, 'PROGRAMACIÓN II ', 8, 1),
(6, 'SISTEMAS DE COMUNICACIÓN ', 8, 0),
(7, 'ARQUITECTURA DE COMPUTADORES ', 8, 0),
(8, 'ESTRUCTURA DE DATOS ', 8, 1),
(9, 'REDES DE COMPUTADORES ', 8, 0),
(10, 'SISTEMAS OPERATIVOS ', 8, 0),
(11, 'COMPILADORES Y LENGUAJES', 8, 0),
(12, 'BASES DE DATOS', 8, 1),
(13, 'ALGORITMOS', 8, 5),
(14, 'ALGORITMOS NUMERICOS', 8, 3),
(15, 'GESTION DE PROYECTOS ', 8, 0),
(16, 'TCP-IP', 8, 0),
(17, 'TECNOLOGÍAS DE SEGURIDAD', 8, 0),
(18, 'INTELIGENCIA ARTIFICIAL', 8, 0),
(19, 'BASES DE DATOS DISTRIBUIDAS', 8, 0),
(20, 'INGENIERÍA DE SOFTWARE I', 8, 0),
(21, 'APLICACIONES EN AMBIENTES PROPIETARIOS', 8, 0),
(22, 'ADMINISTRACIÓN FINANCIERA', 8, 0),
(23, 'COMPUTACIÓN DISTRIBUIDA', 8, 0),
(24, 'INTELIGENCIA DE NEGOCIOS', 8, 0),
(25, 'INGENIERÍA DE SOFTWARE II', 8, 4),
(26, 'APLICACIONES EN AMBIENTES LIBRES', 8, 0),
(27, 'LEGISLACIÓN INFORMÁTICA', 8, 0),
(28, 'DISEÑO DE PROCESOS ORGANIZACIONALES', 8, 0),
(29, 'ADMINISTRACIÓN DE SISTEMAS OPERATIVOS Y REDES', 8, 0),
(30, 'CALIDAD DE SOFTWARE', 8, 0),
(31, 'ADMINISTRACIÓN DE BASES DE DATOS', 8, 0),
(32, 'APLICACIONES WEB', 8, 0),
(33, 'APLICACIONES MÓVILES', 8, 0),
(34, 'HABILIDADES DIRECTIVAS', 8, 0),
(35, 'GESTIÓN DE SEGURIDAD INFORMÁTICA', 8, 0),
(36, 'AUDITORIA Y EVALUACIÓN DE SISTEMAS COMPUTACIONALES', 8, 0),
(37, 'GESTIÓN DE TIC Y UNIDADES INFORMÁTICAS', 8, 0),
(38, 'PLANES DE NEGOCIO TIC', 8, 0),
(39, 'TALLER DE FORMULACIÓN PROYECTOS TITULACIÓN', 8, 0),
(40, 'MUESTREO', 2, 0),
(41, 'GERENCIA DE PROCESOS', 2, 0),
(42, 'SISTEMAS DE GESTION DE LA CALIDAD', 2, 0),
(43, 'MEJORAMIENTO DE PROCESOS EMPRESARIALES', 2, 0),
(44, 'FUNDAMENTOS DE MARKETING', 2, 0),
(45, 'CONTABILIDAD GENERAL', 2, 0),
(46, 'CONTABILIDAD DE COSTOS', 2, 0),
(47, 'MACROECONOMIA ', 2, 0),
(48, 'ECONOMETRIA', 2, 0),
(49, 'ANALISIS FINANCIERO', 2, 0),
(50, 'HORMIGON', 3, 0),
(51, 'VIAS', 3, 0),
(52, 'RESISTENCIA DE MATERIALES', 3, 0),
(53, 'CONSTRUCCIONES CIVILES', 3, 0),
(54, 'INSTALACIONES EN EDIFICIOS', 3, 0),
(55, 'MECANICA DE SUELOS', 3, 0),
(56, 'ALCANTARILLADO', 3, 0),
(57, 'AGUA POTABLE', 3, 0),
(58, 'TOPOGRAFIA', 3, 0),
(59, 'DISPOSITIVOS ELECTRONICOS', 4, 0),
(60, 'CIRCUITOS ELECTRONICOS', 4, 0),
(61, 'ALTO VOLTAJE', 4, 0),
(62, 'CENTRALES DE GENERACION ELECTRICA', 4, 0),
(63, 'TEORIA ELECTROMAGNETICA', 4, 0),
(64, 'CONVERSION ELECTROMECANICA DE ENERGIA', 4, 0),
(65, 'MAQUINAS ELECTRICAS', 4, 0),
(66, 'GEOESTADISTICA', 5, 0),
(67, 'GEOTECNIA', 5, 0),
(68, 'GEOQUIMICA', 5, 2),
(69, 'MAPAS GEOLOGICOS', 5, 0),
(70, 'PETROLOGIA SEDUMENTARIA', 5, 0),
(71, 'TECTONICA DE PLACAS', 5, 0),
(72, 'MINERALES', 5, 0),
(73, 'MECANICA DE MATERIALES', 6, 0),
(74, 'CIENCIA DE MATERIALES', 6, 0),
(75, 'TEORIA DE MAQUINAS', 6, 0),
(76, 'TRANSFERENCIA DE CALOR', 6, 0),
(77, 'CONTROL AUTOMATICO', 6, 0),
(78, 'TURBOMAQUINAS', 6, 0),
(79, 'DINAMICA', 6, 0),
(80, 'TERMODINAMICA', 7, 0),
(81, 'FISICO QUIMICA', 7, 0),
(82, 'TERMODINAMICA', 7, 0),
(83, 'QUIMICA ANALITICA', 7, 0),
(84, 'QUIMICA ORGANICA', 7, 0),
(85, 'BIOQUIMICA', 7, 0),
(86, 'INGENIERIA DE LA REACCION', 7, 0),
(87, 'MICROPROCESADORES', 9, 0),
(88, 'TELECOMUNICACIONES I', 9, 0),
(89, 'MEDIOS DE TRANSMISION ', 9, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objeto_aprendizaje`
--

CREATE TABLE `objeto_aprendizaje` (
  `idobjeto_aprendizaje` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `institucion` varchar(45) DEFAULT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `palabras_clave` varchar(500) DEFAULT NULL,
  `tamanio` varchar(45) DEFAULT NULL,
  `ruta` varchar(45) DEFAULT NULL,
  `materia` varchar(50) DEFAULT NULL,
  `tipo_repo` int(2) DEFAULT NULL,
  `descarga` int(11) DEFAULT NULL,
  `Privado` varchar(3) DEFAULT NULL,
  `Publico` varchar(3) DEFAULT NULL,
  `direcurl` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `objeto_aprendizaje`
--

INSERT INTO `objeto_aprendizaje` (`idobjeto_aprendizaje`, `nombre`, `descripcion`, `id_usuario`, `institucion`, `fechaCreacion`, `palabras_clave`, `tamanio`, `ruta`, `materia`, `tipo_repo`, `descarga`, `Privado`, `Publico`, `direcurl`) VALUES
(2, 'github', 'Ayuda', 4, 'EPN', '2019-06-30 18:23:26', 'git', '813', '../../storage/github.txt', 'ALGORITMOS', 1, 0, 'htt', 'SI', NULL),
(3, 'Patrones', 'Inteligencia de negocios', 4, 'EPN', '2019-06-30 18:35:49', 'Metodos', '1583', '../../storage/Patrones.txt', 'ALGORITMOS NUMERICOS', 1, 0, 'SI', 'SI', NULL),
(4, 'LOLO', 'LO', 4, 'EPN', '2019-07-01 00:30:09', 'LO', '77807', '../../storage/LOLO.jpeg', 'ESTRUCTURA DE DATOS ', 1, 0, 'SI', NULL, NULL),
(5, 'uu', 'unasd', 4, 'EPN', '2019-07-01 00:37:58', 'ASDASD', '66179', '../../storage/uu.jpeg', 'GEOQUIMICA', 1, 0, 'SI', NULL, NULL),
(6, 'Software', 'Met', 4, 'EPN', '2019-07-01 03:15:11', 'xp', '2133', '../../storage/Software.txt', 'INGENIERÍA DE SOFTWARE II', 1, 0, 'SI', NULL, NULL),
(7, 'asdweasdsadasdasdasdasd', 'asdasdasdasdasdsa', 4, 'EPN', '2019-07-01 03:36:32', 'ew', '1339', '../../storage/asdweasdsadasdasdasdasd.txt', 'ALGORITMOS NUMERICOS', 1, 0, 'SI', NULL, NULL),
(8, 'XP', 'xp', 4, 'EPN', '2019-07-01 03:45:53', 'metodologia', '1270', '../../storage/XP.txt', 'INGENIERÍA DE SOFTWARE II', 1, 0, 'SI', NULL, NULL),
(9, 'Base de datos', 'Libres', 4, 'EPN', '2019-07-01 21:53:19', 'Server', '30098', '../../storage/Base+de+datos.sql', 'PROGRAMACIÓN II ', 1, 0, 'SI', NULL, NULL),
(10, 'Libres1', 'Parte del codigo', 2, 'EPN', '2019-07-01 23:26:14', 'Li', '13207', '../../storage/Libres1.php', 'BASES DE DATOS', 1, 0, 'SI', 'SI', NULL),
(11, 'Test Driven', 'metodologia', 4, 'EPN', '2019-07-02 02:33:49', 'metodologia', '336', '../../storage/Test+Driven.txt', 'INGENIERÍA DE SOFTWARE II', 1, 0, 'SI', 'SI', NULL),
(12, 'Wifi', 'metodologia', 4, 'EPN', '2019-07-02 19:54:58', 'wIFI', '34', '../../storage/Wifi.txt', 'ALGORITMOS NUMERICOS', 1, 0, 'SI', 'SI', NULL),
(13, 'Base', 'Base', 4, 'EPN', '2019-07-02 23:52:56', 'Base', '20804', '../../storage/Base.sql', NULL, 1, 0, 'SI', 'NO', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `idprofesor` int(11) NOT NULL,
  `ci` varchar(10) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `id_departamento` int(11) DEFAULT NULL,
  `id_facultad` int(11) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_nacimiento` varchar(45) DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `ciudad` varchar(10) DEFAULT NULL,
  `domicilio` varchar(60) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `convencional` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idprofesor`, `ci`, `nombres`, `apellidos`, `id_departamento`, `id_facultad`, `mail`, `id_usuario`, `fecha_nacimiento`, `genero`, `ciudad`, `domicilio`, `celular`, `convencional`) VALUES
(1, '1725790032', 'Alexis', 'Maldonado', 11, 2, 'alexis.maldonado@epn.edu.ec', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '1725790032', 'Fernando', 'Tapia', 7, 6, 'alexisalex31@hotmail.com', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '0802548578', 'Maria', 'Intriago', 17, 8, 'monserrate.intriago@epn.edu.ec', 9, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `contrasenia` varchar(45) DEFAULT NULL,
  `tipo_usuario` varchar(3) DEFAULT NULL,
  `activo` varchar(1) DEFAULT NULL,
  `cambio_de_clave` varchar(1) DEFAULT NULL,
  `foto` varchar(45) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `contrasenia`, `tipo_usuario`, `activo`, `cambio_de_clave`, `foto`) VALUES
(1, 'PaulLora1', '123', 'ADM', 'V', 'F', ''),
(2, 'ktapia', 'hola123', 'EST', 'V', 'F', ''),
(4, 'AlexisMaldonado0', 'alexis', 'PRO', 'V', 'F', ''),
(5, 'FernandoTapia0', 'bESn9', 'PRO', 'F', 'F', ''),
(6, 'mmjaramilloarteaga', 'mmjaramilloarteaga', 'EST', 'V', 'F', ''),
(7, 'mmjaramillo', 'mmjaramillo', 'EST', 'V', 'F', ''),
(8, 'mmjaramillo', '123', 'EST', 'V', 'F', ''),
(9, 'MariaIntriago0', 'gcjFI', 'PRO', 'V', 'F', ''),
(10, 'AngelYanez0', 'aCOn9', 'EST', 'V', 'T', ''),
(11, 'CarolOña0', 'G2aOI', 'EST', 'V', 'T', ''),
(12, 'PaulLora0', '1234', 'PRO', 'V', 'F', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `idvaloracion` int(11) NOT NULL,
  `idobjeto_aprendizaje` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`idvaloracion`, `idobjeto_aprendizaje`, `idusuario`, `puntuacion`) VALUES
(2, 12, 2, 5),
(3, 12, 2, 3),
(4, 12, 2, 4),
(5, 12, 2, 4),
(6, 12, 2, 1),
(7, 12, 4, 1),
(8, 3, 4, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `catalogooa`
--
ALTER TABLE `catalogooa`
  ADD PRIMARY KEY (`idCatalogoOA`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idcomentario`),
  ADD KEY `fk_comentario_usuario1_idx` (`idusuario`),
  ADD KEY `fk_comentario_objeto_aprendizaje1_idx` (`id_objeto_aprendizaje`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`iddepartamento`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`),
  ADD KEY `fk_estudiante_usuario1_idx` (`id_usuario`),
  ADD KEY `fk_estudiante_facultad1_idx` (`id_facultad`);

--
-- Indices de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `facultad`
--
ALTER TABLE `facultad`
  ADD PRIMARY KEY (`idfacultad`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`idForo`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`materia_id`),
  ADD KEY `facultad_id` (`facultad_id`);

--
-- Indices de la tabla `objeto_aprendizaje`
--
ALTER TABLE `objeto_aprendizaje`
  ADD PRIMARY KEY (`idobjeto_aprendizaje`),
  ADD KEY `fk_objeto_aprendizaje_usuario1_idx` (`id_usuario`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idprofesor`),
  ADD KEY `fk_profesor_usuario_idx` (`id_usuario`),
  ADD KEY `fk_profesor_departamento1_idx` (`id_departamento`),
  ADD KEY `fk_profesor_facultad1_idx` (`id_facultad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`idvaloracion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `catalogooa`
--
ALTER TABLE `catalogooa`
  MODIFY `idCatalogoOA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idcomentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `iddepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `experiencia`
--
ALTER TABLE `experiencia`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `facultad`
--
ALTER TABLE `facultad`
  MODIFY `idfacultad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `idForo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `materia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `objeto_aprendizaje`
--
ALTER TABLE `objeto_aprendizaje`
  MODIFY `idobjeto_aprendizaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idprofesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `idvaloracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `fk_estudiante_facultad1` FOREIGN KEY (`id_facultad`) REFERENCES `facultad` (`idfacultad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `experiencia`
--
ALTER TABLE `experiencia`
  ADD CONSTRAINT `experiencia_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`facultad_id`) REFERENCES `facultad` (`idfacultad`);

--
-- Filtros para la tabla `objeto_aprendizaje`
--
ALTER TABLE `objeto_aprendizaje`
  ADD CONSTRAINT `fk_objeto_aprendizaje_usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
