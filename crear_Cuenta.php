<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/crear_Cuenta.css">
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

    <section class="registro_usuario">
        <h2>Datos Personales</h2>
        <div class="recuadro">
            <!-- Formulario 1: Datos personales -->
            <form action="php/registro_usuario_be.php" method="POST" class="formulario_registro">
            
                <p>Nombre Completo</p>
                <input type="text" name="nombre_completo" placeholder="Escribe tu nombre" required>

                <p>Correo Electrónico</p>
                <input type="email" name="correo" placeholder="Ejemplo123@gmail.com" required>

                <p>Número de Documento</p>
                <input type="number" name="numero_id" placeholder="Ej:1234567890" required>
                
                <p>Contraseña</p>
                <input type="password" name="contrasenia" placeholder="MiContrasena1234" required>
                
                <button class="control" type="submit">CREAR CUENTA</button>   

            </form>
        </div>     
    </section>
</body>
</html>
