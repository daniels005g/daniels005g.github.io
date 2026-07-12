<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda Web PHP - Construcion de Software</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h2 { color: #1F4E78; border-bottom: 2px solid #1F4E78; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border: 1px solid #dee2e6; }
        th { background-color: #1F4E78; color: white; }
        .container { display: flex; gap: 30px; }
        .box { flex: 1; padding: 25px; background: white; border-radius: 8px; border: 1px solid #e9ecef; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .btn { background-color: #2E74B5; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 0.9em; display: inline-block; }
        .btn:hover { background-color: #1F4E78; }
        .btn-danger { background-color: #c00000; }
        .btn-danger:hover { background-color: #8a0000; }
        .totales { text-align: right; margin-top: 20px; padding-top: 15px; border-top: 2px dashed #dee2e6; font-size: 1.1em; }
        .totales p { margin: 6px 0; }
    </style>
</head>
<body>

    <h2>Sistema de Ventas - Arquitectura MVC (Sin Base de Datos)</h2>

    <div class="container">
        <!-- Catálogo de Productos -->
        <div class="box">
            <h3 style="color: #2E74B5; margin-top:0;">Catálogo de Artículos</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripción</th>
                        <th>Precio Base</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $prod): ?>
                    <tr>
                        <td><strong><?= $prod->id ?></strong></td>
                        <td><?= htmlspecialchars($prod->nombre) ?></td>
                        <td>S/. <?= number_format($prod->precio, 2) ?></td>
                        <td><a class="btn" href="index.php?accion=agregar&id=<?= $prod->id ?>">Agregar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Carrito de Compras -->
        <div class="box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="color: #2E74B5; margin: 0;">Resumen del Carrito</h3>
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <a class="btn btn-danger" href="index.php?accion=vaciar">Vaciar Carrito</a>
                <?php endif; ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Artículo</th>
                        <th>Precio</th>
                        <th>Cant.</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['carrito'])): ?>
                        <?php foreach ($_SESSION['carrito'] as $id => $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td>S/. <?= number_format($item['precio'], 2) ?></td>
                            <td><?= $item['cantidad'] ?></td>
                            <td>S/. <?= number_format($item['precio'] * $item['cantidad'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #777;">El carrito está vacío.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Totales calculados en el Controlador -->
            <div class="totales">
                <p><strong>Subtotal (Valor Venta):</strong> S/. <?= number_format($subtotalNeto, 2) ?></p>
                <p style="color: #c00000;"><strong>IGV (18.00%):</strong> S/. <?= number_format($igv, 2) ?></p>
                <p style="font-size: 1.25em; color: #1F4E78; font-weight: bold;"><strong>Total a Pagar:</strong> S/. <?= number_format($totalPagar, 2) ?></p>
            </div>
        </div>
    </div>

</body>
</html>