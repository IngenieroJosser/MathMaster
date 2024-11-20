<?php
include('connection.php'); // Incluir la conexión a la base de datos

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Consultar los datos del usuario
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - MathMaster</title>
    <link rel="stylesheet" href="../frontend/css/modules/userAdministration.css">
</head>
<body>
    <div class="container-admin-users">
        <h1>Editar Usuario</h1>
        
        <form action="save_user.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <label for="username">Nombre de Usuario</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>

            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="role">Rol</label>
            <select id="role" name="role" required>
                <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
                <option value="docente" <?php echo $user['role'] == 'docente' ? 'selected' : ''; ?>>Docente</option>
                <option value="estudiante" <?php echo $user['role'] == 'estudiante' ? 'selected' : ''; ?>>Estudiante</option>
            </select>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close(); // Cerrar la conexión
?>
