<?php
namespace Controlador;

use Modelo\Datos;

class CarritoController {
    
    public function __construct() {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    }

    public function agregarAlCarrito() {
        $id = intval($_GET['id'] ?? 0);
        $catalogo = Datos::getCatalogo();

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
        // Redirige al enrutador principal en su acción por defecto (listar)
        header('Location: index.php?controlador=carrito&accion=listar');
        exit();
    }

    public function vaciarCarrito() {
        $_SESSION['carrito'] = [];
        header('Location: index.php?controlador=carrito&accion=listar');
        exit();
    }

    public function mostrarTienda() {
        // Pedir datos al Modelo
        $productos = Datos::getCatalogo();
        
        // Calcular variables de negocio (Totales + IGV)
        $subtotalNeto = 0.0;
        foreach ($_SESSION['carrito'] as $item) {
            $subtotalNeto += $item['precio'] * $item['cantidad'];
        }
        
        $igv = $subtotalNeto * 0.18;
        $totalPagar = $subtotalNeto + $igv;

        // Cargar la Vista correspondiente
        require_once 'vista/tienda.php';
    }
}