<?php
    session_start();
    include('../../backend/connection.php');

    // Verificar que el usuario tiene el rol de Estudiante
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Estudiante') {
        die("<p>No tienes acceso a esta página.</p>");
    }

    // Consulta para obtener las preguntas creadas por los docentes
    $sql = "SELECT * FROM questions";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Encuesta - MathMaster</title>
    <link rel="stylesheet" href="../css/modules/viewResult.css">
</head>
<body>
    <div class="container">
        <h1>Responder Encuesta</h1>
        <form id="studentAnswersForm" action="../../backend/submitAnswers.php" method="POST" onsubmit="showModal(event)">
            <?php
                // Mostrar las preguntas
                if ($result && $result->num_rows > 0): 
                    while ($row = $result->fetch_assoc()): ?>
                        <div class="question-card">
                            <h2><?php echo htmlspecialchars($row['question'], ENT_QUOTES, 'UTF-8'); ?></h2>
                            <?php for ($i = 1; $i <= 4; $i++): 
                                $optionKey = "option" . $i;
                                if (!empty($row[$optionKey])): ?>
                                    <label>
                                        <input 
                                            type="radio" 
                                            name="answers[<?php echo $row['id']; ?>]" 
                                            value="<?php echo $optionKey; ?>" 
                                            required>
                                        <?php echo htmlspecialchars($row[$optionKey], ENT_QUOTES, 'UTF-8'); ?>
                                    </label><br>
                                <?php endif; 
                            endfor; ?>
                        </div>
                    <?php endwhile;
                else: ?>
                    <p>No hay preguntas disponibles.</p>
                <?php endif; ?>
            <button type="submit" style="padding: 12px 25px; border: none; border-radius: 5px; background-color: var(--color-primary); color: #ffffff; font-size: 16px; cursor: pointer; transition: all .3s ease; display: block; margin: 20px auto;">Enviar Respuestas</button>
        </form>
    </div>

    <!-- Modal for Confirmation -->
    <div id="responseModal" class="modal">
        <div class="modal-content">
            <h2>¡Gracias por tus respuestas!</h2>
            <p>Las respuestas se han enviado correctamente.</p>
            <button onclick="closeModal()">Cerrar</button>
        </div>
    </div>

    <script src="../js/submitAnswers.js"></script>
</body>
</html>

<?php
    $conn->close();
?>
