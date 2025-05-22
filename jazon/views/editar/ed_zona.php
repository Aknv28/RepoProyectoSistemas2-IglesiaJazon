<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_zona = $_GET['id'];

    // Obtener datos actuales de la zona
    $sql = "SELECT * FROM zona WHERE Id_Zona = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_zona, PDO::PARAM_INT);
    $stmt->execute();
    $zona = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la zona
    if (!$zona) {
        echo "<div class='alert alert-danger text-center'>Zona no encontrada.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de zona no válido.</div>";
    exit;
}

// Procesar actualización si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_zona = trim($_POST['nombre_zona']);

    if (!empty($nombre_zona)) {
        $sql = "UPDATE zona SET NombreZona = :nombre WHERE Id_Zona = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre_zona);
        $stmt->bindParam(':id', $id_zona);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Zona actualizada correctamente.</div>";
            // Actualizar los datos mostrados en el form
            $zona['nombre'] = $nombre_zona;
        } else {
            echo "<div class='alert alert-danger text-center'>Error al actualizar la zona: " . $conn->errorInfo()[2] . "</div>";
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
    <title>Editar Zona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Editar Zona</h2>
        <form method="POST" onsubmit="return validarFormulario();">
            <div class="mb-3">
                <label for="nombre_zona" class="form-label">Nombre de la Zona</label>
                <input type="text" name="nombre_zona" id="nombre_zona" class="form-control" value="<?= htmlspecialchars($zona['NombreZona']) ?>" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Zona</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <script src="../../js/zona.js"></script>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>
