<?php
require_once 'modelo/Articulo.php';
require_once 'modelo/Datos.php';
require_once 'controlador/CarritoController.php';

use Controlador\CarritoController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$controladorInput = $_GET['controlador'] ?? 'carrito';
$accionInput      = $_GET['accion'] ?? 'listar';

if ($controladorInput === 'carrito') {
    $controller = new CarritoController();
    
    switch ($accionInput) {
        case 'agregar':
            $controller->agregarAlCarrito();
            break;
        case 'guardar_articulo': // <-- Nueva ruta
            $controller->guardarNuevoArticulo();
            break;
        case 'vaciar':
            $controller->vaciarCarrito();
            break;
        case 'listar':
        default:
            $controller->mostrarTienda();
            break;
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Controlador No Encontrado</h1>";
}