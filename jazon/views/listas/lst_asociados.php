<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Determinar el valor de habilitado según el filtro
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto, se muestran habilitados

// Recuperar los asociados basados en el valor de habilitado
$sql = "SELECT a.Id_Asociado, a.nombre, a.Apellido_Pat, a.Apellido_Mat, a.fecha_nacimiento, a.habilitado, z.NombreZona, u.usuario
        FROM asociados a
        LEFT JOIN zona z ON a.id_zona = z.Id_Zona
        LEFT JOIN usuarios u ON a.id_usuario = u.id_usuario
        WHERE a.habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$asociados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Asociados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Listado de Asociados</h2>

        <!-- Botón para cambiar entre habilitados e inhabilitados -->
        <div class="text-center mb-3">
            <a href="?habilitado=1" class="btn btn-success btn-sm">Mostrar Habilitados</a>
            <a href="?habilitado=0" class="btn btn-warning btn-sm">Mostrar Inhabilitados</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Zona</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($asociados as $asociado): ?>
                    <tr>
                        <td><?= $asociado['Id_Asociado'] ?></td>
                        <td><?= htmlspecialchars($asociado['nombre']) ?></td>
                        <td><?= htmlspecialchars($asociado['Apellido_Pat']) ?></td>
                        <td><?= htmlspecialchars($asociado['Apellido_Mat']) ?></td>
                        <td><?= htmlspecialchars($asociado['fecha_nacimiento']) ?></td>
                        <td><?= htmlspecialchars($asociado['NombreZona'] ?? 'No asignada') ?></td>
                        <td><?= htmlspecialchars($asociado['usuario']) ?></td>
                        <td>
                            <a href="../editar/ed_asociado.php?id=<?= $asociado['Id_Asociado'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <?php if ($asociado['habilitado'] == 1): ?>
                                <a href="../eliminar/el_asociado.php?id=<?= $asociado['Id_Asociado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar a este asociado?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_asociado.php?id=<?= $asociado['Id_Asociado'] ?>" class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_asociado.php" class="btn btn-primary">Agregar Nuevo Asociado</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
