<?php
session_start();
include 'php/conexion_be.php';

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

$correo = $_SESSION['usuario'];
$query = "SELECT id FROM usuarios WHERE correo_electronico = '$correo'";
$result = mysqli_query($conexion, $query);
$datos = mysqli_fetch_assoc($result);
$id_usuario = $datos['id'];

$sql = "SELECT p.id, p.nombre, p.descripcion, p.precio, c.cantidad
        FROM carrito_compras c
        JOIN productos p ON c.producto_id = p.id
        WHERE c.usuario_id = $id_usuario";
$resultado = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/carrito.css">
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
    <a href="carrito.php" class="carrito">
        <img src="images/Carrito.png" alt="Carrito de Compras">
        <span id="contador-carrito" class="carrito-unidades">0</span>
    </a>
</header>
<body>
    <h1>Productos En Tu Carrito</h1>

    <!-- Inicializa el total de la compra cuando no hay productos -->
    <?php $total = 0; ?>

    <?php while ($producto = mysqli_fetch_assoc($resultado)) {
        $subtotal = $producto['precio'] * $producto['cantidad'];
        $total += $subtotal;
    ?>
        <div class="contenedor">
            <div>
            <h3><?= $producto['nombre'] ?></h3>
            <p><?= $producto['descripcion'] ?></p>
            <p><strong>Precio:</strong> COP <?= number_format($producto['precio'], 2) ?></p>
            <p><strong>Unidades:</strong> <?= $producto['cantidad'] ?></p>
            <p><strong>Subtotal:</strong> COP <?= number_format($subtotal, 2) ?></p>
            </div>
            
            <!-- Botones para actualizar cantidad y eliminar producto -->
            <button onclick="actualizarCantidad(<?= $producto['id'] ?>, 'sumar')" class="modificador">+</button>
            <button onclick="actualizarCantidad(<?= $producto['id'] ?>, 'restar')" class="modificador">-</button>
            <button onclick="eliminarProducto(<?= $producto['id'] ?>)" class="eliminar">Eliminar Productos</button>
            
        </div>
    <?php } ?>

    <h2>Total a pagar: <span>COP <?= number_format($total, 2) ?></span></h2>

    <script>
        function actualizarCantidad(producto_id, accion) {
            fetch('php/actualizar_cantidad.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ producto_id, accion })
            }).then(() => location.reload());
        }

        function eliminarProducto(producto_id) {
            fetch('php/eliminar_carrito.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ producto_id })
            }).then(() => location.reload());
        }
    </script>
    <script src="js/script3.js"></script>
</body>
</html>
