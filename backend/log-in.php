<?php
// Include database connection file
include 'connection.php';

session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check that inputs are not empty
    if (empty($email) || empty($password)) {
        die("Email and password are required");
    }

    // Prepare SQL query to select user by email
    $stmt = $conn->prepare("SELECT id, username, password, role FROM user WHERE email = ?");
    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Redirect based on user role
            if ($_SESSION['role'] == 'Administrador') {
                header("Location: ../frontend/screen/dashboard.html");
            } elseif ($_SESSION['role'] == 'Docente') {
                header("Location: ../frontend/screen/createQuestion.html");
            } elseif ($_SESSION['role'] == 'Estudiante') {
                header("Location: ../frontend/screen/viewResults.html");
            } else {
                echo "Rol no reconocido";
            }
            exit();
        } else {
            echo "Email o contraseña invalida";
        }
    } else {
        echo "Email o contraseña invalida";
    }

    $stmt->close();
}

$conn->close();
?>
