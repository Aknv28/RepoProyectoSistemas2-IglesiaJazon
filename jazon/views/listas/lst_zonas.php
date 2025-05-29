<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se ha recibido el parámetro para habilitados/inhabilitados
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto muestra habilitados

// Recuperar ubicaciones según el estado de habilitación
$sql = "SELECT Id_Zona, nombreZona, habilitado FROM zona WHERE habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$zonas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Zonas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Listado de Zonas</h2>

        <div class="text-center mb-3">
            <a href="?habilitado=1" class="btn btn-success btn-sm">Mostrar Habilitadas</a>
            <a href="?habilitado=0" class="btn btn-warning btn-sm">Mostrar Inhabilitadas</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zonas as $zona): ?>
                    <tr>
                        <td><?= $zona['Id_Zona'] ?></td>
                        <td><?= htmlspecialchars($zona['nombreZona']) ?></td>
                        <td>
                            <a href="../editar/ed_zona.php?id=<?= $zona['Id_Zona'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <?php if ($zona['habilitado'] == 1): ?>
                                <a href="../eliminar/el_zona.php?id=<?= $zona['Id_Zona'] ?>" 
                                    class="btn btn-danger btn-sm" 
                                    onclick="return confirm('¿Estás seguro de eliminar a esta zona?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_zona.php?id=<?= $zona['Id_Zona'] ?>"
                                    class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_zona.php" class="btn btn-primary">Agregar Nuevo Zona</a>
            <a href="../index2.php" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
