<?php
// Iniciar la sesión
session_start();
$usuarioLogeado = isset($_SESSION["id_user_log"]);
// Conexión a la base de datos
require_once '../includes/bd.php';
$conn = Database::getInstance();

// Consultar todos los eventos habilitados
$sql = "SELECT * FROM eventos WHERE habilitado = 1 AND Fecha >= CURDATE()";
$stmt = $conn->prepare($sql);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos de la Iglesia Jazon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../css/index.css">
</head>

<body>

    <div class="container mt-5">
        <h1 class="text-center">Eventos nuevos de la Iglesia Jazon</h1>
        <?php if (!$usuarioLogeado): ?>
            <a href="../login.html" class="btn btn-primary">Login</a>
        <?php endif; ?>
        <a href="resul_eventos.php" class="btn btn-primary">Resultados de los eventos</a>


        <?php foreach ($eventos as $evento): ?>
            <div class="event-container mt-4 p-3 border rounded">
                <h2><?php echo htmlspecialchars($evento['Nombre']); ?></h2>
                <p><strong>Fecha:</strong> <?php echo $evento['Fecha']; ?></p>
                <p><strong>Categoría:</strong> <?php echo $evento['Id_Categoria']; ?></p>
                <p><strong>Ubicación:</strong> <?php echo $evento['Id_Ubicacion']; ?></p>
                <p><strong>Horario:</strong> <?php echo $evento['Id_Horario']; ?></p>

                <!-- Mostrar el botón solo si el usuario está logeado -->
                <?php if ($usuarioLogeado): ?>
                    <form action="componentes/form_respuesta.php" method="POST">
                        <input type="hidden" name="id_eventos" value="<?php echo $evento['Id_Eventos']; ?>">
                        <button type="submit" class="btn btn-primary">Sugerencia</button>
                    </form>
                <?php else: ?>
                    <!-- Si no está logeado, el botón no aparece -->
                    <p class="text-danger">Debe iniciar sesión para sugerir eventos.</p>
                <?php endif; ?>
            </div>

        <?php endforeach; ?>
        <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>