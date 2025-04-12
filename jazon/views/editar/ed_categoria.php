<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categoria = $_GET['id'];

    // Obtener datos actuales de la categoría
    $sql = "SELECT * FROM categoria WHERE Id_Categoria = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_categoria, PDO::PARAM_INT);
    $stmt->execute();
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la categoría
    if (!$categoria) {
        echo "<div class='alert alert-danger text-center'>Categoría no encontrada.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de categoría no válido.</div>";
    exit;
}

// Procesar actualización si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        $sql = "UPDATE categoria SET nombre = :nombre WHERE Id_Categoria = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':id', $id_categoria);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Categoría actualizada correctamente.</div>";
            // Actualizar los datos mostrados en el form
            $categoria['nombre'] = $nombre;
        } else {
            echo "<div class='alert alert-danger text-center'>Error al actualizar la categoría: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>El nombre no puede estar vacío.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Editar Categoría</h2>
        <form method="POST">
            <?php include '../componentes/form_categoria.php'; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>