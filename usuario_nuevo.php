<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!$username || !$password) {
        $mensaje = "Debe introducir usuario y contraseña.";
    } else {
        // Comprobar si ya existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);

        if ($stmt->fetch()) {
            $mensaje = "El nombre de usuario ya existe.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, password_hash) VALUES (?, ?)");
            $stmt->execute([$username, $hash]);
            header("Location: usuario_lista.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Crear Nuevo Usuario</h2>
    <p><a href="usuario_lista.php" class="btn btn-secondary btn-sm">← Volver</a></p>

    <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nombre de usuario:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Crear Usuario</button>
    </form>
</body>
</html>
