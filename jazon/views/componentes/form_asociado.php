<?php
// Si deseas incluir la lógica de zona aquí, puedes hacerlo
require_once '../../includes/bd.php';
$conn = Database::getInstance();
$zonas = $conn->query("SELECT Id_Zona, NombreZona FROM zona WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);
$roles = $conn->query("SELECT * FROM roles WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);

// Variable para determinar si es edición o agregación
$modo = isset($_GET['action']) && $_GET['action'] == 'ed_asociados' ? 'editar' : 'agregar';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Asociado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/estilos.css">
    <link rel="stylesheet" href="../../css/index.css">
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

    <?php if ($modo === 'agregar'): ?>
        <!-- Solo mostrar estos campos en el modo de agregar -->
        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required min="1950-01-01"
                max="2005-12-31" value="<?= isset($asociado['fecha_nacimiento']) ? $asociado['fecha_nacimiento'] : '' ?>">
        </div>

        <div class="mb-3">
            <label for="id_zona" class="form-label">Zona (opcional)</label>
            <select name="id_zona">
                <?php foreach ($zonas as $zona): ?>
                    <option value="<?= $zona['Id_Zona'] ?>" <?php
                      // Verifica si el valor de 'id_zona' enviado por POST coincide con el ID de la zona
                      echo (isset($id_zona) && $id_zona == $zona['Id_Zona']) ? 'selected' : '';
                      ?>>
                        <?= $zona['NombreZona'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="id_rol" class="form-label">Rol </label>
            <select name="id_rol" id="id_rol" class="form-control">
                <!-- Opciones de roles -->
                <?php foreach ($roles as $rol): ?>
                    <option value="<?= $rol['Id_Rol'] ?>" <?php
                      // Compara si $id_rol es igual al valor del rol actual
                      echo (isset($id_rol) && $id_rol == $rol['Id_Rol']) ? 'selected' : '';
                      ?>>
                        <?= htmlspecialchars($rol['Tipo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

</body>

</html>
