<?php
    // Incluir la conexión a la base de datos
    include('connection.php');

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $question = $_POST['question'];
        $option1 = $_POST['option1'];
        $option2 = $_POST['option2'];
        $option3 = isset($_POST['option3']) ? $_POST['option3'] : NULL;
        $option4 = isset($_POST['option4']) ? $_POST['option4'] : NULL;
        $correctOption = $_POST['correct_option'];

        // Validar que la opción correcta sea una de las opciones proporcionadas
        $valid_options = ['option1', 'option2', 'option3', 'option4'];
        if (!in_array($correctOption, $valid_options)) {
            die("Error: Opción correcta inválida.");
        }

        // Preparar la consulta SQL para insertar la nueva pregunta
        $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_option) 
                VALUES (?, ?, ?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("ssssss", $question, $option1, $option2, $option3, $option4, $correctOption);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Pregunta guardada exitosamente.";
        } else {
            echo "Error en la ejecución de la consulta: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error: El formulario no se ha enviado correctamente.";
    }

    // Cerrar la conexión
    $conn->close();
?>
