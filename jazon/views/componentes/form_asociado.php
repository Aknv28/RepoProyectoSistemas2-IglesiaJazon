<?php
// Si deseas incluir la lógica de zona aquí, puedes hacerlo
require_once '../../includes/bd.php';
$conn = Database::getInstance();
$zonas = $conn->query("SELECT Id_Zona, NombreZona FROM zona WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Asociado</title>
   
</head>

<body>
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombres</label>
        <input type="text" name="nombre" id="nombre" class="form-control" required
            value="<?= isset($asociado['Nombre']) ? htmlspecialchars($asociado['Nombre']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="apellido_pat" class="form-label">Apellido Paterno</label>
        <input type="text" name="apellido_pat" id="apellido_pat" class="form-control" required
            value="<?= isset($asociado['Apellido_Pat']) ? htmlspecialchars($asociado['Apellido_Pat']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="apellido_mat" class="form-label">Apellidos Materno</label>
        <input type="text" name="apellido_mat" id="apellido_mat" class="form-control" required
            value="<?= isset($asociado['Apellido_Mat']) ? htmlspecialchars($asociado['Apellido_Mat']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required min="1950-01-01"
            max="2005-12-31" value="<?= isset($asociado['fecha_nacimiento']) ? $asociado['fecha_nacimiento'] : '' ?>">
    </div>

    <div class="mb-3">
        <label for="contacto" class="form-label">Teléfono</label>
        <input type="tel" name="contacto" id="contacto" class="form-control" pattern="^[67][0-9]{7}$"
            title="El teléfono debe empezar con 7 o 6 y tener 8 dígitos." required
            value="<?= isset($asociado['NumeroTelefono']) ? htmlspecialchars($asociado['NumeroTelefono']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo (opcional)</label>
        <input type="email" name="correo" id="correo" class="form-control"
            value="<?= isset($asociado['Correo']) ? htmlspecialchars($asociado['Correo']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="id_zona" class="form-label">Zona (opcional)</label>
        <select name="id_zona" id="id_zona" class="form-control">
            <!-- Opción predeterminada -->
            <option value="" <?= empty($asociado['id_zona']) ? 'selected' : '' ?>>-- Selecciona una zona --</option>

            <!-- Opciones de zonas -->
            <?php foreach ($zonas as $zona): ?>
                <option value="<?= $zona['Id_Zona'] ?>" <?= isset($asociado['id_zona']) && $asociado['id_zona'] == $zona['Id_Zona'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($zona['NombreZona']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>



    <!-- Campos ocultos para enviar los valores generados -->
    <input type="hidden" name="usuario_generado" id="usuario_generado"
        value="<?= isset($asociado['usuario']) ? $asociado['usuario'] : '' ?>">
    <input type="hidden" name="contrasena_generada" id="contrasena_generada"
        value="<?= isset($asociado['contrasena']) ? $asociado['contrasena'] : '' ?>">

    <!-- Mostrar usuario y contraseña generados -->
    <div class="mb-3">
        <label for="usuario" class="form-label">Usuario</label>
        <input type="text" id="usuario" class="form-control" readonly
            value="<?= isset($asociado['usuario']) ? htmlspecialchars($asociado['usuario']) : '' ?>">
    </div>

    <div class="mb-3">
        <label for="contrasena" class="form-label">Contraseña</label>
        <input type="text" id="contrasena" class="form-control" readonly
            value="<?= isset($asociado['contrasena']) ? htmlspecialchars($asociado['contrasena']) : '' ?>">
    </div>


</body>

</html>