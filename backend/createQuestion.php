<?php
include './connection.php';

// Habilitar el reporte de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $question_text = trim($_POST['question']);
    $option1 = trim($_POST['option1']);
    $option2 = trim($_POST['option2']);
    $option3 = trim($_POST['option3']);
    $option4 = trim($_POST['option4']);
    $correct_option = trim($_POST['correctOption']);
    $created_by = 1; // Cambia esto al ID del usuario que está creando la pregunta, o hazlo dinámico si es necesario

    // Verificar que los datos no estén vacíos
    if (empty($question_text) || empty($option1) || empty($option2) || empty($correct_option)) {
        die("Todos los campos obligatorios deben ser completados");
    }

    // Consulta SQL para insertar la nueva pregunta utilizando declaraciones preparadas
    $stmt = $conn->prepare("
        INSERT INTO questions (question_text, option1, option2, option3, option4, correct_option, created_by) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssi", 
        $question_text, 
        $option1, 
        $option2, 
        $option3, 
        $option4, 
        $correct_option, 
        $created_by
    );

    if ($stmt->execute()) {
        echo "<script>
                document.getElementById('modalMessage').innerText = 'Pregunta creada exitosamente.';
                document.getElementById('confirmationModal').style.display = 'block';
                setTimeout(function() {
                    window.location.href = '../frontend/screen/userProfile.html'; // Cambia esta URL a donde desees redirigir
                }, 2000); // Redirigir después de 2 segundos
              </script>";
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
