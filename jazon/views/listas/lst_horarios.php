<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Recuperar todos los asociados
$sql = "SELECT *
        FROM horarios
        WHERE habilitado = 1";
$stmt = $conn->query($sql);
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Horarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Listado de Horarios</h2>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hora Inicio</th>
                    <th>Hora Final</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($horarios as $horario): ?>
                    <tr>
                        <td><?= $horario['Id_Horario'] ?></td>
                        <td><?= htmlspecialchars($horario['Hora_Inicio']) ?></td>
                        <td><?= htmlspecialchars($horario['Hora_Final']) ?></td>
                        <td>
                            <a href="../editar/ed_horario.php?id=<?= $horario['Id_Horario'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../eliminar/el_horario.php?id=<?= $horario['Id_Horario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este horario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_horario.php" class="btn btn-primary">Agregar Nuevo Horario</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
