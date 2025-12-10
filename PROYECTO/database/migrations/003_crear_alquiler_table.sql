CREATE TABLE alquiler (
    id_alquiler INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    id_pelicula INT NOT NULL,

    fecha_alquiler DATE NOT NULL DEFAULT (CURRENT_DATE),
    fecha_devolucion DATE DEFAULT NULL,

    estado ENUM('alquilado','devuelto','atrasado','cancelado') 
        NOT NULL DEFAULT 'alquilado',

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_alquiler_cliente FOREIGN KEY (id_cliente) 
        REFERENCES cliente(id_cliente)
        ON DELETE CASCADE 
        ON UPDATE CASCADE,

    CONSTRAINT fk_alquiler_pelicula FOREIGN KEY (id_pelicula) 
        REFERENCES peliculas(id_pelicula)
        ON DELETE CASCADE 
        ON UPDATE CASCADE
);
