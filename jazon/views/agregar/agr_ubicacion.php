<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $zona = trim($_POST['zona']);
    $calle = trim($_POST['calle']);
    $nrolugar = trim($_POST['nrolugar']);
    $habilitado = 1;

    if (!empty($zona) && !empty($calle) && !empty($nrolugar)) {
        $sql = "INSERT INTO ubicacion (zona, calle, nrolugar, habilitado) VALUES (:zona, :calle, :nrolugar, :habilitado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':zona', $zona);
        $stmt->bindParam(':calle', $calle);
        $stmt->bindParam(':nrolugar', $nrolugar);
        $stmt->bindParam(':habilitado', $habilitado);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Ubicacion agregada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar zona: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Los campos no pueden estar vacíos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Ubicacion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>
    <div class="container mt-5">
        <h2 class="text-center">Agregar Nueva Ubicacion</h2>
        <form method="POST">
            <?php include '../componentes/form_ubicacion.php'; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar Ubicacion</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>

</html>