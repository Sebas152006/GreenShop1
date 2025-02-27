<?php
    // Inicia sesion o reanuda una sesion iniciada
    session_start();

    include 'php/verificar_rol.php';

    // Si no hay ninguna sesion iniciada, redirige al usuario al menu inicio de sesion
    if(!isset($_SESSION['usuario'])){
        echo '
            <script>
            alert("Por Favor, Debes Iniciar Sesión");
            window.location = "index.php";
            </script>
        ';
        session_destroy();
        die();
    }
    
    // Verifica si el rol es de Administrador
    verificarRol(2)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Pagina de admin</h1>
    <a href="php/cerrar_sesion.php">Cerrar Sesión</a>
</body>
</html>