<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se ha recibido el parámetro para habilitados/inhabilitados
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto muestra habilitados

// Recuperar ubicaciones según el estado de habilitación
$sql = "SELECT * FROM horarios WHERE habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
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

        <div class="text-center mb-3">
            <a href="?habilitado=1" class="btn btn-success btn-sm">Mostrar Habilitados</a>
            <a href="?habilitado=0" class="btn btn-warning btn-sm">Mostrar Inhabilitados</a>
        </div>

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
                            <?php if ($horario['habilitado'] == 1): ?>
                                <a href="../eliminar/el_horario.php?id=<?= $horario['Id_Horario'] ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Estás seguro de eliminar a este horario?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_horario.php?id=<?= $horario['Id_Horario'] ?>"
                                    class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_horario.php" class="btn btn-primary">Agregar Nuevo Horario</a>
            <a href="../index2.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
