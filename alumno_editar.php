<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID no proporcionado.");
}

$stmt = $pdo->prepare("SELECT * FROM alumnos WHERE id = ?");
$stmt->execute([$id]);
$alumno = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alumno) {
    die("Alumno no encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $es_menor = isset($_POST['es_menor']) ? 1 : 0;
    $baja = isset($_POST['baja']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE alumnos SET nombre = ?, apellido = ?, dni = ?, telefono = ?, email = ?, direccion = ?, fecha_nacimiento = ?, es_menor = ?, baja = ? WHERE id = ?");
    $stmt->execute([$nombre, $apellido, $dni, $telefono, $email, $direccion, $fecha_nacimiento, $es_menor, $baja, $id]);

    header("Location: alumno_lista.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Editar Alumno</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($alumno['nombre']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Apellido:</label>
            <input type="text" name="apellido" value="<?= htmlspecialchars($alumno['apellido']) ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>DNI/NIE:</label>
            <input type="text" name="dni" value="<?= htmlspecialchars($alumno['dni']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($alumno['telefono']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($alumno['email']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?= htmlspecialchars($alumno['direccion']) ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" value="<?= htmlspecialchars($alumno['fecha_nacimiento']) ?>" class="form-control">
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="es_menor" id="es_menor" <?= $alumno['es_menor'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="es_menor">Es menor de edad</label>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="baja" id="baja" <?= $alumno['baja'] ? 'checked' : '' ?>>
            <label class="form-check-label" for="baja">Dar de baja al alumno</label>
        </div>
        <button class="btn btn-primary">Guardar cambios</button>
        <a href="alumno_lista.php" class="btn btn-secondary">Cancelar</a>
    </form>
</body>
</html>