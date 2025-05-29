<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Determinar el valor de habilitado según el filtro
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto, se muestran habilitados

// Recuperar los formularios basados en el valor de habilitado
$sql = "SELECT Id_Formulario, actividad, fecha, habilitado
        FROM formulario
        WHERE habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$formularios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto, se muestran habilitados

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Formularios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Listado de Formularios</h2>

        <!-- Botones para cambiar entre habilitados e inhabilitados -->
        <div class="text-center mb-3">
            <a href="?habilitado=1" class="btn btn-success btn-sm">Mostrar Habilitados</a>
            <a href="?habilitado=0" class="btn btn-warning btn-sm">Mostrar Inhabilitados</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Actividad</th>
                    <th>Fecha</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($formularios as $formulario): ?>
                    <tr>
                        <td><?= $formulario['Id_Formulario'] ?></td>
                        <td><?= htmlspecialchars($formulario['actividad']) ?></td>
                        <td><?= htmlspecialchars($formulario['fecha']) ?></td>
                        <td>
                            <a href="../editar/ed_formulario.php?id=<?= $formulario['Id_Formulario'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <?php if ($formulario['habilitado'] == 1): ?>
                                <a href="../eliminar/el_formulario.php?id=<?= $formulario['Id_Formulario'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este formulario?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_formulario.php?id=<?= $formulario['Id_Formulario'] ?>" class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_formulario.php" class="btn btn-primary">Agregar Nuevo Formulario</a>
            <a href="../index2.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
