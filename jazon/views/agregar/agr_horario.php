<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hora_inicio = trim($_POST['hora_inicio']);
    $hora_final = trim($_POST['hora_final']);
    $habilitado = 1;

    if (!empty($hora_inicio) && !empty($hora_final)) {
        $sql = "INSERT INTO horarios (hora_inicio, hora_final, habilitado) VALUES (:hora_inicio, :hora_final, :habilitado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_final', $hora_final);
        $stmt->bindParam(':habilitado', $habilitado);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Horario nuevO agregado correctamente.</div>";
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
    <title>Agregar Horario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header.php'; ?>


    <div class="container mt-5">
        <h2 class="text-center">Agregar Nuevo Horario</h2>
        <form method="POST">
            <?php include '../componentes/form_horarios.php'; ?>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar Nuevo Horario</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>