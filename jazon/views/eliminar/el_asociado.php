<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if (isset($_GET['id'])) {
    $id_asociado = $_GET['id'];

    // Actualizar a "inhabilitado" (habilitado = 0) en la tabla asociados
    $sql_asociado = "UPDATE asociados SET habilitado = 0 WHERE Id_Asociado = :id_asociado";
    $stmt_asociado = $conn->prepare($sql_asociado);
    $stmt_asociado->bindParam(':id_asociado', $id_asociado);
    
    // Actualizar a "inhabilitado" en la tabla usuarios (si existe referencia)
    $sql_usuario = "UPDATE usuarios SET habilitado = 0 WHERE id_usuario = (SELECT id_usuario FROM asociados WHERE Id_Asociado = :id_asociado)";
    $stmt_usuario = $conn->prepare($sql_usuario);
    $stmt_usuario->bindParam(':id_asociado', $id_asociado);

    // Actualizar a "inhabilitado" en la tabla contactos (si existe referencia)
    $sql_contacto = "UPDATE contactos SET habilitado = 0 WHERE id_contacto = (SELECT id_contacto FROM asociados WHERE Id_Asociado = :id_asociado)";
    $stmt_contacto = $conn->prepare($sql_contacto);
    $stmt_contacto->bindParam(':id_asociado', $id_asociado);

    try {
        // Ejecutar las actualizaciones
        $conn->beginTransaction();
        $stmt_asociado->execute();
        $stmt_usuario->execute();
        $stmt_contacto->execute();
        $conn->commit();

        // Redirigir después de actualizar
        echo "<script>
                alert('Asociado inhabilitado correctamente');
                window.location.href = '../listas/lst_asociados.php';
              </script>";
        exit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "<div class='alert alert-danger text-center'>Error al inhabilitar el asociado: " . $e->getMessage() . "</div>";
    }
}
?>
