<?php
// Iniciar la sesión
session_start();
$usuarioLogeado = isset($_SESSION["id_user_log"]);
// Conexión a la base de datos
require_once '../includes/bd.php';
$conn = Database::getInstance();

// Consultar todos los eventos habilitados
$sql = "SELECT * FROM eventos as e JOIN resultados as r ON e.id_resultado = r.id_respuesta ";
$stmt = $conn->prepare($sql);
$stmt->execute();
$resulE = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <a href="eventos.php" class="btn btn-primary">Salir</a>

        <?php foreach ($resulE as $resul): ?>
            <div class="event-container mt-4 p-3 border rounded">
                <h2><?php echo htmlspecialchars($resul['Nombre']); ?></h2>
                <div>
                    <p><strong>Fecha:</strong> <?php echo $resul['Fecha']; ?></p>
                    <p><strong>Categoría:</strong> <?php echo $resul['Id_Categoria']; ?></p>
                    <p><strong>Ubicación:</strong> <?php echo $resul['Id_Ubicacion']; ?></p>
                    <p><strong>Horario:</strong> <?php echo $resul['Id_Horario']; ?></p>
                    <br>
                </div>
                <div>
                    <p><strong>Resultado 1:</strong> <?php echo $resul['Resultado1']; ?></p>
                    <p><strong>Resultado 2:</strong> <?php echo $resul['Resultado2']; ?></p>
                    <p><strong>Resultado 3:</strong> <?php echo $resul['Resultado3']; ?></p>
                    <p><strong>Resultado 4:</strong> <?php echo $resul['Resultado4']; ?></p>
                </div>
            </div>

        <?php endforeach; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>