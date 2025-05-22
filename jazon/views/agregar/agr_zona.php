<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_zona = trim($_POST['nombre_zona']);
    $habilitado = 1;

    if (!empty($nombre_zona)) {
        $sql = "INSERT INTO zona (NombreZona, habilitado) VALUES (:nombre_zona, :habilitado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_zona', $nombre_zona);
        $stmt->bindParam(':habilitado', $habilitado);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Zona agregada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar zona: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>El nombre de la zona no puede estar vacío.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Zona</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>


<body>
    <?php include '../../includes/header2.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nueva Zona</h2>
        <form method="POST" onsubmit="return validarFormulario();">
        <?php include '../componentes/form_zona.php'; ?>

        <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar Zona</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <script src="../../js/zona.js"></script>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>
