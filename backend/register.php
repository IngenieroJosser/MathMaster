<?php
include './connection.php';

// Habilitar el reporte de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir y limpiar los datos del formulario
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Verificar que los datos no estén vacíos
    if (empty($username) || empty($email) || empty($password) || empty($role)) {
        die("Todos los campos son obligatorios");
    }

    // Encriptar la contraseña de manera segura
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if ($hashed_password === false) {
        die("Error al encriptar la contraseña");
    }

    // Consulta SQL para insertar el nuevo usuario utilizando declaraciones preparadas
    $stmt = $conn->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "<script>alert('El nuevo registro $username ha sido creado exitosamente');</script>";
        header("Location: ../frontend/screen/login.html");
        exit(); // Asegúrate de detener la ejecución después de redirigir
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
