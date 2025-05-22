<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_horario = $_GET['id'];

    // Actualizar el estado de habilitado a 0
    $sql_update = "UPDATE horarios SET habilitado = 0 WHERE id_horario = :id_horario";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':id_horario', $id_horario);

    if ($stmt->execute()) {
        echo "<script>
                alert('Horario deshabilitado exitosamente');
                window.location.href = '../listas/lst_horarios.php';  // Redirigir a la página de listado o similar
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al deshabilitar horario: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de horario no válido.</div>";
    exit;
}

?>
