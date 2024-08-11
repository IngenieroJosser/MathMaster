<?php
    // Incluir la conexión a la base de datos
    include('connection.php');

    // Iniciar la sesión
    session_start();

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Preparar la consulta SQL para verificar las credenciales
        $sql = "SELECT id, username, email, password, role FROM user WHERE email = ?";
        
        // Preparar la declaración
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }

        // Vincular los parámetros
        $stmt->bind_param("s", $email);

        // Ejecutar la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se encontró un usuario con ese email
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verificar la contraseña
            if (password_verify($password, $user['password'])) {
                // Guardar la información del usuario en la sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Devolver éxito
                echo "success";
            } else {
                // Contraseña incorrecta
                echo "error: Contraseña incorrecta.";
            }
        } else {
            // Usuario no encontrado
            echo "error: Usuario no encontrado.";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "error: El formulario no se ha enviado correctamente.";
    }

    // Cerrar la conexión
    $conn->close();
?>
