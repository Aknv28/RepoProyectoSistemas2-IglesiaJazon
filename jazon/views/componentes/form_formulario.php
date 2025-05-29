<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

?>

<div class="mb-3">
    <label for="actividad" class="form-label">Actividad</label>
    <input type="text" class="form-control" id="actividad" name="actividad" value="<?= htmlspecialchars($formulario['Actividad']) ?>" required>
    <span id="error_actividad" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta1" class="form-label">Pregunta 1</label>
    <input type="text" class="form-control" id="pregunta1" name="pregunta1" value="<?= htmlspecialchars($formulario['Pregunta1']) ?>" required>
    <span id="error_pregunta1" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta2" class="form-label">Pregunta 2</label>
    <input type="text" class="form-control" id="pregunta2" name="pregunta2" value="<?= htmlspecialchars($formulario['Pregunta2']) ?>" required>
    <span id="error_pregunta2" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta3" class="form-label">Pregunta 3</label>
    <input type="text" class="form-control" id="pregunta3" name="pregunta3" value="<?= htmlspecialchars($formulario['Pregunta3']) ?>" required>
    <span id="error_pregunta3" class="text-danger"></span>
</div>

<div class="mb-3">
    <label for="pregunta4" class="form-label">Pregunta 4</label>
    <input type="text" class="form-control" id="pregunta4" name="pregunta4" value="<?= htmlspecialchars($formulario['Pregunta4']) ?>" required>
    <span id="error_pregunta4" class="text-danger"></span>
</div>

<div class="mb-3">
  <label for="fecha" class="form-label">Fecha</label>
  <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $formulario['Fecha'] ?>" required>
  <div id="error_fecha" class="text-danger"></div>
</div>

<div class="mb-3">
    <label for="fecha_fin" class="form-label">Fecha Finalización del formulario</label>
    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?= $formulario['Fecha_fin'] ?>" required>
    <span id="error_fecha_fin" class="text-danger"></span>
</div>

