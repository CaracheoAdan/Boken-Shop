-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2024 a las 07:09:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boken`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(1, 'hola 2'),
(5, 'Chamarra'),
(6, 'Ropa femenina'),
(7, 'Ropa femenina'),
(9, 'Ropa de invierno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_transaccion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_cliente` varchar(20) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `rfc` varchar(13) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `primer_apellido`, `segundo_apellido`, `nombre`, `rfc`, `id_usuario`, `fotografia`) VALUES
(1, 'Campos', 'Caracheo', 'Adan Javier', '123567891234', 2, '79215c11c02c57628642fad4dc85fe3c.jfif'),
(2, 'Rivera', 'Mozqueda', 'Ruben Eliezer', 'djsksotskfms', 3, '9f8fcbf0a08356dd5c99e2fc0167c153.jfif'),
(3, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 5, '61c6f93651705a3634faa3690e660268.png'),
(4, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 5, '2aac2c1f84516008f9ff005753a99f00.png'),
(5, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 5, '8e8df51b7fe91e6c88a8122a7ff413b1.png'),
(6, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 5, 'f9708bb3cf2abefa3037c847f8876a94.png'),
(7, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 5, '2c60a432d5e7f556b6e8eecce633ae29.png'),
(9, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 4, '746ea294b0588585a1075fcbe0f570f6.png'),
(10, 'Campos', 'Caracheo', 'Adan Javier', '1234567891234', 4, '70ec62d73d8a746c1d053df534daf9d0.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `permiso`) VALUES
(1, 'index'),
(2, 'Ver Productos'),
(3, 'Nuevos productos'),
(4, 'Modificar productos'),
(5, 'Eliminar productos'),
(6, 'Agregar un usuario'),
(7, 'Modificar un usuario'),
(8, 'Eliminar un usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `descuento`, `id_categoria`, `activo`) VALUES
(1, 'Sudadera de hombre!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡Te presentamos nuestra sudadera estrella!</h2>\r\n    <p>Esta prenda es el equilibrio perfecto entre <strong>estilo</strong> y <strong>comodidad</strong>. Confeccionada en un tejido suave y cálido, ideal para esos días frescos, cuenta con un diseño moderno que se adapta a cualquier ocasión.</p>\r\n    <ul>\r\n        <li><strong>✔ Capucha ajustable:</strong> perfecta para mantenerte protegido del frío con un toque casual.</li>\r\n        <li><strong>✔ Bolsillo frontal tipo canguro:</strong> práctico y funcional, ideal para calentar tus manos o llevar tus objetos esenciales.</li>\r\n        <li><strong>✔ Puños y cintura elásticos:</strong> garantizan un ajuste cómodo y mantienen el calor donde más lo necesitas.</li>\r\n    </ul>\r\n    <p>Disponible en una <strong>variedad de colores y tallas</strong> para que encuentres tu favorita. ¡Ideal para combinar con jeans, joggers o incluso para estar cómodo en casa! 🛍️</p>\r\n</div>', 3500.00, 10, 1, 1),
(2, 'Chamarra De Hombre!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡Te presentamos nuestra sudadera estrella!</h2>\r\n    <p>Esta prenda es el equilibrio perfecto entre <strong>estilo</strong> y <strong>comodidad</strong>. Confeccionada en un tejido suave y cálido, ideal para esos días frescos, cuenta con un diseño moderno que se adapta a cualquier ocasión.</p>\r\n    <ul>\r\n        <li><strong>✔ Capucha ajustable:</strong> perfecta para mantenerte protegido del frío con un toque casual.</li>\r\n        <li><strong>✔ Bolsillo frontal tipo canguro:</strong> práctico y funcional, ideal para calentar tus manos o llevar tus objetos esenciales.</li>\r\n        <li><strong>✔ Puños y cintura elásticos:</strong> garantizan un ajuste cómodo y mantienen el calor donde más lo necesitas.</li>\r\n    </ul>\r\n    <p>Disponible en una <strong>variedad de colores y tallas</strong> para que encuentres tu favorita. ¡Ideal para combinar con jeans, joggers o incluso para estar cómodo en casa! 🛍️</p>\r\n</div>', 5000.00, 14, 1, 1),
(3, 'Vestido De Dama!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\n    <h2>¡Luce encantadora con nuestro vestido rosa!</h2>\n    <p>Este <strong>vestido rosa</strong> está diseñado para resaltar tu estilo y feminidad en cualquier ocasión. Con detalles cuidadosamente elaborados y un corte favorecedor, es la prenda perfecta para eventos especiales o salidas casuales.</p>\n    <ul>\n        <li><strong>✔ Color rosa suave:</strong> elegante y romántico, ideal para un look fresco y encantador.</li>\n        <li><strong>✔ Tela ligera y cómoda:</strong> confeccionado con materiales de alta calidad que te mantienen cómoda durante todo el día.</li>\n        <li><strong>✔ Corte ajustado con caída fluida:</strong> diseñado para estilizar la figura y brindar movimiento natural.</li>\n        <li><strong>✔ Detalles especiales:</strong> como tirantes ajustables, encaje o botones decorativos, según el modelo.</li>\n    </ul>\n    <p>Disponible en tallas para todos los estilos, este vestido es fácil de combinar con sandalias, tacones o zapatillas. ¡Siente la confianza y el glamour en cada paso! 🌸</p>\n</div>\n', 3500.00, 12, 1, 1),
(4, 'Jeans Clasicos !!\r\n', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡No te pierdas nuestros jeans clásicos!</h2>\r\n    <p>Un básico imprescindible en cualquier guardarropa, estos jeans ofrecen la combinación perfecta de estilo, comodidad y durabilidad.</p>\r\n    <ul>\r\n        <li><strong>✔ Corte recto:</strong> versátil y favorecedor para todos los estilos.</li>\r\n        <li><strong>✔ Tela de mezclilla resistente:</strong> diseñada para soportar el uso diario.</li>\r\n        <li><strong>✔ Bolsillos funcionales:</strong> ideales para guardar lo esencial.</li>\r\n        <li><strong>✔ Tallas y colores variados:</strong> desde los clásicos azul y negro hasta tonos modernos.</li>\r\n    </ul>\r\n    <p>Perfectos para combinar con camisetas, blusas o chamarras. ¡Un must en tu colección! 👖</p>\r\n</div>\r\n', 1200.00, 2, 1, 1),
(5, 'Blusa De Diseñador!!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡Añade elegancia con nuestra blusa de diseño!</h2>\r\n    <p>Ideal para el trabajo o eventos especiales, esta blusa combina diseño y confort para destacar en cualquier ocasión.</p>\r\n    <ul>\r\n        <li><strong>✔ Material ligero:</strong> perfecto para mantenerte fresca todo el día.</li>\r\n        <li><strong>✔ Detalles delicados:</strong> encaje, plisados o botones decorativos según el modelo.</li>\r\n        <li><strong>✔ Corte moderno:</strong> favorece la silueta y combina con todo.</li>\r\n        <li><strong>✔ Colores neutros y vivos:</strong> para adaptarse a cualquier estilo.</li>\r\n    </ul>\r\n    <p>Combínala con faldas, pantalones o jeans para un look versátil y sofisticado. 🌟</p>\r\n</div>\r\n', 300.00, 1, 1, 1),
(6, 'Mini Falda!!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡Dale un toque chic a tu outfit con nuestra falda midi!</h2>\r\n    <p>Esta falda es perfecta para quienes buscan un estilo moderno y cómodo, ideal para cualquier temporada.</p>\r\n    <ul>\r\n        <li><strong>✔ Largo midi:</strong> elegante y práctico, adecuado para eventos casuales o formales.</li>\r\n        <li><strong>✔ Tejido ligero:</strong> ofrece movimiento fluido y comodidad.</li>\r\n        <li><strong>✔ Cintura alta:</strong> estiliza la figura y se adapta a cualquier tipo de cuerpo.</li>\r\n        <li><strong>✔ Estampados y colores variados:</strong> desde tonos sólidos hasta patrones florales.</li>\r\n    </ul>\r\n    <p>Combínala con tacones, zapatillas o sandalias para un look perfecto. 💃</p>\r\n</div>\r\n', 2000.00, 0, 1, 1),
(7, 'Playera Basica!!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡La playera básica que necesitas!</h2>\r\n    <p>Esta playera es el aliado perfecto para looks cómodos y casuales. Un esencial en tu guardarropa.</p>\r\n    <ul>\r\n        <li><strong>✔ Corte unisex:</strong> diseñado para adaptarse a todos los estilos.</li>\r\n        <li><strong>✔ Material 100% algodón:</strong> suave, ligero y transpirable.</li>\r\n        <li><strong>✔ Colores básicos y vibrantes:</strong> elige entre blanco, negro, azul y más.</li>\r\n        <li><strong>✔ Fácil de combinar:</strong> perfecta para usar con jeans, shorts o faldas.</li>\r\n    </ul>\r\n    <p>¡Cómoda y versátil para el día a día! 👕</p>\r\n</div>\r\n', 7300.00, 30, 1, 1),
(8, 'Shorts Deportivos!!', '<div style=\"font-family: Arial, sans-serif; line-height: 1.6;\">\r\n    <h2>¡Prepárate para moverte con nuestros shorts deportivos!</h2>\r\n    <p>Diseñados para ofrecer la máxima comodidad durante tus entrenamientos o actividades al aire libre.</p>\r\n    <ul>\r\n        <li><strong>✔ Tela transpirable:</strong> mantiene la frescura incluso en los entrenamientos más intensos.</li>\r\n        <li><strong>✔ Cintura elástica con cordón:</strong> ajustable para mayor comodidad.</li>\r\n        <li><strong>✔ Bolsillos prácticos:</strong> ideales para llevar tus esenciales.</li>\r\n        <li><strong>✔ Diseños modernos:</strong> disponibles en colores neutros y vivos.</li>\r\n    </ul>\r\n    <p>Perfectos para el gimnasio, correr o simplemente relajarte. ¡Muévete con estilo! 🏃‍♂️</p>\r\n</div>\r\n', 450.00, 12, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'usuario'),
(2, 'Cliente'),
(3, 'encargado'),
(4, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_permiso`
--

CREATE TABLE `rol_permiso` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol_permiso`
--

INSERT INTO `rol_permiso` (`id_rol`, `id_permiso`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `contrasena` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `contrasena`) VALUES
(4, '21031400@itcelaya.edu.mx', '202cb962ac59075b964b07152d234b70'),
(5, 'admin@prueba.com', 'd9b1d7db4cd6e70935368a1efb10e377'),
(6, '21031179@itcelaya.edu.mx', 'd9b1d7db4cd6e70935368a1efb10e377');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario`, `id_rol`) VALUES
(4, 4),
(5, 3),
(5, 4),
(6, 1),
(6, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario`,`id_rol`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol_permiso`
--
ALTER TABLE `rol_permiso`
  ADD CONSTRAINT `rol_permiso_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `rol_permiso_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `usuario_rol_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_rol_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
