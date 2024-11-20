<?php
include('connection.php'); // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $questionId = $_GET['id'];

    // Consultar la pregunta a editar
    $sql = "SELECT * FROM questions WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $questionId);
    $stmt->execute();
    $result = $stmt->get_result();
    $question = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pregunta = $_POST['question'];
    $opcion1 = $_POST['option1'];
    $opcion2 = $_POST['option2'];
    $opcion3 = $_POST['option3'] ?? null;
    $opcion4 = $_POST['option4'] ?? null;
    $opcion_correcta = $_POST['correct_option'];

    // Actualizar la pregunta en la base de datos
    $sql = "UPDATE questions SET question = ?, option1 = ?, option2 = ?, option3 = ?, option3 = ?, correct_option = ? WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $opcion_correcta, $questionId);

    if ($stmt->execute()) {
        header("Location: ../frontend/screen/userAdministration.php"); // Redirigir a la vista de preguntas
    } else {
        echo "<script>alert('Error al actualizar la pregunta');</script>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pregunta - MathMaster</title>
    <link rel="stylesheet" href="../frontend/css/modules/createQuestion.css">
</head>
<body>
    <div class="container-create-question">
        <h1>Editar Pregunta</h1>
        <form action="editQuestion.php?id=<?php echo $questionId; ?>" method="POST">
            <label for="question">Pregunta</label>
            <input type="text" id="question" name="question" value="<?php echo htmlspecialchars($question['question']); ?>" required>
            
            <label for="option1">Opción 1</label>
            <input type="text" id="option1" name="option1" value="<?php echo htmlspecialchars($question['option1']); ?>" required>
            
            <label for="option2">Opción 2</label>
            <input type="text" id="option2" name="option2" value="<?php echo htmlspecialchars($question['option2']); ?>" required>
            
            <label for="option3">Opción 3</label>
            <input type="text" id="option3" name="option3" value="<?php echo htmlspecialchars($question['option3']); ?>">
            
            <label for="option4">Opción 4</label>
            <input type="text" id="option4" name="option4" value="<?php echo htmlspecialchars($question['option4']); ?>">
            
            <label for="correct_option">Opción Correcta</label>
            <select id="correct_option" name="correct_option" required>
                <option value="option1" <?php echo $question['correct_option'] == 'option1' ? 'selected' : ''; ?>>Opción 1</option>
                <option value="option2" <?php echo $question['correct_option'] == 'option2' ? 'selected' : ''; ?>>Opción 2</option>
                <option value="option3" <?php echo $question['correct_option'] == 'option3' ? 'selected' : ''; ?>>Opción 3</option>
                <option value="option4" <?php echo $question['correct_option'] == 'option4' ? 'selected' : ''; ?>>Opción 4</option>
            </select>
            
            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close(); // Cerrar la conexión
?>
