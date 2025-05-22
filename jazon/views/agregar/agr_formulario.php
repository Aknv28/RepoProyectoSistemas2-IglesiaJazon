<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recuperar los datos del formulario
    $actividad = $_POST['actividad'];
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];
    $pregunta3 = $_POST['pregunta3'];
    $pregunta4 = $_POST['pregunta4'];
    $horario = $_POST['horario'];
    $fecha = $_POST['fecha'];
    $fecha_fin = $_POST['fecha_fin'];
    $habilitado = $_POST['habilitado'];
    $id_ubicacion = $_POST['id_ubicacion'];

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO formulario (Actividad, Pregunta1, Pregunta2, Pregunta3, Pregunta4, Horario, Fecha, Fecha_fin, habilitado, Id_Ubicacion)
            VALUES (:actividad, :pregunta1, :pregunta2, :pregunta3, :pregunta4, :horario, :fecha, :fecha_fin, :habilitado, :id_ubicacion)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':actividad', $actividad);
    $stmt->bindParam(':pregunta1', $pregunta1);
    $stmt->bindParam(':pregunta2', $pregunta2);
    $stmt->bindParam(':pregunta3', $pregunta3);
    $stmt->bindParam(':pregunta4', $pregunta4);
    $stmt->bindParam(':horario', $horario);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':fecha_fin', $fecha_fin);
    $stmt->bindParam(':habilitado', $habilitado);
    $stmt->bindParam(':id_ubicacion', $id_ubicacion);

    if ($stmt->execute()) {
        // Redirigir a una página de éxito o mostrar un mensaje
        echo "<div class='alert alert-success'>Formulario guardado correctamente.</div>";
    } else {
        // Mostrar un mensaje de error
        echo "<div class='alert alert-danger'>Hubo un error al guardar el formulario.</div>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar un nuevo Formulario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
<?php include '../../includes/header2.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Formulario de Registro</h2>
    <form method="POST" onsubmit="return validarFormulario();">
        <?php include '../componentes/form_formulario.php'; ?>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Agregar Asociado</button>
            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            <a href="../listas/lst_formularios.php" class="btn btn-secondary">Lista</a>
        </div>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
<script src="../../js/formulario.js"></script>
</body>
</html>