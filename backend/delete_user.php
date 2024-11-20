<?php
include('connection.php'); // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        header("Location: ../frontend/screen/userAdministration.php"); // Redirigir a la página de administración de usuarios
        exit;
    } else {
        echo "Error al eliminar el usuario: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close(); // Cerrar la conexión
?>
