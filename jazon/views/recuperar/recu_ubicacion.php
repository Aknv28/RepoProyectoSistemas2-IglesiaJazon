<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_ubicacion = $_GET['id'];
    $sql = "UPDATE ubicacion SET habilitado = 1 WHERE Id_Ubicacion = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id_ubicacion);
    // Si no se encuentra la ubicación
    if ($stmt->execute()) {
        echo "<script> alert('Se recupero la ubicacion')
                    window.location.href = '../listas/lst_ubicaciones.php';
        </script>";
    }else {
        echo "<div class='alert alert-danger text-center'>Error al recuperar la ubicacion: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de ubicación no válido.</div>";
    exit;
}
