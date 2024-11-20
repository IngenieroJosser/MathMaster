<?php
session_start();

// Verificar que el usuario es estudiante
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Estudiante') {
    die("Acceso no autorizado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gracias por participar</title>
    <script>
        // Redirigir después de 5 minutos (300,000 milisegundos)
        setTimeout(function() {
            window.location.href = "../screen/viewResults.php"; 
        }, 4000); // 300000ms = 5 minutos
    </script>
    <style>
        body {
            font-family: 'Nunito';
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }

        h1 {
            font-size: 30px;
            color: #4CAF50;
        }

        p {
            font-size: 20px;
            color: #555;
        }

        @font-face {
        font-family: 'Nunito';
        src: url('../assets/fonts/Nunito-ExtraLight.ttf');
        }

        h1, 
        h2, 
        h3, 
        h4, 
        h5, 
        h6, 
        p, 
        span, 
        a, 
        li,
        input,
        label,
        button,
        select,
        option,
        th,
        td {
            font-family: 'Nunito';
        }
    </style>
</head>
<body>

    <h1>¡Gracias por formarte en Matemáticas!</h1>
    <p>Tu participación es muy valiosa. Estaremos redirigiéndote a la página de resultados en breve...</p>

</body>
</html>
