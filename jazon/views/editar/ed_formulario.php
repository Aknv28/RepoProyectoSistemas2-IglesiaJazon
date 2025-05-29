<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se ha enviado un ID de formulario para editar
if (isset($_GET['id'])) {
    $id_formulario = $_GET['id'];

    $sql = "SELECT * FROM formulario WHERE Id_Formulario = :id_formulario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_formulario', $id_formulario);
    $stmt->execute();
    $formulario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$formulario) {
        echo "<div class='alert alert-danger text-center'>No se encontró el formulario.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger text-center'>No se proporcionó un ID de formulario.</div>";
    exit();
}

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $actividad = $_POST['actividad'];
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $pregunta4 = $_POST['pregunta4'];
    $fecha = $_POST['fecha'];
    $fecha_fin = $_POST['fecha_fin'];
    $habilitado = $_POST['habilitado'];

    $sql_update = "UPDATE formulario 
                   SET Actividad = :actividad, Pregunta1 = :pregunta1, Pregunta2 = :pregunta2, Pregunta3 = :pregunta3, 
                       Pregunta4 = :pregunta4, Fecha = :fecha, Fecha_fin = :fecha_fin, habilitado = :habilitado
                   WHERE Id_Formulario = :id_formulario";

    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':actividad', $actividad);
    $stmt->bindParam(':pregunta1', $pregunta1);
    $stmt->bindParam(':pregunta2', $pregunta2);
    $stmt->bindParam(':pregunta3', $pregunta3);
    $stmt->bindParam(':pregunta4', $pregunta4);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->bindParam(':habilitado', $habilitado);
    $stmt->bindParam(':id_formulario', $id_formulario);

    if ($stmt->execute()) {
        echo "<script>
                alert('Formulario actualizado exitosamente.');
                window.location.href = '../listas/lst_formularios.php';
              </script>";
        exit();
    } else {
        echo "<div class='alert alert-danger text-center'>Error al actualizar formulario: " . $conn->errorInfo()[2] . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Editar Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
<?php include '../../includes/header2.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Editar Formulario</h2>
    <form method="POST" onsubmit="return validarFormulario();">
        <?php include '../componentes/form_formulario.php'; ?>
        <input type="hidden" name="habilitado" value="<?= $formulario['habilitado'] ?>">
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Actualizar Formulario</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
        </div>
    </form>
</div>

<script src="../../js/formulario.js"></script>
<?php include '../../includes/footer.php'; ?>
</body>
</html>
