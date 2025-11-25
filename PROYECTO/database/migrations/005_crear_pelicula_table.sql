CREATE TABLE peliculas (
    id_pelicula INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL UNIQUE,
    tipo ENUM('pelicula', 'serie') NOT NULL,
    genero VARCHAR(50) NOT NULL,
    anio YEAR NOT NULL,
    duracion INT NOT NULL, -- minutos
    clasificacion VARCHAR(10),
    sinopsis TEXT,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);