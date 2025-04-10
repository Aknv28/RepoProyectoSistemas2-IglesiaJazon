<?php
// Conexión a la base de datos
require_once 'includes/bd.php';
$conn = Database::getInstance();

// Consultar todos los eventos habilitados
$sql = "SELECT * FROM eventos WHERE habilitado = 1";
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
</head>
<body>

    <div class="container mt-5">
        <h1 class="text-center">Eventos de la Iglesia Jazon</h1>

        <?php foreach ($eventos as $evento): ?>
            <div class="event-container mt-4 p-3 border rounded">
                <h2><?php echo htmlspecialchars($evento['Nombre']); ?></h2>
                <p><strong>Fecha:</strong> <?php echo $evento['Fecha']; ?></p>
                <p><strong>Resultado:</strong> <?php echo $evento['Id_Resultado'] ? 'Resultado disponible' : 'Aún no disponible'; ?></p>
                <p><strong>Categoría:</strong> <?php echo $evento['Id_Categoria']; ?></p>
                <p><strong>Ubicación:</strong> <?php echo $evento['Id_Ubicacion']; ?></p>
                <p><strong>Horario:</strong> <?php echo $evento['Id_Horario']; ?></p>
                
                <!-- Botón de sugerencia -->
                <form action="sugerencia.php" method="POST">
                    <input type="hidden" name="evento_id" value="<?php echo $evento['Id_Eventos']; ?>">
                    <button type="submit" class="btn btn-primary">Sugerencia</button>
                </form>
            </div>
        <?php endforeach; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
