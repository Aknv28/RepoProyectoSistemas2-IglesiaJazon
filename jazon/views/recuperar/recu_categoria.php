<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

// Verificar si se envió un ID por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_categoria = $_GET['id'];

    // Actualizar el estado de habilitado a 1
    $sql_update = "UPDATE categoria SET habilitado = 1 WHERE id_categoria = :id_categoria";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':id_categoria', $id_categoria);

    if ($stmt->execute()) {
        echo "<script>
                alert('Categoria recuperado exitosamente');
                window.location.href = '../listas/lst_categorias.php';  // Redirigir a la página de listado o similar
              </script>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error al recuperar categoria: " . $conn->errorInfo()[2] . "</div>";
    }
} else {
    echo "<div class='alert alert-danger text-center'>ID de categoría no válido.</div>";
    exit;
}

?>
