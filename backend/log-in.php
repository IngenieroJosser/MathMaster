<?php
    // Incluir la conexión a la base de datos
    include('connection.php');

    // Iniciar la sesión
    session_start();

    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los datos del formulario y sanitizarlos
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        // Preparar la consulta SQL para verificar las credenciales
        $sql = "SELECT id, username, email, password, role FROM users WHERE email = ?";
        
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

                // Redirigir al usuario según su rol
                switch ($user['role']) {
                    case 'Administrador':
                        header("Location: ../frontend/screen/dashboard.html");
                        break;
                    case 'Docente':
                        header("Location: ../frontend/screen/createQuestion.html.html");
                        break;
                    case 'Estudiante':
                        header("Location: ../frontend/screen/viewResults.html");
                        break;
                    default:
                        // Redirigir a una página de error si el rol no es reconocido
                        header("Location: ../frontend/login.html?error=Rol no reconocido.");
                        break;
                }
                exit();
            } else {
                // Contraseña incorrecta, redirigir con un mensaje de error
                header("Location: ../frontend/login.html?error=Contraseña incorrecta.");
                exit();
            }
        } else {
            // Usuario no encontrado, redirigir con un mensaje de error
            header("Location: ../frontend/login.html?error=Usuario no encontrado.");
            exit();
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        // Redirigir si el formulario no fue enviado correctamente
        header("Location: ../frontend/login.html?error=El formulario no se ha enviado correctamente.");
        exit();
    }

    // Cerrar la conexión
    $conn->close();
?>
