<?php
require_once 'includes/auth.php';
require_once 'includes/db.php';

$busqueda = $_GET['busqueda'] ?? "";

$sql = "SELECT * FROM alumnos WHERE 
        nombre LIKE :b OR apellidos LIKE :b OR dni LIKE :b 
        ORDER BY fecha_registro DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute(['b' => "%$busqueda%"]);
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Alumnos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .baja {
            background-color: #f8d7da !important;
        }
    </style>
</head>
<body class="container py-4">
    <h2>Lista de Alumnos</h2>
    <p><a href="dashboard.php" class="btn btn-secondary btn-sm">← Volver al panel</a></p>

    <form method="GET" class="mb-3">
        <input name="busqueda" class="form-control" placeholder="Buscar por nombre, apellidos o DNI..." value="<?= htmlspecialchars($busqueda) ?>">
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Alta</th>
                <th>Bonificación</th>
                <th>Estado</th>
                <th>Fecha Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($alumnos as $a): ?>
            <tr class="<?= $a['estado'] === 'baja' ? 'baja' : '' ?>">
                <td><?= $a['nombre'] . " " . $a['apellidos'] ?></td>
                <td><?= $a['dni'] ?></td>
                <td><?= ucfirst($a['tipo_alta']) ?></td>
                <td>
                    <?php
                        switch ($a['bonificacion']) {
                            case 'familia_numerosa': echo "Familia Numerosa (50%)"; break;
                            case 'renta_baja': echo "Renta baja (100%)"; break;
                            case 'banda': echo "Banda (100%)"; break;
                            default: echo "Ninguna";
                        }
                    ?>
                </td>
                <td>
                    <?php
                        echo match ($a['estado']) {
                            'activo' => '🟢 Activo',
                            'lista_espera' => '🟡 Lista de espera',
                            'baja' => '🔴 Baja'
                        };
                    ?>
                </td>
                <td><?= $a['fecha_registro'] ?></td>
                <td>
                    <a href="alumno_editar.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                    <?php if ($a['estado'] != 'baja'): ?>
                        <a href="alumno_baja.php?id=<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Dar de baja al alumno?')">Dar baja</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
