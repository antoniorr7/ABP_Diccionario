
CREATE TABLE IF NOT EXISTS `clase` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombreClase` varchar(255) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `palabras`
CREATE TABLE IF NOT EXISTS `palabras` (
  `idPalabra` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `audio` blob DEFAULT NULL,
  `idClase` int(11) DEFAULT NULL,
  `palabra` varchar(255) DEFAULT NULL,
  UNIQUE KEY `idClase_palabra` (`idClase`, `palabra`),
  FOREIGN KEY (`idClase`) REFERENCES `clase` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `traducciones`
CREATE TABLE IF NOT EXISTS `traducciones` (
  `idTraduccion` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `significados` text DEFAULT NULL,
  `idPalabra` int(11) DEFAULT NULL,
  FOREIGN KEY (`idPalabra`) REFERENCES `palabras` (`idPalabra`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE IF NOT EXISTS `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombreUsuario` varchar(255) NOT NULL UNIQUE,
  `contrasena` varchar(255) NOT NULL,
  `esAdmin` BIT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


ALTER TABLE `clase`
ADD COLUMN `idUsuario` int(11) DEFAULT NULL,
ADD CONSTRAINT `fk_usuario_clase`
FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
ON DELETE CASCADE;
ALTER TABLE `clase`
ADD CONSTRAINT `nombreClase_idUsuario_unique`
UNIQUE (`nombreClase`, `idUsuario`);


ALTER TABLE `clase`
ADD COLUMN `codigo` varchar(5) NOT NULL UNIQUE;






-- -- Estructura de tabla para la tabla `clase`
-- CREATE TABLE IF NOT EXISTS `clase` (
--   `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `nombreClase` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Estructura de tabla para la tabla `palabras`
-- CREATE TABLE IF NOT EXISTS `palabras` (
--   `idPalabra` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `audio` blob DEFAULT NULL,
--   `idClase` int(11) DEFAULT NULL,
--   `palabra` varchar(255) DEFAULT NULL,
--   FOREIGN KEY (`idClase`) REFERENCES `clase` (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Estructura de tabla para la tabla `traducciones`
-- CREATE TABLE IF NOT EXISTS `traducciones` (
--   `idTraduccion` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `significados` text DEFAULT NULL,
--   `idPalabra` int(11) DEFAULT NULL,
--   FOREIGN KEY (`idPalabra`) REFERENCES `palabras` (`idPalabra`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Estructura de tabla para la tabla `usuarios`
-- CREATE TABLE IF NOT EXISTS `usuarios` (
--   `idUsuario` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `nombreUsuario` varchar(255) NOT NULL,
--   `contrasena` varchar(255) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -- Añadir restricción de unicidad al campo nombreUsuario en la tabla usuarios
-- ALTER TABLE usuarios
-- ADD CONSTRAINT nombreUsuario_unico UNIQUE (nombreUsuario);
-- ALTER TABLE usuarios
-- ADD COLUMN esAdmin BIT DEFAULT 0;


-- -- Modificar tabla palabras para agregar ON DELETE CASCADE
-- ALTER TABLE palabras
-- ADD CONSTRAINT fk_idClase
-- FOREIGN KEY (`idClase`)
-- REFERENCES `clase` (`id`)
-- ON DELETE CASCADE;

-- -- Modificar tabla traducciones para agregar ON DELETE CASCADE
-- ALTER TABLE traducciones
-- ADD CONSTRAINT fk_idPalabra
-- FOREIGN KEY (`idPalabra`)
-- REFERENCES `palabras` (`idPalabra`)
-- ON DELETE CASCADE;
-- Estructura de tabla para la tabla `clase`
-- Estructura de tabla para la tabla `clase`