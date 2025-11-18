CREATE TABLE IF NOT EXISTS valoracion (
    id_valoracion INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    id_pelicula INT,
    puntuacion INT NOT NULL,
    comentario TEXT,
    fecha DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (id_pelicula) REFERENCES peliculas(id_pelicula)
) ENGINE=InnoDB;
