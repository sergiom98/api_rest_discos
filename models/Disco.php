<?php
    class Disco {
        function __construct(int $id_disco, string $nombre, string $duracion,
            string $casa_discografica, string $fecha_edicion, string $imagen) 
            {
                $this->id_disco = $id_disco;
                $this->nombre = $nombre;
                $this->duracion = $duracion;
                $this->casa_discografica = $casa_discografica;
                $this->fecha_edicion = $fecha_edicion;
                $this->imagen = $imagen;
        }
    }
?>