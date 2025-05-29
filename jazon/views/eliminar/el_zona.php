<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_zona = $_GET['id'];

    // Actualizar el estado de habilitado a 0
    $sql_update = "UPDATE zona SET habilitado = 0 WHERE id_zona = :id_zona";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':id_zona', $id_zona);

    if ($stmt->execute()) {
        echo "<script>
                alert('Zona deshabilitado exitosamente');
                window.location.href = '../listas/lst_zonas.php';  // Redirigir a la página de listado o similar
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al deshabilitar zona: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de zona no válido.</div>";
    exit;
}

?>
