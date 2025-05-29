<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

$ubicaciones = $conn->query("SELECT Id_Ubicacion, Zona, Calle, nroLugar FROM ubicacion WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);
$horarios = $conn->query("SELECT Id_Horario, Hora_Inicio, Hora_Final FROM horarios WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="mb-3">
    <label for="actividad" class="form-label">Actividad</label>
    <input type="text" class="form-control" id="actividad" name="actividad" required>
    <span id="error_actividad" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta1" class="form-label">Pregunta 1</label>
    <input type="text" class="form-control" id="pregunta1" name="pregunta1" required>
    <span id="error_pregunta1" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta2" class="form-label">Pregunta 2</label>
    <input type="text" class="form-control" id="pregunta2" name="pregunta2" required>
    <span id="error_pregunta2" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta3" class="form-label">Pregunta 3</label>
    <input type="text" class="form-control" id="pregunta3" name="pregunta3" required>
    <span id="error_pregunta3" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta4" class="form-label">Pregunta 4</label>
    <input type="text" class="form-control" id="pregunta4" name="pregunta4" required>
    <span id="error_pregunta4" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="horario" class="form-label">Horario</label>
    <select class="form-control" id="horario" name="horario" required>
        <option value="" disabled selected>Seleccione un horario</option>
        <?php foreach ($horarios as $horario): ?>
            <option value="<?= $horario['Id_Horario'] ?>">
                <?= $horario['Hora_Inicio'] . ' - ' . $horario['Hora_Final'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span id="error_horario" class="text-danger"></span>
</div>

<div class="mb-3">
  <label for="fecha" class="form-label">Fecha</label>
  <input type="date" class="form-control" id="fecha" name="fecha" required>
  <div id="error_fecha" class="text-danger"></div>
</div>

<div class="mb-3">
    <label for="fecha_fin" class="form-label">Fecha Finalización del formulario</label>
    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
    <span id="error_fecha_fin" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="id_ubicacion" class="form-label">Ubicación</label>
    <select class="form-control" id="id_ubicacion" name="id_ubicacion" required>
        <option value="" disabled selected>Seleccione una ubicación</option>
        <?php foreach ($ubicaciones as $ubicacion): ?>
            <option value="<?= $ubicacion['Id_Ubicacion'] ?>">
                <?= $ubicacion['Zona'] . ', ' . $ubicacion['Calle'] . ' ' . $ubicacion['nroLugar'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span id="error_ubicacion" class="text-danger"></span>
</div>

<!-- Campo oculto de habilitado -->
<input type="hidden" name="habilitado" value="1">
