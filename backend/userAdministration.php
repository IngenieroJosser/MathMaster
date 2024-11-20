<?php
include('connection.php');

header('Content-Type: application/json');

// Obtener todos los usuarios
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $roleFilter = isset($_GET['role']) ? $_GET['role'] : '';
    
    $sql = "SELECT id, username, email, role, created_at FROM users WHERE role LIKE ?";
    $stmt = $conn->prepare($sql);
    
    // Filtrar por rol si se proporciona
    $role = $roleFilter ? $roleFilter : '%';
    $stmt->bind_param("s", $role);
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    $users = [];
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    
    echo json_encode($users);
}

// Crear o actualizar un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['role'])) {
    $id = isset($_POST['id']) ? $_POST['id'] : null;  // Si no se proporciona ID, se crea un nuevo usuario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    
    if ($id) {
        // Actualizar usuario
        $sql = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $username, $email, $role, $id);
    } else {
        // Crear nuevo usuario
        $sql = "INSERT INTO users (username, email, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $role);
    }
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Usuario guardado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al guardar el usuario']);
    }
}

// Eliminar usuario
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo json_encode(['message' => 'Usuario eliminado correctamente']);
    } else {
        echo json_encode(['error' => 'Error al eliminar el usuario']);
    }
}

$conn->close();
?>
