<?php
namespace Modelo;

require_once 'Articulo.php';

class Datos {
    public static function getCatalogo() {
        // Si no existe el catálogo en la sesión, inicializamos los productos base
        if (!isset($_SESSION['catalogo_productos'])) {
            $_SESSION['catalogo_productos'] = [
                1 => new Articulo(1, 'Router Mikrotik hAP ac2', 250.00),
                2 => new Articulo(2, 'Bobina de Fibra Óptica Drop 1km', 380.00),
                3 => new Articulo(3, 'ONT Huawei XPON', 85.00),
                4 => new Articulo(4, 'Switch Administrable Giga 8p', 190.00)
            ];
        }
        return $_SESSION['catalogo_productos'];
    }

    public static function agregarNuevoArticulo($nombre, $precio) {
        $catalogo = self::getCatalogo();
        
        // Auto-incrementar el ID basándonos en el último elemento
        $nuevoId = empty($catalogo) ? 1 : max(array_keys($catalogo)) + 1;
        
        // Guardar el nuevo artículo en la sesión del catálogo
        $_SESSION['catalogo_productos'][$nuevoId] = new Articulo($nuevoId, $nombre, $precio);
    }
}