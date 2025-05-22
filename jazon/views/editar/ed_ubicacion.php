<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_ubicacion = $_GET['id'];
    // Obtener datos actuales de la ubicación
    $sql = "SELECT * FROM ubicacion WHERE Id_Ubicacion = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_ubicacion, PDO::PARAM_INT);
    $stmt->execute();
    $ubicacion = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si no se encuentra la ubicación
    if (!$ubicacion) {
        echo "<script> alert('no se encontro la ubicacion')</script>";

        exit;
    }
    else{
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de ubicación no válido.</div>";
    exit;
}

// Procesar actualización si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $zona = trim($_POST['zona']);
    $calle = trim($_POST['calle']);
    $nrolugar = trim($_POST['nrolugar']);

    if (!empty($zona) && !empty($calle) && !empty($nrolugar)) {
        $sql = "UPDATE ubicacion SET Zona = :zona, Calle = :calle, NroLugar = :nrolugar WHERE Id_Ubicacion = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':zona', $zona);
        $stmt->bindParam(':calle', $calle);
        $stmt->bindParam(':nrolugar', $nrolugar);
        $stmt->bindParam(':id', $id_ubicacion);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Ubicación actualizada exitosamente');
                    window.location.href = '../listas/lst_ubicaciones.php';
                  </script>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error al actualizar la ubicación: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Todos los campos deben ser llenados.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Ubicacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">

</head>

<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Editar Ubicacion</h2>
        <form method="POST">
            <?php include '../componentes/form_ubicacion.php'; ?>
            <button type="submit" class="btn btn-primary">Actualizar la Ubicacion</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>