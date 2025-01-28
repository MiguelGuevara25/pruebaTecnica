<?php
// Incluir la conexión a la base de datos
include 'db.php';
// Definir las consultas SQL
$queryBodega = "SELECT id, nombre FROM bodega";
$queryMoneda = "SELECT id, nombre FROM moneda";

// Ejecutar las consultas
$bodegas = $pdo->query($queryBodega);
$monedas = $pdo->query($queryMoneda);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Prueba técnica</title>
</head>

<body>
  <div class="form-container">
    <div class="form-box">
      <h1 class="form-title">Formulario de producto</h1>

      <form id="productForm" method="POST" action="guardar_producto.php">
        <div class="form-inputs">
          <div class="form-group">
            <label for="codigo">Código</label>
            <input id="codigo" type="text" name="codigo" class="form-input">
          </div>

          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input id="nombre" type="text" name="nombre" class="form-input">
          </div>

          <div class="form-group">
            <label for="bodega">Bodega</label>
            <select name="bodega" id="bodega" class="form-input">
              <option value="">Seleccione una bodega</option>
              <?php foreach ($bodegas as $bodega): ?>
                <option value="<?= $bodega['id'] ?>">
                  <?= $bodega['nombre'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="sucursal">Sucursal</label>
            <select name="sucursal" id="sucursal" class="form-input">
            </select>
          </div>

          <div class="form-group">
            <label for="moneda">Moneda</label>
            <select name="moneda" id="moneda" class="form-input">
              <option value="">Seleccione una moneda</option>
              <?php foreach ($monedas as $moneda): ?>
                <option value="<?= $moneda['id'] ?>">
                  <?= $moneda['nombre'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="precio">Precio</label>
            <input id="precio" type="text" name="precio" class="form-input">
          </div>
        </div>

        <div class="form-group__checkbox">
          <p class="form-label">Material del Producto</p>

          <div class="form-checkbox-group">
            <div class="form-checkbox">
              <input type="checkbox" id="plastic" name="materiales[]" value="Plástico">
              <label for="plastic">Plástico</label>
            </div>

            <div class="form-checkbox">
              <input type="checkbox" id="metal" name="materiales[]" value="Metal">
              <label for="metal">Metal</label>
            </div>

            <div class="form-checkbox">
              <input type="checkbox" id="wood" name="materiales[]" value="Madera">
              <label for="wood">Madera</label>
            </div>

            <div class="form-checkbox">
              <input type="checkbox" id="glass" name="materiales[]" value="Vidrio">
              <label for="glass">Vidrio</label>
            </div>

            <div class="form-checkbox">
              <input type="checkbox" id="textile" name="materiales[]" value="Textil">
              <label for="textile">Textil</label>
            </div>
          </div>
        </div>

        <div class="form-group__textarea">
          <label for="descripcion">Descripción</label>
          <textarea id="descripcion" name="descripcion" class="form-textarea"></textarea>
        </div>

        <div class="btn-container">
          <input class="form-button" type="submit" value="Guardar Producto">
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>

</body>

</html>