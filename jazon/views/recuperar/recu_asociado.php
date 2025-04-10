<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se ha enviado un id de asociado para actualizar
if (isset($_GET['id'])) {
    $id_asociado = $_GET['id'];

    // Actualizar el estado de habilitado a 1
    $sql_update = "UPDATE asociados SET habilitado = 1 WHERE id_asociado = :id_asociado";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':id_asociado', $id_asociado);

    if ($stmt->execute()) {
        echo "<script>
                alert('Asociado recuperado exitosamente');
                window.location.href = '../listas/lst_asociados.php';  // Redirigir a la página de listado o similar
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al recuperar asociado: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>No se proporcionó un ID de asociado.</div>";
    exit();
}
?>
