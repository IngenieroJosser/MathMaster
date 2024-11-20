<?php
include('connection.php'); // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];

    // Eliminar la pregunta
    $sql = "DELETE FROM questions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $questionId);

    if ($stmt->execute()) {
        header("Location: ../frontend/screen/userAdministration.php"); // Redirigir a la vista de preguntas
    } else {
        echo "<script>alert('Error al eliminar la pregunta');</script>";
    }

    $stmt->close();
}

$conn->close(); // Cerrar la conexión
?>
