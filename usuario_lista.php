<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY username ASC");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios Administradores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Usuarios Administradores</h2>
    <p><a href="dashboard.php" class="btn btn-secondary btn-sm">← Volver al panel</a></p>
    <p><a href="usuario_nuevo.php" class="btn btn-success">+ Crear nuevo usuario</a></p>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td>
                    <?php if ($_SESSION['usuario'] !== $u['username']): ?>
                        <a href="usuario_borrar.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                    <?php else: ?>
                        <em>(tú)</em>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
