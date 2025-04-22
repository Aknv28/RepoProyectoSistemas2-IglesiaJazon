<div class="mb-3">
    <label for="hora_inicio" class="form-label">Hora inicio</label>
    <input type="text" name="hora_inicio" class="form-control" value="<?= isset($horario['hora_inicio']) ? htmlspecialchars($horario['hora_inicio']) : '' ?>" required>
</div>

<div class="mb-3">
    <label for="hora_final" class="form-label">Hora final</label>
    <input type="text" name="hora_final" class="form-control" value="<?= isset($horario['hora_final']) ? htmlspecialchars($horario['hora_final']) : '' ?>" required>
</div>
