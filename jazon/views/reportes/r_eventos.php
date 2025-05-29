<?php
// Conexión a la base de datos
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if (isset($_POST['evento'])) {
    $id_evento = $_POST['evento'];
    // Consultar todos los eventos habilitados
    $sql = "SELECT e.Id_Eventos, e.nombre as nomEvento, e.Fecha, e.habilitado, e.Id_Resultado, e.Id_Categoria, e.Id_Ubicacion, e.Id_Horario,
            r.Id_Respuesta, r.Resultado1, r.Resultado2, r.Resultado3, r.Resultado4, r.Horario,
            c.Id_Categoria, c.Nombre as nomCategoria,
            u.Id_Ubicacion, CONCAT(u.Zona, ' ' ,u.Calle, ' ', u.NroLugar) as ubicacion,
            h.Id_Horario, CONCAT(h.Hora_Inicio, ' - ',h.Hora_Final) as horario,
            f.Pregunta1, f.Pregunta2, f.Pregunta3, f.Pregunta4
            FROM eventos as e JOIN resultados as r ON e.Id_Resultado = r.Id_Respuesta 
            JOIN categoria as c ON c.Id_categoria = e.Id_Categoria
            JOIN ubicacion as u ON u.Id_Ubicacion = e.Id_Ubicacion
            JOIN horarios as h ON h.Id_Horario = e.Id_Horario
            JOIN formulario as f ON f.Id_Evento = e.Id_Eventos
            where Id_Eventos = $id_evento AND e.habilitado = 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);
} else {

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

</head>

<body>
    <div class="container mt-5">
        <img src="../../img/logo/logoFinal2.png" alt="" width="200px">

        <h1 class="text-center mb-4">Reporte de eventos</h1>

        <div class="card mt-4">
            <div class="card-header">
                <h3>Reporte del Evento: <?php echo htmlspecialchars($evento['nomEvento']); ?></h3>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <p><strong> <?php echo $evento['Pregunta1']; ?>:</strong> <?php echo $evento['Resultado1']; ?></p>
                <p><strong><?php echo $evento['Pregunta2']; ?>:</strong> <?php echo $evento['Resultado2']; ?></p>
                <p><strong><?php echo $evento['Pregunta3']; ?>:</strong> <?php echo $evento['Resultado3']; ?></p>
                <p><strong><?php echo $evento['Pregunta4']; ?>:</strong> <?php echo $evento['Resultado4']; ?></p>

                <!-- Lista de Niños -->
                <h4 class="mt-4">El evento es un: <?php echo $evento['nomCategoria'] ?></h4>
                <p><strong>Fecha:</strong> <?php echo $evento['Fecha']; ?></p>
                <p><strong>Ubicacion:</strong> <?php echo $evento['ubicacion']; ?></p>
                <p><strong>Horario:</strong> <?php echo $evento['horario']; ?></p>
            </div>
        </div>
        <!-- Botones de acción -->
        <div class="mt-4 text-center no-print">
            <a href="../reportes.php" class="btn btn-primary">Volver a Reportes</a>
            <button class="btn btn-success" onclick="exportToPDF()">Exportar a PDF</button>
        </div>
    </div>

    <!-- Script para Exportar a PDF -->
    <script>
        function exportToPDF() {
            window.print(); // Esta función puede ser modificada para generar un PDF usando una librería como jsPDF
        }
    </script>
</body>

</html>