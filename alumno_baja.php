<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("UPDATE alumnos SET estado = 'baja' WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: alumno_lista.php");
exit;
