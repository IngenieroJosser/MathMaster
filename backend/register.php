<?php
    // Incluir la conexión a la base de datos
    include('connection.php');

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        // Validar el rol
        $valid_roles = ['Administrador', 'Docente', 'Estudiante'];
        if (!in_array($role, $valid_roles)) {
            die("Error: Rol inválido.");
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar el nuevo usuario
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";

        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro exitoso.";
            // Redirigir a la página de inicio de sesión u otra página
            header("Location: ../frontend/screen/login.html");
        } else {
            echo "Error en la ejecución de la consulta: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();
?>
