<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_zona = trim($_POST['nombre_zona']);

    if (!empty($nombre_zona)) {
        $sql = "INSERT INTO zona (NombreZona) VALUES (:nombre_zona)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre_zona', $nombre_zona);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success text-center'>Zona agregada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>Error al agregar zona: " . $conn->errorInfo()[2] . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>El nombre de la zona no puede estar vacío.</div>";
    }
}
?>
<?php include '../componentes/form_zona.php'; ?>
