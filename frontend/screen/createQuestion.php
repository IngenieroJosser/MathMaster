<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pregunta - MathMaster</title>
    <link rel="stylesheet" href="../css/modules/createQuestion.css">
</head>
<body>
    <div class="container-create-question">
        <h1>Crear Pregunta</h1>
        <form id="createQuestionForm" action="../../backend/createQuestion.php" method="POST">
            <label for="question">Pregunta</label>
            <input type="text" id="question" name="question" required>
            
            <label for="option1">Opción 1</label>
            <input type="text" id="option1" name="option1" required>
            
            <label for="option2">Opción 2</label>
            <input type="text" id="option2" name="option2" required>
            
            <label for="option3">Opción 3</label>
            <input type="text" id="option3" name="option3">
            
            <label for="option4">Opción 4</label>
            <input type="text" id="option4" name="option4">
            
            <label for="correct_option">Opción Correcta</label>
            <select id="correct_option" name="correct_option" required>
                <option value="" selected>Selecciona la opción correcta</option>
                <option value="option1">Opción 1</option>
                <option value="option2">Opción 2</option>
                <option value="option3">Opción 3</option>
                <option value="option4">Opción 4</option>
            </select>
            <!-- frontend\screen\createQuestion.html -->
            <button type="submit">Guardar Pregunta</button>
            <a class="viewResultStudents" href="viewResultStudents.php">Ver respuestas de los estudiantes</a>
        </form>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage">Pregunta creada exitosamente.</p>
        </div>
    </div>

    <script src="../js/createQuestion.js"></script>
</body>
</html>
