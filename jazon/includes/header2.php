<?php
session_start();  // Asegúrate de iniciar la sesión

// Verificar si la sesión está activa
if (isset($_SESSION['id_user_log']) && isset($_SESSION['user_log'])) {
    $id_usuario = $_SESSION['id_user_log'];  // Obtener id_usuario
    $usuario = $_SESSION['user_log'];        // Obtener usuario
    $id_rol = $_SESSION['tipo_rol_log'];       // Obtener rol
} else {
    echo "No estás logueado.";
}
?>

<!-- CABECERA -->
<header class="p-3">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="title-container">
                <img src="../img/logo/logoFinal2.png" class="logo" alt="Logo de la Iglesia">
            </div>
            <span class="title">Iglesia Jazon</span>
            <ul class="nav col-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../../index.html" class="nav-link px-1">Inicio</a></li>
            </ul>
            <ul class="nav col-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="../index2.php" class="nav-link px-1">Dashboard</a></li>
            </ul>
            <div>
                <p id="usuario"><?php echo "Usuario: " . $usuario ?></p>
                <p id="rol"><?php echo "Rol: " . $id_rol ?></p>
                <a href="../../includes/logout.php" class="btn btn-outline-danger">Cerrar sesión</a>
            </div>
        </div>
    </div>
</header>
