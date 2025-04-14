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

// Verifica si el rol es de un cliente
verificarRol(2);

include '../php/conexion_be.php';

include 'actualizar_usuarios.php';

// Filtro de búsqueda
$buscar = isset($_GET['buscar']) ? $_GET['buscar'] : '';
$sql = "SELECT * FROM usuarios";
if (!empty($buscar)) {
    $sql .= " WHERE correo_electronico LIKE '%$buscar%' OR documento LIKE '%$buscar%'";
}

$result = mysqli_query($conexion, $sql);
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/usuarios_admin.css">
        <!--Importamos la fuente Lato-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
            <input type="text" name="buscar" placeholder="Buscar por correo o documento" value="<?php echo $buscar; ?>">
            <button type="submit" class="buscar">Buscar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Rol</th>
                    <th>Id</th>
                    <th>Nombre Completo</th>
                    <th>Correo Electrónico</th>
                    <th>Documento</th>
                    <th>Contraseña</th>
                    <th>Editar</th>
                    <th>Guardar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($mostrar = mysqli_fetch_array($result)) { ?>
                <tr id="fila-<?php echo $mostrar['id']; ?>">
                    <form method="POST" action="">
                        <td><input type="text" name="id_rol" value="<?php echo $mostrar['id_rol']; ?>" disabled></td>
                        <td><input type="text" name="id" value="<?php echo $mostrar['id']; ?>" readonly disabled></td>
                        <td><input type="text" name="nombre_completo" value="<?php echo $mostrar['nombre_completo']; ?>" disabled></td>
                        <td><input type="email" name="correo_electronico" value="<?php echo $mostrar['correo_electronico']; ?>" disabled></td>
                        <td><input type="text" name="documento" value="<?php echo $mostrar['documento']; ?>" disabled></td>
                        <td><input type="password" name="contrasenia" placeholder="Dejar vacío si no se cambia" disabled></td>
                        <td>
                            <button type="button" onclick="habilitarEdicion(<?php echo $mostrar['id']; ?>)"><img src="../images/crud/1.png" alt="Editar"></button>
                        </td>
                        <td>
                            <button type="submit" name="btnGuardar" value="<?php echo $mostrar['id']; ?>" disabled><img src="../images/crud/3.png" alt="Guardar"></button>
                        </td>
                    </form>
                    <td>
                        <form action="eliminar.php" method="POST" class="eliminar2">
                            <input type="hidden" name="txtId" value="<?php echo $mostrar['id']; ?>">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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
