<?php
include 'db.php';

if (isset($_GET['codigo'])) {
  $codigo = $_GET['codigo'];
  $checkCodigoQuery = "SELECT COUNT(*) FROM productos WHERE codigo = '$codigo'";
  $resultado = $pdo->query($checkCodigoQuery);
  $existeCodigo = $resultado->fetchColumn();

  if ($existeCodigo > 0) {
    echo json_encode(['exists' => true]);
  } else {
    echo json_encode(['exists' => false]);
  }
}
