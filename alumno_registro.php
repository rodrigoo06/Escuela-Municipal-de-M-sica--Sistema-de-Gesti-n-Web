<?php
require_once 'includes/db.php';

$mensaje = "";

// Contar alumnos activos (no en lista de espera ni baja)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM alumnos WHERE estado = 'activo'");
$stmt->execute();
$alumnos_activos = $stmt->fetchColumn();

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos del alumno
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $domicilio = $_POST['domicilio'];
    $fecha_registro = date('Y-m-d');
    $es_menor = isset($_POST['es_menor']) ? 1 : 0;
    $tipo_alta = $_POST['tipo_alta'];
    $bonificacion = $_POST['bonificacion'];

    // Datos del representante
    $nombre_rep = $_POST['nombre_representante'] ?? null;
    $apellidos_rep = $_POST['apellidos_representante'] ?? null;
    $dni_rep = $_POST['dni_representante'] ?? null;
    $telefono_rep = $_POST['telefono_representante'] ?? null;
    $email_rep = $_POST['email_representante'] ?? null;
    $domicilio_rep = $_POST['domicilio_representante'] ?? null;

    // Determinar estado: activo o lista_espera
    $estado = ($alumnos_activos >= 55) ? 'lista_espera' : 'activo';

    $sql = "INSERT INTO alumnos 
        (nombre, apellidos, fecha_nacimiento, dni, telefono, email, domicilio, fecha_registro, es_menor,
        nombre_representante, apellidos_representante, dni_representante, telefono_representante, email_representante, domicilio_representante,
        tipo_alta, bonificacion, estado)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $nombre, $apellidos, $fecha_nacimiento, $dni, $telefono, $email, $domicilio, $fecha_registro, $es_menor,
        $nombre_rep, $apellidos_rep, $dni_rep, $telefono_rep, $email_rep, $domicilio_rep,
        $tipo_alta, $bonificacion, $estado
    ]);

    $mensaje = "Alumno registrado correctamente. Estado: $estado";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Alumno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleRepresentante() {
            const esMenor = document.getElementById("es_menor").checked;
            const repSection = document.getElementById("representante-section");
            repSection.style.display = esMenor ? "block" : "none";
        }
    </script>
</head>
<body class="container py-5">
    <h2>Registrar Alumno</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-success"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nombre:</label>
            <input name="nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Apellidos:</label>
            <input name="apellidos" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Fecha de nacimiento:</label>
            <input type="date" name="fecha_nacimiento" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>DNI/NIE:</label>
            <input name="dni" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Teléfono:</label>
            <input name="telefono" class="form-control">
        </div>
        <div class="mb-3">
            <label>Correo electrónico:</label>
            <input type="email" name="email" class="form-control">
        </div>
        <div class="mb-3">
            <label>Domicilio:</label>
            <textarea name="domicilio" class="form-control"></textarea>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="es_menor" name="es_menor" onchange="toggleRepresentante()">
            <label class="form-check-label" for="es_menor">¿Es menor de edad?</label>
        </div>

        <div id="representante-section" style="display:none;">
            <h5>Representante legal</h5>
            <div class="mb-3">
                <label>Nombre:</label>
                <input name="nombre_representante" class="form-control">
            </div>
            <div class="mb-3">
                <label>Apellidos:</label>
                <input name="apellidos_representante" class="form-control">
            </div>
            <div class="mb-3">
                <label>DNI:</label>
                <input name="dni_representante" class="form-control">
            </div>
            <div class="mb-3">
                <label>Teléfono:</label>
                <input name="telefono_representante" class="form-control">
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input name="email_representante" class="form-control">
            </div>
            <div class="mb-3">
                <label>Domicilio:</label>
                <textarea name="domicilio_representante" class="form-control"></textarea>
            </div>
        </div>

        <div class="mb-3">
            <label>Tipo de alta:</label>
            <select name="tipo_alta" class="form-control" required>
                <option value="renovacion">Renovación</option>
                <option value="nuevo">Nuevo</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Bonificación:</label>
            <select name="bonificacion" class="form-control">
                <option value="ninguna">Ninguna</option>
                <option value="familia_numerosa">Familia numerosa (50%)</option>
                <option value="renta_baja">Renta baja (100%)</option>
                <option value="banda">Miembro de la Banda (100%)</option>
            </select>
        </div>

        <button class="btn btn-primary">Registrar</button>
    </form>
</body>
</html>
