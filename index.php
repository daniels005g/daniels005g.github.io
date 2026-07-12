<?php
require_once 'controlador/CarritoController.php';

use Controlador\CarritoController;

// Instanciar y ejecutar el controlador
$app = new CarritoController();
$app->manejarPeticion();
