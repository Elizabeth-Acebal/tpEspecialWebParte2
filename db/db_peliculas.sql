-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2023 a las 05:17:45
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `genero` varchar(40) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`genero`, `id_genero`) VALUES
('Acción', 1),
('Animación', 2),
('Ciencia ficción', 3),
('Drama', 4),
('Comedia', 5),
('Terror', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `pelicula_id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` text NOT NULL,
  `director` varchar(45) NOT NULL,
  `calificacion` varchar(45) NOT NULL,
  `id_genero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`pelicula_id`, `titulo`, `descripcion`, `director`, `calificacion`, `id_genero`) VALUES
(12, 'EL EXORSISTA', 'Hace exactamente 50 años este otoño, la película de terror más aterradora de la historia llegó a las pantallas, impactando a la audiencia de todo el mundo. Este año, en octubre, comienza un nuevo capítulo. De Blumhouse y el director David Gordon Green, quienes rompieron el statu quo con la resurrección de la franquicia de Halloween, llega \"El Exorcista: Creyentes\".', 'David Gordon Green', 'Apta para mayores de 13 años con reservas', 6),
(13, 'SONIDO DE LIBERTAD', 'Sonido De Libertad, basada en una increíble historia real, trae luz y esperanza al obscuro mundo del tráfico de menores. Después de rescatar a un niño de los traficantes, un agente federal descubre que la hermana del niño todavía está cautiva y decide embarcarse en una peligrosa misión para salvarla. Con el tiempo en su contra, renuncia a su trabajo y se adentra en lo profundo de la selva colombiana, poniendo su vida en riesgo para liberarla y traerla de vuelta a casa.', 'Alejandro Monteverde', 'Apta para mayores de 13 años con reservas', 4),
(14, 'PAW PATROL: LA SUPER PELICULA', 'Cuando un meteorito mágico aterriza en Adventure City, otorga superpoderes a los cachorros de PAW Patrol, ¡transformándolos en los SÚPER CACHORROS! Para Skye, la más pequeña del equipo, sus nuevos poderes son un sueño hecho realidad. Pero las cosas empeoran cuando el archirrival de los cachorros, Humdinger, escapa de la cárcel y se une a una científica loca para robarles los superpoderes. Con el destino de Adventure City en juego, los Súper Cachorros deberán detener a los supervillanos antes de que sea demasiado tarde, y Skye deberá aprender que incluso el cachorro más pequeño puede marcar la diferencia.', 'Callan Brunker', 'Apta para todo publico', 2),
(15, 'LA MONJA', '1956, Francia. Un sacerdote es asesinado, un mal se extiende y la hermana Irene se enfrenta de nuevo a la fuerza malévola de Valak, la monja demonio.', 'Michael Chaves', 'Apta para mayores de 13 años con reservas', 6),
(16, 'EL JUSTICIERO', 'Desde que renunció a su vida como asesino del gobierno, Robert McCall (Denzel Washington) ha luchado por reconciliarse con las horribles cosas que hizo en el pasado y encuentra un extraño consuelo en servir a la justicia en nombre de los oprimidos. Encontrándose sorpresivamente en su casa en el sur de Italia, descubre que sus nuevos amigos están bajo el control de los jefes del crimen local. Cuando los acontecimientos se tornan mortales, McCall sabe lo que tiene que hacer: convertirse en el protector de sus amigos enfrentándose a la mafia.', 'Antoine Fuqua', 'Apta para mayores de 16 años', 1),
(17, 'DISNEY 100: TOY STORY', 'Ambientado en un mundo donde los juguetes tienen vida propia, esta historia está vista a través de dos juguetes: Woody (Tom Hanks), un vaquero parlante a cuerda, y Buzz Lightyear (Tim Allen), una heroica figura de acción especial. El cómico dúo finalmente aprende a dejar de lado sus diferencias cuando se separan de su dueño, Andy, y se encuentran en una desopilante misión llena de aventuras…donde solo sobrevivirán si forman una alianza.', 'Disney', 'Apta para todo publico', 2),
(21, 'PUAN', 'Marcelo ha dedicado su vida a la enseñanza de filosofía en la Universidad de Buenos Aires. Cuando el Profesor Caselli, su mentor, muere inesperadamente, Marcelo asume que heredará la posición de titular de Cátedra que ha quedado vacante. Lo que no imagina es que Rafael Sujarchuk, un carismático y seductor colega, regresará de su pedestal en las universidades europeas para disputar esa misma Cátedra. Los torpes esfuerzos de Marcelo por demostrar que es el mejor candidato desencadenarán un duelo filosófico, mientras su vida y el país entran en un espiral de caos. Cuando el Profesor Caselli, su mentor, muere inesperadamente, Marcelo asume que heredará el puesto vacante. Sin embargo Rafael, un carismático colega, regresa de Europa para disputar esa misma Cátedra. Los torpes esfuerzos de Marcelo por demostrar que es el mejor candidato desencadenarán un duelo filosófico, mientras su vida y el país entran en un espiral de caos.', 'María Alché & Benjamín Naishtat', 'Apta para todo publico', 5),
(23, 'INFINITY POOL', 'El trailer muestra a un escritor y su pareja de vacaciones en una isla paradisíaca, donde se topan con una fanática que menciona que lleva años esperando por su segundo libro, pero él parece estar bloqueado.', ' Brandon Cronenberg', 'Apta para mayores de 13 años con reservas', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(45) NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`) VALUES
(1, 'webadmin@gmail.com', '$2a$12$c1nkKjuvptVH523qEfYnlupx0rcfLuGhGoKdxNkt5rTCZhcB7buHC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`pelicula_id`),
  ADD KEY `fk_peliculas_género` (`id_genero`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `pelicula_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(45) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD CONSTRAINT `fk_peliculas_género` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
