<?php
require_once 'includes/auth.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?></h2>
    <p><a href="logout.php" class="btn btn-danger btn-sm">Cerrar sesión</a></p>

    <div class="list-group">
        <a href="alumno_registro.php" class="list-group-item list-group-item-action">➕ Registrar alumno</a>
        <a href="alumno_lista.php" class="list-group-item list-group-item-action">📋 Ver lista de alumnos</a>
        <a href="usuario_gestion.php" class="list-group-item list-group-item-action">👥 Gestionar administradores</a>
    </div>
</body>
</html>
