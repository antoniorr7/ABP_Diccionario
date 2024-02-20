
-- Estructura de tabla para la tabla `clase`
CREATE TABLE `clase` (
  `id` int(11) NOT NULL,
  `nombreClase` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `palabras`
CREATE TABLE `palabras` (
  `idPalabra` int(11) NOT NULL,
  `audio` blob DEFAULT NULL,
  `idClase` int(11) DEFAULT NULL,
  `palabra` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `traducciones`
CREATE TABLE `traducciones` (
  `idTraduccion` int(11) NOT NULL,
  `significados` text DEFAULT NULL,
  `idPalabra` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


