-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 16:04:17
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
-- Base de datos: `mathmaster`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) DEFAULT NULL,
  `option4` varchar(255) DEFAULT NULL,
  `correct_option` enum('option1','option2','option3','option4') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `questions`
--

INSERT INTO `questions` (`id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`, `created_at`) VALUES
(1, 'Que son las cosas', 'Aja', 'Nada', 'oggnounbsti', 'hahahahaha', 'option1', '2024-11-20 08:07:29'),
(2, 'Quien es winner?', 'La pampara', 'Un ser humano', 'Un canson', 'Un canson', 'option1', '2024-11-20 08:08:47'),
(4, 'Quien es Yenesith', 'una mujer linda', 'una mujer inteligente', 'una perra sorprendente, curchilinea y elocuente', 'todas las anteriores', 'option4', '2024-11-20 14:37:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `student_answers`
--

CREATE TABLE `student_answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `selected_option` enum('option1','option2','option3','option4') NOT NULL,
  `answered_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Administrador','Docente','Estudiante') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Joss Cordoba Rivas', 'josscordobarivas@gmail.com', '$2y$10$nqOX3U7Lz38/gL6gvDdmh.KNHnYSRxZ2bh3rNiskf0EN8x5yvKAOC', 'Docente', '2024-11-19 23:18:41', '2024-11-19 23:18:41'),
(6, 'Docente', 'docente@gmail.com', '$2y$10$OHCeNFtxlCzYgaMX7S/1aeO5bRv6m0kxgMMa7TesY17o1Hhwt/.a2', 'Docente', '2024-11-19 23:35:37', '2024-11-19 23:35:37'),
(8, 'wiwi', 'winner@gmail.com', '$2y$10$DB9qsBGeKKIPU7oU7YUGM.509KnXyR.12klitKbioir.a8T1Co0K2', 'Administrador', '2024-11-20 12:07:10', '2024-11-20 12:07:10'),
(9, 'carlosdupa', 'carlosdupa@gmail.com', '$2y$10$AomylMx8Zg9TnAlo1a.MP.SKu.qbQXVMJBc/lKpn7YcODs6DVnHfi', 'Administrador', '2024-11-20 12:09:05', '2024-11-20 12:09:05'),
(10, 'jaider robira', 'jaider@gmail.com', '$2y$10$emY25dZ7y6meylQKHO//benMgyW3E9fucc8.fm15HA/Ist4ZPPLCm', 'Docente', '2024-11-20 12:20:52', '2024-11-20 12:20:52'),
(11, 'Administrador', 'administrador@gmail.com', '$2y$10$mGVd8jOKAwjmSvYZqMHwVOFDHlQD6VqKBXRfisgpMv5ED0NZESfVG', 'Administrador', '2024-11-20 14:33:51', '2024-11-20 14:33:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `student_answers`
--
ALTER TABLE `student_answers`
  ADD CONSTRAINT `student_answers_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_answers_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
