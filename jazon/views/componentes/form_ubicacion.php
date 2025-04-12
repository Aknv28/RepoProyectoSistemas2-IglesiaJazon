<div class="mb-3">
    <label for="zona" class="form-label">Nombre de la Zona</label>
    <input type="text" name="zona" id="zona" class="form-control" value="<?= isset($ubicacion['Zona']) ? htmlspecialchars($ubicacion['Zona']) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="calle" class="form-label">Nombre de la Calle</label>
    <input type="text" name="calle" id="calle" class="form-control" value="<?= isset($ubicacion['Calle']) ? htmlspecialchars($ubicacion['Calle']) : '' ?>" required>
</div>
<div class="mb-3">
    <label for="nrolugar" class="form-label">Numero del lugar</label>
    <input type="text" name="nrolugar" id="nrolugar" class="form-control" value="<?= isset($ubicacion['NroLugar']) ? htmlspecialchars($ubicacion['NroLugar']) : '' ?>" required>
</div>