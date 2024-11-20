<?php
session_start();
include('../../backend/connection.php');

// Verificar que el usuario tiene el rol de Docente
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Docente') {
    die("<p>No tienes acceso a esta página.</p>");
}

// Obtener todas las respuestas de los estudiantes junto con la respuesta correcta y el título de la pregunta
$sql = "SELECT 
            questions.id AS question_id,
            questions.question,
            questions.correct_option,
            users.username AS student_name,
            student_answers.selected_option,
            student_answers.answered_at
        FROM student_answers
        JOIN questions ON student_answers.question_id = questions.id
        JOIN users ON student_answers.student_id = users.id
        WHERE users.role = 'Estudiante'
        ORDER BY student_answers.answered_at";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de la Encuesta - MathMaster</title>
    <link rel="stylesheet" href="../css/modules/viewResultStudents.css">
</head>
<body>
    <div class="container">
        <h1>Resultados de la Encuesta</h1>
        <a href="../../backend/cerrar-sesion.php">Cerrar sesión</a>

        <?php if ($result->num_rows > 0): ?>
            <div class="results">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="result-card">
                        <h2>Pregunta: <?php echo htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p><strong>Estudiante:</strong> <?php echo htmlspecialchars($row['student_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Respuesta seleccionada:</strong> <?php echo htmlspecialchars($row['selected_option'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Fecha de respuesta:</strong> <?php echo htmlspecialchars($row['answered_at'], ENT_QUOTES, 'UTF-8'); ?></p>

                        <?php
                        // Comparar la respuesta seleccionada con la respuesta correcta
                        if ($row['selected_option'] == $row['correct_option']) {
                            echo '<p><strong>Resultado:</strong> Correcta</p>';
                        } else {
                            echo '<p><strong>Resultado:</strong> Incorrecta</p>';
                            echo '<p><strong>Respuesta correcta:</strong> ' . htmlspecialchars($row['correct_option'], ENT_QUOTES, 'UTF-8') . '</p>';
                        }
                        ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No se encontraron respuestas de estudiantes.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
