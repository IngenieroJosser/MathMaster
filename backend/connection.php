<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mathmaster"; // Asegúrate de que este nombre coincide con tu base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
?>
