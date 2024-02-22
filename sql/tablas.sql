-- Estructura de tabla para la tabla `clase`
CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombreClase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `palabras`
CREATE TABLE IF NOT EXISTS `palabras` (
  `idPalabra` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `audio` blob DEFAULT NULL,
  `idClase` int(11) DEFAULT NULL,
  `palabra` varchar(255) DEFAULT NULL,
  FOREIGN KEY (`idClase`) REFERENCES `clase` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `traducciones`
CREATE TABLE IF NOT EXISTS `traducciones` (
  `idTraduccion` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `significados` text DEFAULT NULL,
  `idPalabra` int(11) DEFAULT NULL,
  FOREIGN KEY (`idPalabra`) REFERENCES `palabras` (`idPalabra`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;