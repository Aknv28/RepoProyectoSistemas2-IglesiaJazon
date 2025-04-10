<?php
// Conexión a la base de datos
require_once 'includes/bd.php';
$conn = Database::getInstance();

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = "ANV209100";
    $contrasena = "ANV730100";
    $habilitado = 1;


    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario AND contrasena = :contrasena AND habilitado = :habilitado";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contrasena', $contrasena);
    $stmt->bindParam(':habilitado', $habilitado);
    $stmt->execute();

    // Verificar si se encontraron los datos del usuario
    if ($stmt->rowCount() > 0) {
        // Obtener los datos del usuario
        $usuario_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_rol = $usuario_data['Id_Rol']; // Obtener el id_rol del usuario

        // Consultar la base de datos para obtener el nombre del rol basado en id_rol
        $sql_rol = "SELECT Tipo FROM roles WHERE Id_Rol = :Id_Rol AND habilitado = :habilitado";
        $stmt_rol = $conn->prepare($sql_rol);
        $stmt_rol->bindParam(':Id_Rol', $id_rol);
        $stmt_rol->bindParam(':habilitado', $habilitado);
        $stmt_rol->execute();

        if ($stmt_rol->rowCount() > 0) {
            // Obtener el nombre del rol
            $rol_data = $stmt_rol->fetch(PDO::FETCH_ASSOC);
            $rol = $rol_data['Tipo']; // Obtener el nombre del rol

            // Redirigir dependiendo del rol
            if ($rol === 'asociado') {
                echo "<script>
                            alert('Estimado asociado ingreso exitosamente');
                            window.location.href = 'eventos.php';  // Redirigir a la página de listado o similar
                        </script>";
            } elseif ($rol === 'pastor') {
                echo "<script>
                            alert('Estimado pastor ingreso exitosamente');
                            window.location.href = 'views/index2.php';  // Redirigir a la página de listado o similar
                        </script>";
            } elseif ($rol === 'administrador') {
                echo "<script>
                            alert('Estimado supervisor ingreso exitosamente');
                            window.location.href = 'views/index2.php';  // Redirigir a la página de listado o similar
                        </script>";
            } else {
                echo "error";

            }
            exit();
        } else {
            // Si no se encuentra el nombre del rol, manejar el error
            $error = "Rol no encontrado.";
            echo "error";

        }
    } else {
        // Si las credenciales no son correctas, mostrar un mensaje de error
        $error = "a";
        echo "error";
    }
}
?>