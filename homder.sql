-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 02:01:53
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `homder`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favourites`
--

CREATE TABLE `favourites` (
  `user_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `location` varchar(120) DEFAULT NULL,
  `price` varchar(20) NOT NULL,
  `rooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `innerArea` decimal(10,0) DEFAULT NULL,
  `outerArea` decimal(10,0) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `location`, `price`, `rooms`, `bathrooms`, `innerArea`, `outerArea`, `userID`) VALUES
(1, 'Apartamento en arriendo', 'Apartamento nuevo para que disfrutes con tu familia, tiene excelentes acabados en los interiores de los baños y alcobas, cerca de colegios univerisdad (UTB San buenaventura) transporte publico Terminal de transporte, llamanos ya!.', 'VILLA ROSITA - Cartagena - Bolívar', 'COP 900,000', 3, 2, '53', '0', 1),
(2, 'Apartamento en arriendo', 'Hermoso apartamento esquinero a estrenar, sector manga cartagena Colombia, cuenta con tres habitaciones, tres baños, sala comedor, cocina americana, Zona de labores, balcon con Una excelente vista, parqueadero, el conjunto dispone de vigilancia privada las 24 horas, salon de niños, solarium y piscina en el ultimo nivel con Una impresionante vista, muy cerca al centro historico y Zona turistica, buen transporte publico, supermercados, restaurantes, etc contrato a un año', 'MANGA - Cartagena - Bolívar', 'COP 3,600,000', 3, 3, '97', '0', 1),
(3, 'Apartamento en arriendo', 'Apartamento en arriendo a estrenar con excelente acabados consta de 3 habitaciones, 2 baños, sala comedor, cocina integral, Zona de labores, parqueadero propio. Amenidades: Piscina , gym full dotado, salon social climatizado, baño turco , 4 pisos de parqueadero de visitantes.', 'URBANIZACION EL CAMPESTRE - Cartagena - Bolívar', 'COP 1,700,000', 3, 2, '66', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('0','1') DEFAULT '1',
  `post_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `post_images`
--

INSERT INTO `post_images` (`id`, `file_name`, `uploaded_on`, `status`, `post_id`) VALUES
(1, 'a1ef63dc82a2612526fb56e5293b1ac0.jpg', '2022-11-13 17:19:36', '1', 1),
(2, 'bcd37a1255d884863497b289904333ee.jpg', '2022-11-13 17:19:36', '1', 1),
(3, '6e6329194203f9f42392283529fd67fe.jpg', '2022-11-13 17:19:36', '1', 1),
(4, '89d28c4811e69c0cd60aeea8ef0da08f.jpg', '2022-11-13 17:19:36', '1', 1),
(5, '88d2cc03ea94167a3b1708203cd763ad.jpg', '2022-11-13 17:19:36', '1', 1),
(6, 'd5bf3ca8013c4bcc3ae4c757bbd953c0.jpg', '2022-11-13 17:23:28', '1', 2),
(7, '672537bac8d3a6cd583f1c971d61f4f3.jpg', '2022-11-13 17:23:28', '1', 2),
(8, '564b41a08dedb97d22fef969ee467708.jpg', '2022-11-13 17:23:28', '1', 2),
(9, '260df090f06c01a12dfc11bc3a6eb3fc.jpg', '2022-11-13 17:23:28', '1', 2),
(10, '7a8164cb0e88f43c08079dd4a4138cf0.jpg', '2022-11-13 17:23:28', '1', 2),
(11, '9247cb363b7f03c7f3cb543f34eac259.jpg', '2022-11-13 17:26:49', '1', 3),
(12, '36ed4df18cae04965e57cec95fd626b8.jpg', '2022-11-13 17:26:49', '1', 3),
(13, '4a0caee2d21a8f3ebeaa3019184ad368.jpg', '2022-11-13 17:26:49', '1', 3),
(14, '23f5ba4c2b226ae8adae0154b9116537.jpg', '2022-11-13 17:26:49', '1', 3),
(15, 'bc9e69cf0ab9df24f8286341c02c9e77.jpg', '2022-11-13 17:26:49', '1', 3),
(16, '89c98fd271e3b6f460fa420631216d44.jpg', '2022-11-13 17:26:49', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ratings`
--

CREATE TABLE `ratings` (
  `rating` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `target_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `profile-pic` varchar(255) DEFAULT 'default-user.svg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `description`, `phone`, `profile-pic`) VALUES
(1, 'Pablo Jose Hernandez Melendez', 'phernandezm07@gmail.com', '278a216fc87211a680a8e52067bd2a2b', 'Estudiante de ingeniería de sistemas en la Universidad de Cartagena.', '3052012834', '8f029bada58fa9255f590dd850c0a1bd.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favourites`
--
ALTER TABLE `favourites`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Indices de la tabla `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indices de la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `target_id` (`target_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `post_images`
--
ALTER TABLE `post_images`
  ADD CONSTRAINT `post_images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ratings_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
