<?php
include('../../backend/connection.php'); // Incluir la conexión a la base de datos

// Consultar todos los usuarios
$sql = "SELECT id, username, email, role, created_at FROM users";
$result = $conn->query($sql);

// Consultar todas las preguntas
$sql = "SELECT * FROM questions";
$resultQuestion = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios - MathMaster</title>
    <link rel="stylesheet" href="../css/modules/userAdministration.css">
</head>
<body>
    <div class="container-admin-users">
        <h1> Panel de Administración - MathMaster</h1>
        
        <!-- Barra de búsqueda y filtros -->
        <div class="search-filters">
            <input type="text" id="search" placeholder="Buscar usuario...">
            <!-- <a href="./dashboard.html" class="btn-dashboard">Dashboard</a> -->
            <label for="roleFilter" class="visually-hidden">Filtrar por rol</label>
            <select id="roleFilter">
                <option value="">Todos los roles</option>
                <option value="admin">Administrador</option>
                <option value="docente">Docente</option>
                <option value="estudiante">Estudiante</option>
            </select>
        </div>

        <!-- Tabla de usuarios -->
        <table>
            <thead>
                <tr>
                    <th>Nombre de Usuario</th>
                    <th>Correo Electrónico</th>
                    <th>Rol</th>
                    <th>Fecha de Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                <?php
                if ($result->num_rows > 0) {
                    // Mostrar los datos de los usuarios
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                        echo "<td>
                                <a href='../../backend/edit_user.php?id=" . $row['id'] . "' class='edit-btn'>Editar</a>
                                <a href='../../backend/delete_user.php?id=" . $row['id'] . "' class='delete-btn'>Eliminar</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabla de preguntas -->
        <div class="container-view-questions">
        <h1>Ver Preguntas</h1>
        <table>
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Opciones</th>
                    <th>Opción Correcta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultQuestion->num_rows > 0) {
                    // Mostrar las preguntas
                    while($row = $resultQuestion->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['question']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['option1']) . ", " . htmlspecialchars($row['option2']) . ", " . htmlspecialchars($row['option3']) . ", " . htmlspecialchars($row['option4']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['correct_option']) . "</td>";
                        echo "<td>
                                <a href='../../backend/editQuestion.php?id=" . $row['id'] . "' class='edit-btn'>Editar</a>
                                <a href='../../backend/deleteQuestion.php?id=" . $row['id'] . "' class='delete-btn'>Eliminar</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay preguntas registradas.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- <script src="../js/userAdministration.js"></script> -->
</body>
</html>

<?php
$conn->close(); // Cerrar la conexión
?>
