<?php
include('connection.php');
session_start();

// Verificar que el usuario es estudiante
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Estudiante') {
    die("Acceso no autorizado.");
}

// Verificar que el formulario se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_SESSION['user_id']; // ID del estudiante
    $answers = $_POST['answers']; // Respuestas enviadas

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Preparar la consulta
        $sql = "INSERT INTO student_answers (question_id, student_id, selected_option) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        foreach ($answers as $questionId => $selectedOption) {
            $stmt->bind_param("iis", $questionId, $studentId, $selectedOption);
            $stmt->execute();
        }

        // Confirmar la transacción
        $conn->commit();
        echo "Respuestas guardadas exitosamente.";
        header('Location: ../frontend/screen/viewResults.php');
    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        die("Error al guardar respuestas: " . $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Error: No se envió el formulario.";
}
?>
