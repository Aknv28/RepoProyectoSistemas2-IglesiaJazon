<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre']);
    $habilitado = 1;

    if (!empty($nombre)) {
        $sql = "INSERT INTO categoria (Nombre, habilitado) VALUES (:Nombre, :habilitado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':Nombre', $nombre);
        $stmt->bindParam(':habilitado', $habilitado);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Categoria agregada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar la categoria: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>La categoria no puede estar vacío.</div>";
    }
}
?>
<?php include '../componentes/form_categoria.php'; ?>


