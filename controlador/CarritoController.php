<?php
namespace Controlador;

require_once 'modelo/Datos.php';
use Modelo\Datos;

class CarritoController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function manejarPeticion() {
        $accion = $_GET['accion'] ?? 'listar';

        switch ($accion) {
            case 'agregar':
                $this->agregarAlCarrito();
                break;
            case 'vaciar':
                $this->vaciarCarrito();
                break;
            case 'listar':
            default:
                $this->mostrarTienda();
                break;
        }
    }

    private function agregarAlCarrito() {
        $id = intval($_GET['id'] ?? 0);
        $catalogo = Datos::getCatalogo();

        // Validamos que el artículo exista en nuestro modelo de datos
        if (isset($catalogo[$id])) {
            if (isset($_SESSION['carrito'][$id])) {
                $_SESSION['carrito'][$id]['cantidad']++;
            } else {
                $_SESSION['carrito'][$id] = [
                    'nombre'   => $catalogo[$id]->nombre,
                    'precio'   => $catalogo[$id]->precio,
                    'cantidad' => 1
                ];
            }
        }
        // Redirección limpia (Patrón Post-Redirect-Get)
        header('Location: index.php');
        exit();
    }

    private function vaciarCarrito() {
        $_SESSION['carrito'] = [];
        header('Location: index.php');
        exit();
    }

    private function mostrarTienda() {
        // Obtenemos los artículos del Modelo
        $productos = Datos::getCatalogo();
        
        // El controlador calcula los totales antes de enviarlos a la vista
        $subtotalNeto = 0.0;
        foreach ($_SESSION['carrito'] as $item) {
            $subtotalNeto += $item['precio'] * $item['cantidad'];
        }
        
        $igv = $subtotalNeto * 0.18;
        $totalPagar = $subtotalNeto + $igv;

        // Incluimos la Vista para renderizar la pantalla
        require_once 'vista/tienda.php';
    }
}