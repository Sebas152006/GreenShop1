<?php
// Inicia sesión o reanuda una sesión iniciada
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

// Verifica si el rol es de un administrador
verificarRol(2);

include '../php/conexion_be.php'; // Conexión a la base de datos

// Si se envía el formulario, procesamos la adición del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name'])); // Convierte la imagen a binario

        // Inserta el producto en la base de datos
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen) VALUES ('$nombre', '$descripcion', '$precio', '$imagen')";

        if (mysqli_query($conexion, $sql)) {
            echo '<script>alert("Producto agregado con éxito."); window.location = "productos.php";</script>';
        } else {
            echo '<script>alert("Error al agregar el producto.");</script>';
        }
    } else {
        echo '<script>alert("Debes subir una imagen para el producto.");</script>';
    }
}
?>
<!DOCTYPE html> 
<html lang="es"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="../css/productos.css"> 
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
        <h1>Agregar Producto</h1> 
        <form action="agregar.php" method="POST" enctype="multipart/form-data"> 
            <label for="nombre">Nombre del Producto:</label> 
            <input type="text" id="nombre" name="nombre" required><br><br> 
            <label for="descripcion">Descripción:</label> <textarea id="descripcion" name="descripcion" required></textarea><br><br> 
            <label for="precio">Precio (COP):</label> <input type="number" id="precio" name="precio" step="0.01" required><br><br> 
            <label for="imagen">Imagen:</label> <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br> 
            <button type="submit">Guardar Producto</button> 
        </form> 
    </body> 
</html>