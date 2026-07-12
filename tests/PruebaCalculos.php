<?php
/* 
  PRUEBA UNITARIA: Verificación de cálculos de venta
*/

// Datos de prueba (Simulamos un producto de 100 soles)
$precioProducto = 100.00;
$igvEsperado = 18.00;
$totalEsperado = 118.00;

// Lógica que estamos probando
$igvCalculado = $precioProducto * 0.18;
$totalCalculado = $precioProducto + $igvCalculado;

echo "\n--- RESULTADOS DE LA PRUEBA UNITARIA ---\n";

if ($igvCalculado == $igvEsperado) {
    echo "✅ PRUEBA 1 PASADA: El IGV es correcto (S/. 18.00).\n";
} else {
    echo "❌ PRUEBA 1 FALLIDA: El IGV está mal calculado.\n";
}

if ($totalCalculado == $totalEsperado) {
    echo "✅ PRUEBA 2 PASADA: El Total es correcto (S/. 118.00).\n";
} else {
    echo "❌ PRUEBA 2 FALLIDA: La suma total es incorrecta.\n";
}
echo "---------------------------------------\n";
?>
