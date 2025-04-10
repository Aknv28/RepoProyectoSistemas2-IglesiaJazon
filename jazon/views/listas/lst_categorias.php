<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Determinar el valor de habilitado según el filtro
$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1; // Por defecto, se muestran habilitadas

// Recuperar las categorías basadas en el valor de habilitado
$sql = "SELECT Id_Categoria, nombre, habilitado
        FROM categoria
        WHERE habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Listado de Categorías</h2>

        <!-- Botones para cambiar entre habilitadas e inhabilitadas -->
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
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria['Id_Categoria'] ?></td>
                        <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                        <td>
                            <a href="../editar/ed_categoria.php?id=<?= $categoria['Id_Categoria'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <?php if ($categoria['habilitado'] == 1): ?>
                                <a href="../eliminar/el_categoria.php?id=<?= $categoria['Id_Categoria'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">Eliminar</a>
                            <?php else: ?>
                                <a href="../recuperar/recu_categoria.php?id=<?= $categoria['Id_Categoria'] ?>" class="btn btn-success btn-sm">Recuperar</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="../agregar/agr_categoria.php" class="btn btn-primary">Agregar Nueva Categoría</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
