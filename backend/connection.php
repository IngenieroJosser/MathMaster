<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "mathmaster";

// Crear conexión
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Opcional: Establecer el conjunto de caracteres a UTF-8
$conn->set_charset("utf8");

// Si deseas confirmar que la conexión es exitosa, puedes descomentar la siguiente línea
// echo "Conexión exitosa a la base de datos '$dbname'";

// Recuerda cerrar la conexión cuando hayas terminado de usarla en tu script PHP principal:
// $conn->close();
?>
