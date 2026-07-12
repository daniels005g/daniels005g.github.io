<?php
// 1. Carga automática de Modelos y Controladores necesarios
require_once 'modelo/Articulo.php';
require_once 'modelo/Datos.php';
require_once 'controlador/CarritoController.php';

use Controlador\CarritoController;

// 2. Iniciar sesión globalmente
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 3. Capturar qué controlador y acción solicita el usuario (por defecto: carrito y listar)
$controladorInput = $_GET['controlador'] ?? 'carrito';
$accionInput      = $_GET['accion'] ?? 'listar';

// 4. Enrutamiento dinámico
if ($controladorInput === 'carrito') {
    $controller = new CarritoController();
    
    // Ejecutamos el método según la acción solicitada
    switch ($accionInput) {
        case 'agregar':
            $controller->agregarAlCarrito();
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
    // Si se busca un controlador que no existe, mandamos un error 404
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Controlador No Encontrado</h1>";
}