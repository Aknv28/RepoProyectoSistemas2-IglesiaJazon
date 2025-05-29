<?php
// Iniciar la sesión
session_start();
$usuarioLogeado = isset($_SESSION["id_user_log"]);
// Conexión a la base de datos
require_once '../includes/bd.php';
$conn = Database::getInstance();

// Consultar todos los eventos habilitados
// Consultar resultados con JOIN
$sql = "SELECT e.*, 
               r.Resultado1, r.Resultado2, r.Resultado3, r.Resultado4,
               f.Pregunta1, f.Pregunta2, f.Pregunta3, f.Pregunta4,
               c.Nombre AS Nombre_Categoria, 
               u.Zona, u.Calle, u.NroLugar, 
               h.Hora_Inicio, h.Hora_Final
        FROM eventos e
        JOIN resultados r ON e.id_resultado = r.Id_Respuesta
        JOIN formulario f ON r.Id_Formulario = f.Id_Formulario
        JOIN categoria c ON e.Id_Categoria = c.Id_Categoria
        JOIN ubicacion u ON e.Id_Ubicacion = u.Id_Ubicacion
        JOIN horarios h ON e.Id_Horario = h.Id_Horario";

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
                    <p><strong>Categoría:</strong> <?php echo htmlspecialchars($resul['Nombre_Categoria']); ?></p>
                    <p><strong>Ubicación:</strong> <?php echo htmlspecialchars($resul['Zona'] . ', ' . $resul['Calle'] . ' ' . ($resul['NroLugar'] ?? '')); ?></p>
                    <p><strong>Horario:</strong> <?php echo htmlspecialchars($resul['Hora_Inicio'] . ' - ' . $resul['Hora_Final']); ?></p>
                    <br>
                </div>
                <div>
                    <p><strong><?php echo htmlspecialchars($resul['Pregunta1']); ?>:</strong> <?php echo htmlspecialchars($resul['Resultado1']); ?></p>
                    <p><strong><?php echo htmlspecialchars($resul['Pregunta2']); ?>:</strong> <?php echo htmlspecialchars($resul['Resultado2']); ?></p>
                    <p><strong><?php echo htmlspecialchars($resul['Pregunta3']); ?>:</strong> <?php echo htmlspecialchars($resul['Resultado3']); ?></p>
                    <p><strong><?php echo htmlspecialchars($resul['Pregunta4']); ?>:</strong> <?php echo htmlspecialchars($resul['Resultado4']); ?></p>
                </div>

            </div>

        <?php endforeach; ?>
        <a href="eventos.php" class="btn btn-primary">Volver</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>