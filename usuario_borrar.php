<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: usuario_lista.php");
exit;
