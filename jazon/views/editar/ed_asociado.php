<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Recuperar las zonas habilitadas
$zonaAs = $conn->query("SELECT Id_Zona, NombreZona FROM zona WHERE habilitado = 1")->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se ha enviado un id de asociado para editar
if (isset($_GET['id'])) {
    $id_asociado = $_GET['id'];

    // Recuperar todos los datos relacionados con el asociado, usuario, contacto, zona y rol
    $sql_asociado = "SELECT 
                        a.*, 
                        c.NumeroTelefono, 
                        c.Correo, 
                        u.usuario, 
                        u.contrasena, 
                        z.NombreZona, 
                        r.Tipo as Rol
                     FROM asociados a
                     LEFT JOIN contactos c ON a.id_contacto = c.id_contacto 
                     LEFT JOIN usuarios u ON a.id_usuario = u.id_usuario 
                     LEFT JOIN zona z ON a.id_zona = z.Id_Zona 
                     LEFT JOIN roles r ON u.Id_Rol = r.Id_Rol 
                     WHERE a.id_asociado = :id_asociado";
    $stmt = $conn->prepare($sql_asociado);
    $stmt->bindParam(':id_asociado', $id_asociado);
    $stmt->execute();
    $asociado = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$asociado) {
        echo "<div class='alert alert-danger text-center'>No se encontró el asociado.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger text-center'>No se proporcionó un ID de asociado.</div>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
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
        // Actualizar en la tabla contacto
        $sql_contacto = "UPDATE contactos SET NumeroTelefono = :NumeroTelefono, Correo = :correo WHERE id_contacto = :id_contacto";
        $stmt_contacto = $conn->prepare($sql_contacto);
        $stmt_contacto->bindParam(':NumeroTelefono', $telefono);
        $stmt_contacto->bindParam(':correo', $correo);
        $stmt_contacto->bindParam(':id_contacto', $asociado['id_contacto']);

        if ($stmt_contacto->execute()) {
            // Actualizar el usuario generado
            $sql_usuario = "UPDATE usuarios SET usuario = :usuario, contrasena = :contrasena WHERE id_usuario = :id_usuario";
            $stmt_usuario = $conn->prepare($sql_usuario);
            $stmt_usuario->bindParam(':usuario', $usuario);
            $stmt_usuario->bindParam(':contrasena', $contrasena);
            $stmt_usuario->bindParam(':id_usuario', $asociado['id_usuario']);

            if ($stmt_usuario->execute()) {
                // 2. Actualizar en la tabla asociados
                $sql_asociado = "UPDATE asociados SET nombre = :nombre, Apellido_Pat = :Apellido_Pat, Apellido_Mat = :Apellido_Mat, 
                                 fecha_nacimiento = :fecha_nacimiento, habilitado = :habilitado, id_contacto = :id_contacto, 
                                 id_zona = :id_zona, id_usuario = :id_usuario WHERE id_asociado = :id_asociado";
                $stmt_asociado = $conn->prepare($sql_asociado);
                $stmt_asociado->bindParam(':nombre', $nombre);
                $stmt_asociado->bindParam(':Apellido_Pat', $apellido_pat);
                $stmt_asociado->bindParam(':Apellido_Mat', $apellido_mat);
                $stmt_asociado->bindParam(':fecha_nacimiento', $fecha_nacimiento);
                $stmt_asociado->bindParam(':habilitado', $habilitado, PDO::PARAM_INT);
                $stmt_asociado->bindParam(':id_contacto', $asociado['id_contacto']);
                $stmt_asociado->bindParam(':id_zona', $id_zona);
                $stmt_asociado->bindParam(':id_usuario', $asociado['id_usuario']);
                $stmt_asociado->bindParam(':id_asociado', $id_asociado);

                if ($stmt_asociado->execute()) {
                    echo "<script>
                            alert('Asociado actualizado exitosamente');
                            window.location.href = '../listas/lst_asociados.php';  // Redirigir a la página de listado o similar
                        </script>";
                    exit();
                } else {
                    echo "<div class='alert alert-danger text-center'>Error al actualizar asociado: " . $conn->errorInfo()[2] . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger text-center'>Error al actualizar usuario: " . $conn->errorInfo()[2] . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Error al actualizar contacto: " . $conn->errorInfo()[2] . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Editar Asociado</title>
</head>

<body>
    <?php include '../../includes/header.php'; ?>

    <div class="container mt-5">
        <h2 class="text-center">Editar Asociado</h2>
        <form method="POST">
            <?php include '../componentes/form_asociado.php'; ?>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Actualizar Asociado</button>
                <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
            </div>
        </form>
    </div>

    <?php include '../../includes/footer.php'; ?>
</body>

</html>
