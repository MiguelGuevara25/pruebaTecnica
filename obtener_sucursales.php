<?php
include 'db.php';

$querySucursales = "SELECT id, nombre FROM sucursales";
$sucursales = $pdo->query($querySucursales)->fetchAll();

echo json_encode($sucursales);
