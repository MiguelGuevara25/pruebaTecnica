<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $codigo = $_POST['codigo'] ?? null;
  $nombre = $_POST['nombre'] ?? null;
  $bodega = $_POST['bodega'] ?? null;
  $sucursal = $_POST['sucursal'] ?? null;
  $moneda = $_POST['moneda'] ?? null;
  $precio = $_POST['precio'] ?? null;
  $materiales = isset($_POST['materiales']) ? implode(', ', $_POST['materiales']) : null;
  $descripcion = $_POST['descripcion'] ?? null;

  if (!$codigo || !$nombre || !$bodega || !$sucursal || !$moneda || !$precio) {
    echo json_encode(["status" => "error", "code" => "missing_fields"]);
    exit;
  }

  $checkCodigoQuery = "SELECT COUNT(*) FROM productos WHERE codigo = '$codigo'";
  $resultado = $pdo->query($checkCodigoQuery);
  $existeCodigo = $resultado->fetchColumn();

  if ($existeCodigo > 0) {
    echo json_encode(["status" => "error", "code" => "codigo_existe"]);
    exit;
  }

  $query = "INSERT INTO productos (codigo, nombre, bodega_id, sucursal_id, moneda_id, precio, materiales, descripcion) 
            VALUES ('$codigo', '$nombre', '$bodega', '$sucursal', '$moneda', '$precio', '$materiales', '$descripcion')";

  if ($pdo->exec($query)) {
    echo json_encode(["status" => "success", "code" => "producto_guardado"]);
  } else {
    echo json_encode(["status" => "error", "code" => "error_guardar"]);
  }
}
