<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

$habilitado = isset($_GET['habilitado']) ? $_GET['habilitado'] : 1;

$sql = "
SELECT f.Id_Formulario, f.Actividad, f.Pregunta1, f.Pregunta2, f.Pregunta3, f.Pregunta4, 
       CONCAT(h.hora_inicio, ' - ', h.hora_final) AS HorarioTexto,
       f.Fecha, f.Fecha_fin, f.habilitado, concat(u.zona, ' - ', u.calle, ' - ', u.nrolugar) as ubicacion
FROM formulario f
LEFT JOIN horarios h ON f.Horario = h.id_horario
LEFT JOIN ubicacion u ON f.Id_Ubicacion = u.id_ubicacion
WHERE f.habilitado = :habilitado";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
$stmt->execute();
$formularios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Actividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../../includes/header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Formulario de Actividades</h2>

        <form action="procesar_formulario.php" method="post">
            <?php foreach ($formularios as $formulario): ?>
                <fieldset class="border p-3 mb-4">
                    <legend>Formulario #<?= $formulario['Id_Formulario'] ?></legend>

                    <div class="mb-3">
                        <label class="form-label"><strong>Actividad:</strong></label>
                        <input type="text" name="actividad[]" class="form-control"
                            value="<?= htmlspecialchars($formulario['Actividad']) ?>">
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
                                <td><input type="text" name="resp1[]" class="form-control" placeholder="Respuesta 1"></td>
                                <td><input type="text" name="resp2[]" class="form-control" placeholder="Respuesta 2"></td>
                                <td><input type="text" name="resp3[]" class="form-control" placeholder="Respuesta 3"></td>
                                <td><input type="text" name="resp4[]" class="form-control" placeholder="Respuesta 4"></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label"><strong>Horario:</strong></label>
                            <input type="text" name="horario[]" class="form-control" value="<?= htmlspecialchars($formulario['HorarioTexto']) ?>" readonly>

                        </div>
                        <div class="col">
                            <label class="form-label"><strong>Fecha inicio:</strong></label>
                            <input type="date" name="fecha[]" class="form-control" value="<?= $formulario['Fecha'] ?>">
                        </div>
                        <div class="col">
                            <label class="form-label"><strong>Fecha fin:</strong></label>
                            <input type="date" name="fecha_fin[]" class="form-control"
                                value="<?= $formulario['Fecha_fin'] ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>ID Ubicación:</strong></label>
                        <input type="text" name="ubicacion[]" class="form-control" value="<?= htmlspecialchars($formulario['ubicacion']) ?>" readonly>

                    </div>

                    <input type="hidden" name="id_formulario[]" value="<?= $formulario['Id_Formulario'] ?>">
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