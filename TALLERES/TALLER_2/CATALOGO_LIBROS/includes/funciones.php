<?php
function obtenerLibros() {
    return [
        [
            'titulo' => 'El Quijote',
            'autor' => 'Miguel de Cervantes',
            'anio_publicacion' => 1605,
            'genero' => 'Novela',
            'descripcion' => 'La historia del ingenioso hidalgo Don Quijote de la Mancha.'
        ],
        [
            'titulo' => 'Cien Años de Soledad',
            'autor' => 'Gabriel García Márquez',
            'anio_publicacion' => 1967,
            'genero' => 'Realismo mágico',
            'descripcion' => 'La historia de la familia Buendía en Macondo.'
        ],
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'anio_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Una visión sombría de un futuro totalitario.'
        ],
        [
            'titulo' => 'El Principito',
            'autor' => 'Antoine de Saint-Exupéry',
            'anio_publicacion' => 1943,
            'genero' => 'Fábula',
            'descripcion' => 'Un niño viaja entre planetas reflexionando sobre la vida.'
        ],
        [
            'titulo' => 'La Sombra del Viento',
            'autor' => 'Carlos Ruiz Zafón',
            'anio_publicacion' => 2001,
            'genero' => 'Misterio',
            'descripcion' => 'Un joven descubre un libro que cambia su vida.'
        ]
    ];
}

function mostrarDetallesLibro($libro) {
    // Exportar array como string
    $export = var_export($libro, true);

    // Reemplazar array (...) por [ ... ]
    $export = str_replace("array (", "[", $export);
    $export = preg_replace("/\n\s*\)/", "\n]", $export);

    return "<pre>$export</pre>";
}
?>