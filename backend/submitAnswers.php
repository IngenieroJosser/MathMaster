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
        header('Location: ../frontend/screen/thank_you.php');
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

// Acceder a las respuestas del formulario
// Verificar que el usuario tiene el rol de Estudiante
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Estudiante') {
    die("<p>No tienes acceso a esta página.</p>");
}

// Verificar si se han enviado las respuestas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $answers = $_POST['answers']; // Las respuestas enviadas

    // Recorrer las respuestas y almacenarlas en la base de datos
    foreach ($answers as $questionId => $answer) {
        $studentId = $_SESSION['student_id']; // Suponiendo que el ID del estudiante está en la sesión

        // Preparar la consulta para almacenar la respuesta
        $stmt = $conn->prepare("INSERT INTO student_answers (student_id, question_id, answer) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $studentId, $questionId, $answer);

        // Ejecutar la consulta
        if (!$stmt->execute()) {
            echo "Error al guardar la respuesta: " . $stmt->error;
        }
    }

    // Redirigir al estudiante a una página de confirmación (puedes personalizarla)
    header("Location: thank_you.php");
    exit;
} else {
    echo "No se han enviado respuestas.";
}
?>
