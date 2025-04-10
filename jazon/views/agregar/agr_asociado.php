<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

$zonas = $conn->query("SELECT Id_Zona, NombreZona FROM zona WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $apellido_pat = $_POST['apellido_pat'];
    $apellido_mat = $_POST['apellido_mat'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $telefono = $_POST['contacto'];
    $correo = $_POST['correo'];
    $habilitado = 1;
    $id_zona = !empty($_POST['id_zona']) ? $_POST['id_zona'] : null;

    $usuario = $_POST['usuario_generado'];
    $contrasena = $_POST['contrasena_generada'];

    // Validación de año de nacimiento
    $anio_nacimiento = intval(date('Y', strtotime($fecha_nacimiento)));
    if ($anio_nacimiento < 1950 || $anio_nacimiento > 2005) {
        echo "<div class='alert alert-danger text-center'>La fecha de nacimiento debe estar entre 1950 y 2005.</div>";
    } else {
        // 1. Insertar en la tabla contacto
        $sql_contacto = "INSERT INTO contactos (NumeroTelefono, Correo, habilitado) VALUES (:NumeroTelefono, :correo, :habilitado)";
        $stmt_contacto = $conn->prepare($sql_contacto);
        $stmt_contacto->bindParam(':NumeroTelefono', $telefono);
        $stmt_contacto->bindParam(':correo', $correo);
        $stmt_contacto->bindParam(':habilitado', $habilitado);

        if ($stmt_contacto->execute()) {
            // Insertar usuario generado en la tabla de usuarios con id_rol = 1
            $sql_usuario = "INSERT INTO usuarios (usuario, contrasena, habilitado, id_rol)
                            VALUES (:usuario, :contrasena, :habilitado, 1)";
            $stmt_usuario = $conn->prepare($sql_usuario);
            $stmt_usuario->bindParam(':usuario', $usuario);
            $stmt_usuario->bindParam(':contrasena', $contrasena);
            $stmt_usuario->bindParam(':habilitado', $habilitado);

            if ($stmt_usuario->execute()) {
                $id_usuario = $conn->lastInsertId(); // Obtener ID del usuario recién insertado
                $id_contacto = $conn->lastInsertId(); // Obtener ID del contacto recién insertado

                // 2. Insertar en la tabla asociados
                $sql_asociado = "INSERT INTO asociados (nombre, Apellido_Pat, Apellido_Mat, fecha_nacimiento, habilitado, id_contacto, id_zona, id_usuario)
                                 VALUES (:nombre, :Apellido_Pat, :Apellido_Mat, :fecha_nacimiento, :habilitado, :id_contacto, :id_zona, :id_usuario)";
                $stmt_asociado = $conn->prepare($sql_asociado);
                $stmt_asociado->bindParam(':nombre', $nombre);
                $stmt_asociado->bindParam(':Apellido_Pat', $apellido_pat);
                $stmt_asociado->bindParam(':Apellido_Mat', $apellido_mat);
                $stmt_asociado->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                $stmt_asociado->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
                $stmt_asociado->bindParam(':id_contacto', $id_contacto);
                $stmt_asociado->bindParam(':id_zona', $id_zona);
                $stmt_asociado->bindParam(':id_usuario', $id_usuario);

                if ($stmt_asociado->execute()) {
                    echo "<script>
                            alert('asociado agregado exitosamente');
                        </script>";
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Error al agregar asociado: " . $conn->errorInfo()[2] . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>Error al agregar usuario: " . $conn->errorInfo()[2] . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar contacto: " . $conn->errorInfo()[2] . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Asociado</title>
    
</head>

<body>
    <?php include '../../includes/header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Agregar Asociado</h2>
        <form method="POST">
            <?php include '../componentes/form_asociado.php'; ?>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Agregar Asociado</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

<!-- Script para mostrar los valores generados en los campos -->
<script>
    document.getElementById('usuario').addEventListener('focus', function () {
        var nombre = document.querySelector('input[name="nombre"]').value;
        var apellidoPat = document.querySelector('input[name="apellido_pat"]').value;
        var apellidoMat = document.querySelector('input[name="apellido_mat"]').value;

        if (nombre && apellidoPat && apellidoMat) {
            var usuario = nombre.charAt(0).toUpperCase() + apellidoPat.charAt(0).toUpperCase() + apellidoMat.charAt(0).toUpperCase() + Math.floor(Math.random() * (999 - 100 + 1)) + 100;
            var contrasena = nombre.charAt(0).toUpperCase() + apellidoPat.charAt(0).toUpperCase() + apellidoMat.charAt(0).toUpperCase() + Math.floor(Math.random() * (999 - 100 + 1)) + 100;
            document.getElementById('usuario').value = usuario;
            document.getElementById('contrasena').value = contrasena;

            // Asignar a los campos ocultos para enviar con el formulario
            document.getElementById('usuario_generado').value = usuario;
            document.getElementById('contrasena_generada').value = contrasena;
        }
    });
    document.querySelector("form").addEventListener("submit", function (event) {
        var telefono = document.getElementById("contacto").value;
        var telefonoPattern = /^[67][0-9]{7}$/;

        if (!telefonoPattern.test(telefono)) {
            alert("El teléfono debe empezar con 7 o 6 y tener 8 dígitos.");
            event.preventDefault(); // Previene el envío del formulario si la validación falla
        }
    });
</script>
</body>

</html>