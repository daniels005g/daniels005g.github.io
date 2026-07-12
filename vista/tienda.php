<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Evaluacion Final</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; background-color: #f8f9fa; color: #333; }
        h2 { color: #1F4E78; border-bottom: 2px solid #1F4E78; padding-bottom: 10px; display: flex; justify-content: space-between; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; background: white; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border: 1px solid #dee2e6; }
        th { background-color: #1F4E78; color: white; }
        
        /* Contenedor Principal (Regresamos a 2 columnas principales) */
        .container { display: flex; gap: 30px; align-items: flex-start; }
        .box { flex: 1; padding: 25px; background: white; border-radius: 8px; border: 1px solid #e9ecef; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        
        /* Estilos de Botones */
        .btn { background-color: #2E74B5; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 0.9em; display: inline-block; border: none; cursor: pointer; }
        .btn:hover { background-color: #1F4E78; }
        .btn-danger { background-color: #c00000; }
        .btn-danger:hover { background-color: #8a0000; }
        
        /* Botón Flotante / Icono Calculadora */
        .btn-calc { background-color: #ff9f0a; padding: 10px 15px; font-size: 1.1em; font-weight: bold; border-radius: 6px; display: flex; align-items: center; gap: 8px; }
        .btn-calc:hover { background-color: #cc7f08; }

        .totales { text-align: right; margin-top: 20px; padding-top: 15px; border-top: 2px dashed #dee2e6; font-size: 1.1em; }
        .totales p { margin: 6px 0; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }


        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); display: flex; justify-content: center; align-items: center; z-index: 1000; opacity: 0; pointer-events: none; transition: opacity 0.3s ease; }
        .modal-overlay.active { opacity: 1; pointer-events: auto; }
        .modal-content { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.3); width: 320px; position: relative; transform: scale(0.7); transition: transform 0.3s ease; }
        .modal-overlay.active .modal-content { transform: scale(1); }
        .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .modal-header h3 { margin: 0; color: #1F4E78; }
        .close-modal { font-size: 1.5em; background: none; border: none; cursor: pointer; color: #aaa; }
        .close-modal:hover { color: #333; }

        .calculator { background: #343a40; border-radius: 8px; padding: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); box-sizing: border-box; }
        .calc-screen { width: 100%; height: 50px; background: #212529; border: none; border-radius: 4px; color: #fff; text-align: right; padding: 10px; font-size: 1.5em; box-sizing: border-box; margin-bottom: 15px; font-family: monospace; }
        .calc-buttons { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
        .calc-btn { padding: 15px; font-size: 1.2em; border: none; border-radius: 4px; cursor: pointer; background: #e9ecef; color: #212529; font-weight: bold; text-align: center; }
        .calc-btn:hover { background: #ced4da; }
        .calc-btn.operator { background: #ff9f0a; color: white; }
        .calc-btn.operator:hover { background: #cc7f08; }
        .calc-btn.clear { background: #dc3545; color: white; }
        .calc-btn.clear:hover { background: #bd2130; }
        .calc-btn.equal { background: #28a745; color: white; grid-column: span 2; }
        .calc-btn.equal:hover { background: #218838; }
    </style>
</head>
<body>

    <h2>
        <span>EVALUACION FINAL - CONSTRUCCION DE SOFTWARE</span>
        <button class="btn btn-calc" onclick="toggleModal(true)">+ Calculadora</button>
    </h2>

    <!-- Formulario para crear un artículo -->
    <div class="box" style="margin-bottom: 30px;">
        <h3 style="color: #2E74B5; margin-top:0;">Agregar Nuevo Artículo al Catálogo</h3>
        <form action="index.php?controlador=carrito&accion=guardar_articulo" method="POST" style="display: flex; gap: 20px; align-items: flex-end;">
            <div class="form-group" style="flex: 2;">
                <label for="nombre">Descripción del Artículo:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Conector RJ45 blindado x100" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label for="precio">Precio Base (S/.):</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0.1" placeholder="0.00" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn" style="background-color: #28a745; padding: 10px 20px;">Crear Producto</button>
            </div>
        </form>
    </div>


    <div class="container">
        
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
                        <td><a class="btn" href="index.php?controlador=carrito&accion=agregar&id=<?= $prod->id ?>">Agregar</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="box">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="color: #2E74B5; margin: 0;">Resumen de Carrito</h3>
                <?php if (!empty($_SESSION['carrito'])): ?>
                    <a class="btn btn-danger" href="index.php?controlador=carrito&accion=vaciar">Vaciar Carrito</a>
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
                        <td colspan="4" style="text-align: center; color: #777;">El Carrito está vacía.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <div class="totales">
                <p><strong>Subtotal (Valor Venta):</strong> S/. <?= number_format($subtotalNeto, 2) ?></p>
                <p style="color: #c00000;"><strong>IGV (18.00%):</strong> S/. <?= number_format($igv, 2) ?></p>
                <p style="font-size: 1.25em; color: #1F4E78; font-weight: bold;"><strong>Total a Pagar:</strong> S/. <?= number_format($totalPagar, 2) ?></p>
            </div>
        </div>
    </div>


    <div id="calcModal" class="modal-overlay" onclick="closeModalOnOverlay(event)">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Calculadora de Apoyo</h3>
                <button class="close-modal" onclick="toggleModal(false)">&times;</button>
            </div>
            
            <div class="calculator">
                <input type="text" id="screen" class="calc-screen" value="0" disabled>
                <div class="calc-buttons">
                    <button class="calc-btn clear" onclick="clearScreen()">C</button>
                    <button class="calc-btn operator" onclick="pressKey('/')">/</button>
                    <button class="calc-btn operator" onclick="pressKey('*')">*</button>
                    <button class="calc-btn operator" onclick="pressKey('-')">-</button>
                    
                    <button class="calc-btn" onclick="pressKey('7')">7</button>
                    <button class="calc-btn" onclick="pressKey('8')">8</button>
                    <button class="calc-btn" onclick="pressKey('9')">9</button>
                    <button class="calc-btn operator" onclick="pressKey('+')">+</button>
                    
                    <button class="calc-btn" onclick="pressKey('4')">4</button>
                    <button class="calc-btn" onclick="pressKey('5')">5</button>
                    <button class="calc-btn" onclick="pressKey('6')">6</button>
                    <button class="calc-btn" onclick="pressKey('.')">.</button>
                    
                    <button class="calc-btn" onclick="pressKey('1')">1</button>
                    <button class="calc-btn" onclick="pressKey('2')">2</button>
                    <button class="calc-btn" onclick="pressKey('3')">3</button>
                    <button class="calc-btn" onclick="pressKey('0')">0</button>
                    
                    <button class="calc-btn equal" onclick="calculateResult()">=</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts de Control UI (Modal) y Funcionalidad (Calculadora) -->
    <script>
        // --- CONTROL DEL MODAL ---
        const modal = document.getElementById('calcModal');

        function toggleModal(show) {
            if (show) {
                modal.classList.add('active');
            } else {
                modal.classList.remove('active');
            }
        }

        // Cierra el modal si se hace clic fuera del recuadro blanco
        function closeModalOnOverlay(event) {
            if (event.target === modal) {
                toggleModal(false);
            }
        }

        // --- LÓGICA CALCULADORA ---
        const screen = document.getElementById('screen');
        let newOperation = true;

        function pressKey(key) {
            if (newOperation && !isNaN(key)) {
                screen.value = key;
                newOperation = false;
            } else {
                if (screen.value === '0' && key !== '.') {
                    screen.value = key;
                } else {
                    screen.value += key;
                }
                newOperation = false;
            }
        }

        function clearScreen() {
            screen.value = '0';
            newOperation = true;
        }

        function calculateResult() {
            try {
                let result = eval(screen.value);
                screen.value = Number(Math.round(result + 'e4') + 'e-4');
                newOperation = true;
            } catch (error) {
                screen.value = 'Error';
                newOperation = true;
            }
        }
    </script>

</body>
</html>