<?php
session_start();
include 'php/conexion_be.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit;
}

// Obtener datos del usuario
$usuario = $_SESSION['usuario'];
$query = "SELECT * FROM usuarios WHERE correo_electronico = '$usuario'";
$resultado = mysqli_query($conexion, $query);
$datos_usuario = mysqli_fetch_assoc($resultado);

// Obtener direcciones del usuario
$id_usuario = $datos_usuario['id'];
$query_direcciones = "SELECT * FROM direcciones WHERE usuario_id = $id_usuario";
$resultado_direcciones = mysqli_query($conexion, $query_direcciones);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/perfil.css">
    <!--Importamos la fuente Lato-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900&display=swap" rel="stylesheet">
    <title>GreenShop</title>
    <link rel="icon" href="images/1.png">
</head>
<header>
    <!-- Imagen del logo en la esquina superior izquierda -->
    <a href="tienda.php" class="logo">
        <img src="images/Logo.png" alt="GreenShop Logo">
    </a>

    <a href="php/cerrar_sesion.php" class="cerrar_sesion">Cerrar Sesión</a>

    <!-- Ícono de usuario -->
    <a href="perfil.php" class="usuario">
        <img src="images/Perfil.png" alt="Perfil de Usuario" style="width: 40px;">
    </a>


    <!-- Imagen del carrito de compras -->
    <a href="index.php" class="carrito">
        <img src="images/Carrito.png" alt="Carrito de Compras">
        <span id="contador-carrito" class="carrito-unidades">0</span>
    </a>
</header>
<body>
    <h1>Mi Perfil</h1>
    <?php
        $direcciones = []; // Array temporal para almacenar las direcciones

        // Guardamos los datos en el array
        while ($dir = mysqli_fetch_assoc($resultado_direcciones)) {
            $direcciones[] = $dir;
        }
    ?>

    <div class="datos-personales">
        <h2>Datos Personales</h2>
        <p>Nombre: <?php echo $datos_usuario['nombre_completo']; ?></p>
        <p>Correo: <?php echo $datos_usuario['correo_electronico']; ?></p>
        <p>Numero de Cedula: <?php echo $datos_usuario['documento']; ?></p>
        <?php foreach ($direcciones as $dir) { ?>
            <p>Telefono: <?php echo $dir['telefono_contacto']; ?></p> 
        <?php } ?>
    </div>

    <div class="direcciones">
        <h2>Mis Direcciones</h2>
        <ul>
            <?php foreach ($direcciones as $dir) { ?>
                <li>
                    <?php echo $dir['codigo_postal'] .", ". $dir['direccion'] . ", " . $dir['ciudad'] . ", " . $dir['pais']; ?>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="agregar-direccion">
        <h3>Agregar nueva dirección</h3>
        <form action="php/guardar_direccion.php" method="POST">
            <input type="text" name="direccion" placeholder="Dirección" required><br>
            <input type="text" name="ciudad" placeholder="Ciudad"><br>
            <input type="text" name="departamento" placeholder="Departamento"><br>
            <input type="text" name="pais" placeholder="País"><br>
            <input type="text" name="codigo_postal" placeholder="Código Postal"><br>
            <input type="text" name="telefono_contacto" placeholder="Teléfono"><br>
            <input type="submit" value="Guardar">
        </form>
    </div>

</body>
</html>
