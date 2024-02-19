-- Crear la tabla Clase
CREATE TABLE Clase (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombreClase VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- Crear la tabla PalabrasIngles
CREATE TABLE PalabrasIngles (
    idPalabra INT AUTO_INCREMENT PRIMARY KEY,
    Audio BLOB,
    idClase INT,
    FOREIGN KEY (idClase) REFERENCES Clase(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Crear la tabla Traducciones
CREATE TABLE Traducciones (
    idTraduccion INT AUTO_INCREMENT PRIMARY KEY,
    significados TEXT,
    idPalabra INT,
    FOREIGN KEY (idPalabra) REFERENCES PalabrasIngles(idPalabra) ON DELETE CASCADE
) ENGINE=InnoDB;
