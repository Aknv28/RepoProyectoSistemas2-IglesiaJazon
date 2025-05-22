<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se ha recibido el parámetro para habilitados/inhabilitados
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto muestra habilitados

// Recuperar ubicaciones según el estado de habilitación
$sql = "SELECT * FROM ubicacion WHERE habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$ubicaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <h2 class="text-center">
            <?php echo $habilitado == 1 ? "Listado de Ubicaciones Habilitadas" : "Listado de Ubicaciones Inhabilitadas"; ?>
        </h2>
        <!-- Botones para cambiar entre habilitados e inhabilitados -->
        <div class="text-center mb-3">
            <a href="?habilitado=1" class="btn btn-success btn-sm">Mostrar Habilitadas</a>
            <a href="?habilitado=0" class="btn btn-warning btn-sm">Mostrar Inhabilitadas</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Zona</th>
                    <th>Calle</th>
                    <th>Nro Lugar</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ubicaciones as $ubicacion): ?>
                    <tr>
                        <td><?= $ubicacion['Id_Ubicacion'] ?></td>
                        <td><?= htmlspecialchars($ubicacion['Zona']) ?></td>
                        <td><?= htmlspecialchars($ubicacion['Calle']) ?></td>
                        <td><?= htmlspecialchars($ubicacion['NroLugar']) ?></td>
                        <td>
                            <a href="../editar/ed_ubicacion.php?id=<?= $ubicacion['Id_Ubicacion'] ?>"
                                class="btn btn-warning btn-sm">Editar</a>
                            <?php if ($ubicacion['habilitado'] == 1): ?>
                                <a href="../eliminar/el_ubicacion.php?id=<?= $ubicacion['Id_Ubicacion'] ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar esta zona?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_ubicacion.php?id=<?= $ubicacion['Id_Ubicacion'] ?>"
                                    class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_ubicacion.php" class="btn btn-primary">Agregar Nueva Ubicación</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
