<?php
$usuarioLogeado = false;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$usuarioLogeado = isset($_SESSION['ver_log']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/conIndex2.css">
</head>

<body>

    <?php include '../includes/header.php'; ?>


    <?php if ($usuarioLogeado): ?>
        <?php include '../includes/menu.php'; ?>

        <?php include 'componentes/presentacion.php'; ?>
    <?php else: ?>
        <?php include '../includes/tarjeta.php'; ?>
    <?php endif; ?>

    <!-- Pie de página -->
    <?php include '../includes/footer.php'; ?>


</body>

</html>