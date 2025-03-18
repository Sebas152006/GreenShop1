<?php
// Inicia sesión o reanuda una sesión iniciada
session_start();
include '../php/verificar_rol.php';

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

// Verifica si el rol es de administrador
verificarRol(2);

include '../php/conexion_be.php';

// Filtro de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
$sql = "SELECT * FROM productos";
if (!empty($buscar)) {
    $sql .= " WHERE nombre LIKE '%$buscar%' OR descripcion LIKE '%$buscar%'";
}

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/productos_Admin.css">
    <title>GreenShop</title>
    <link rel="icon" href="../images/1.png">
    <script src="../js/script4.js"></script>
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
    <!-- Formulario para filtrar -->
    <form method="GET" action="">
        <input type="text" name="buscar" placeholder="Buscar por nombre o descripción" value="<?php echo $buscar; ?>">
        <button type="submit" class="buscar">Buscar</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Editar</th>
                <th>Guardar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($producto = mysqli_fetch_array($result)) { ?>
            <tr id="fila-<?php echo $producto['id']; ?>">
                <form method="POST" action="actualizar_Producto.php" enctype="multipart/form-data">
                    <td><input type="text" name="id" value="<?php echo $producto['id']; ?>" readonly disabled></td>
                    <td><input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" disabled></td>
                    <td><textarea name="descripcion" id="descripcion-<?php echo $producto['id']; ?>" disabled><?php echo $producto['descripcion']; ?></textarea></td>
                    <td><input type="number" name="precio" value="<?php echo $producto['precio']; ?>" disabled></td>
                    <td>
                        <label for="imagen-<?php echo $producto['id']; ?>">
                            <img src="data:image/jpeg;base64,<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" width="50">
                        </label>
                        <input type="file" id="imagen-<?php echo $producto['id']; ?>" name="imagen" accept="image/*" style="display: none;" disabled>
                    </td>
                    <td>
                        <button type="button" onclick="habilitarEdicion(<?php echo $producto['id']; ?>)"><img src="../images/crud/1.png" alt="Editar"></button>
                    </td>
                    <td>
                        <button type="submit" name="btnGuardar" value="<?php echo $producto['id']; ?>" disabled><img src="../images/crud/3.png" alt="Guardar"></button>
                    </td>
                </form>
                <td>
                    <form action="eliminar_Producto.php" method="POST" class="eliminar2">
                        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            <img class="eliminar" src="../images/crud/2.png" alt="Eliminar">
                        </button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
