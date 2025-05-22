<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1;
$id_evento = isset($_POST['id_eventos']) ? $_POST['id_eventos'] : null;
$sql = "
SELECT f.Id_Formulario, f.Actividad, f.Pregunta1, f.Pregunta2, f.Pregunta3, f.Pregunta4, 
       f.Fecha, f.Fecha_fin, f.habilitado, concat(u.zona, ' - ', u.calle, ' - ', u.nrolugar) as ubicacion
FROM formulario f
LEFT JOIN ubicacion u ON f.Id_Ubicacion = u.id_ubicacion
JOIN eventos e ON f.id_evento = :evento
WHERE f.habilitado = :habilitado";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->bindParam(':evento', $id_evento, PDO::PARAM_INT);
$stmt->execute();
$formularios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlHorarios = 'SELECT * FROM horarios';
$stmtH = $conn->prepare($sqlHorarios);
$stmtH->execute();
$horarios = $stmtH->fetchAll(PDO::FETCH_ASSOC);

$sqlUbi = 'SELECT * FROM ubicacion';
$stmtU = $conn->prepare($sqlUbi);
$stmtU->execute();
$ubicaciones = $stmtU->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/index.css">
</head>

<body>
    <?php include '../../includes/header2.php'; ?>

    <div class="container mt-5">
        <form action="../agregar/agr_respuesta.php" method="post">
            <!-- Asegúrate que este campo esté presente y contenga el ID del usuario actual -->
            <input type="hidden" name="id_asociado" value="<?= $_SESSION['id_usuario'] ?? 1 ?>">


            <?php foreach ($formularios as $formulario): ?>
                <fieldset class="border p-3 mb-4">
                    <legend>Formulario #<?= $formulario['Id_Formulario'] ?></legend>

                    <div class="mb-3">
                        <label class="form-label"><strong>Actividad:
                                <?= htmlspecialchars($formulario['Actividad']) ?></strong></label>
                    </div>

                    <table class="table table-bordered text-center">
                        <thead class="table-light">
                            <tr>
                                <th><?= htmlspecialchars($formulario['Pregunta1']) ?></th>
                                <th><?= htmlspecialchars($formulario['Pregunta2']) ?></th>
                                <th><?= htmlspecialchars($formulario['Pregunta3']) ?></th>
                                <th><?= htmlspecialchars($formulario['Pregunta4']) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="Respuesta1" class="form-control" placeholder="Respuesta 1">
                                </td>
                                <td><input type="text" name="Respuesta2" class="form-control" placeholder="Respuesta 2">
                                </td>
                                <td><input type="text" name="Respuesta3" class="form-control" placeholder="Respuesta 3">
                                </td>
                                <td><input type="text" name="Respuesta4" class="form-control" placeholder="Respuesta 4">
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row mb-3">
                        <label class="form-label"><strong>Horario:</strong></label>

                        <select name="horario" class="form-select">
                            <?php foreach ($horarios as $horario): ?>
                                <option value="<?= $horario['Id_Horario'] ?>" <?= isset($horarioSeleccionado) && $horarioSeleccionado == $horario['Id_Horario'] ? 'selected' : '' ?>>
                                    <?= $horario['Hora_Inicio'] . " - " . $horario['Hora_Final'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>


                        <div class="col">
                            <label class="form-label"><strong>Fecha Sugerencia:</strong></label>
                            <input type="date" name="fecha" class="form-control" value="<?= $formulario['Fecha'] ?>">
                        </div>
                        <div class="col">
                            <label class="form-label"><strong>Fecha se cierran las respuestas:</strong></label>
                            <input type="date" name="fecha_fin" class="form-control"
                                value="<?= $formulario['Fecha_fin'] ?>" readonly>
                        </div>
                    </div>

                    <label class="form-label"><strong>ID Ubicación:</strong></label>
                    <select name="ubicacion" class="form-select">
                        <?php foreach ($ubicaciones as $ubicacion): ?>
                            <option value="<?= $ubicacion['Id_Ubicacion'] ?>" <?= isset($ubicacionSeleccionada) && $ubicacionSeleccionada == $ubicacion['Id_Ubicacion'] ? 'selected' : '' ?>>
                                <?= $ubicacion['Zona'] . " - " . $ubicacion['Calle'] . " - " . $ubicacion['NroLugar'] ?>
                            </option>

                        <?php endforeach; ?>
                    </select>


                    <input type="hidden" name="id_formulario" value="<?= $formulario['Id_Formulario'] ?>">
                </fieldset>
            <?php endforeach; ?>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>