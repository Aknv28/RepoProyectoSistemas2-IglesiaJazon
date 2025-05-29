<?php
require_once '../../includes/bd.php';
$conn = Database::getInstance();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$id_asociado = $_SESSION['aso_id_log'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Respuesta1 = $_POST['Respuesta1'] ;
    $Respuesta2 = $_POST['Respuesta2'] ;
    $Respuesta3 = $_POST['Respuesta3'] ;
    $Respuesta4 = $_POST['Respuesta4'] ;
    $horarios = $_POST['horario'];
    $fechas = $_POST['fecha'] ;
    $ubicaciones = $_POST['ubicacion'];
    $formularios = $_POST['id_formulario'] ;

    $sql = "INSERT INTO respuestas 
            (Respuesta1, Respuesta2, Respuesta3, Respuesta4, Horario, Fecha, Ubicacion, Id_Formulario, Id_Asociado) 
            VALUES 
            (:Respuesta1, :Respuesta2, :Respuesta3, :Respuesta4, :Horario, :Fecha, :Ubicacion, :Id_Formulario, :Id_Asociado)";

    $stmt = $conn->prepare($sql);

        $stmt->bindParam(':Respuesta1', $Respuesta1);
        $stmt->bindParam(':Respuesta2', $Respuesta2);
        $stmt->bindParam(':Respuesta3', $Respuesta3);
        $stmt->bindParam(':Respuesta4', $Respuesta4);
        $stmt->bindParam(':Horario', $horarios);
        $stmt->bindParam(':Fecha', $fechas);
        $stmt->bindParam(':Ubicacion', $ubicaciones);
        $stmt->bindParam(':Id_Formulario', $formularios);
        $stmt->bindParam(':Id_Asociado', $id_asociado);

        if (!$stmt->execute()) {
            echo "<script>alert('Error al insertar la respuesta ');</script>";
        }

    echo "<script>alert('Respuestas guardadas exitosamente');
    window.location.href = '../eventos.php';
    </script>";
}
?>
