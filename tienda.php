<?php
// Inicia sesión o reanuda una sesión iniciada
session_start();
include 'php/verificar_rol.php';
include 'php/conexion_be.php'; // Conexión a la base de datos

// Si no hay ninguna sesión iniciada, redirige al usuario al menú de inicio de sesión
if (!isset($_SESSION['usuario'])) {
    echo '
        <script>
        alert("Por Favor, Debes Iniciar Sesión");
        window.location = "index.php";
        </script>
    ';
    session_destroy();
    die();
}

// Verifica si el rol es de un cliente
verificarRol(1);

// Consulta los productos desde la base de datos
$sql = "SELECT * FROM productos";
$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tienda.css">
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

    <!-- Imagen del carrito de compras -->
    <a href="index.php" class="carrito">
        <img src="images/Carrito.png" alt="Carrito de Compras">
        <span id="contador-carrito" class="carrito-unidades">0</span>
    </a>
</header>

<body>
    <section class="container">
        <?php
        // Mostrar los productos dinámicamente
        while ($producto = mysqli_fetch_array($result)) {
        ?>
        <article>
            <div>
            <div class="imagen">
            <img src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>" 
             alt="<?php echo $producto['nombre']; ?>" >

            </div>

                <div class="precio">
                    <p>COP <?php echo number_format($producto['precio'], 2); ?></p>
                </div>
            </div>

            <div class="contenido">
                <h2><?php echo $producto['nombre']; ?></h2>
                <div class="recuadro">
                    <h3>Descripción</h3>
                    <p><?php echo $producto['descripcion']; ?></p>

                    <!-- Botones de los productos -->
                    <div class="botones">
                        <!-- Botones para cambiar cantidad de productos -->
                        <button onclick="disminuir(this)" class="cantidad-control">-</button>
                        <input class="unidades" type="number" value="1" min="1">
                        <button onclick="incrementar(this)" class="cantidad-control">+</button>
                        <!-- Botón que se encarga de añadir los productos al carrito -->
                        <button class="agregar">AGREGAR AL CARRITO</button>
                    </div>
                </div>
            </div>
        </article>
        <?php
        }
        ?>
    </section>

    <a href="https://web.whatsapp.com/" class="logo-Whatsapp">
        <img src="images/WhatsApp.png" alt="Servicio al Cliente">
    </a>

    <script src="js/script3.js"></script>
</body>

<footer>
    <!-- Formulario para notificaciones de ofertas -->
    <div class="formulario">
        <p>Suscríbete para obtener información de nuestros descuentos</p>
        <form>
            <input type="email" placeholder="Escribe tu correo electrónico" required>
        </form>
    </div>
</footer>
</html>
