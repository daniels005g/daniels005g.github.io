<?php
namespace Modelo;

class Datos {
    public static function getCatalogo() {
        return [
            1 => new Articulo(1, 'Router Mikrotik hAP ac2', 250.00),
            2 => new Articulo(2, 'Bobina de Fibra Óptica Drop 1km', 380.00),
            3 => new Articulo(3, 'ONT Huawei XPON', 85.00),
            4 => new Articulo(4, 'Switch Administrable Giga 8p', 190.00)
        ];
    }
}