<?php
// Conexión a la base de datos
require_once '../includes/bd.php';
$conn = Database::getInstance();
session_start();  // Iniciar la sesión

// Verificar si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $usuario = $_POST['usuario_log'];
    $contrasena = $_POST['contrasena_log'];
    $habilitado = 1;

    // Consultar la base de datos para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE Usuario = :Usuario AND habilitado = :habilitado";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Usuario', $usuario);
    $stmt->bindParam(':habilitado', $habilitado);
    $stmt->execute();

    // Verificar si se encontraron los datos del usuario
    if ($stmt->rowCount() > 0) {
        $usuario_data = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verificar si las contraseñas coinciden
        echo "Contraseña enviada: " . $contrasena . "<br>";
        echo "Contraseña en base de datos: " . $usuario_data['Contrasena'] . "<br>";

        // Verificar la contraseña
        if ($contrasena === $usuario_data['Contrasena']) {
            $id_rol = $usuario_data['Id_Rol']; // Obtener el id_rol del usuario

            $_SESSION['id_user_log'] = $usuario_data['Id_Usuario'];  // id_usuario
            $_SESSION['user_log'] = $usuario_data['Usuario'];        // usuario

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
                $_SESSION['tipo_rol_log'] = $rol;

                // Obtener id_ubicacion del asociado
                $sqlAso = "SELECT * FROM asociados WHERE Id_Usuario = :id_usuario";
                $stmt_asociado = $conn->prepare($sqlAso);
                $stmt_asociado->bindParam(':id_usuario', $usuario_data['Id_Usuario']);
                $stmt_asociado->execute();
                $asociado_data = $stmt_asociado->fetch(PDO::FETCH_ASSOC);

                $_SESSION['tipo_rol_log'] = $rol;
                $_SESSION['aso_id_log'] = $asociado_data['Id_Asociado'];
                $_SESSION['ver_log'] = true;                // Redirigir dependiendo del rol
                if ($rol === 'asociado') {
                    echo "<script>alert('Ingreso exitoso como asociado'); window.location.href = 'eventos.php';</script>";
                } elseif ($rol === 'pastor') {
                    echo "<script>alert('Ingreso exitoso como pastor'); window.location.href = 'index2.php';</script>";
                } elseif ($rol === 'administrador') {
                    echo "<script>alert('Ingreso exitoso como administrador'); window.location.href = 'index2.php';</script>";
                } else {
                    echo "<div class='alert alert-danger'>Rol no reconocido.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Rol no encontrado.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Usuario no encontrado o deshabilitado.</div>";
    }
}
?>