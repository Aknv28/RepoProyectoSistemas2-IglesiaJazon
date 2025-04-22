<?php

include("login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['Nombre'];
    $fecha = $_POST['Fecha'];
    $id_categoria = $_POST['Id_Categoria'];
    $id_ubicacion = $_POST['Id_Ubicacion'];
    $id_horario = $_POST['Id_Horario'];
    
}
?>