<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $Id_Formulario = $_GET['id'];

    // Actualizar el estado de habilitado a 0
    $sql_update = "UPDATE formulario SET habilitado = 0 WHERE Id_Formulario = :Id_Formulario";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':Id_Formulario', $Id_Formulario);

    if ($stmt->execute()) {
        echo "<script>
                alert('Formulario deshabilitado exitosamente');
                window.location.href = '../listas/lst_formularios.php'; 
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al deshabilitar formulario: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de Formulario no válido.</div>";
    exit;
}

?>
