<?php
    session_start();
    // Si el usuario existe procede a hacer verificacion de roles
    if(isset($_SESSION['usuario'])){
        if ($_SESSION['id_rol'] == 1) {
            header("location: tienda.php"); // Redirigir a tienda si es cliente
        } elseif ($_SESSION['id_rol'] == 2) {
            header("location: crud/admin.php"); // Redirigir a la página de admin si es administrador
        }
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicio_Sesion.css">
    <!--Importamos la fuente Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>GreenShop</title>
    <link rel="icon" href="images/1.png">
</head>
<body>

    <!-- Imagen del logo en la esquina superior izquierda -->
    <a href="index.php" class="logo">
        <img src="images/Logo.png" alt="GreenShop Logo">
    </a>

    <!-- Imágenes en las esquinas -->
    <img src="images/img-1.png" alt="Esquina superior derecha" class="corner top-left">
    <img src="images/img-2.png" alt="Esquina inferior derecha" class="corner bottom-left">
    <img src="images/img-3.png" alt="Esquina inferior izquierda" class="corner top-right">
    <img src="images/img-4.png" alt="Esquina superior izquierda" class="corner bottom-right">

    <section class="recuadro">
        <h2>Inicio de Sesión</h2>
        <div class="ingreso_usuario">
            <!--Formulario de inicio de sesion-->
            <form action="php/login_usuario_be.php" class="formulario_login" method="POST">

                <p>Correo Electrónico</p>
                <input type="text" name="correo" required>
         
                <p>Contraseña</p>
                <input type="password" name="contrasenia" required>

                <!--Link de recuperacion de contraseña-->
                <a href="recuperar_Cuenta.html" class="link">¿Olvidaste tu Contraseña?</a>
    
                <button class="inicio_sesion" type="submit">INICIAR SESIÓN</button>
                    
            </form>
        </div>

        <!--Boton para crear una cuenta-->
        <button class="crear_cuenta" onclick="location.href='crear_Cuenta.php'">CREAR CUENTA</button>

    </section>
</body>
</html>