<?php
    // Inicia sesion o reanuda una sesion iniciada
    session_start();

    include '../php/verificar_rol.php';

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
    <link rel="stylesheet" href="../css/admin.css">
    <!--Importamos la fuente Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>GreenShop</title>
    <link rel="icon" href="../images/1.png">
</head>
<header>
        <a href="admin.php">Inicio</a>
        <div class="menu">
            <a>Productos</a>
            <div class="submenu">
                <a href="agregar_Productos.php">Agregar Producto</a>
                <a href="catalogo.php">Catálogo</a>
            </div>
        </div>
        <a href="control_Usuarios.php">Usuarios</a>
        <a href="../php/cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesión</a>
    </header>
<body>
    <div>
        <img src="../images/crud/logo_Fondo.png" alt="Logo de GreenShop Admin">
    </div>
</body>
</html>