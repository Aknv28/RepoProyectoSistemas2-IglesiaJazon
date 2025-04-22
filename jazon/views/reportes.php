<?php
// Conexión a la base de datos
require_once '../includes/bd.php';
$conn = Database::getInstance();

// Consultar todos los eventos habilitados
$sql = "SELECT * FROM eventos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Consultar todos los eventos habilitados
$sql = "SELECT * FROM eventos as e JOIN resultados as r ON e.Id_Resultado = r.Id_Respuesta";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/index.css">

</head>

<body>
    <?php
    include("../includes/header.php");
    ?>


    <!-- CONTENIDO -->
    <div class="container">
        <h1>Generación de Reportes</h1>
        <!-- Reporte de Actividad -->
        <form action="reportes/r_eventos.php" method="POST">

            <div class=" form-group mb-3 ">
                <label class="form-label " for="evento">Reporte de eventos</label>
                <br>
                <select name="evento" id="evento">
                    <option value="">Seleccione...</option>
                    <?php foreach ($eventos as $evento): ?>
                        <option value=<?= $evento['Id_Eventos'] ?>> <?= $evento['Nombre'] ?></option>";
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="actividad_id" id="actividad_id">
                <button type="submit" name="registro_actividad" value="true" class="btn2 btn-primary ms-2 ">Generar
                    Reporte</button>
            </div>
        </form>

        <!-- Reporte de Evento -->
        <form action="reportes/r_resultados.php" method="POST">
            <div class=" form-group mb-3 ">
                <label class="form-label " for="resultado">Reporte de resultados de los eventos</label>
                <br>
                <select name="resultado" id="resultado" ¿>
                    <option value="">Seleccione...</option>
                    <?php foreach ($resultados as $resultado): ?>
                        <option value=<?= $resultado['Id_Respuesta'] ?>> <?= $resultado['Nombre'] ?></option>";
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="evento_id" id="evento_id">
                <button type="submit" name="registro_evento" value="true" class="btn2 btn-primary ms-2 ">Generar
                    Reporte</button>

            </div>
        </form>
        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>

</body>

</html>