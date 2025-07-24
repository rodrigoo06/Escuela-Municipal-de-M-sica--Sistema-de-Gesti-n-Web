<?php
session_start();
require_once 'includes/db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol']
        ];
        header("Location: dashboard.php");
        exit;
    } else {
        $mensaje = "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Iniciar sesión</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-danger"><?= $mensaje ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Email:</label>
            <input name="email" type="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Contraseña:</label>
            <input name="password" type="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Entrar</button>
    </form>
</body>
</html>
