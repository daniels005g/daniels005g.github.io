<?php
namespace Modelo;

class Articulo {
    public $id;
    public $nombre;
    public $precio;

    public function __construct($id, $nombre, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
}